<?php
    include_once('conn.class.php');

    class UserFeed extends Conn
    {
        public int $wordID;
        public int $userID;
        public string $date;

        public function __construct(int $wordID, int $userID, string $date)
        {
            $this->wordID = $wordID;
            $this->userID = $userID;
            $this->date = $date;
        }

        public function __destruct()
        {
            $sqlInput = "INSERT INTO feed (wordID, userID, date) VALUES (?, ?, ?)";
            $stmtInput = $this->connect()->prepare($sqlInput);
            $stmtInput->execute([$this->wordID, $this->userID, $this->date]);
        }
    }