<?php
    include_once('staticQueries.class.php');

    class QuizWords extends StaticQueries
    {
        public static int $counter = 0;
        public static array $quizWords = array();

        public static function RandomQuizWords() : void
        {
            while(self::$counter < 4) {
                $randnum = mt_rand(1, 200);
                $sql = "SELECT word, def, id FROM letter WHERE id = $randnum";
                $stmt = self::connect()->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch();
                array_push(self::$quizWords, $res);
                self::$counter++;
            }
            echo json_encode(self::$quizWords);
            exit();
        }
    }
QuizWords::RandomQuizWords();