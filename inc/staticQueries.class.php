<?php
    include_once("connStatic.class.php");

    class StaticQueries extends ConnStatic
    {
        private static array $favouriteWordArray = array();
        private static array $userFeedArray = array();

        public static function checkDatabaseForNewUser(string $username, string $email)
        {
            $sql = "SELECT username, email FROM users WHERE username = ? OR email = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$username, $email]);
            $names = $stmt->fetchAll();

            if($names) {
                foreach($names as $name) {
                    if($name['username'] === $username) {
                        return 0;
                    } else if($name['email'] === $email) {
                        return 1;
                    } else {
                        return true;
                    }
                }
            }
        }

        protected static function checkWordID(string $word) : array
        {
            $sql = "SELECT id FROM letter WHERE word = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$word]);
            return $stmt->fetch();
        }

        protected static function deleteWord(int $wordID, int $userID) : void
        {
            $sql = "DELETE FROM favourites WHERE wordID = ? AND userID = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$wordID, $userID]);
        }

        protected static function addWord(int $wordID, int $userID) : void
        {
            $sqlInput = "INSERT INTO favourites (wordID, userID) VALUES (?, ?)";
            $stmtInput = self::connect()->prepare($sqlInput);
            $stmtInput->execute([$wordID, $userID]);
        }

        protected static function checkFavourite(int $wordID, int $userID) : bool
        {
            $sql = "SELECT userID FROM favourites WHERE wordID = ? AND userID = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$wordID, $userID]);
            $res = $stmt->fetch();
            if($res) {
                return true;
            } else {
                return false;
            }
        }

        public static function checkUserID(string $user)
        {
            $sql = "SELECT id FROM users WHERE username = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$user]);
            $res = $stmt->fetch();
            if($res) {
                return $res;
            } else {
                return false;
            }
        }

        public static function checkIndividualUserEmail(string $user) : string
        {
            $sql = "SELECT email FROM users WHERE username = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$user]);
            $res = $stmt->fetch();
            if($res) {
                return $res['email'];
            }
        }

        private static function getEmailByID(int $userID) : string
        {
            $sql = "SELECT email FROM users WHERE id = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$userID]);
            $res = $stmt->fetch();
            if($res) {
                return $res['email'];
            }
        }

        private static function getUsernameByID(int $userID) : string
        {
            $sql = "SELECT username FROM users WHERE id = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$userID]);
            $res = $stmt->fetch();
            if($res) {
                return $res['username'];
            }
        }

        protected static function checkUserEmail(string $newEmail) : int
        {
            $sql = "SELECT email FROM users";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute();
            $emails = $stmt->fetchAll();

            if($emails) {
                foreach($emails as $email) {
                    if($email['email'] === $newEmail) {
                        return 0;
                    } else {
                        return 1;
                    }
                }
            }
        }

        protected static function deleteUser(int $userID) : void
        {
            $sqlFeed = "DELETE FROM feed WHERE userID = ?";
            $sqlFavs = "DELETE FROM favourites WHERE userID = ?";

            $stmt1 = self::connect()->prepare($sqlFavs);
            $stmt3 = self::connect()->prepare($sqlFeed);

            $stmt1->execute([$userID]);
            $stmt3->execute([$userID]);
            
            $sqlUser = "DELETE FROM users WHERE id = ?";
            $stmt2 = self::connect()->prepare($sqlUser);
            $stmt2->execute([$userID]);

        }

        protected static function newUserConfirmationEmail(string $username, string $userEmail) : void
        {
            $to = $userEmail;
            $subject = "Tili luotu sivulle Tietotekniikkasanakartuttaja";
            $message = "Hei ja onnittelut $username. Olet onnistuneesti luonut Tietotekniikkasanakartuttaja-sivullemme tilin. Siirry sivulle <a href='http://localhost/sop'>oheisella linkillä.</a>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <admin@tsk.fi>' . "\r\n";
            mail($to, $subject, $message, $headers);
        }

        protected static function setNewEmail(string $newEmail, string $user, string $oldEmail) : void
        {
            $sql = "UPDATE users SET email = ? WHERE username = ?";
            $stmt = self::connect()->prepare($sql);
            $stmt->execute([$newEmail, $user]);
            $subject = "Tilisi sähköpostiosoite on vaihdettu";
            $message = "Hei $user. Tilisi sähköpostiosoite $oldEmail on vaihdettu osoitteseen $newEmail.";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <admin@tsk.fi>' . "\r\n";
            mail($newEmail, $subject, $message, $headers);
        }

        protected static function deleteAccountEmail(int $userID) : void
        {
            $email = self::getEmailByID($userID);
            $username = self::getUsernameByID($userID);
            $subject = "Tilisi on poistettu";
            $message = "Hei $username. Tilisi on poistettu.";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <admin@tsk.fi>' . "\r\n";
            mail($email, $subject, $message, $headers);
        }

        public static function getFavouriteWords(int $userID) : array
        {
            $sqlW = "SELECT wordID FROM favourites WHERE userID = ?";
            $stmtW = self::connect()->prepare($sqlW);
            $stmtW->execute([$userID]);
            $resultsW = $stmtW->fetchAll();

            $sql = "SELECT * FROM letter WHERE id = ?";
            $stmt = self::connect()->prepare($sql);
            foreach($resultsW as $result) {
                foreach(array_unique($result) as $resUniq) {
                    $stmt->execute([$resUniq]);
                    $res = $stmt->fetchAll();
                    array_push(self::$favouriteWordArray, $res);
                }
            }
            return array_reverse(self::$favouriteWordArray);
        }

        public static function getFavouriteWord(int $wordID) : array
        {
            $sqlW = "SELECT word, def, id FROM letter WHERE id = ?";
            $stmtW = self::connect()->prepare($sqlW);
            $stmtW->execute([$wordID]);
            $res = $stmtW->fetch();
            return $res;
        }

        public static function getUserFeed(int $userID) : array
        {
            $sqlW = "SELECT wordID, date FROM feed WHERE userID = ?";
            $stmtW = self::connect()->prepare($sqlW);
            $stmtW->execute([$userID]);
            $resultsW = $stmtW->fetchAll();

            $sql = "SELECT * FROM letter WHERE id = ?";
            $stmt = self::connect()->prepare($sql);
            foreach($resultsW as $result) {
                $stmt->execute([$result['wordID']]);
                $res = $stmt->fetchAll();
                array_push($res[0], $result['date']);
                array_push(self::$userFeedArray, $res);
            }
            return array_reverse(self::$userFeedArray);
        }
    }