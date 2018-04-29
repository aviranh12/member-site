<?php

require_once "header.php";
require_once "exercise.functions.php";

$courseId = $_GET["courseId"];
$stepNum = $_GET["stepNum"];
$pageNum = $_GET["pageNum"];


$sellPage = $_GET["sellPage"];


if ($sellPage)
{

	 //$sellPage = str_replace("~~", "&",  $sellPage);
	 
	 //$sellPage = str_replace("!@1", "//", $sellPage);	 
	 
		echo '<div class="embed-responsive embed-responsive-4by3">
	  <iframe class="embed-responsive-item" src="'.$sellPage.'"></iframe>
	</div>';
}
else
{
	echo '<div id="logo" class="panel-heading" ><p>'.lang('Level').' '. $stepNum. "</p>";

	$numberOfPage = getNumberOfPageStep($courseId, $stepNum);

	$dropdownClass = 'dropdown-menu';

	if (isRtl()) {
		$dropdownClass .= ' dropdown-menu-right';
	}

	echo '<div class="dropdown">
	    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">'.lang('Page').' '.$pageNum. '
	    <span class="caret"></span></button>
	    <ul class="'.$dropdownClass.'" role="menu" aria-labelledby="menu1">';

	for ($i = 1; $i <= $numberOfPage; $i++)
	{
		if ($i == $pageNum)
		{
			 echo '<li role="presentation" class="active">';
		}
		else
		{
			 echo '<li role="presentation">';
		}

		echo '<a role="menuitem"  tabindex="-1" href="?courseId='.$courseId.'&stepNum='.$stepNum.'&pageNum='.$i.'">'.lang('Page').' '.$i.'</a></li>';
	}

	echo '</ul>
	  </div></div>';

	  echo '<div id="page" class="panel-body">';

	if (isTheStepCanShow($courseId, $stepNum))
	{
		$page = getPage($courseId, $stepNum, $pageNum);

		$rtl = isRtl();

		$className = $rtl ? 'next' : 'previous';

		if ($pageNum > 1)
		{
			echo'<ul class="pager">
					<li class="'.$className.'">
						<a href="?courseId='.$courseId.'&stepNum='.$stepNum.'&pageNum='.($pageNum - 1).'">'.lang('Previous_page').'</a>
					</li>
				</ul>';
		}
		else if ($stepNum > 1)
		{
			echo'<ul class="pager">
					<li class="'.$className.'">
						<a href="?courseId='.$courseId.'&stepNum='.($stepNum - 1).'&pageNum=1">'.lang('Previous_level').'</a>
					</li>
				</ul>';
		}

		echo $page["content"];

	  $nextPage = null;

		if  ($numberOfPage == $pageNum)
		{
			$exerciseForm = getExerciseForm($courseId,$stepNum, $pageNum);

			echo $exerciseForm["result"];
		}
		else
		{
			$nextPageNum = $pageNum + 1;

			$nextPage = getPage($courseId, $stepNum, $nextPageNum);

			if ($nextPage)
			{
				echo'<ul class="pager">

	    <li class="'.$className.'"><a href="?courseId='.$courseId.'&stepNum='.$stepNum.'&pageNum='.$nextPageNum.'">'.lang('Next_page').'</a></li>

	  		</ul>';
			}
		}

		$userId = $_SESSION['user_id'];

		if ((!$nextPage) && isTheStepIsOver($userId,$courseId,$stepNum))
		{
			$nextStepNum = $stepNum + 1;

			$nextStep =  getStep($courseId, $nextStepNum);

			if ($nextStep)
			{

				openStepToUser($userId,$courseId, $nextStepNum);
				echo '<ul class="pager"><li class="'.$className.'"><a href="getContent.php?courseId='.$courseId.
				'&stepNum='.$nextStepNum.
				'&pageNum=1">'.lang('Level').' '.
				$nextStepNum. '</a></li></ul>';
			}
		}
	}
	else
	{
		if (isLoggedIn())
		{
			echo '<p>'.lang('The_level_is_not_open').'</p>';
		}
		else
		{
			header('Location: index.php');
		}
	}
}

echo '</div>';

 require_once "footer.php";
 ?>