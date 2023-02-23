<?php
class User{
    
    private $connObj = null;
    public function __construct($connection){
        // $this->name = $name;
        // $this->username = $username;
        // $this->pwd = $pwd;
        // $this->email = $email;
        // $this->contact = $contact;
        $this->connObj = $connection;
    }

    public function create($name,$username,$pwd,$email,$contact)
    {
        $query = "INSERT INTO `users` (`id`, `name`, `username`, `email`, `pwd`, `contact`, `created_at`, `updated_at`) VALUES (NULL, '$name', '$username', '$email', '$pwd', '$contact', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $conn = $this->connObj->getConnection();
        $res = mysqli_query($conn, $query);
        return $res;
    }

    public function login($username, $password){
        $query = "select * from users where username = '$username' and pwd = '$password';";
        $conn = $this->connObj->getConnection();
        $res = mysqli_query($conn, $query);
        echo mysqli_error($conn);
        if (mysqli_num_rows($res) === 1){
            $row = mysqli_fetch_assoc($res);
            return array("success"=>true,"userid"=>$row['id']);
        }
        else{

            return array("success" => false);
        }

    }


}