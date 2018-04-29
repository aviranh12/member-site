<?php

error_reporting(0);
require_once ('login.functions.inc.php');
require_once ('mail.functions.inc.php');



$a = getCoursesIdByItemNumbers('burning-desire,secout-2,secout-3');


echo '<br/><br/>';

var_dump(array_filter(explode(',',  $a)));

function getCoursesIdByItemNumbers($itemNumbers)
{
	$con = getSelectConnection();

	$itemNumbersAfterEscape = mysql_real_escape_string($itemNumbers);
	$itemNumbersAfterReplace = str_replace(",", "','",  $itemNumbersAfterEscape);
	$item_numbersForQuery = "'".$itemNumbersAfterReplace."'";

	$query = sprintf("SELECT course_id
	FROM courses 
	WHERE item_number in (%s)",
	$item_numbersForQuery);

	$result = mysql_query($query, $con);

	$row = mysql_fetch_assoc($result);

	$coursesId = '';

	while($row)
	{
		$coursesId.=($row["course_id"].',');

		$row = mysql_fetch_assoc($result);
	}

	echo 'getCoursesIdByItem_numbers result '.$query.'<br/><br/>';
	var_dump($coursesId);

	return $coursesId ;
}