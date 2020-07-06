<?php
include_once('staticQueries.class.php');
    class FetchFavourites extends StaticQueries
    {
        public static function fetchFavouriteWords(int $userID) : array
        {
            return self::getFavouriteWords($userID);
            exit();
        }
    }