<?php

require_once "header.php";

if (isLoggedIn() == true)
{

    if (isset($_POST['change']))
    {
        if (changePassword($_POST['username'], $_POST['oldpassword'], $_POST['password'],
            $_POST['password2']))
        {
            echo lang("Your_password_has_been_changed"). "<br /> <a href='./index.php'>".
            lang("Return_to_homepage")."</a>";

        } else
        {
            echo lang("Password_change_failed");
            show_changepassword_form();
        }

    } else
    {
        show_changepassword_form();
    }

} else {
	// user is not loggedin
    show_loginform();
}

require_once "footer.php";

?>