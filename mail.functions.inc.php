<?php

##### Mail functions #####

function sendLostPasswordEmail($username, $newpassword)
{
    global $domain;
    $message = "
    You have requested a new password on http://".$domain."/,
    
    Your new password information:
    
    username:  ".$username."
    password:  ".$newpassword."
    
    
    Regards
    ".$domain." Administration
    ";

    if (sendMail($username, "Your password has been reset.", $message, "Aviran@vast.space"))
    {
        return true;
    } else
    {
        return false;
    }
}

function sendMail($to, $subject, $message, $from)
{
    $from_header = "From: $from";

    if (mail($to, $subject, $message, $from_header))
    {
        return true;
    } else
    {
        return false;
    }
    return false;
}

            
function sendMailHtml($to, $subject, $body, $from)
{
    $headersfrom ='';
    $headersfrom .= 'MIME-Version: 1.0' . "\r\n";
    $headersfrom .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headersfrom .= 'From: '.$from.' '. "\r\n";

    if (mail($to,$subject,$body,$headersfrom))
    {
        //echo 'send sucses to', $to, '<br/>',$body,'headersfrom=' ,$headersfrom;
        return true;
    } 
   
    return false;
}        
            

function sendUpdateAccountEmail($username, $password)
{
    $domain = $_SERVER['SERVER_NAME'];
    
    $link = "http://$domain/";
    $message = '
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td dir="rtl" style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; text-align: right; padding: 3px;">
<p>נראה שהוספת מוצר לחשבון שלך</p>
<p>פרטי ההתחברות שלך (למקרה ששכחת :))</p>
<p>שם משתמש:&nbsp;'.$username.'</p>
<p>סיסמא:&nbsp;'.$password.'</p>
<p dir="ltr">'.$link.'&nbsp;</p>
</td>
</tr>
</tbody>
</table>
';

    if (sendMailHtml($username, "פרטי ההתחברות שלך.", $message, 'Aviran@vast.space'))
    {
        //echo 'send sucses to', $username;
        return true;
    } else
    {
        return false;
    }
}
function sendNewAccountEmail($username, $password)
{
   $domain = $_SERVER['SERVER_NAME'];
    
    $link = "http://".$domain."/";
    $message = '
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td dir="rtl" style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; text-align: right; padding: 3px;"><span id="m_5209830551656783613preheadertext" style="display: none!important; max-height: 0px; font-size: 1px; overflow: hidden;"> החשבון שלך מוכן :) </span>
<p>תודה שנרשמת ל&nbsp;'.$domain.',</p>
<p>פרטי ההתחברות שלך</p>
<p>שם משתמש:&nbsp;'.$username.'</p>
<p>סיסמא:&nbsp;'.$password.'</p>
<p dir="ltr">'.$link.'&nbsp;</p>
</td>
</tr>
</tbody>
</table>
';

    if (sendMailHtml($username, "איזה יופי שהצטרפת אלינו.", $message, 'Aviran@vast.space'))
    {
        return true;
    } 
    else
    {
     echo 'feld send to', $username;
        return false;
    }
}

?>