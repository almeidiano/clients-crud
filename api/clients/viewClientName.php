<?php 
	require '../../class/Main.php';
	$clients = new Clients();
	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'get') {
		$client_id = filter_input(INPUT_GET, 'client_id');
		$client_name = $clients->getClientName($client_id);

		exit(json_encode($client_name));
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}
?>