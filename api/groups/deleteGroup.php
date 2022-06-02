<?php 
	require '../../class/Main.php';
	$groups = new Groups();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'delete') {
		$group_id = filter_input(INPUT_GET, 'group_id');
		if($groups->deleteGroup($group_id)){
			$array['result'] = ['status' => true];
		}else{
			$array['result'] = ['status' => false];
		}
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}

	require('../../class/Return.php');
?>