<?php
require_once "header.php";

if (isLoggedIn())
{

	$uid = $_SESSION['user_id'];

	$userFromDb =  getUserById($uid);

	if ($userFromDb[user_type] == 0) //admin
	{

		$approve = $_POST['approve'];
		$course_Id = $_POST['course_Id'];
		$step_num = $_POST['step_num'];
		$user_id = $_POST['user_id'];
		$adminAnswere = $_POST['adminAnswere'];

		if (!$adminAnswere)
		{
			if ($approve == 'true')
			{
				$adminAnswere =   lang('approved');
			}
			else
			{
				$adminAnswere =   lang('not_approved_try_again');
			}
		}

		if ($approve == 'true')
		{
			$approve = 1;
		}
		else
		{
			$approve = 0;
		}

		$answere_read_only = $approve;

		$query = sprintf("UPDATE user_steps
	     SET		 admin_answer = '%s',
					answere_read_only = '%s',
					is_admin_approve = '%s'
		WHERE user_id = '%s' and
			  course_Id = '%s' and
			  step_num = '%s' ",
			mysql_real_escape_string($adminAnswere),
			mysql_real_escape_string($answere_read_only),
			mysql_real_escape_string($approve),
			mysql_real_escape_string($user_id),
			mysql_real_escape_string($course_Id),
			mysql_real_escape_string($step_num));

			if (mysql_query($query))
		   {
				//echo "sucess";
				return true;
			}
			else
			{				//echo "no sucess";
				return false;
			}
	}
}