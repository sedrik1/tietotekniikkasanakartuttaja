<?php
    include_once('staticQueries.class.php');

    class CheckQuiz extends StaticQueries
    {
        public static function checkChoice() : void
        {
            $res = self::getFavouriteWord($_REQUEST['defID']);
            if($_REQUEST['word'] !== $res['id']) {
                echo "Väärin";
            } else {
                echo 'Oikein';
            }
            exit();
        }
    }

CheckQuiz::checkChoice();