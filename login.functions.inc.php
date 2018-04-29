<?php
require_once ('db_connect.inc.php');
#### Login Functions #####

function isLoggedIn()
{
    if (isset($_SESSION['user_id']) && isset($_SESSION['username']))
    {
			return true; // the user is loged in
    } else
    {
			return false; // not logged in
    }

    return false;

}

function checkLogin($u, $p)
{
//global $seed; // global because $seed is declared in the header.php file



    if (!valid_password($p) || !user_exists($u))
    {
        return false; // the name was not valid, or the password, or the username did not exist
    }



  $p = mysql_real_escape_string($p);
  $u = mysql_real_escape_string($u);
    //Now let us look for the user in the database.
    $query = sprintf("
		SELECT user_id
		FROM users
		WHERE
		username = '$u' AND password = '$p'
		AND disabled = 0
		LIMIT 1;");


    $result = mysql_query($query, getSelectConnection());
    // If the database returns a 0 as result we know the login information is incorrect.
    // If the database returns a 1 as result we know  the login was correct and we proceed.
    // If the database returns a result > 1 there are multple users
    // with the same username and password, so the login will fail.

    if (mysql_num_rows($result) != 1)
    {
        return false;
    } else
    {
        // Login was successfull
        $row = mysql_fetch_array($result);
        // Save the user ID for use later
        $_SESSION['user_id'] = $row['user_id'];
        // Save the username for use later
        $_SESSION['username'] = $u;
        // Now we show the userbox
        return true;
    }
    return false;
}

 function isUserAlowToStep($userId,$courseId, $stepNum) {

	$query = sprintf("SELECT MAX(step_num) FROM user_steps WHERE user_id = '%s' and course_Id = '%s'",
		mysql_real_escape_string($userId), mysql_real_escape_string($courseId));

	//echo '<br>query : '.$query.'<br><br>';

	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);

	if ($row['MAX(step_num)'] == null)
	{
		return false;
	}
	else
	{
		if ($row['MAX(step_num)'] >= $stepNum)
		{

			return true;
		}
		else
		{
			return false;
		}
	}
}
 function isUserAlowToCourse($userId, $courseId) {

	$query = sprintf("SELECT count(*) FROM users_permission WHERE user_id = '%s' and course_id = '%s' and allowed = 1",
		mysql_real_escape_string($userId), mysql_real_escape_string($courseId));

	//echo '<br>query : '.$query.'<br><br>';

	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);

	if ($row['count(*)'] == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

 function openStepToUser($userId,$courseId, $stepNum)
 {
	 if (isStepExist($courseId, $stepNum))
	 {
		//echo 'openStepToUser!!!';
		//echo 'stepNum='.$stepNum;
		$query = sprintf("SELECT step_num FROM user_steps WHERE user_id = '%s' and step_num = '%s' and course_Id =  '%s'",
			mysql_real_escape_string($userId), mysql_real_escape_string($stepNum),mysql_real_escape_string($courseId));


		//echo $query.'<br>';
		$result = mysql_query($query, getSelectConnection());


		$row = mysql_fetch_assoc($result);


		if ($row['step_num'] != null)
		{
			//echo 'the user is alredy alowed';
			return false;
		}
		else
		{

			$sqlInsert = sprintf("insert into user_steps (user_id,	step_num,course_Id, time_step_open ) value ('%s','%s','%s','%s')",
			mysql_real_escape_string($userId), mysql_real_escape_string($stepNum),mysql_real_escape_string($courseId), date('Y-m-d H:i:s'));

	 // echo $sqlInsert;

			if (mysql_query($sqlInsert,getInsertConnection()))
		    {
				//echo "sucess";
				return true;
			}
			else
			{
				//echo "no sucess";
				return false;
			}
		}
	}
 }

function isStepExist($courseId, $stepNum)
{
	$query = sprintf("SELECT step_num
					  FROM steps
					  WHERE step_num = '%s' and
					  course_Id =  '%s'",
		mysql_real_escape_string($stepNum), mysql_real_escape_string($courseId));


	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);
	return( $row["step_num"] == $stepNum);
}


 function exerciseFromUser($userId,$courseId, $stepNum, $answere, $answere_read_only){
	 $query = sprintf("UPDATE user_steps
	     SET		 user_response = '%s',answere_read_only = '%s'
		WHERE user_id = '%s' and course_Id = '%s' and step_num = '%s' ",
			mysql_real_escape_string($answere),
			mysql_real_escape_string($answere_read_only),
			mysql_real_escape_string($userId),
			mysql_real_escape_string($courseId),
			mysql_real_escape_string($stepNum));
		//echo $query.'<br>';
		//return;
		
		$con = getUpdateConnection();
			if (mysql_query($query,$con))
		   {
				//echo "sucess";
				return true;
			}
			else
			{				//echo "no sucess";
			//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
				return false;
			}
 }

 function getUserStep($userId,$courseId, $stepNum)
 {

	$query = sprintf("SELECT *
	FROM user_steps
	WHERE user_id = '%s' and course_Id = '%s' and step_num = '%s' ",
		mysql_real_escape_string($userId),mysql_real_escape_string($courseId), mysql_real_escape_string($stepNum));
	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());


	$row = mysql_fetch_assoc($result);

	return $row;
 }


  function getPathsStepsOfUser($userId)
 {
	$query = sprintf("SELECT   c.course_name , us.course_id , us.step_num, s.step_name
					  FROM     user_steps us, courses c, steps s
					  WHERE     c.course_id = us.course_id AND
								us.course_Id = s.course_id AND
								us.step_num = s.step_num AND
								us.user_id = '%s'
					  ORDER BY us.course_id ASC, us.step_num ASC",
		mysql_real_escape_string($userId));
	//echo '<br><br><br><br><br><br>'.$query.'<br><br><br><br><br>';
	$result = mysql_query($query, getSelectConnection());

//desc   ASC
	//$row = mysql_fetch_assoc($result);

	return $result;
 }

 
 function getAllCourses()
 {

 $query = sprintf("SELECT course_id, course_name
					  FROM   courses
					  ");
	//echo '<br><br><br><br><br><br>'.$query.'<br><br><br><br><br>';
	$result = mysql_query($query, getSelectConnection());
	return $result;
//desc   ASC
	$row = mysql_fetch_assoc($result);
	return $row;
 }
 
function newGetPathsStepsOfUser($userId)
 {
 	$userId = mysql_real_escape_string($userId);
	$query = sprintf("SELECT c.course_name , us.course_id , us.step_num, s.step_name
									  FROM   user_steps us, courses c, steps s, users_permission up
									  WHERE  up.user_id = '%s'  and
				                   up.allowed > 0 and
				                   up.course_id = c.course_id and
												   c.course_id = us.course_id AND
													 us.course_Id = s.course_id AND
													 us.step_num = s.step_num AND
													 us.user_id = '%s'
									  ORDER BY us.course_id ASC, us.step_num ASC",
		$userId,$userId);
	//echo '<br><br><br><br><br><br>'.$query.'<br><br><br><br><br>';
	$result = mysql_query($query, getSelectConnection());

//desc   ASC
	$row = mysql_fetch_assoc($result);

	$map;

	while ($row)
	{
		if (!$map[$row["course_id"]])
		{
		  $map[$row["course_id"]] = array();
		}

		array_push($map[$row["course_id"]], $row);



		$row = mysql_fetch_assoc($result);
	}

	return $map;
 }

  function getStep($courseId, $stepNum)
 {
	$query = sprintf("SELECT *
	FROM steps
	WHERE course_id = '%s' and step_num = '%s' ",
		mysql_real_escape_string($courseId),
		mysql_real_escape_string($stepNum));
	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());


	$row = mysql_fetch_assoc($result);

	return $row;
 }

 function isUserCanFillTheExercise($userId,$courseId,$stepNum)
 {

	$userStep =  getUserStep($userId,$courseId,$stepNum);

	$diff  = leftSecondsForStep($userId,$courseId,$stepNum);

	if ($diff > 0)
	{
		//echo 'the time is not erive yet';
		return false;
	}
	 $answere_read_only = $userStep['answere_read_only'];

	if ($answere_read_only)
	{
		//echo 'the fild define as read only';
		return false;
	}
	return true;

 }
 function leftSecondsForStep($userId,$courseId,$stepNum)
 {

	 $userStep =  getUserStep($userId,$courseId,$stepNum);
	$step = getStep($courseId,$stepNum);

	$time_step_open =    new DateTime( $userStep['time_step_open']);

	$minimum_day_for_step = $step['minimum_day_for_step'];

	$timeNow  = new DateTime();

	if ($minimum_day_for_step <= 0 )
	{
		return 0;
	}
	$timeExpire =    $time_step_open->add(new DateInterval('P'.$minimum_day_for_step.'D'));



	$diff  = $time_step_open->getTimestamp() - $timeNow->getTimestamp();
	return $diff;
 }

 function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a '.lang('days').
    																', %h '.lang('hours').
    																', %i '.lang('minutes').
    																' '.lang('and').
    																 ' %s '.lang('seconds'));
}

