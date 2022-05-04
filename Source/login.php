<?php
session_start();
require_once("connect.php");
class User extends Database{
    function login($username, $password){
        $connect = $this->connect_database();
        $password=md5($password);
        $query="Select users.id,username, password, role from users where username='$username' and password='$password'";
        $result= mysqli_query($connect, $query);
//        var_dump($query);die;
        $i=mysqli_num_rows($result);
        if($i==1){
            while($row=mysqli_fetch_array($result)){
                $_SESSION["id"]=$row["id"];
                $_SESSION["username"]=$row["username"];
                $_SESSION["password"]=$row["password"];
                $_SESSION['role'] = $row['role'];
                echo "<script>
            window.location = '../main-ltr/index.php';
        </script>";
            }
        }

        else{
            echo 'username or password is wrong!';
        }
    }
    function confirm($username, $password, $role){
        if ($role != '1') {
            echo "<script>
                    window.location = '../main-ltr/user_index.php';
                </script>";
        }
        $connect = $this->connect_database();
        $query="Select username, password from users where username='$username' and password='$password'";
        $result= mysqli_query($connect, $query);
        if(!$result){
            echo "<script>
                    window.location = '../main-ltr/login.php';
                </script>";
        }
    }
}
?>