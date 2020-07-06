<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="fi" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Luo tili">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Luo tili - Tietotekniikkasanakartuttaja</title>
        <link rel="icon" href="demo_icon.gif" type="image/gif" sizes="16x16">
        <link href="https://fonts.googleapis.com/css?family=Contrail+One|Average&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/soP/assets/init.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <fieldset class="fieldsetL">
        <p id="signupMsg"></p>
        <legend>Syötä tietosi</legend>
            <input required name="user" id="user" type="text" placeholder="Käyttäjänimi">
            <br>
            <input required name="email" id="email" type="email" placeholder="Sähköposti">
            <br>
            <input required name="pwd" id="pwd" type="password" placeholder="Salasana">
<!--        <input required name="pwdCheck" id="pwdCheck" type="password" placeholder="Kirjoita salasana uudelleen">-->
            <br>
            <br>
            <button type="button" name="submitSignup" id="submitSignUpForm">Luo tili</button>    
        </fieldset>
        <script src="../assets/signUpFormValid.js" async defer></script>
    </body>
</html>