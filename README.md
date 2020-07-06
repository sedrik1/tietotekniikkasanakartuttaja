# tietotekniikkasanakartuttaja / IT word accumulator
PHP-pohjainen, AJAXia hyödyntävä tietotekniikkasanakartuttaja, joka mm. tulostaa sivulle suomenkielisiä IT-sanoja selityksineen, tilin luonnin sanojen tallentamista ja latausta CSV-tiedostona varten ja sanavisan sanojen tarkoituksien ymmärtämisen testaamiseksi.

A PHP and AJAX based web page that among other things prints Finnish IT words to the front page with descriptions, offers a word quiz to test one's understanding of the words, creating an account and saving as well as downloading the words as an CSV-file.

# asentaminen / installation
Käyttämistä varten tarvitaan palvelin ja SQL-tietokanta. Olen itse käyttänyt XAMPP-tekniikkapinkkaa (tuki Apache-palvelimelle, phpMyAdminille ja PHP:lle), jossa hakemisto asetetaan polkuun: xampp/htdocs/`kansio`. Tietokanta on nimellä `words` ja sen sisällä taulut `favourites`, `words`, `feed`, `letter` ja `users`.
<br/>
Kuva tietokantamallista tässä osoitteessa: https://sedrik1.github.io/imgs/ttsk/ttsk%20(5).png.

<ul>
  <li>favourites-taulun malli on favouriteID (INT, primary key (PK) ja AUTO_INCREMENT (A_I)), wordID (INT, !null, default: none) ja userID (INT, secondary key (SK))</li>
  <li>feed-taulun malli on feedID (INT, PK, !null, default: none, A_I), wordID (INT, null, default: null) ja userID (INT, null, default: null, SK) ja date (VARCHAR, null, default: null)</li>
  <li>letter-taulun malli on id (INT, PK, !null, default: none, A_I), word (tinytext, null, default: null) ja def (mediumtext, !null, default: none)</li>
  <li>users-taulun malli on id (INT, PK, !null, default: none, A_I), username (varchar, null, default: null), email (varchar, null, default: null), password (varchar, null, default: null), adminPrivileges (INT, null, default: 0)</li>
</ul>

One needs to have a server and an SQL database. I have used XAMPP which provides support for an Apache server, phpMyAdmin and PHP. Place the directory to: xampp/htdocs/`directory`. The database is named `words` with tables `favourites`, `words`, `feed`, `letter` and `users`.
<br/>
A picture of the database model can be observed here: https://sedrik1.github.io/imgs/ttsk/ttsk%20(5).png.

<ul>
  <li>favourites table model is favouriteID (INT, primary key (PK) ja AUTO_INCREMENT (A_I)), wordID (INT, !null, default: none) ja userID (INT, secondary key (SK))</li>
  <li>feed table model is feedID (INT, PK, !null, default: none, A_I), wordID (INT, null, default: null) ja userID (INT, null, default: null, SK) ja date (VARCHAR, null, default: null)</li>
  <li>letter table model is  id (INT, PK, !null, default: none, A_I), word (tinytext, null, default: null) ja def (mediumtext, !null, default: none)</li>
  <li>users table model is  id (INT, PK, !null, default: none, A_I), username (varchar, null, default: null), email (varchar, null, default: null), password (varchar, null, default: null), adminPrivileges (INT, null, default: 0)</li>
</ul>
