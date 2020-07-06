<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie('user', null, -1, '/');
    header("Location: ../?logout=success");
    exit();