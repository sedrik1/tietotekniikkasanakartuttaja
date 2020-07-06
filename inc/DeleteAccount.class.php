<?php
    include_once('staticQueries.class.php');
    include_once('UserCookie.php');

    class DeleteAccount extends StaticQueries
    {
        public int $userID;
        public function __construct(int $userID)
        {
            $this->userID = $userID;
        }

        public function deleteAccount()
        {
            $this::deleteAccountEmail($this->userID);
            $this::deleteUser($this->userID);
            echo "Poistettu";
            exit();
        }
    }

$delete = new DeleteAccount($_COOKIE['user']);
$delete->deleteAccount();