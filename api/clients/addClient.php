<?php 
	require '../../class/Main.php';
	$clients = new Clients();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'post') {
		$client_name = filter_input(INPUT_POST, 'client_name');
		$client_cpf = filter_input(INPUT_POST, 'client_cpf');
		$client_group_id = filter_input(INPUT_POST, 'client_group_id');

		if($clients->addClient($client_name, $client_cpf, $client_group_id)){
			$array['result'] = ['status' => true];
		}else{
			$array['result'] = ['status' => false];
		}
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}

	require('../../class/Return.php');
?>