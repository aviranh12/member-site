<?php

require_once "header.php";

if (isset( $_POST['answere']))
{
	$userId = $_POST['userId'];
	$courseId = $_POST['courseId'];
	$stepNum = $_POST['stepNum'];


	if (isUserCanFillTheExercise($userId,$courseId,$stepNum))
	{
		$user_response = strip_tags($_POST['answere']);

		if 	(exerciseFromUser($userId, $courseId,$stepNum, $user_response, true)){
			return true;
		}
	}
}

return false;

function getExerciseForm($courseId,$stepNum)
{
	$result = "<div id='ExerciseForm'>";

	if (isTheStepCanShow($courseId, $stepNum))
	{
		$userId = $_SESSION['user_id'];
		$user = getUserById($userId);

		$isUserCanFillTheExercise = 	isUserCanFillTheExercise($userId,$courseId,$stepNum);

		$userStep =  getUserStep($userId,$courseId,$stepNum);
		$step = getStep($courseId, $stepNum);
		$user_response =  $userStep['user_response'];
		$admin_answer =  $userStep['admin_answer'];


		$leftSecondsForStep = leftSecondsForStep($userId,$courseId,$stepNum);

		if ($user['need_admin_approval'] && $step["need_admin_approval"])
		{
			$result .= '<textarea class="form-control" id="textareaId" name="answere" rows="5"';

			if  (!$isUserCanFillTheExercise)
			{
				$result .='disabled="disabled"';
			}

			$result .='>'.$user_response.'</textarea>';

			if  ($isUserCanFillTheExercise)
			{
				$result .= '<input type="hidden" id="userId" value="'.$userId.'">';
				$result .= '<input type="hidden" id="courseId" value="'.$courseId.'">';
				$result .= '<input type="hidden" id="stepNum" value="'.$stepNum.'"><br/>';
				$result .=	'<input id="submitId" type="submit" value="שלח"  class="btn btn-info" onclick="sendExercise()">';
			}

			$result .='<script src="exercise.functions.js"></script>';
		}

		if ($leftSecondsForStep > 0)
		{
			$finalResult["exerciseHolding"] = true;
			$timeLeft= secondsToTime ($leftSecondsForStep);
			$result .= '<br/>'.lang('Time_left').' '.$timeLeft;

			if (!$user['need_admin_approval'] || !$step["need_admin_approval"])
			{
				$result .= " ".lang('until_level_finish');
			}
			else
			{
				$result .= " ".lang('Until_date_of_submission_of_the_exercise');
			}

		}

		if ($admin_answer &&
		($userStep['is_admin_approve']   ||  !$userStep['answere_read_only']  ))
		{
			$result .= '<br/><br/><label>'.lang('Answere').': '.$admin_answer.'</label>';
		}

	}
	$result .= '</div>';

	$finalResult["result"] = $result;


	return $finalResult;
}
