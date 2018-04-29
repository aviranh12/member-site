<?php

require_once "header.php";

if (isLoggedIn())
{
   $u = $_SESSION['username'];

	$userFromDb =  getUserById($uid);
	
	if ($userFromDb["user_type"] == 0) //admin
	{
		if (isset( $_POST['req'])) {
			$req = $_POST['req'];
			$res = '';
			if ('seletCource' == $req) {
				$courseId = $_POST['courseId'];
				
				 //cho $courseId;//on_encode(array("courseId"=>'courseId'));
				$res =  getNumberOfSteps($courseId);
				
			}
			if ('seletStep' == $req) {
				$courseId = $_POST['courseId'];
				$stepNum = $_POST['stepNum'];
				$res = getNumberOfPageStep($courseId, $stepNum);				
			}
			if ('seletPage' == $req) {
				$courseId = $_POST['courseId'];
				$stepNum = $_POST['stepNum'];
				$pageNum = $_POST['pageNum'];
				$res = getPage($courseId, $stepNum, $pageNum);
				if ($res) {
					$res = $res["content"];
				}				
				
			}
			if ('savePage' == $req) {
				$courseId = $_POST['courseId'];
				$stepNum = $_POST['stepNum'];
				$pageNum = $_POST['pageNum'];
				$content = $_POST['content'];
				
				if ($courseId && $stepNum && $pageNum && $content) {
				//$res = $content;
				
				///////////////////////////////////
						 $query = sprintf("UPDATE step_pages
							 SET		 content = '%s'
							WHERE course_id = '%s' AND step_num = '%s' AND page_num = '%s' ",
								mysql_real_escape_string($content),
								mysql_real_escape_string($courseId),
								mysql_real_escape_string($stepNum),
								mysql_real_escape_string($pageNum));
							//echo $query.'<br>';
							//return;
							
							$con = getUpdateConnection();
								if (mysql_query($query,$con))
							   {
									//echo "sucess";
									$res = $query.'sucess';
								}
								else
								{				//echo "no sucess";
								$res = mysql_errno($con) . ": " . mysql_error($con) . "\n";
									//$res = 'no sucess';
								}
					 
				///////////////////////////////////
				}
				
			}
		
			
			ob_clean();
			echo $res;
		}
	}
}




function getNumberOfSteps($courseId)
 {

	$query = sprintf("SELECT COUNT(*) as numberOfSteps
					FROM steps
					WHERE course_id = '%s'",
	mysql_real_escape_string($courseId));

	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());


	$row = mysql_fetch_assoc($result);

	return $row['numberOfSteps'];
 }