<?php 
    include_once 'db_credentials.php';
    include_once 'db_connection.php';
    $msg = "";
    $username_msg = "";
    $password_msg = "";

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        if(!empty($_POST['username']) AND !empty($_POST['password']))
        {
            if(Token::check($_POST['token']))
            {
                $uname = $_POST['username'];

                $pass = MD5($_POST['password']);

                $obj = new DB_connect();
                $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
                $query = "SELECT id,firstname,lastname,username,email,password,user_type_id FROM users where username = '".$uname."' AND password = '".$pass."' AND user_reg_status = 1";
                $result = $obj->select_records($query);
                if($result)
                {
                    foreach ($result as $key => $value) {
                        $query2 = 'SELECT user_type FROM user_types WHERE id = '.$value["user_type_id"];
                        $result2 = $obj->select_records($query2);
                        foreach ($result2 as $key2 => $value2) {
                            
                            if ($value2["user_type"] == "Student") {
                                session_start();
                                $_SESSION['firstname'] = $value['firstname'];
                                $_SESSION['username'] = $uname;
                                header("Location:student_dashboard.php");
                            }
                            else if ($value2["user_type"] == "Teacher") {
                                session_start();
                                $_SESSION['firstname'] = $value['firstname'];
                                $_SESSION['username'] = $uname;
                                header("Location:teacher_dashboard.php");
                            }
                            else if ($value2["user_type"] == "Admin") {
                                session_start();
                                $_SESSION['firstname'] = $value['firstname'];
                                $_SESSION['username'] = $uname;
                                header("Location:admin_dashboard.php");
                            }
                        }
                    }
                }
                else
                {
                    $query = "SELECT id FROM users where username = '".$uname."' AND user_reg_status = 1";
                    $result = $obj->select_records($query);

                    $query2 = "SELECT id FROM users where username = '".$uname."' AND password = '".$pass."' AND user_reg_status = 1";
                    $result2 = $obj->select_records($query2);

                    if (!$result) {
                        $username_msg = "Invalid Username";
                    }

                    if (!$result2) {
                        $password_msg = "Incorrect Password";
                    }
                }
            }
        }
        else
        {
            if(empty($_POST['username']))
            {
                $username_msg = "Please enter your username";
            }
            if(empty($_POST['password']))
            {
                $password_msg = "Please enter your password";
            }
        }
    }
 ?>