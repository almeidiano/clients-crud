<?php 
	require '../../class/Main.php';
	$clients = new Clients();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'delete') {
		$client_id = filter_input(INPUT_GET, 'client_id');
		
		if($clients->deleteClient($client_id)){
			$array['result'] = ['status' => true];
		}else{
			$array['result'] = ['status' => false];
		}
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}

	require('../../class/Return.php');
?>