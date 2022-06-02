<?php 
    session_start();
    require_once('Config.php');
    $db = new DB();

    class Clients extends DB{
        
        public function getAllClients(){
            $sql = "SELECT * FROM clients";
            $sql = $this->connect()->query($sql);
            
            if($sql->rowCount() > 0){
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return array();
            }
        }

        public function addClient($client_name, $client_cpf, $client_group_id){
             $sql = "INSERT INTO clients(client_name, client_cpf, client_group_id)VALUES (:client_name, :client_cpf, :client_group_id)";
             $sql = $this->connect()->prepare($sql);
             $sql->bindValue(":client_name", $client_name);
             $sql->bindValue(":client_cpf", $client_cpf);
             $sql->bindValue(":client_group_id", $client_group_id);
             $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getClientName($client_id){
            $sql = "SELECT * FROM clients WHERE client_id = :client_id";
            $sql = $this->connect()->prepare($sql);
            $sql->bindValue(":client_id", $client_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $clientName = $sql->fetch(PDO::FETCH_ASSOC);
                return $clientName['client_name'];
            }else{
                return '';
            }
        }

        public function getClientInfo($client_id){
            $sql = "SELECT * FROM clients WHERE client_id = :client_id";
            $sql = $this->connect()->prepare($sql);
            $sql->bindValue(":client_id", $client_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                return $sql->fetch(PDO::FETCH_ASSOC);
            }else{
                return '';
            }
        }

        public function updateClient($client_name,$client_cpf,$client_group_id,$client_id){
            $sql = "UPDATE public.clients SET client_name=:client_name, client_cpf=:client_cpf, client_group_id=:client_group_id WHERE client_id=:client_id";
            $sql = $this->connect()->prepare($sql);   
            $sql->bindValue(":client_name", $client_name);
            $sql->bindValue(":client_cpf", $client_cpf);
            $sql->bindValue(":client_group_id", $client_group_id);
            $sql->bindValue(":client_id", $client_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function deleteClient($client_id){
            $sql = "DELETE FROM clients WHERE client_id = :client_id";
            $sql = $this->connect()->prepare($sql);
            $sql->bindValue(":client_id", $client_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
    }

    class Groups extends Clients{
        public function getAllGroups(){
            $sql = "SELECT * FROM clients_group WHERE group_id NOT IN (0)";
            $sql = $this->connect()->query($sql);
            
            if($sql->rowCount() > 0){
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return array();
            }
        }

        public function addGroup($group_name,$group_desc){
             $sql = "INSERT INTO clients_group(group_name, group_desc)VALUES (:group_name, :group_desc)";
             $sql = $this->connect()->prepare($sql);
             $sql->bindValue(":group_name", $group_name);
             $sql->bindValue(":group_desc", $group_desc);
             $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getGroupName($group_id){
            $sql = "SELECT * FROM clients_group WHERE group_id = :group_id";
            $sql = $this->connect()->prepare($sql);
            $sql->bindValue(":group_id", $group_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                return $data['group_name'];
            }else{
                return '';
            }
        }

        public function getGroupInfo($group_id){
            $sql = "SELECT * FROM clients_group WHERE group_id = :group_id";
            $sql = $this->connect()->prepare($sql);
            $sql->bindValue(":group_id", $group_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                return $sql->fetch(PDO::FETCH_ASSOC);
            }else{
                return '';
            }
        }

        public function updateGroup($group_name,$group_desc,$group_id){
            $sql = "UPDATE public.clients_group SET group_name=:group_name, group_desc=:group_desc WHERE group_id=:group_id";
            $sql = $this->connect()->prepare($sql);   
            $sql->bindValue(":group_name", $group_name);
            $sql->bindValue(":group_desc", $group_desc);
            $sql->bindValue(":group_id", $group_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function deleteGroup($group_id){
            $query = "UPDATE clients SET client_group_id = 0 FROM clients_group WHERE group_id = $group_id AND client_group_id = group_id;";
            $query .= "DELETE FROM clients_group WHERE group_id = $group_id;";

            $connect = pg_connect("host=".Config::DB_HOST." port=".Config::DB_PORT." dbname=".Config::DB_DATABASE." user=".Config::DB_USER." password=".Config::DB_PASS."") or die ("Error:".pg_last_error());
            $res = pg_query($connect, $query);
            $rows = pg_affected_rows($res);
            
            if($rows > 0) {
                return true;
                pg_close($connect);
            }else{
                return false;
                pg_close($connect);
            }
        }
    }
?>