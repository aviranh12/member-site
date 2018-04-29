<?php

require_once "header.php";

if (isset($_POST['lostpass'])){

	if (lostPassword($_POST['username'])){

		echo "<div class='panel panel-success'><div class='panel-heading'>
		".lang('Password_reset_message')."<br />
		<a href='./index.php'>".lang('Click_here_to_return_to_the_homepage')."</a>
		</div></div>
		";

	}else {

		echo "<div class='panel panel-danger'><div class='panel-heading'>
  ".lang('Email_incurrect')."
  </div></div>
  ";
		show_lostpassword_form();

	}

} else {
	//user has not pressed the button
	show_lostpassword_form();
}

 require_once "footer.php";
?>