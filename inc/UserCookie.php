<?php

    class UserCookie
    {
        public int $userID;
        public function __construct(int $userID)
        { 
            $this->userID = $userID;
            setcookie("user", $this->userID, time() + (1728000 * 30), "/");
        }
    }