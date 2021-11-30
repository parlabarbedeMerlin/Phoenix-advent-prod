<?php
class DatabaseManager{
    function __construct($host,$dbname,$user,$password){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    function connect(){
        try {
            $db = new PDO("mysql:host=". $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch(PDOException $e0){
            echo $e0;
        }
    }

    function getAll($table){
        $db = $this->connect();
        $query = "SELECT * FROM $table";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAllBy($table,$column,$value){
        $db = $this->connect();
        $query = "SELECT * FROM $table WHERE $column = :value";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':value',$value);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAllByOrder($table,$column,$value,$order){
        $db = $this->connect();
        $query = "SELECT * FROM $table WHERE $column = :value ORDER BY $order";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':value',$value);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAllByOrderLimit($table,$column,$value,$order,$limit){
        $db = $this->connect();
        $query = "SELECT * FROM $table WHERE $column = :value ORDER BY $order LIMIT $limit";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':value',$value);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAllByOrderLimitOffset($table,$column,$value,$order,$limit,$offset){
        $db = $this->connect();
        $query = "SELECT * FROM $table WHERE $column = :value ORDER BY $order LIMIT $limit OFFSET $offset";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':value',$value);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function insert($table,$columns,$values){
        $db = $this->connect();
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    function update($table,$columns,$values,$where){
        $db = $this->connect();
        $query = "UPDATE $table SET $columns WHERE $where";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    function delete($table,$where){
        $db = $this->connect();
        $query = "DELETE FROM $table WHERE $where";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

}

$db = new DatabaseManager();

?>