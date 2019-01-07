function loadSubjects(baseurl,id,type)
{
	var class_id;
  if(type == 'theory') 
    class_id = $('#classdetailth').val();
  else if(type == 'lab')
    class_id = $('#classdetaillb').val();
  if(class_id == 'Select Class') {
    var sub = $('#subjectdetailth');
    sub.empty();
    sub.append($("<option></option>").attr("value",'Select Subject').text('Select Subject'));
  } else if(class_id == 'Select Lab') {
    var sub = $('#subjectdetaillb');
    sub.empty();
    sub.append($("<option></option>").attr("value",'Select Subject').text('Select Subject'));
  } else {
    if(type == 'theory') {
      $('#newth').prop('disabled',true);
      $('#viewth').prop('disabled',true);
    }
    else if(type == 'lab') {
      $('#newlb').prop('disabled',true);
      $('#viewlb').prop('disabled',true);
    }

	$.ajax({
        url : baseurl + "index.php/get_subjects",
        type : "POST",
        dataType:"JSON",
        data : {type:type,faculty_id:id,class_id:class_id},
        success : function(data) {
        	var sub;
          if(type == 'theory') {
            sub = $('#subjectdetailth');
            $('#newth').prop('disabled',false);
            $('#viewth').prop('disabled',false);
          }
          else if(type == 'lab') {
            sub = $('#subjectdetaillb');
            $('#newlb').prop('disabled',false);
            $('#viewlb').prop('disabled',false);
          }
          sub.empty();
          $.each(data, function(key,value) {
            sub.append($("<option></option>").attr("value",key).text(value));
          });
        }
    })
}
}

function login_faculty(baseurl) {
  var username = $('#username').val();
  var password = $('#password').val();

  re = /^\w+$/;
  reg = /[a-z]/;
  if(username == "") {
      alert("Error: Username cannot be blank!");
      $('#username').focus();
    }
   else if(!re.test(username)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      $('#username').focus();
    }
    else if(password == "") {
      alert("Error: Password cannot be blank!");
        $('#password').focus();
    }
   else if(password.length < 6) {
        alert("Error: Password must contain at least six characters!");
        $('#password').focus();
      }
    else if(password == username) {
        alert("Error: Password must be different from Username!");
        $('#password').focus();
      }
    else if(!reg.test(password)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        $('#password').focus();
      }
    else {
      $('#login-submit').html('Logging In...');
      $('#login-submit').prop('disabled',true);

      $.ajax({
        url : baseurl + "index.php/verify_faculty",
        type : "POST",
        data : {username:username,password:password},
        success : function(data) {
          if (data == 'success') {
            window.location.replace(baseurl+"index.php/selector");
          } else {
            $('#login-submit').html('Log In');
            $('#login-submit').prop('disabled',false);
            $('#error_msg').html('Incorrect username or password!!');
          }
        }
    })
    }
}

function save_attendance(baseurl) {
  var date = $('#datePicker').val();
  var checked = [];
  $.each($("input[name='attendanceRecords[]']:checked"), function(){
    checked.push($(this).val());
  });
  var cnf;
  if (checked.length == 0) 
    cnf = confirm("Mark all absent!!");
  else cnf = true;

  if (cnf) {
    $.ajax({
          url : baseurl + "index.php/save_attendance",
          type : "POST",
          data : {date:date,attendanceRecords:checked},
          success : function(data) {
            if (data == 'saved') {
              alert("Records Saved Successfully!!");
              window.location.replace(baseurl+"index.php/class_selector");
            } else alert("Records Not Saved. Please Try Again!!");
          }
      })
  }
}

function relative_view(baseurl) {
  var limit = $("input[name='limit']").val();
  var classdetail = $("input[name='classdetail']").val();
  var subjectdetail = $("input[name='subjectdetail']").val();
  var batch = $("input[name='batch']").val();
  var dateEdit = $("input[name='dateEdit']:checked").val();

  if(!dateEdit && limit>0)
    alert('Please Select any date!!');
  else {
    $('#tabpage').html('<br><br><br><h4>Loading...</h4><br><br><br><br><br>');
    $.ajax({
          url : baseurl + "index.php/view_attendance",
          type : "POST",
          dataType:"JSON",
          data : {limit:limit,relative:1,classdetail:classdetail,subjectdetail:subjectdetail,batch:batch,dateEdit:dateEdit},
          success : function(data) {
            $('#tabpage').html(data.table);
            init_table(data.div);
            table.reload();
          }
      })
  }
}

function generate_pdf(baseurl,schedule) {
  $.ajax({
          url : baseurl + "index.php/ViewAttendance/generate_report",
          type : "POST",
          data : {schedule_id:schedule},
          success : function(data) {
            var element = document.createElement('a');
            element.setAttribute('href',baseurl+'reports/'+data);
            element.setAttribute('download',data);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
            setTimeout(function() {
              $.post(baseurl+"index.php/ViewAttendance/delete_report",{
                        name:data
                      }, function(data){});
            },5000);
          },
          error : function(xhr,status,error) {
            console.log(error);
          }
      })
}

function generate_full_report(baseurl) {
  var class_id = $('#class_id').val();
  var from = $('#datePicker1').val();
  var to = $('#datePicker2').val();

  if(from == to)
    alert('Please select two different dates!!');
  else if(from > to)
    alert('From date must be older than To date!!');
  else {
    $.ajax({
          url : baseurl + "index.php/Selector/full_report_pdf",
          type : "POST",
          data : {class_id:class_id,from:from,to:to},
          success : function(data) {
            var element = document.createElement('a');
            element.setAttribute('href',baseurl+'reports/'+data);
            element.setAttribute('download',data);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
            setTimeout(function() {
              $.post(baseurl+"index.php/ViewAttendance/delete_report",{
                        name:data
                      }, function(data){});
            },5000);
          },
          error : function(xhr,status,error) {
            console.log(error);
          }
      })
  }
}