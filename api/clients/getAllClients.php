<?php 
	require '../../class/Main.php';
	$clients = new Clients();

	$method = strtolower($_SERVER['REQUEST_METHOD']);

	if($method == 'get') {
		$data = $clients->getAllClients();

		forEach($data as $item) {
			$array['result'][] = [
				'client_id' => $item['client_id'],
				'client_name' => $item['client_name'],
				'client_cpf' => $item['client_cpf'],
				'client_group_id' => $item['client_group_id']
			];
		}
		require('../../class/Return.php');
	}else{
		$array['result'] = ['error' => true, 'message' => 'Method not allowed'];
	}
?>