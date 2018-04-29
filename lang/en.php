<?php
function lang($phrase){
    static $lang = array(
        'approved' => 'approved :)', //מאושר :)
        'not_approved_try_again' => 'not approved try again',   //לא מאושר, נסה שוב
        'Your_password_has_been_changed' => 'Your password has been changed !',
        'Return_to_homepage' => 'Return to homepage',
        'Password_change_failed' => 'Password change failed! Please try again.',
        'Change_Password' => 'Change Password', //שנה סיסמא
        'Current_Password' => 'Current Password', //'סיסמא נוכחית'
        'New_Password' => 'New Password', //סיסמא חדשה
        'Confirm_New_Password' => 'Confirm New Password', //'סיסמא חדשה שוב'
        'Username' => 'Username',//שם משתמש
        'Password' => 'Password',//סיסמא
        'Confirm_Password' => 'Confirm Password',
        'Login' => 'Login',//התחבר
        'Lost_Password' => 'Lost Password',//שכחתי סיסמא
        'Reset_Password' => 'Reset Password',
        'Email' => 'Email',
        'Register' => 'Register',
        'Time_left' => 'Time left', //נשארו עוד
        'until_level_finish' => 'until the end of the level', //עד לסיום השלב
        'Until_date_of_submission_of_the_exercise' => 'until date of submission of the exercise', //עד להגשת התרגיל
        'days' => 'days', // ימים
        'hours' => 'hours', // שעות
        'minutes' => 'minutes', // דקות
        'and' => 'and', // ו
        'seconds' => 'seconds', // שניות
        'Answere' => 'Answere', // תשובה
        'Level' => 'Level', // שלב
        'Page' => 'Page', //
        'Previous_page' => 'Previous page', // הדף הקודם
        'Previous_level' => 'Previous level', // השלב הקודם
        'Next_page' => 'Next page', // דפ הבא
        'The_level_is_not_open' => 'The level is not open', // השלב לא פתוח
        'Home_page' => 'Home page', // דף הבית
        'Incorrect_Login_information' => 'Incorrect Login information !', //
        'Password_reset_message' => 'Your password has been reset, an email containing your new password has been sent to your inbox.', //
        'Email_incurrect' => 'Email is incurrect', // שם משתמש או סיסמא לא נכונים
        'Click_here_to_return_to_the_homepage' => 'Click here to return to the homepage.', // שם משתמש או סיסמא לא נכונים

        'Thank_you_for_registering' => 'Thank you for registering',
        'Click_here_to_login' => 'Click here to login.',
        'Registration_failed_Please_try_again' => 'Registration failed! Please try again.',
        'Email_is_not_valid' => 'email is not valid.',
        'Passwords_not_match' => 'Passwords not match.',
        'Password_is_not_valid' => 'Password is not valid.',
        'Error_in_creating_user' => 'Error in creating user',
		'Logout' => 'Logout'
    );
    return $lang[$phrase];
}
