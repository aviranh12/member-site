<?php
// Database settings
// database hostname or IP. default:localhost
// localhost will be correct for 99% of times
define("HOST", "localhost");
// Database name
define("DB", "aviranh1_success_dating_course");


// Database user
define("DBUSER_select", "root");
// Database password
define("PASS_select", "");


// Database user
define("DBUSER_insert", "root");
// Database password
define("PASS_insert", "");


// Database user
define("DBUSER_update", "root");
// Database password
define("PASS_update", "");

############## Make the mysql connection ###########

function getSelectConnection()
{
  $conn_select = mysql_connect(HOST, DBUSER_select, PASS_select) or  die('Could not connect !<br />Please contact the site\'s administrator.s');
 mysql_query("SET NAMES UTF8");

$db = mysql_select_db(DB, $conn_select) or  die('Could not connect to database !<br />Please contact the site\'s administrator.s');

  return $conn_select;
}

function getInsertConnection()
{
  $conn_insert = mysql_connect(HOST, DBUSER_insert, PASS_insert) or  die('Could not connect !<br />Please contact the site\'s administrator.i');
  mysql_query("SET NAMES UTF8");

  $db = mysql_select_db(DB, $conn_insert) or  die('Could not connect to database !<br />Please contact the site\'s administrator.i');

  return $conn_insert;
}
function getUpdateConnection()
{
  $conn_update = mysql_connect(HOST, DBUSER_update, PASS_update) or  die('Could not connect !<br />Please contact the site\'s administrator.u');
  mysql_query("SET NAMES UTF8");

  $db = mysql_select_db(DB, $conn_update) or  die('Could not connect to database !<br />Please contact the site\'s administrator.u');

  return $conn_update;
}

?>