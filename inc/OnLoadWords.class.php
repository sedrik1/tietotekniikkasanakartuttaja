<?php

include_once('staticQueries.class.php');
$userID = StaticQueries::checkUserID($_REQUEST['user']);
echo json_encode(
    array(
        'array' => StaticQueries::getFavouriteWords($userID['id'])
    )
);
exit();