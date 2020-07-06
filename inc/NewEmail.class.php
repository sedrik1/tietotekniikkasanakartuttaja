<?php
    include_once('staticQueries.class.php');
    class NewEmail extends StaticQueries
    {
        public static function changeEmail()
        {
            $oldEmail = self::checkIndividualUserEmail($_REQUEST['user']);
            if(!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array('feedback' => 'Sähköpostiosoite on väärässä muodossa', 'newEmail' => $oldEmail));
            } else {
                $aNewEmail = $_REQUEST['email'];
                $checkEmail = self::checkUserEmail($aNewEmail);
                if($checkEmail === 0) {
                    echo json_encode(array('feedback' => 'Sähköpostiosoite on jo käytössä', 'newEmail' => $oldEmail));
                } else if($checkEmail === 1){
                    self::setNewEmail($aNewEmail, $_REQUEST['user'], $oldEmail);
                    $_SESSION['email'] = $aNewEmail;
                    echo json_encode(array('feedback' => 'Sähköposti vaihdettu', 'newEmail' => $aNewEmail));
                } else {
                    echo json_encode(array('feedback' => 'Jokin meni pieleen', 'newEmail' => $oldEmail));
                }
            }
            exit();
        }
    }

NewEmail::changeEmail();