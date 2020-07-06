<?php
    include_once('inc/staticQueries.class.php');
    include_once('UserCookie.php');

    class Login extends StaticQueries 
    {
        public static $usersWords = array();

        public function userLogin($username, $pwd)
        {
            if(!empty($username) && !empty($pwd)) {
                $sql = "SELECT id, username, password, email, adminPrivileges FROM users WHERE username = ?";
                $stmt = self::connect()->prepare($sql);
                $stmt->execute([$username]);
                $results = $stmt->fetch();
                if($results) {
                    if(password_verify($pwd, $results['password']) === TRUE) {
                        $_SESSION['id'] = $results['id'];
                        $_SESSION['username'] = $results['username'];
                        $_SESSION['email'] = $results['email'];
                        if($results['adminPrivileges'] === 0) {
                            $_SESSION['privileges'] = 0;
                        } else {
                            $_SESSION['privileges'] = $results['adminPrivileges'];
                        }
                        $newCookie = new UserCookie($results['id']);
                        header("Location: ?signin=success");
                    } else {
                        header("Location: ?signin=fail");
                    }
                } else {
                    header("Location: ?signin=fail");
                }
            }
            exit();
        }
    }