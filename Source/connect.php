<?php
class Database
{
    function connect_database(){
        $connect = mysqli_connect("localhost", "root", "", "sinhvien");
        if (!$connect) {
            die("khong ket noi duoc");
        }
        $connect->set_charset("utf8");
        return $connect;
    }
    function get_admin()
    {
        $connect = $this->connect_database();
        $result = mysqli_query($connect, "select count(users.id) as total from users inner join user_details on users.id= user_details.id_user where role='1'");
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        echo '
            <a class="btn btn-outline btn-danger mb-5 d-flex justify-content-between" href="javascript:void(0)">Admin <span class="pull-right">'.$total.'</span></a>
        ';
    }
    function get_nv()
    {
        $connect = $this->connect_database();
        $result = mysqli_query($connect, "select count(users.id) as total from users inner join user_details on users.id= user_details.id_user where role='2'");
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        echo '
            <a class="btn btn-outline btn-info mb-5 d-flex justify-content-between" href="javascript:void(0)">Employee <span class="pull-right">'.$total.'</span></a>
        ';
    }
    function get_alluser()
    {
        $connect = $this->connect_database();
        $result = mysqli_query($connect, "select count(users.id) as total from users");
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        echo '
            <a class="btn btn-outline btn-warning mb-5 d-flex justify-content-between" href="javascript:void(0)">Tổng <span class="pull-right">'.$total.'</span></a>
        ';
    }

    function user_list(){
        $connect = $this->connect_database();
        $query = "select*from users inner join user_details on users.id= user_details.id_user";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($result)) {
            if($row['role']== 1){
                $string='admin';
            }
            elseif($row["role"] == 2) {
                $string='Employee';
            }
            if($row['id']==0){
                echo'Không có người dùng nào';
            }
            echo'<div class="media align-items-center">

                <span class="badge badge-dot "></span>	
    
                <a class="avatar avatar-lg status-success" href="#">
                  <img src="../../images/avatar/1.jpg" alt="...">
                </a>
    
                <div class="media-body">
                  <p>
                    <a href="#"><strong>'.$row['full_name'].'</strong></a>
                    <small class="sidetitle">'.$row['username'].'</small>
                  </p>
                  <p>Loại người dùng:'.$string.'</p>
    
                  <nav class="nav mt-2">
                    <a class="nav-link" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="nav-link" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="nav-link" href="#"><i class="fa fa-github"></i></a>
                    <a class="nav-link" href="#"><i class="fa fa-linkedin"></i></a>
                  </nav>
                </div>
    
                <div class="media-right gap-items">
    
                  <div class="btn-group">
                    <a class="media-action lead" href="#" data-toggle="dropdown"><i class="ion-android-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="../main-ltr/profile.php?id='.$row['id'].'"><i class="fa fa-fw fa-user"></i>Edit</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="../main-ltr/profile.php?id='.$row['id'].'"><i class="fa fa-fw fa-remove"></i> Remove</a>
                    </div>
                  </div>
                </div>
              </div>';
        }

    }
    public function getDetailUser(string $id): array {
        $connect = $this->connect_database();
        $query = "select*from users u inner join user_details ud on u.id= ud.id_user where u.id={$id}";
        $result = mysqli_query($connect,$query);
        $num = mysqli_num_rows($result);
        $data = [];
//        var_dump($query); die();
        if ($num > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $data['role'] = $row['role'];
                $data['full_name'] = $row['full_name'];
                $data['phone'] = $row['phone'];
                $data['created_at'] = $row['created_at'];
                $data['date'] = $row['birthday'];
            }
        }
        return $data;
    }


    public function updateUser(array $data, string $id): bool {
        $connect = $this->connect_database();
        $phone = $data['phone'];
        $full_name =  $data['full_name'];
        $birthday =  $data['birthday'];
        $role =  $data['role'];
        $query = "UPDATE user_details SET phone='${phone}', birthday='${birthday}', full_name='${full_name}' WHERE id_user = ${id};
                    ";
//        var_dump( $query);die;
        if (mysqli_query($connect, $query)) {
            $query2 = "UPDATE users SET role='${role}' WHERE id = ${id};";
            if (mysqli_query($connect, $query2))
            return 1;
        }

        return 0;
    }
    public function deleteUser(array $data, string $id): bool {
        $connect = $this->connect_database();
        //$role = $data["role"];
        $query = "
            SET FOREIGN_KEY_CHECKS=0;delete from user_details where id_user={$id}; delete from users where id={$id} ";
        var_dump($query);die;
        if (mysqli_query($connect, $query)) {
            return 1;
        }
        return 0;

    }
    function addnewUser($user,$pass, $full_name, $role, $phone, $date)
    {
        $link=$this->connect_database();
        $sql="select * from users where username='$user'";
        $result=mysqli_query($link,$sql);
        $numberUser = mysqli_num_rows($result);
        if($numberUser == 0)
        {
            $pass=md5($pass);
            $timestamp=time();
            $day=date("Y-m-d h:i:s",$timestamp);
            $sql_insert_tb_user = "INSERT INTO `users`(`username`, `password`, `role` )
            VALUES ('$user','$pass','$role')";
            mysqli_query($link,$sql_insert_tb_user);
            $id_user = mysqli_insert_id($link);
            if($id_user != 0) {
                $sql2="INSERT INTO `user_details`( `phone`, `birthday`,  `full_name`, `created_at`, `id_user`) 
               VALUES ('$phone','$date','$full_name','$day', $id_user)";
//                    var_dump($sql2);die;
                if(mysqli_query($link,$sql2))
                {
                    echo"<script>alert('User created');</script>";
                }
                else
                {
                    echo"<script>alert('Add user failed');</script>";
                }
            }
            else
            {
                echo"<script>alert('Add user failed');</script>";
            }
        }
        else
        {
            echo"<script>alert('Username already exists');</script>";
        }
    }
    public function updatePass(array $data, string $id): bool
    {
        $connect = $this->connect_database();
        $re_pass = $data['re_pass'];
        $password = $data['password'];
        $pass = md5($re_pass);
        $query = "select * from users where id={$id}";
        $result = mysqli_query($connect, $query);
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $current_pass = $row['password'];
//                var_dump($current_pass, $pass); die();
                if ($pass === $current_pass) {
                    echo 'password is same with current';
                }
                if ($re_pass === $password) {
                    $query = "UPDATE users SET password='${pass}' WHERE id = ${id}; ";
                    if (mysqli_query($connect, $query)) {
                        return 1;
                    }
                    return 0;
                }
            }
        }
        return 0;
    }

}