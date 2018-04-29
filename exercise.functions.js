function sendExercise()
{
	answere = $("#textareaId").val();

	userId = $("#userId").val();
	courseId = $("#courseId").val();
	stepNum = $("#stepNum").val();

	$.post({
      url: 'exercise.functions.php',
      type: 'post',
      data: {'answere': answere,
				'userId': userId,
				'courseId': courseId,
				'stepNum': stepNum
			},
      success: function(data, status) {
		  $("#textareaId").attr("disabled","disabled");
		  $("#submitId").css('visibility', 'hidden');
			alert(":)");
			//alert(data);
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
		alert(err);
      }
    }); // end ajax call



}