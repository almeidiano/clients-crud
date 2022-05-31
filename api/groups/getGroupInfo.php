<?php 
	require '../../class/Main.php';
	$groups = new Groups();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == "get") {
		$group_id = filter_input(INPUT_GET, 'group_id');
		$group_info = $groups->getGroupInfo($group_id);
		exit(json_encode($group_info));
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}

	require('../../class/Return.php');
?>