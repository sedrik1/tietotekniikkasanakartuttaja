<?php
    include_once('inc/Login.class.php');
    include_once('inc/FetchFavourites.class.php');
    include_once('inc/staticQueries.class.php');
    include_once('inc/UserCookie.php');
    session_start();

    if(isset($_POST['submitLogin'])) {
        Login::userLogin($_POST['loginUser'], $_POST['loginPwd']);
    }
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="fi" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Kasvata tietotekniikan sanavarastoasi">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tietotekniikkasanakartuttaja - suomen kielen tietotekniikkasanaston tyyssija</title>
        <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
        <link rel="manifest" href="assets/site.webmanifest">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Contrail+One|Average&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/init.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <button onclick="topFunction()" id="topB" class="topB" title="Takaisin ylös">&and;</button>
        <div class="jumbotron text-center" id="topbar">
            <h1 class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="topTitle">Tietotekniikkasanakartuttaja</h1>
            <nav class="navbar navbar-expand-lg navbar-dark text-center">
                <button class="navbar-toggler text-center" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav justify-content-center" id="collapsibleNavbar">
                    <ul id="buttonlist" class="navbar-nav nav justify-content-center">
                    <?php
                        if(!isset($_SESSION['id'])) {
                            echo '<li data="contentButton" style="border-left: 0px;" class="btn">Tallennetut sanat</li>';
                        } else {
                            echo '<li data="contentButton" onclick="" style="border-left: 0px;" class="btn">Profiili ja tallennetut sanat</li>';
                        }
                        ?>
                        <li data="contentButton" class="btn">Etusivu</li>
                        <li data="contentButton" id="randWordButton" class="btn">Satunnainen sana</li>
                        <li data="contentButton" onclick="quizWords()" class="btn">Sanavisa</li>
                        <?php
                            if(!isset($_SESSION['id'])) {
                                echo '<li id="loginButton" class="btn">Kirjaudu sisään</li>';
                            } else {
                                echo '<li onclick="out()" id="logoutButton" class="btn">Kirjaudu ulos</li>';
                            }
                        ?>
                        <li style="border-right: 0px;" class="btn" onclick="Mode()" id="mode">Tumma tila</li>
                    </ul>
                </div>  
            </nav>
            <input placeholder="Etsi sanaa" class="col-xs-12 col-s-12 col-md-7 col-lg-4" style="margin-top: 6px;" type="text" id="sana">
            <div class="container">
                <div class="row">
                    <div class="col-s-12 col-md-12 col-lg-12" id="loginFormContainer" style="display: none;">
                        <form class="" id="loginForm" method="POST" action="">
                            <h4 style="padding: 3px; margin-top: 3px; color: black;">Kirjaudu sisään</h4>
                            <input name="loginUser" type="text" placeholder="Käyttäjänimi">
                            <input name="loginPwd" type="password" placeholder="Salasana">
                            <button type="submit" name="submitLogin" id="loginSubmitButton">Kirjaudu sisään</button>
                        </form>
                        <button class="col-6" id="loginButtonButton" onclick="redirectToLogin()">Ei tiliä? Klikkaa siirtyäksesi luomaan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="pseudoModal" class="content">
                <span id="closeModal" title="Sulje haku" class="closeRand">&times;</span>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <p style="font-weight: bold;">Haun tulokset:</p>
                        <div id="innerModal"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div id="content" data="displayContent" class="col-s-12 col-md-12 col-lg-12 content">
                    <h6 id="feedbackVisitor" style="font-weight: bold; display: none;"></h6>
                        <div class="randWord" id="randWord">
                            <span class="closeRand" title="Sulje Satunnainen sana -taulu" id="closeRand">&times;</span>
                            <p style="font-weight: bold;">Satunnainen sanasi:</p>
                            <div id="randWordInner">
                                <span id="replaceID"></span>
                                <h4 id="replaceH4"></h4>
                                <p id="replaceP"></p>
                            </div>
                        </div>
                        <br>
                        <label for="times">Muuta sanantulostusnopeutta:</label>
                        <select onchange="setPrintWord(this)" id="times">
                            <option disabled selected>Oletusasetuksena minuutti</option>
                            <option value="1000">Sekunti</option>
                            <option value="5000">Viisi sekuntia</option>
                            <option value="30000">30 sekuntia</option>
                            <option value="60000">Minuutti</option>
                            <option value="300000">Viisi minuuttia</option>
                            <option value="600000">Kymmenen minuuttia</option>
                            <option value="1800000">Puoli tuntia</option>
                            <option value="3600000">Tunti</option>
                        </select>
                        <br>
                        <br>
                        <div id="getWord"></div>
                        <div id="getWord1"></div>
                    </div>
                    <div id="profile" data="displayContent" class="col-s-12 col-md-12 col-lg-12 content" style="display:none;">
                        <span id="showContentText">Näytä profiilitiedot &or;</span>
                        <div class="contentText" style="display:none;" id="a">
                            <?php 
                                if(!isset($_SESSION['id'])) {?>
                                    <span class="echoedInfo" id="profileName">Vieras</span>
                                <?php } else { ?>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <span id="profileName" class="echoedInfo"><?php echo $_SESSION['username'] ?></span>
                                                <br/>
                                                <span id="profileEmail" class="echoedInfo"><?php echo StaticQueries::checkIndividualUserEmail($_SESSION['username']) ?></span>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                <input class="emailInfo" placeholder="Syötä uusi sähköpostiosoite" type="email" id="changeEmail">
                                                <p class="profileButtons" onclick="changeEmail()" id="changeEmailButton">Vaihda sähköpostiosoitettasi</p>
                                                <p id="emailFeedback"></p>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-4">
                                                <a class="profileButtons" href="inc/DownloadWords.inc.php?user=<?php echo $_SESSION['username']?>" download>Lataa tallentamasi sanat CSV-tiedostona</a>
                                            </div>
                                            <div class="col-sm-12 col-md-2 col-lg-2">
                                                <p class="profileButtons" onclick="deleteAcco()" id="deleteAccount">Poista tili</p>
                                            </div>
                                        </div>
                                <?php }
                            ?>
                        </div>
                        <div style="margin-top: 48px;" id="favourites">
                            <?php 
                                if(!isset($_SESSION['id'])) {
                                    echo "";
                                } else {
                                    echo "";
                                }
                            ?>
                        </div>
                    </div>
                    <div id="quiz" data='displayContent' class="col-s-12 col-md-12 col-lg-12 content" style="display:none;">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>Arvaa sana määritelmän perusteella:<p id="wordDefinition"></p></div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div id="quizContentRow" class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div id="quizContent">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="container d-flex justify-content-start mb-3">
                                <p style="margin: 15px;" id="result"></p>
                                <button style="margin: 9px;" class="profileButtons" onclick="quizWords()" style="display:none;" id="newWords">Kokeile onneasi uudestaan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p id="feedback" class="feedback"></p>

        <script src="assets/quizWords.js" async defer></script>
        <script src="assets/checkQuiz.js" async defer></script>
        <script src="assets/loginForm.js" async defer></script>
        <script src="assets/js.js" async defer></script>
        <script src="assets/randWord.js" async defer></script>
        <script src="assets/contents.js" async defer></script>
        <script src="assets/addFav.js" async defer></script>
        <script src="assets/ajaxGetWord.js" async defer></script>
        <script src="assets/ajaxWord.js" async defer></script>
        <script src="assets/onLoadWords.js" async defer></script>
        <script src="assets/newEmail.js" async defer></script>
        <script src="assets/userFeed.js" async defer></script>
        <script src="assets/deleteAcco.js" async defer></script>
    </body>
</html>