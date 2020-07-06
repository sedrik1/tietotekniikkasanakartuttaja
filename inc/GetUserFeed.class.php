<?php
    include_once('UserCookie.php');
    include_once('staticQueries.class.php');

    class GetUserFeed extends StaticQueries
    {
        private array $words = array();

        public function fetchFeed(int $userID)
        {
            $res = $this::getUserFeed($userID);
            return $this->checkFavourites($res);
            exit();
        }

        private function checkFavourites(array $wordArray)
        {
            foreach($wordArray as $array) {
                foreach($array as $index) {
                    if($this::checkFavourite($index['id'], $_COOKIE['user']) === false) {
                        array_push(
                            $this->words, 
                            array(
                                'msg' => 'Lisää',
                                'id' => $index['id'],
                                'word' => $index['word'],
                                'def' => $index['def'],
                                'date' => $index[0]
                            )
                        );
                    } else {
                        array_push(
                            $this->words, 
                            array(
                                'msg' => 'Poista',
                                'id' => $index['id'],
                                'word' => $index['word'],
                                'def' => $index['def'],
                                'date' => $index[0]
                            )
                        );
                    }
                }
            }
            return $this->words;
        }
    }

$fetchFeed = new GetUserFeed();
echo json_encode($fetchFeed->fetchFeed($_COOKIE['user']));