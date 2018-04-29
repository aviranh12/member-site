<?php
error_reporting(1); // we don't want to see errors on screen
date_default_timezone_set("Asia/Jerusalem");
// Start a session
session_start();

require_once ("functions.inc.php"); // include all the functions


$domain =  $_SERVER["SERVER_NAME"]; // the domain name without http://www.




?>

<html>
<head>
<title><?php echo $domain; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta charset="utf-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="extention/bootstrap.min.css">
<!-- jQuery library -->
<script src="extention/jquery-2.2.4.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
 -->

<!-- Latest compiled JavaScript -->
<script src="extention/bootstrap.min.js"></script>


<?php

//echo lang('NO_PHOTO');


$rtl = isRtl();

	if ($rtl)
	{
			echo '<style>
			.navbar .nav > li {
			    float: right;
			}

			</style>';
	}
?>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '192109538023564');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=192109538023564&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>

<?php
if ($rtl) {
	echo '<body dir="rtl">';
}
else {
	echo '<body>';
}

echo " <div class='container' >
			 <div id='menu' class='page-header navbar ' role='navigation'>
					<ul class=' nav nav-tabs'  >";


if(homePageActive())
{
	echo"<li id='home_page_id' class='active'>";
}
else
{
	echo"<li id='home_page_id'>";
}

 //echo '<a href="http://'. $_SERVER['SERVER_NAME'].'">'.lang('Home_page').'</a>';
 echo '<a href="http://'. $_SERVER['SERVER_NAME'].'/membersitenew">'.lang('Home_page').'</a>';

echo "</li>";

if (isLoggedIn())
{
  $u = $_SESSION['username'];
  $uid = $_SESSION['user_id'];

  $userFromDb =  getUserById($uid);

  $allSteps = newGetPathsStepsOfUser($uid);


	$showOnlyActiveCourse =	getShowOnlyActiveCourseIndecator();


  foreach ($allSteps as $stepsCourse)
  {
  	$firstStep = $stepsCourse[0];

		if ($showOnlyActiveCourse && isset($_GET["courseId"]) && $_GET["courseId"] != $firstStep["course_id"])
    {
      continue;
    }

    if ($_GET["courseId"] == $firstStep["course_id"])
    {
			echo "<li class='dropdown active'";
    }
    else
    {
			echo "<li class='dropdown'";
    }

		echo " id='tab_course_id_".$firstStep["course_id"]."'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$firstStep["course_name"]."<span class='caret'></span></a><ul class='dropdown-menu'>";

		foreach ($stepsCourse as $step)
		{
			if (  $step["step_name"] == null)
			{
				$step["step_name"] = lang('Level').' '.$step["step_num"];
			}
			echo '<li';

			if ($_GET["courseId"] == $step["course_id"] &&
					$_GET["stepNum"] == $step["step_num"])
	    {
	    		echo " class='active'";
	    }

			echo ' id="tab_course_id_'.$step["course_id"]. '_step_num_'.$step["step_num"] . '"><a href="getContent.php?courseId='.$step["course_id"].'&stepNum='.$step["step_num"].'&pageNum=1">'.$step["step_name"].'</a></li>';
		}

		 echo '</ul>
    			</li>';
  }


  if (!($showOnlyActiveCourse && anyCourseActive()))
  {
	  $notAllowedCourses =  getNotAllowedCoursesOfUser($_SESSION['user_id']);
	  $arrlength = count($notAllowedCourses);
	  for($x = 0; $x < $arrlength; $x++)
	  {
			//$sellPage =   str_replace("&","~~",$notAllowedCourses[$x]["sell_page"]);
			//$sellPage =   str_replace("//","!@1",$sellPage);
			$sellPage =   urlencode($notAllowedCourses[$x]["sell_page"]);
			
			if ($_GET["courseId"] == $notAllowedCourses[$x]["course_id"])
			{
				echo "<li class='active' ";
			}
			else
			{
				echo "<li ";
			}

	  	echo  " id='tab_course_id_".$notAllowedCourses[$x]["course_id"]."'>";
	  	echo '<a href="getContent.php?sellPage='.$sellPage.
	  	'&courseId='.$notAllowedCourses[$x]["course_id"].'">'.
	  	$notAllowedCourses[$x]["course_name"].'</a>';
	  	echo "</li>";
	  }
	}
}

?>
</ul>
</div><div class="panel panel-info">
<?php

function homePageActive()
{
	return !(isset($_GET["courseId"]));
}

function anyCourseActive()
{
	return (isset($_GET["stepNum"]));

}
