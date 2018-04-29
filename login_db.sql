-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2016 at 08:39 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(2) NOT NULL,
  `course_name` varchar(26) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`) VALUES
(1, 'הקורס הראשון'),
(2, 'הקורס השני');

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE IF NOT EXISTS `steps` (
  `course_id` int(2) NOT NULL,
  `step_num` int(11) NOT NULL,
  `need_admin_approval` tinyint(1) NOT NULL,
  `minimum_day_for_step` int(2) NOT NULL,
  PRIMARY KEY (`course_id`,`step_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`course_id`, `step_num`, `need_admin_approval`, `minimum_day_for_step`) VALUES
(1, 1, 1, 0),
(1, 2, 1, 0),
(1, 3, 0, 0),
(1, 4, 1, 0),
(2, 1, 1, 0),
(2, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `step_pages`
--

CREATE TABLE IF NOT EXISTS `step_pages` (
  `course_id` int(2) NOT NULL,
  `step_num` int(2) NOT NULL,
  `page_num` int(2) NOT NULL,
  `content` varchar(2470) NOT NULL,
  `is_exercise` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`course_id`,`step_num`,`page_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `step_pages`
--

INSERT INTO `step_pages` (`course_id`, `step_num`, `page_num`, `content`, `is_exercise`) VALUES
(1, 1, 1, '\n		נפח קניות באינטרנט – כיום, יותר ויותר אנשי<br/> \n		ם עושים את הקניות שלהם באינטרנט (גם בישראל, לא רק בארה"ב<br/> \n		ואירופה) וזה יוצר יותר הזדמנויות שאתה יכול לנצל עבורך.<br/> \nשוק גלובלי – למרות שיש תחרות, האינטרנט הוא השוק הגדול ביותר בעול<br/> \nם ובאמצעות הרשת תוכל להגיע לקהל רחב או מצומצם (כתלות בנישה שאתה פועל בה).<br/> \nכמות הגולשים באינטרנט – כמות הגולשים באינטרנט עולה מידי חודש והצ<br/> \nפי הוא שכמות גולשים זו תמשיך להעלות ככל שיותר משקי בית ומדינות מתפתחות מתחברות<br/> \n			<br/> ', 0),
(1, 1, 2, 'אז הנה תרגיל ראשון :)<br/>\n<br/>\n<br/>\nקח דף.<br/>\n<br/>\nתרשום בצד ימין של כל התכונות החיוביות שלך. <br/>\n<br/>\nובצד שמאל את כל התחומים שאתה צריך לעבוד עליהם.<br/>\n<br/>\nותהיה כנה כמה שאתה יכול.<br/>\n<br/>\nעל הצד השני של העמוד,<br/>\nאני רוצה שתכתוב פסקה שמתארת<br/>\nמי אתה חושב שאתה כאדם. <br/>\nפירוט כל חלקי האישיות שלך שמראה מי אתה. <br/>\nכל מה שאתה יכול לכתוב, ובכלל זה:<br/>\n- גיל<br/>\n- מראה חיצוני<br/>\n- אישיות<br/>\n- תחביבים ותחומי עניין<br/>\n- אורח חיים נוכחי<br/>\n- מטרות לעתיד<br/>\nרשימה זו צריכה בעצם להיות כל הסיבות שבגללן אישה הייתה רוצה להיות אתך.<br/>\n<br/>\nסיימת?<br/>\n<br/>\nיופי! ממשיכים<br/>', 0),
(1, 1, 3, 'תכתוב רשימה של מצבים שבהם אתה מרגיש את האיום הגדול ביותר עם נשים.<br/>\r\nליד כל שורה, לרשום את הדבר הגרוע ביותר שיכול לקרות.<br/>\r\nותוסיף גם "אולי" כי לא בטוח שזה יקרה :)<br/>\r\nאני אתן לך רשימה לדוגמא, (אבל שלך יכול להיות שונה)<br/>\r\n<br/>\r\n1) לגשת לדבר עם אישה -  אולי היא תדחה אותי ותלך אני גם אעלב<br/>\r\n2) להתגרות אישה - אולי זה ירגיז אותה והיא תלך.<br/>\r\n3) לנסות לנשק אישה - אולי היא תדחוף אותי והיא גם עלולה לכעוס.<br/>\r\n4) לנסות לגעת בא בצורה מינית - אולי היא תדחוף אותי, אולי תתן לי סטירה ואולי גם תצעק, או שהיא תגיד לי ללכת.<br/>\r\n<br/>\r\nואז תשאל את עצמך,<br/>\r\nעד כמה זה באמת גרוע? <br/>\r\nאני יכול לחיות עם זה? <br/>\r\nזה יכאב לי פיזית?<br/>\r\nמבחינה רגשית? <br/>\r\nמבחינה כספית? <br/>\r\nמבחינה חברתית?<br/>\r\n<br/>\r\nואז תשאל את עצמך <br/>\r\nמה יקרה ברגע שתשלים עם זה <br/>\r\nותחליט שאתה יכול להתמודד עם זה. <br/>\r\nאם אתה ניגש ומדבר עם אישה, <br/>\r\nולאחר מכן היא הולכת משם, <br/>\r\nאתה יכול לשאת את הכאב הזה?<br/>\r\n<br/>\r\n(מבחינתי, זה רק אומר שעברתי עוד אישה אחת לקראת האחת שאני רוצה בחיים שלי. <br/>\r\nואם היא הולכת היא עשתה את זה יותר קל בשבילי להבין אם היא שווה את הזמן והאנרגיה שלי. <br/>\r\nיותר טוב עכשיו מאשר אחרי כמה ארוחות ערב יקרות.<br/>\r\nוזה היחס שצריך להיות לך בכל המצבים האלה.<br/>', 0),
(1, 1, 4, 'עכשיו שב לכתוב את הרשימה שלך, <br/>\r\nתחקור את מה שאתה באמת מרגיש מתוצאה של "כישלון" שיכול להיות באותם מצבים. <br/>\r\n<br/>\r\nברגע שאתה באמת מבין ומקבל את הסיכון, <br/>\r\nאתה תהיה הרבה יותר מוכן ל"הסתכן".<br/>\r\n<br/>\r\nאתה מבין? כל זמן שלא חושבים מה הכי גרוע שיכול להיות אז זה מתנפח לדבר נורא <br/>\r\nאבל כשחושבים מה באמת יכול לקרות, <br/>\r\nזה באמת שטויות<br/>\r\n<br/>\r\nתשלח לי את הרשימות שלך<br/>\r\nאל תתעכב על זה יותר מידי זמן<br/>\r\nתפנה לעצמך זמן ותשב על זה<br/>', 1),
(1, 2, 1, 'קשר עיין זה דבר חשוב מאד באינטראקציה עם בחורה<br/>\r\nאז אנחנו הולכים לתרגל את זה<br/>\r\nאל תדאג זה לא יהיה קשה<br/>\r\nאתה תהנה מזה :) <br/>\r\n<br/>\r\n', 0),
(1, 2, 2, '1)	"תיצור" קשר עין עם עצמך במראה. <br/>\r\nאתה עלול לגלות שאתה יכול לעשות זה רק לכמה דקות בכל פעם לפני שאתה מתפרץ בצחוק ואתה חייב להוריד את העיניים.<br/>\r\n2)	להתאמן על אנשים שאתה עובר ברחוב. <br/>\r\nשים משקפי שמש.<br/>\r\nותיצור קשר עין איתם, אתה יודע שהם לא יכולים לראות את העיניים שלך. <br/>\r\nאז יהיה לך יותר קל<br/>\r\n(אתה גם יכול להתאמן על זה ממקום שלא רואים שאתה מסתכל<br/>\r\nפשוט משקפי שמש זה יותר קל)<br/>\r\n3)	אחרי שעשית את מספר 2 כמה פעמים (או אם בא לך לדלג שלב :)) <br/>\r\nצור קשר עין אמיתי. <br/>\r\nבלי משקפי שמש, <br/>\r\nתיצור קשר עין עם כל אישה שאתה רואה ברחוב. <br/>\r\nהחזק אותו במשך זמן רב ככל שתוכל. <br/>\r\nתן להם הנהון וחיוך אם זה עוזר לך.<br/>\r\nועדיף שתחייך כשהיא מסתכלת עליך (זה יכול להפחיד אותה קצת אם לא חח)<br/>\r\nאתה צריך לתרגל את זה עד שתגיע לנקודה שבה אתה יכול לנעול את העיינים שלך על מישהי<br/>\r\nוהיא נשברת קודם ומורידה את העיניים לפניך. <br/>\r\nברוב המקרים,<br/>\r\nהיא תביט למטה לפנייך,<br/>\r\nוזה סימן של כניעה.<br/>\r\n(זה לא תמיד סימן של עניין בך, <br/>\r\nאבל זה סימן טוב על הדומיננטיות שלך.)<br/>\r\nלא חייבים להקדיש לזה זמן<br/>\r\nאפשר לעשות את זה תוך כדי הליכה ברחוב<br/>\r\nוזה ממש כיף :) תלמד ליהנות מזה<br/>', 1),
(1, 3, 1, 'אנחנו נעשה עוד כמה רשימות.<br/>\r\n<br/>\r\nאני יודע שזה משעמם אבל זה די חשוב<br/>\r\n<br/>\r\nקדימה!!<br/>\r\n<br/>', 0),
(1, 3, 2, 'עשה רשימה על עצמך של דברים שאתה מאמין שהם אמיתים.<br/>\r\nלדוגמא<br/>\r\n"אני לא יכול לדבר רוסית."<br/>\r\n"אני לא אטרקטיבי לנשים."<br/>\r\n"אני לא חכם מספיק כדי להתקבל לעבודה X."<br/>\r\n"אני לא יכול להפוך למיליונר."<br/>\r\n"אני לא יכול להשיג בחורות שוות."<br/>\r\n<br/>\r\nרשמת?<br/>\r\nיופי!<br/>\r\nאז הגיע הזמן לפרוץ אותם. <br/>\r\nעכשיו, ממש ליד כל אחד מהם, <br/>\r\nתעשה רשימה של סיבות למה אתה מאמין שזה אמיתי, <br/>\r\nאבל תכתוב את זה בגוף שלישי (כאילו אתה כותב על מישהו אחר)<br/>\r\nואחר כך תקרא את סיבה שוב ושוב עד שזה יראה כאילו מישהו אחר כתב את זה עליך. <br/>\r\nואני רוצה שתתחיל לפקפק בסיבות האלו.<br/>\r\nותכתוב מחדש את אותה אמונה, רק בצורה הפוכה, וגם תכתוב סיבות לכל אחד<br/>\r\n<br/>\r\n"אני יכול לדבר רוסית – <br/>\r\nזה ייקח קצת זמן שיעורי עזר, <br/>\r\nאבל אפשר לעשות את זה. <br/>\r\nאם מיליוני רוסים יכולים לעשות את זה, גם לי יכול, <br/>\r\nזה פשוט לא יהיה טבעי בהתחלה. "<br/>\r\n<br/>\r\n"אני יכול להפוך למיליונר. – <br/>\r\nזה רק ייקח זמן ללמוד מה צריך לעשות כדי להתעשר. <br/>\r\nאני אקרא כל מה שאני יכול על הנושא ואלמד הכל על איך כסף עובד. "<br/>\r\n...<br/>\r\n<br/>\r\nאיפה שיש רצון יש יכולת.<br/>\r\nתשמור על התדמית שלך,<br/>\r\nאבל תשחרר את אותם אמונות שלא משרתות אותך או מעכבות אותך.<br/>\r\n<br/>\r\nתכתוב בקצרה איך זה הרגיש לך<br/>', 1),
(1, 4, 1, 'דף חדש אני יודע', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `display_name` varchar(30) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '1',
  `need_admin_approval` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `disabled`, `display_name`, `user_type`, `need_admin_approval`) VALUES
(2, 'aviranh12', 'tur', 'avrahamyosef12@gmail.com', 0, '', 0, 1),
(15, 'aaaaa', 'aaaaa', 'aviranh12@gmail.com', 0, '', 1, 1),
(16, 'www', 'www', 'aviranh12@gmail.com', 0, '', 1, 1),
(24, 'aaa', 'aaa', 'hayunl@walla.co.il', 0, 'aaa', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_permission`
--

CREATE TABLE IF NOT EXISTS `users_permission` (
  `user_id` int(2) NOT NULL,
  `course_id` int(2) NOT NULL,
  `allowed` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_permission`
--

INSERT INTO `users_permission` (`user_id`, `course_id`, `allowed`) VALUES
(2, 1, 1),
(2, 2, 1),
(15, 1, 1),
(16, 1, 1),
(24, 1, 1),
(24, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_steps`
--

CREATE TABLE IF NOT EXISTS `user_steps` (
  `user_id` int(11) NOT NULL,
  `course_Id` int(2) NOT NULL,
  `step_num` int(11) NOT NULL,
  `user_response` varchar(900) DEFAULT NULL,
  `admin_answer` varchar(250) DEFAULT NULL,
  `time_step_open` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `answere_read_only` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin_approve` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`step_num`,`course_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_steps`
--

INSERT INTO `user_steps` (`user_id`, `course_Id`, `step_num`, `user_response`, `admin_answer`, `time_step_open`, `answere_read_only`, `is_admin_approve`) VALUES
(2, 1, 1, 'תשובת המשתמש', 'מאושר', '2016-04-29 04:34:23', 1, 1),
(2, 2, 1, NULL, NULL, '2016-04-30 08:23:46', 0, 0),
(2, 1, 2, 'לא בא לי', 'מאושר :)', '2016-04-30 15:29:20', 1, 1),
(2, 1, 3, NULL, NULL, '2016-06-10 12:41:31', 0, 0),
(16, 1, 1, 'תשובת המשתמש', 'now it is ok', '2016-05-14 08:05:23', 0, 0),
(16, 1, 2, NULL, NULL, '2016-05-14 11:06:26', 0, 0),
(24, 1, 1, 'i finishd \nThank you very math', 'מאושר', '2016-04-29 11:05:36', 1, 1),
(24, 2, 1, NULL, NULL, '2016-04-30 13:14:45', 0, 0),
(24, 1, 2, NULL, NULL, '2016-04-30 08:23:46', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_typs`
--

CREATE TABLE IF NOT EXISTS `user_typs` (
  `type_id` int(1) NOT NULL,
  `type_name` varchar(15) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_typs`
--

INSERT INTO `user_typs` (`type_id`, `type_name`) VALUES
(0, 'admin'),
(1, 'standard');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
