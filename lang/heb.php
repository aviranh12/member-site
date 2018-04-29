<?php
function lang($phrase){
    static $lang = array(
        'approved' => 'מאושר :)', //
        'not_approved_try_again' => 'לא מאושר, נסה שוב',   //
        'Your_password_has_been_changed' => 'הסיסמא שלך השתנתה',
        'Return_to_homepage' => 'חזור לדף הבית',
        'Password_change_failed' => 'שינוי הסיסמא נכשל, נסה שוב מאוחר יותר',
        'Change_Password' => 'שנה סיסמא', //
        'Current_Password' => 'סיסמא נוכחית', //
        'New_Password' => 'סיסמא חדשה', //
        'Confirm_New_Password' => 'סיסמא חדשה שוב', //'סיסמא חדשה שוב'
        'Username' => 'שם משתמש',//שם משתמש
        'Password' => 'סיסמא',//
        'Confirm_Password' => 'סיסמא שוב',
        'Login' => 'התחברות',
        'Lost_Password' => 'שכחתי סיסמא',//
        'Reset_Password' => 'אתחל סיסמא',
        'Email' => 'אימייל',
        'Register' => 'הרשמה',
        'Time_left' => 'נשארו עוד', //
        'until_level_finish' => 'עד לסיום השלב', //
        'Until_date_of_submission_of_the_exercise' => 'עד להגשת התרגיל', //
        'days' => 'ימים',
        'hours' => 'שעות', //
        'minutes' => 'דקות', //
        'and' => 'ו', //
        'seconds' => 'שניות', //
        'Answere' => 'תשובה', //
        'Level' => 'שלב', //
        'Page' => 'דף', //
        'Previous_page' => 'הדף הקודם', //
        'Previous_level' => 'השלב הקודם', //
        'Next_page' => 'דף הבא',
        'The_level_is_not_open' => 'השלב לא פתוח', //
        'Home_page' => 'דף הבית', //
        'Incorrect_Login_information' => 'שגיאת התחברות !', //

        'Password_reset_message' => 'הסיסמא שלך אותחלה,אימייל עם הסיסמא החדשה נשלח אליך.', //
        'Email_incurrect' => 'האימייל לא קיים אצלנו במערכת',
        'Click_here_to_return_to_the_homepage' => 'לחץ כאן למעבר לדף הבית',

        'Thank_you_for_registering' => 'תודה לך על ההרשמה',
        'Click_here_to_login' => 'לחץ כאן להתחברות.',
        'Registration_failed_Please_try_again' => 'ההרשמה נכשלה, נסה שוב בבקשה.',
        'Email_is_not_valid' => 'האימייל לא תקין.',
        'Passwords_not_match' => 'הסיסמאות לא זהות.',
        'Password_is_not_valid' => 'הסיסמא לא תקינה.',
        'Error_in_creating_user' => 'שגיאה ביצירת משתמש',
	    'Logout' => 'התנתק'
    );
    return $lang[$phrase];
}
