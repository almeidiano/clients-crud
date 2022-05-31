<?php 
	require '../../class/Main.php';
	$groups = new Groups();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'post') {
		$group_name = filter_input(INPUT_POST, 'group_name');
		$group_desc = filter_input(INPUT_POST, 'group_desc');

		if($groups->addGroup($group_name,$group_desc)){
			$array['result'] = ['status' => true];
		}else{
			$array['result'] = ['status' => false];
		}
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}

	require('../../class/Return.php');
?>