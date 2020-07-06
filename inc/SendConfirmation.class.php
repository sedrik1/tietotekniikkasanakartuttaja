<?php
    include_once('staticQueries.class.php');

    class SendConfirmation extends StaticQueries
    {
        public function __construct(string $user, string $email)
        {
            $this::newUserConfirmationEmail($user, $email);
        }

        public function __destruct()
        {
            header('Location: ../?success');
        }
    }

$conf = new SendConfirmation($_REQUEST['user'], $_REQUEST['email']);