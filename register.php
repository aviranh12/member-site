<?php

require_once "header.php";

if (isset($_POST['register'])){

  //var_dump($_POST);
  //return;

   /*$res = registerNewUser($_POST['username'], $_POST['password'], $_POST['password2'], $_POST['displayName'], $_POST['coursessId']);

	if ($res == ''){

		echo lang('Thank_you_for_registering').
    "<a href='./index.php'>".lang('Click_here_to_login')."</a>";

	}else {

		echo lang('Registration_failed_Please_try_again')."<br/>".$res;
		show_registration_form();

	}
*/
} else {
// has not pressed the register button
	show_registration_form();
}

 require_once "footer.php";
?>