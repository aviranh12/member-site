
function a(partOfId)
{
	var user_id = '#user_id-' + partOfId;
	var course_Id = '#course_Id-' + partOfId;
	var step_num = '#step_num-' + partOfId;
	var checkbox = '#checkbox-' + partOfId;
	var adminAnswere = '#adminAnswere-' + partOfId;

	user_id = $(user_id).val();
	course_Id = $(course_Id).val();
	step_num = $(step_num).val();
	adminAnswere = $(adminAnswere).val();

	var approve = ($(checkbox).is(':checked'));

	$.post({
      url: 'approve.php',
      type: 'post',
      data: {'user_id': user_id,
	  'course_Id': course_Id,
	  'step_num': step_num,
	  'approve': approve,
	  'adminAnswere': adminAnswere},
      success: function(data, status) {
      var tr = '#tr-' + partOfId;
	  $(tr).remove();

      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
		alert(err);
      }
    }); // end ajax call
}
