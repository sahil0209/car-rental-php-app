<?php
class Car{

    private $connection = null;
    
    public function __construct($connection){
        $this->connection = $connection;
    }

    public function index(){
        $query = "select * from cars";
        if($res = mysqli_query($this->connection->getConnection(),$query)){
            return $res;
        }
    }

    public function get($id){
        $query = "select * from cars c, car_details cd where c.id=cd.cid and c.id=$id";
        if($res = mysqli_query($this->connection->getConnection(),$query)){
            return $res;
        }
    }

    public function getSingleCarDetail($id){
        $query = "select * from cars c, car_details cd where c.id = cd.cid and cd.id=$id";
        if($res = mysqli_query($this->connection->getConnection(),$query)){
            return $res;
        }
    }
}

?>