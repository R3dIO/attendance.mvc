function loadSubjects(baseurl,id,type)
{
	var class_id = $('#classdetailth').val();
  if(class_id == 'Select Class') {
    var sub = $('#subjectdetailth');
    sub.empty();
    sub.append($("<option></option>").attr("value",'Select Subject').text('Select Subject'));
  } else {
	$.ajax({
        url : baseurl + "index.php/get_subjects",
        type : "POST",
        dataType:"JSON",
        data : {type:type,faculty_id:id,class_id:class_id},
        success : function(data) {
        	var sub = $('#subjectdetailth');
          sub.empty();
          $.each(data, function(key,value) {
            sub.append($("<option></option>").attr("value",key).text(value));
          });
        }
    })
}
}