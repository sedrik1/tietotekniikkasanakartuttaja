<?php
    include_once('staticQueries.class.php');
    include_once('FetchFavourites.class.php');

    class GetInfo extends StaticQueries
    {
        public static function echoS()
        {
            if(stripos($_REQUEST['user'], "Vieras") === 0) {
                echo json_encode(array('feedback' => 'Luo tili tallentaaksesi sanoja'));
            } else {
                $userID = self::checkUserID($_REQUEST['user']);
                $checkIfFavourite = self::checkFavourite($_REQUEST['wordID'], $userID['id']);
                if($checkIfFavourite === true) {
                    self::deleteWord($_REQUEST['wordID'], $userID['id']);
                    echo json_encode(
                        array(
                                'feedback' => 'Sana poistettu',
                                'array' => FetchFavourites::fetchFavouriteWords($userID['id'])
                        )
                    );
                } else {
                    $res = self::checkUserID($_REQUEST['user']);
                    if($res) {
                        self::addWord($_REQUEST['wordID'], $res['id']);
                        echo json_encode(
                            array(
                                    'feedback' => 'Sana lisätty suosikkeihin',
                                    'array' => FetchFavourites::fetchFavouriteWords($userID['id'])
                            )
                        );
                    }
                }
            }
            exit();
        }
    }

GetInfo::echoS();