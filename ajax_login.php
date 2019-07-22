<?php 
    session_start();
    include_once 'db_credentials.php';
    include_once 'db_connection.php';
    include_once 'validate_input.php';
    include_once 'csrf_token.php';

    $msg = "";
    
    if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
        if (!empty($_REQUEST['username']) AND !empty($_REQUEST['password'])) {
            if (Token::check($_REQUEST['token'])) {
                
                $uname = $_REQUEST['username'];
                $pass = MD5($_REQUEST['password']);

                $obj = new DB_connect();
                $query = "SELECT id,firstname,lastname,username,email,password,user_type_id FROM users where username = '".$uname."' AND password = '".$pass."' AND user_reg_status = 1";
                $result = $obj->select_records($conn, $query);
                if ($result) {
                    foreach ($result as $key => $value) {
                        $query2 = 'SELECT user_type FROM user_types WHERE id = '.$value["user_type_id"];
                        $result2 = $obj->select_records($conn, $query2);
                        foreach ($result2 as $key2 => $value2) {
                            session_start();
                            $_SESSION['firstname'] = $value['firstname'];
                            $_SESSION['username'] = $uname;
                            $msg = $value2["user_type"];
                        }
                    }
                }
                else {
                    $query = "SELECT id FROM users where username = '".$uname."' AND user_reg_status = 1";
                    $result = $obj->select_records($conn, $query);

                    $query2 = "SELECT id FROM users where username = '".$uname."' AND password = '".$pass."' AND user_reg_status = 1";
                    $result2 = $obj->select_records($conn, $query2);

                    if (!$result && !$result2) {
                        $msg = "Incorrect Username and Password";
                    }

                    else if (!$result) {
                        $msg = "Incorrect Username";
                    }

                    else if (!$result2) {
                        $msg = "Incorrect Password";
                    }
                }
                
            }
        }
        else {
            if (empty($_REQUEST['username']) && empty($_REQUEST['password'])) {
                $msg = "Please fill in the details";
            }
            else if (empty($_REQUEST['username'])) {
                $msg = "Please enter your username";
            }
            else if (empty($_REQUEST['password'])) {
                $msg = "Please enter your password";
            }
        }
    }
    print_r($msg);
?>