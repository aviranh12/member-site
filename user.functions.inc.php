<?php
 require_once ('db_connect.inc.php');
##### User Functions #####

function changePassword($username,$currentpassword,$newpassword,$newpassword2){
global $seed;
	if (!valid_email($username) || !user_exists($username))
    {
        return false;
    }
    if (! valid_password($newpassword,2) || ($newpassword != $newpassword2)){

		return false;
	}

	// we get the current password from the database
    $query = sprintf("SELECT password FROM users WHERE username = '%s' LIMIT 1",
        mysql_real_escape_string($username));

    $result = mysql_query($query, getSelectConnection());
	$row= mysql_fetch_row($result);

	// compare it with the password the user entered, if they don't match, we return false, he needs to enter the correct password.
	if ($row[0] != $currentpassword){

		return false;
	}

	// now we update the password in the database
    $query = sprintf("update users set password = '%s' where username = '%s'",
        mysql_real_escape_string($newpassword), mysql_real_escape_string($username));

    if (mysql_query($query))
    {
		return true;
	}else {return false;}
	return false;
}


function user_exists($username)
{
    if (!valid_email($username))
    {
        return false;
    }

    $query = sprintf("SELECT user_id FROM users WHERE username = '%s' LIMIT 1",
        mysql_real_escape_string($username));


    $result = mysql_query($query, getSelectConnection());


    if (mysql_num_rows($result) > 0)
    {
        return true;
    } else
    {
        return false;
    }

    return false;

}




/*
function registerNewUser($username, $password, $password2,$display_name,$coursesId)
{

  if (!valid_email($username))
  {
    return lang('Email_is_not_valid');
  }

  $id = -1;

  $userExists = true;
  if (user_exists($username))
  {
    $user = getUserByName($username);
    $id =$user["user_id"];
  }
  else
  {
    if ($password != $password2 )
    {
      return lang('Passwords_not_match');
    }

    if (!valid_password($password,2))
    {
      return lang('Password_is_not_valid');
    }

    $sql = sprintf("insert into users (username,password,disabled,display_name) value ('%s','%s', 0,'%s')",
      mysql_real_escape_string($username),
      mysql_real_escape_string($password),
      mysql_real_escape_string($display_name) );


    if (mysql_query($sql))
    {
     $userExists = true;
    }
    else
    {
      $userExists = false;
    }
  }

  if (!$userExists)
  {
    return lang('Error_in_creating_user');
  }
  if ($id  != -1)
  {
    $coursesArry = explode(',',  $coursesId);

    $result = '';
    foreach ($coursesArry as $course_id)
    {
      $result.= openCourseToUser($id,$course_id);
    }
    return $result;
  }

  return '';

}*/

function lostPassword($username)
{
    global $seed;

    if (!valid_email($username) || !user_exists($username))
    {
        return false;
    }

    $query = sprintf("select user_id from users where username = '%s' limit 1",
        $username);

    $result = mysql_query($query, getSelectConnection());

    if (mysql_num_rows($result) != 1)
    {

        return false;
    }


    $newpass = generate_code(8);

    $query = sprintf("update users set password = '%s' where username = '%s'",
        mysql_real_escape_string($newpass), mysql_real_escape_string($username));

    if (mysql_query($query, getUpdateConnection()))
    {
        if (sendLostPasswordEmail($username, $newpass))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }

    return false;
}

?>