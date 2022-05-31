<?php
    require '../../class/Main.php';
    $groups = new Groups();
    $method = strtolower($_SERVER['REQUEST_METHOD']);

    if($method === 'put') {
        $input = json_decode(file_get_contents("php://input"));
        $array = json_decode(json_encode($input), true);

        $group_name = $array['group_name'];
        $group_desc = $array['group_desc'];
        $group_id = $array['group_id'];

        if($groups->updateGroup($group_name,$group_desc,$group_id)){
            $array['result'] = ['status' => true];
        }else{
            $array['result'] = ['status' => false];
        }
    }else{
        $array['result'] = ['error' => true, 'message' => 'Method not allowed'];
    }

    require('../../class/Return.php');
?>