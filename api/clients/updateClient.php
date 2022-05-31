<?php
    require '../../class/Main.php';
    $clients = new Clients();
    $method = strtolower($_SERVER['REQUEST_METHOD']);

    if($method === 'put') {
        $input = json_decode(file_get_contents("php://input"));
        $array = json_decode(json_encode($input), true);

        $client_name = $array['client_name'];
        $client_cpf = $array['client_cpf'];
        $client_group_id = $array['client_group_id'];
        $client_id = $array['client_id'];

        if($clients->updateClient($client_name,$client_cpf,$client_group_id,$client_id)){
            $array['result'] = ['status' => true];
        }else{
            $array['result'] = ['status' => false];
        }
    }else{
        $array['result'] = ['error' => true, 'message' => 'Method not allowed'];
    }

    // require('../../class/Return.php');
?>