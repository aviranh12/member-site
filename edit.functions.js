	  
function seletCource(courseId)
{

	$.post({
      url: 'edit.functions.php',
      type: 'post',
	  //dataType:'JSON', 
      data: {'req': 'seletCource',
			'courseId': courseId
			},
      success: function(stepsNumber, status) {
		  //$("#textareaId").attr("disabled","disabled");
		  //$("#submitId").css('visibility', 'hidden');
			//alert(":)");
			//alert(stepsNumber);
			
			var $dropdown = $("#steps");
			$dropdown
			.find('option')
			.remove().end()
			.append('<option disabled selected value> -- select a step -- </option>')
			
			$('#pages')
			.find('option')
			.remove().end()
			.append('<option disabled selected value> -- select a page -- </option>')
			
			for (var i = 1; i <= stepsNumber; i++) {
				$dropdown.append($("<option />").val(i).text(i));
			}	
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
		alert(err);
      }
    }); // end ajax call
	
	
	
	//alert(partOfId);
}

function seletStep(stepNum)
{

	var courseId = $('#cources').find(":selected").val()
	
	$.post({
      url: 'edit.functions.php',
      type: 'post',
	  //dataType:'JSON', 
      data: {'req': 'seletStep',
			'courseId': courseId,
			'stepNum': stepNum
			},
      success: function(pageNumber, status) {
		  //$("#textareaId").attr("disabled","disabled");
		  //$("#submitId").css('visibility', 'hidden');
			//alert(":)");
			//alert(stepsNumber);
			
			var pages =	$('#pages');
			pages
			.find('option')
			.remove().end()
			.append('<option disabled selected value> -- select a page -- </option>')
			
			
			
			
			for (var i = 1; i <= pageNumber; i++) {
				pages.append($("<option />").val(i).text(i));
			}	
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
		alert(err);
      }
    }); // end ajax call
}


function seletPage(pageNum){

var courseId = $('#cources').find(":selected").val()
var step = $('#steps').find(":selected").val()
	
	$.post({
      url: 'edit.functions.php',
      type: 'post',
	  //dataType:'JSON', 
      data: {'req': 'seletPage',
			'courseId': courseId,
			'stepNum': step,
			'pageNum': pageNum
			},
      success: function(content, status) {
		  //$("#textareaId").attr("disabled","disabled");
		  //$("#submitId").css('visibility', 'hidden');
			//alert(":)");
			//alert(stepsNumber);
			//console.log(content);
			$('#summernote').summernote('code', content);
			
			
	},
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
		alert(err);
      }
    }); // end ajax call
}


function savePage(){

var courseId = $('#cources').find(":selected").val()
var step = $('#steps').find(":selected").val()
var pageNum = $('#pages').find(":selected").val()
var content = $('#summernote').summernote('code');

	
	
	
	$.post({
      url: 'edit.functions.php',
      type: 'post',
	  //dataType:'JSON', 
      data: {'req': 'savePage',
			'courseId': courseId,
			'stepNum': step,
			'pageNum': pageNum,
			'content': content
			},
      success: function(content, status) {
		  //$("#textareaId").attr("disabled","disabled");
		  //$("#submitId").css('visibility', 'hidden');
			//alert(":)");
			//alert(stepsNumber);
			//console.log(content);
			alert(content);
			
			
	},
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
		alert(err);
      }
    }); // end ajax call
	
}