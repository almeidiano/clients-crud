<?php 
	require '../../class/Main.php';
	$groups = new Groups();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'get') {
		$group_id = filter_input(INPUT_GET, 'group_id');
		$group_name = $groups->getGroupName($group_id);

		exit(json_encode($group_name));
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}
?>