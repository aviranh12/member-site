<?php

#### Display Functions ####


function show_changepassword_form(){

echo '<div class="panel-body"><form  class="form-inline" role="form"  action="./changepassword.php" method="post">

  <fieldset>

  <legend>'.lang('Change_Password').'</legend>

  <input type="hidden" value="'.$_SESSION['username'].'" " name="username">

  <dl>

    <dt>

      <label for="oldpassword">'.lang('Current_Password').':</label>

    </dt>

    <dd>

      <input name="oldpassword" type="password"  class="form-control" id="oldpassword" maxlength="15">

    </dd>

  </dl>

  <dl>

    <dt>

      <label for="password">'.lang('New_Password').':</label>

    </dt>

    <dd>

      <input name="password" type="password" id="password"  class="form-control" maxlength="15">

    </dd>

  </dl>

  <dl>

    <dt>

      <label for="password2">'.lang('Confirm_New_Password').':</label>

    </dt>

    <dd>

      <input name="password2" type="password" id="password2"  class="form-control" maxlength="15">

    </dd>

  </dl>



                  <dl>

  <dd>

    <input name="change"  class="btn btn-default"  type="submit" value="'.lang('Change_Password').'">

                  </dd>

  </dl>



  </fieldset>

</form></div>
';
}

function show_loginform($disabled = false)
{

    echo '<div class="panel-body"><form name="login-form" class="form-inline" role="form" id="login-form" method="post" action="./index.php">
  <fieldset>
  <div class="form-group">
  <legend>'.lang('Login').'</legend>
  <dl>
    <dt><label title="Username">'.lang('Username').': </label></dt>
    <dd><input tabindex="1" class="form-control" accesskey="u" name="username" type="text" maxlength="30" id="username" /></dd>
  </dl>
  <dl>
    <dt><label title="Password">'.lang('Password').': </label></dt>
    <dd><input tabindex="2" class="form-control" accesskey="p" name="password" type="password" maxlength="15" id="password" /></dd>
  </dl>
  <dl>
  <dd>
  <p><input tabindex="3" class="btn btn-default" accesskey="l" type="submit" name="cmdlogin"
  value="'.lang('Login').'"';
    if ($disabled == true)
    {
        echo 'disabled="disabled"';
    }
    echo ' /></p>

  </dd>
  </dl>
   <dl>
  <dd>

  <a href="./lostpassword.php" title="Lost Password">'.lang('Lost_Password').'</a>



  </dd></dl>
  </div>

  </fieldset></form></div>';


}

function show_lostpassword_form(){


	echo '<div class="panel-body">
	<form action="./lostpassword.php" method="post"  class="form-inline" role="form">
	<div class="form-group">
	<fieldset><legend>'.lang('Reset_Password').'</legend>
  <dl>
    <dt><label for="username">'.lang('Email').':</label></dt>
    <dd><input name="username" type="text" id="username" maxlength="30" class="form-control">
    </dd>
  </dl>

  <dl>
  <dd>
    <!--input name="reset" type="reset" value="Reset"-->
    <input name="lostpass" type="submit" value="'.lang('Reset_Password').'" class="btn btn-default">
   </dd>
   </dl>
  </fieldset>
  </div>
</form></div>';

}

function show_registration_form(){

  $coursessId;
  if (isset($_POST['coursessId']))
  {
    $coursessId = $_POST['coursessId'];
  }
  else
  {
    $coursessId = $_GET['coursessId'];
  }



	echo '<div class="panel-body">
          <form action="./register.php" method="post" class="form-inline" role="form">

	<fieldset><legend>'.lang('Register').'</legend>
   <div class="form-group">
  <dl>
    <dt><label for="username">'.lang('Email').':</label></dt>
    <dd><input name="username" type="text" class="form-control" id="username" maxlength="30">
    </dd>
  </dl>
  <dl>
    <dt><label for="password">'.lang('Password').':</label></dt>
    <dd><input name="password" type="password" class="form-control" id="password" maxlength="15">
    </dd>
  </dl>
  <dl>
    <dt><label for="password2">'.lang('Confirm_Password').':</label></dt>
    <dd><input name="password2" type="password" class="form-control" id="password2" maxlength="15">
    </dd>
  </dl>
  <dl>
    <dd><input type="hidden" name="coursessId" type="text" class="form-control" id="coursessId" maxlength="255" value="'.$coursessId.'">
    </dd>
  </dl>
  <p>

    <input name="register" type="submit" class="btn btn-default" value="'.lang('Register').'">
  </p>
  </div>
  </fieldset>

</form></div>';

}
function show_userbox()
{
	 $u = $_SESSION['username'];
    $uid = $_SESSION['user_id'];
	 echo "<div id='userbox'><p>
			Welcome $u";


    // retrieve the session information


	$userFromDb =  getUserById($uid);
	


	if ($userFromDb["user_type"] == 0) //admin
	{
		 echo '<div><a href="edit.php">עריכת שיעורים</a></div>';

		
		$result =  getUserResponsesThatWaitToAnswer();

		echo " <div class='table-responsive'><table id='adminTable' border='1' class='table table-bordered'>
		<td>הגשת תרגילים </td>
			<tr>
			<td>user_id </td>
			<td>course_Id</td>
			<td>step_num</td>
			<td>user_response</td>

			<td>admin_answer</td>
			<td>time_step_open</td>
			<td>answere_read_only</td>

			<td>is_admin_approve</td>

  </tr>";


		while ($row = mysql_fetch_assoc($result))
	  {
		  $userId = $row['user_id'];
		  $stepNum = $row['step_num'];
		  $courseId = $row['course_Id'];

			$partOfId=  $userId ."-". $courseId ."-". $stepNum;

			echo '<tr id="tr-'.$partOfId.'">';
		  echo "<td>".$row['user_id']."</td>";
		  echo "<td>".$row['course_Id']."</td>";
		  echo "<td>".$row['step_num']."</td>";
		  echo "<td>".$row['user_response']."</td>";
		  echo "<td>".$row['admin_answer']."</td>";
		  echo "<td>".$row['time_step_open']."</td>";

		  if ($row['answere_read_only'])
		  {
			 echo "<td>true</td>";
		  }
		  else
		  {
			   echo "<td>false</td>";
		  }

		  if ($row['is_admin_approve'])
		  {
			 echo "<td>true</td>";
		  }
		  else
		  {
			   echo "<td>false</td>";
		  }

		  echo '<td>
		<textarea id="adminAnswere-'.$partOfId.'"  name="adminAnswere" cols="40" rows="1" ></textarea>
		<br/>
		<input checked id="checkbox-'.$partOfId.'" type="checkbox" name="isApprove" value="Approve">	מאושר
		<br/>
		 <input type="hidden" id="user_id-'.$partOfId.'" value="'.$row['user_id'].'">
		 <input type="hidden" id="course_Id-'.$partOfId.'" value="'.$row['course_Id'].'">
		 <input type="hidden" id="step_num-'.$partOfId.'" value="'.$row['step_num'].'">

		<input id="submitId" type="submit" value="שלח" class="btn btn-info" onclick="a('."'".$partOfId."'".');" >


			</td>';
		    echo "</tr>";

	  }

			echo "</table></div>";
		echo  '<script src="admin.functions.js"></script>';

	}
    // display the user box



   echo "<ul>
				<li><a href='./changepassword.php'>".lang('Change_Password')."</a></li>
				<li><a href='./logout.php'>".lang('Logout')."</a></li>
			</ul></p>
		 </div>";
}

?>