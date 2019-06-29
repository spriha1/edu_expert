<?php 
    include_once 'db_credentials.php';
    include_once 'db_connection.php';
    if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['password']) && !empty($_POST['password']))
    {
        $uname = $_POST['username'];
        //echo $uname;
        //exit();

        $pass = MD5($_POST['password']);

        $obj = new DB_connect();
        $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
        $query = "SELECT id,user_type_id FROM users where username = '".$uname."' AND password = '".$pass."' AND user_reg_status = 1";
        $result = $obj->select_records($query);
       
        foreach ($result as $key => $value) {
            
       
            $query2 = 'SELECT user_type FROM user_types WHERE id = '.$value["user_type_id"];
            $result2 = $obj->select_records($query2);
            foreach ($result2 as $key2 => $value2) {
               
            
                if($result)
                {
                    if ($value2["user_type"] == "Student") {
                        session_start();
                        $_SESSION['username'] = $uname;
                        header("Location:student_dashboard.php");
                    }
                    else if ($value2["user_type"] == "Teacher") {
                        session_start();
                        $_SESSION['username'] = $uname;
                        header("Location:teacher_dashboard.php");
                    }
                    else if ($value2["user_type"] == "Admin") {
                        session_start();
                        $_SESSION['username'] = $uname;
                        header("Location:admin_dashboard.php");
                    }
                    else
                    {
                        header("Location:register.php");
                    }
                }
                else
                {
                        header("Location:register.php");
                }
            }
        }
    }
 ?>