function isTheStepIsOver($userId,$courseId,$stepNum){

	if (leftSecondsForStep($userId,$courseId,$stepNum) > 0)
	{
		return false;
	}

	$step = getStep($courseId, $stepNum);

	if (!$step['need_admin_approval'])
	{
	//echo 'dont need admin approval';
		return true;
	}

	$user = getUserById($userId);
	if (!$user['need_admin_approval'])
	{
	//echo 'user dont need admin approval';
		return true;
	}
	$userStep = getUserStep($userId,$courseId, $stepNum);

	$is_admin_approve = $userStep['is_admin_approve'];


	if ($is_admin_approve)
	{
		return true;
	}

	return false;
}

 function getUserById($userId)
 {
	$query = sprintf("SELECT *
					FROM users
					WHERE user_id = '%s'",
	mysql_real_escape_string($userId));
	$result = mysql_query($query, getSelectConnection());


	$row = mysql_fetch_assoc($result);

	return $row;
 }



function getUserResponsesThatWaitToAnswer()
{
	$query = sprintf("SELECT
						us.user_id,
						us.step_num,
						us.user_response,
						us.admin_answer,
						us.time_step_open,
						us.answere_read_only,
						us.course_Id,
						us.is_admin_approve
				FROM     user_steps us, steps st, users u
				WHERE
					st.course_id = us.course_Id and
					us.user_id = u.user_id and
					st.step_num = us.step_num and
					st.need_admin_approval and
					us.is_admin_approve = 0 and
					u.need_admin_approval = 1 and
					us.answere_read_only = 1 ");
	$result = mysql_query($query, getSelectConnection());




	return $result;
}

function isCourseExist($courseId)
{
	$query = sprintf("SELECT course_id
					  FROM courses
					  WHERE course_id = '%s' ",
		 mysql_real_escape_string($courseId));


	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);
	return( $row["course_id"] == $courseId);
}

 function openCourseToUser($userId,$courseId)
 {
	 if (!isCourseExist($courseId))
	 {
		 return 'The course '.$courseId.' is not exist';
	 }

	if (isUserAlowToCourse($userId, $courseId))
	{
		return '';
	}

  //echo 'openCourseToUser <br/>';
	//echo "userId=".	$userId." courseId ".$courseId;
	$sqlInsert = sprintf("insert into users_permission
						(user_id, course_id, allowed ) value ('%s','%s','%s')",
	mysql_real_escape_string($userId), mysql_real_escape_string($courseId),1);

	mysql_query($sqlInsert, getInsertConnection());

	openStepToUser($userId,$courseId, 1);

   return '';
 }

 function getCoursesOfUser($userId)
 {
	$query = sprintf("SELECT c.*,

							 s.first_page
					  FROM   users_permission up,
							 courses c ,
							 steps s
					  WHERE  up.allowed = 1 AND
							 up.user_id = '%s' AND
							 up.course_id = c.course_id AND
							 c.course_id = s.course_id AND
							 s.step_num = 1 ",
							 mysql_real_escape_string($userId));
	$result = mysql_query($query, getSelectConnection());

	return $result;
 }


