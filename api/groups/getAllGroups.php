<?php 
	require '../../class/Main.php';
	$groups = new Groups();

	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'get') {
		$data = $groups->getAllGroups();

		forEach($data as $item) {
			$array['result'][] = [
				'group_id' => $item['group_id'],
				'group_name' => $item['group_name']
			];
		}
		require('../../class/Return.php');
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}
?>