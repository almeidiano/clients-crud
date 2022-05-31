<?php 
	require '../../class/Main.php';
	$clients = new Clients();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == "get") {
		$client_id = filter_input(INPUT_GET, 'client_id');
		$client_info = $clients->getClientInfo($client_id);
		exit(json_encode($client_info));
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}

	require('../../class/Return.php');
?>