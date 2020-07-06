<?php
    include_once('staticQueries.class.php');

    class CheckInfo extends StaticQueries
    {
        public string $user;
        public string $email;
        public string $pwd;

        public function insertNewUser(string $user, string $email, string $pwd) : void
        {
            if(!filter_var( $user, FILTER_SANITIZE_STRING ) || 
            !filter_var( $email, FILTER_SANITIZE_EMAIL )) {
                echo json_encode(array('feedback' => 'Jokin syöttämistäsi tiedoista sisältää sallimattomia merkkejä'));
            } else {
                $this->user = trim($user);
                $this->email = trim($email);
                $this->pwd = trim($pwd);
                if(empty($this->user) || empty($this->email) || empty($this->pwd)) {
                    echo json_encode(array('feedback' => 'Jokin syöttämistäsi tiedoista on tyhjä'));
                } else {
                    $res = $this::checkDatabaseForNewUser($this->user, $this->email, $this->pwd);
                    if($res === 0) {
                        echo json_encode(array('feedback' => 'Käyttäjänimi on jo käytössä'));
                    } else if($res === 1) {
                        echo json_encode(array('feedback' => 'Sähköposti on jo käytössä'));
                    } else {
                        $this->pwd = password_hash($this->pwd, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                        $stmt = $this::connect()->prepare($sql);
                        $stmt->execute([$this->user, $this->email, $this->pwd]);
                        echo json_encode(
                            array(
                                'feedback' => 'Tilin luonti onnistui. Sinut ohjataan etusivulle',
                                'user' => $this->user,
                                'email' => $this->email
                            )
                        );
                    }    
                }
            }
        }
    }

$newUser = new CheckInfo();
$newUser->insertNewUser($_REQUEST['user'], $_REQUEST['email'], $_REQUEST['pwd']);