function getNotAllowedCoursesOfUser($userId)
 {
	$query = sprintf("SELECT * FROM courses
										WHERE course_id NOT IN
											(SELECT course_id
											 FROM users_permission
											 WHERE user_id = '%s')",
							 mysql_real_escape_string($userId));
	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);

	$courses = array();
	//$index = 0;
	while($row)
	{
		array_push($courses,$row);
		/*$courses[$index] = $row;
		$index++;*/
		$row = mysql_fetch_assoc($result);

	}

/*	$arrlength = count($courses);
for($x = 0; $x < $arrlength; $x++) {
    var_dump( $courses[$x]);
    echo "<br>";
}*/
//var_dump($courses);

	return $courses;
 }


/*
 function showLogoDiv($courseId, $stepNum)
 {
	 echo '<div id="logo" class="panel-heading"> ';
	 echo '<img src="http://greissdesign.com/wp-content/uploads/2012/09/free-images1-big.jpg"  height="42" width="42">';


	 echo '</div>';
 }*/


 function getPage($courseId, $stepNum, $pageNum)
 {

	$query = sprintf("SELECT content
					FROM step_pages
					WHERE course_id = '%s' and
					      step_num = '%s' and
						  page_num = '%s'",
	mysql_real_escape_string($courseId),
	mysql_real_escape_string($stepNum),
	mysql_real_escape_string($pageNum));
	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());


	$row = mysql_fetch_assoc($result);

	return $row;
 }

function isTheStepCanShow($courseId, $stepNum)
{
	if (isLoggedIn())
	{
		$userId = $_SESSION['user_id'];

		if (isUserAlowToCourse($userId, $courseId))
		{
			if  (isUserAlowToStep($userId, $courseId,$stepNum))
			{
				return true;
			}
			else if ($stepNum == 1)
			{
				openStepToUser($userId,$courseId, $stepNum);
				return true;
			}
		}
	}

	return false;
}
function isRtl()
{
	$query = sprintf("SELECT rtl FROM configuration LIMIT 1");
	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);

	//$row = mysql_fetch_assoc($result);

	return $row["rtl"];
}

function getLanguage()
{
	$query = sprintf("SELECT language FROM configuration LIMIT 1");
	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);

	return $row["language"];
}

function getShowOnlyActiveCourseIndecator()
{
	$query = sprintf("SELECT show_only_active_course FROM configuration LIMIT 1");
	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());

	$row = mysql_fetch_assoc($result);

	//$row = mysql_fetch_assoc($result);

	return $row["show_only_active_course"];
}

 function getNumberOfPageStep($courseId, $stepNum)
 {

	$query = sprintf("SELECT COUNT(page_num) as numberOfPage
					FROM step_pages
					WHERE course_id = '%s' and
					      step_num = '%s'",
	mysql_real_escape_string($courseId),
	mysql_real_escape_string($stepNum));

	//echo $query.'<br>';
	$result = mysql_query($query, getSelectConnection());


	$row = mysql_fetch_assoc($result);

	return $row['numberOfPage'];
 }
?>