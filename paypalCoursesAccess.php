
<?php

error_reporting(0);
require_once ('login.functions.inc.php');
require_once ('mail.functions.inc.php');

$rec = $_GET;

if (count($_POST)) {
  $rec = $_POST;
}

if (count($rec)) {

$username = $rec['username'];

$item_number = $rec['item_number'];

$coursesId = getCoursesIdByItemNumbers($item_number);


//echo $username ,' <br/><br/>';


  $error = '';
  $password = rand(1001,9999);

  $id = -1;

  $userWasExists = false;

 

  $user = getUserByName($username);

//var_dump($user);

  if ($user)
  {
    //echo '<br/>userWasExists<br/>';
    $userWasExists = true;
    $id = $user["user_id"];
    $password = $user["password"];
  }
  else
  {
    $sql = sprintf("insert into users (username,password,disabled) value ('%s','%s', 0)",
      mysql_real_escape_string($username),
      mysql_real_escape_string($password));


    mysql_query($sql, getInsertConnection());

    //echo $sql,' <br/><br/>';
    /*if (!$resultofthie)
    {
     $error.= 'Error_in_creating_user';
      echo '<br/>Error_in_creating_user<br/>';

    }*/


  }

  $user = getUserByName($username);

  if ($user)
  {
    $id = $user["user_id"];
  }


  if ($id  != -1)
  {
      //echo '<br/>id  != -1<br/>';

    $coursesArry = array_filter(explode(',',  $coursesId));

    foreach ($coursesArry as $course_id)
    {
      //echo '<br/>i am here<br/>', $course_id;

      $error.= $course_id. '-'. openCourseToUser($id,$course_id). '; ';
    }
  }
  else
  {
    $error.= 'Error_in_creating_user';
  }

  if ($error != 'Error_in_creating_user') {
  	
    $emailSend;
    if ($userWasExists)
    {
       $emailSend = sendUpdateAccountEmail($username, $password);
    }
    else
    {
      //echo 'sendNewAccountEmail',' <br/><br/>';

       $emailSend = sendNewAccountEmail($username, $password);
    }
    
    if (!$emailSend)
    {
    $error.= ' email not send';
    }
    
    
  }
      //echo "<br/>{$error}<br/>";
  if ($error){
      echo $error;
    }
    else 
    {
      echo 'OK';
    }
}


function getUserByName($userNameInner)
{
  $con = getSelectConnection();
  //echo 'in func ', $userNameInner,' <br/><br/>';
  $query = sprintf("SELECT *
          FROM users
          WHERE username = '%s'",
  mysql_real_escape_string($userNameInner));

  $result = mysql_query($query, $con);


  $row = mysql_fetch_assoc($result);

//echo 'getUserByName result '.$query;
//var_dump($row);
//echo ' <br/><br/>';

  return $row;
}


function getCoursesIdByItemNumbers($itemNumbers)
{
	$con = getSelectConnection();

	$itemNumbersAfterEscape = mysql_real_escape_string($itemNumbers);
	$itemNumbersAfterReplace = str_replace(",", "','",  $itemNumbersAfterEscape);
	$item_numbersForQuery = "'".$itemNumbersAfterReplace."'";

	$query = sprintf("SELECT course_id
	FROM courses 
	WHERE item_number in (%s)",
	$item_numbersForQuery);

	$result = mysql_query($query, $con);

	$row = mysql_fetch_assoc($result);

	$coursesId = '';

	while($row)
	{
		$coursesId.=($row["course_id"].',');

		$row = mysql_fetch_assoc($result);
	}
	
	return $coursesId ;
}
