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
  username = $('#username').val();
  password = $('#password').val();

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