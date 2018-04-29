<?php

 require_once "header.php"; 
 
 
if (isLoggedIn())
{  
    $uid = $_SESSION['user_id'];
	$userFromDb =  getUserById($uid);
	
	
	if ($userFromDb["user_type"] == 0) //admin
	{
		$result = (getAllCourses());
	
		if (mysql_num_rows($result) > 0) {
	
	
			echo '<div><select id="cources" class="selectpicker" onChange="seletCource(this.value);">
			<option disabled selected value> -- select a cource -- </option>';

			

			while($row = mysql_fetch_assoc($result)) {
				//echo "course_id: " . $row["course_id"]. " - course_name: " . $row["course_name"]."<br>";
				echo '<option  value="'. $row["course_id"].'">'. $row["course_name"].'</option>';
			}
			
			
			
			?> </select></div><br/>	
			
			<div><select id="steps" class="selectpicker" onChange="seletStep(this.value);">
			<option disabled selected value> -- select a step -- </option>
			</select>
			</div><br/><div>
			<select id="pages" class="selectpicker" onChange="seletPage(this.value);">
			<option disabled selected value> -- select a page -- </option>
			</select></div><br/>
			
			<div><input id="savePage" type="submit" value="savePage"  class="btn btn-info" onclick="savePage()">

			</div>
			
			<?php
		} 
		
		?>
		
		<script src="edit.functions.js"></script>

		  <link href="extention/summernote.css" rel="stylesheet">
  <script src="extention/summernote.js"></script>
  <div id="summernote"><p>Hello Summernote</p></div>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>


<?php
	
	}
}

 require_once "footer.php";