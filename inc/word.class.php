<?php
include_once('staticQueries.class.php');
include_once('UserFeed.class.php');
include_once('UserCookie.php');
class Word extends StaticQueries
{
    public static array $printed = array();
    public static string $result;
    public static array $wordArray = array(
        'aaltosulje', 'aaltoviiva', 'ahne strategia', 'aidonnus', 
        'aikavaativuus', 'aikaviipale', 'aikaviipalekeskeytys', 'aikaväli', 
        'ajallinen paikallisuus', 'ajastin', 'ajatusviiva', 'ajoittaa', 'ajoituskaavio', 
        'ajonaikainen', 'ajuri', 'aktivaatiotietue', 'aktiviteettikaavio', 
        'akuuttiaksentti', 'alasvetovalikko', 'alaviiva', 'aliasesto', 'aliluokka', 
        'aliohjelma', 'alipuu', 'alivuoto', 'alkeistyyppi', 'altistus', 'anturi', 
        'apumuisti', 'asiakas-palvelin', 'askellisäys', 'askelpalautin', 
        'assosiatiivinen kuvaus', 'asymptoottinen', 'atominen', 'automaatti', 
        'avoin data', 'avoin hajautus', 'binäärihaku', 'bittikartta', 'botti', 
        'bézier-käyrä', 'caps lock', 'captcha', 'daemon', 'daemon prosessi', 
        'debuggaus', 'dedikoitu', 'deterministinen', 'diaesitys', 'dynaaminen lisenssi', 
        'eheytys', 'ehtolause', 'ehtomuuttuja', 'ei-keskeyttävä', 'elolukko', 'emolevy', 
        'emuloida', 'ennakoiva tekstinsyöttö', 'epädeterministinen', 
        'epätasapainoinen puu', 'erotin', 'erottelematon tila', 'erä', 'eräajo', 
        'eräkäsittely', 'esijärjestys', 'esiprotokolla', 'et-merkki', 'etenemispalkki', 
        'etäkäsittely', 'etäkäyttöohjelma', 'etäyhteys', 'fasaadimalli', 'firewire', 
        'gemena kirjain', 'gravisaksentti', 'haara (koodissa)', 'haara (puu)', 
        'haarautuma', 'haavoittuvuus', 'haavoittuvuutta hyödyntävä koodi', 
        'hahmontunnistus', 'haittaohjelma', 'hajautettu järjestelmä', 
        'hajautettu käyttöjärjestelmä', 'hajautettu laskenta', 'hajautus', 
        'hajautusarvo', 'hajautusfunktio', 'hajautustaulu', 'hajoita ja hallitse', 
        'hakasulku', 'hakkeri', 'hakupuu', 'hashtag', 'heittomerkki', 'herjaviesti', 
        'hiekkalaatikko (ohjelmaympäristö)', 'hienovirittää', 'hila', 
        'hukkaamaton tiivistys', 'hymiö', 'hyperlinkki', 'hyperteksti', 
        'hyppyjohdin', 'hyötykuorma', 'häirikköteknologia', 'häirintä', 
        'häiriöaika', 'häntärekursio', 'ihmisen ja tietokoneen vuorovaikutus', 
        'ilmaisinalue', 'ilmentymä', 'indeksoitu sarjallinen', 'invariantti', 
        'isännöinti', 'itsenäinen', 'jakoalkio', 'johdoton', 'jokerimerkki', 
        'jono', 'jonoverkkomalli', 'joukkoskedulointi', 'joutoaika', 'jutustelu', 
        'juuri', 'jälkijärjestys', 'jälkiprotokolla', 'järjestelmäkutsu', 
        'järjestäminen', 'jäsennin', 'jäsentää', 'kaari', 'kaksisuuntainen', 
        'kaksoishajautus', 'kaksoispiste', 'kantaluku', 'kapselointi', 'karsinta', 
        'kasautuminen', 'katkaista', 'kattoprioriteetti', 'kehyksen lukitseminen', 
        'kehys', 'kehäodotus', 'keko', 'kekojärjestäminen', 'kellojakso', 
        'kellotaajuus', 'kenoviiva', 'kenttä', 'kerrosajattelu', 'kerrostaa', 
        'kerrosverkko', 'kertaluokka', 'keskeyttävä', 'keskeytys', 'keskeytyskäsittelija', 
        'keskiarvoanalyysi', 'keskusmuisti', 'ketjutus', 'ketterä ohjelmistokehitys', 
        'kiertokysely', 'kiikkukytkin', 'kiinteä kytkös', 'kiintymys', 'kiistättömyys', 
        'kilpailutilanne', 'kloonata', 'koaksiaalikaapeli', 'kohina', 'kohinanpoisto', 
        'kokeilu', 'kokoava vuorovaikutuskaavio', 'kolikko', 'komentosarja', 'komentotulkki', 
        'kommunikaatiokaavio', 'komponenttikaavio', 'konenäkö', 'konstruktori', 
        'koostekaavio', 'korjaustiedosto', 'korkean tason kieli', 'korvaustila', 
        'koskemattomuus', 'kosketusnäyttö', 'kuittaus', 'kulmasulje', 'kuorman tasaus', 
        'kuormantasaus', 'kuormitus', 'kuplajärjestäminen', 'kustannusarvio', 'kutsu', 
        'kuva-alkio', 'kuvake', 'kuvan tallennus', 'kuvaus', 'kuviointi', 'kysely', 
        'kytkentäyksikkö', 'käsiteanalyysi', 'käskykanta', 'käskykanta-arkkitehtuuri', 
        'käytettävyysaika', 'käyttäjätila', 'käyttöaste', 'käyttöjärjestelmä', 
        'käyttöliittymä', 'käyttötapauskaavio', 'käytäntö', 'käänteinen sivutaulu', 
        'kääntäjä', 'kääre', 'laajennuskortti', 'laillinen systeeminmurtaja', 'lainausmerkki', 
        'laskemisjärjestäminen', 'laskennallisesti hankala', 'laskennan mallit', 
        'laskenta-aika', 'laskentaritilä', 'lehti', 'leveyssuuntainen läpikäynti', 
        'levypuskuri', 'levyvälimuisti', 'liehureuna', 'lihavoida', 'limitin', 'limittäin', 
        'lineaarinen kokeilu', 'lineaarisesti eroteltavissa', 'linkitetty lista', 
        'linkkipolku', 'lisäysjärjestäminen', 'lisäystila', 'literaali', 
        'liukuhihnakäsittely', 'liukuluku', 'liukusäädin', 'logiikkapommi', 'lohko', 
        'lomitusjärjestäminen', 'loopissa odotus', 'lukkiutuminen', 'luokitin', 'luokkakaavio', 
        'luonnollisen kielen käsittely', 'luotettavuus', 'luottamuksellisuus', 
        'luvaton käyttäjä', 'lähdekoodi', 'lähtösolmu', 'läpikirjoittava', 'läpimenovuo', 'löyhä kytkös', 'maalisolmu', 'mainostaja', 'makro', 'maksimikeko', 'massapostittaja', 'merkkauskieli', 'merkkijono', 'metatieto', 'mikro-ohjelmisto', 'minimikeko', 'monikerrosperseptroni', 'monikko (tietojenkäsittely)', 'moniperiytyminen', 'monisäikeinen', 'monitori', 'moniytiminen', 'morfata', 'muistipaikka', 'muuttumaton', 'määrittelydokumentti', 'nestekidenäyttö', 'neuroverkko', 'nimenvaltaus', 'numeronmurskaus', 'nuuskin', 'näppäimistön kaappari', 'näytönsäästäjä', 'oheislaite', 'ohjauslaatta', 'ohjausrakenne', 'ohjelmisto', 'ohjelmistotekniikka', 'ohjelmistotuotanto', 'oikeellisuus', 'oikeellisuustodistus', 'olio', 'oliokaavio', 'omisteinen', 'ongelman kohdealue', 'open access', 'open government', 'open movement', 'ositus', 'osituskäyttö', 'osoitin', 'otanta', 'otsake', 'pahantahtoinen ohjelma', 'paikkatieto', 'painokerroin', 'painotettu', 'pakkauskaavio', 'palomuuri', 'palvelinsovelma', 'palvelun lamautus', 'palvelupyynnön välittäjä', 'parametrisoitu laskenta', 'peesaus', 'pengonta', 'perinnejärjestelmä', 'perusavain', 'peruskäyttäjä', 'peräkkäishaku', 'petollinen järjestelmä', 'piilottelija', 'pikajärjestäminen', 'pikkukuva', 'ping-komento', 'pino', 'pirstoutuminen', 'pistematriisi', 'pisteväli', 'pohjoissilta', 'poikkeus', 'poissulkeminen', 'porrastaa', 'primäärinen kasautuminen', 'prosessin vaihto', 'protokollapino', 'puheentunnistus', 'puheposti', 'pullonkaula', 'puolipiste', 'pysähtymisongelma', 'päällekirjoittaa', 'pääsynoikeuslista', 'pääsynvalvonta', 'päätöksenteontukijärjestelmä', 'päätöspuu', 'raaka voima', 'rajapinta', 'rekursiivinen algoritmi', 'rekursiivisesti numeroituva', 'rekursio', 'rekursiopuu', 'rekursioyhtälö', 'relaatiomalli', 'renderointi', 'rengaslista', 'riippuvuus', 'rinnakkaistava kääntäjä', 'rinnakkaistettu sovellus', 'ripata', 'rivinvaihto', 'roskankeruu', 'rypäs', 'saantiviive', 'saatavuus', 'salainen käyttäjä', 'salaovi', 'salateksti', 'samanaikainen', 'sanastohyökkäys', 'sarjallistuvuus', 'sekundäärinen kasautuminen', 'sekvenssikaavio', 'seuraaminen', 'sidonta', 'siirrettävä koodi', 'siirtonopeus', 'sijoittelukaavio', 'silmukka', 'sirottelu', 'sisäinen pirstoutuminen', 'sisäkkäinen', 'sisäsolmu', 'sivutus', 'skaalautuvuus', 'solmu', 'sovellus', 'sovellusohjelmoinnin käyttöliittymä', 'sovellusten binäärikäyttöliittymä', 'sovelma', 'sprite-grafiikka', 'ssd-levy', 'startup-yritys', 'sulautettu järjestelmä', 'sulkulista', 'sumea logiikka', 'suora linkki', 'suoritinväylä', 'suoritinympäristö', 'suorittaa', 'suoritustila', 'suunnattu verkko', 'suuntaamaton verkko', 'suurtietokone', 'sykli', 'syklitön verkko', 'symbolinen linkki', 'synkroninen', 'syrjäytys', 'syvyyssuuntainen läpikäynti', 'syvätä', 'syöte', 'säie', 'säteenheitto', 'sävy', 'säädin', 'säännöllinen lauseke', 'tahdistamaton', 'takaisinkierto', 'takaisinkytkentä', 'takaisinkytkeytyvä neuroverkko', 'takaisinmallinnus', 'takaovi', 'tallennusritilä', 'tapahtumankäsittely', 'tappajasovellus', 'tarkastussumma', 'tasapainoinen hakupuu', 'tasoitettu analyysi', 'taulukko', 'tehokkuus', 'tekomuuttuja', 'tekoäly', 'tekstintunnistus', 'tiedon louhinta', 'tiedon muuttumattomuus', 'tiedon saatavuus', 'tiedonosoitusmoodi', 'tiedonsiirto', 'tiedostojärjestelmä', 'tiedostovälimuisti', 'tietojenkäsittely', 'tietokannan hallintajärjestelmä', 'tietokoneavusteinen opetus', 'tietokoneavusteinen suunnittelu', 'tietomurto', 'tietorakenne', 'tietotyyppi', 'tietovalkama', 'tietovuo', 'tietue', 'tiivistys', 'tilakaavio', 'tilakas', 'tilavaativuus', 'toimintokieli', 'toimitusvalmis', 'tonkeli', 'topologinen järjestys', 'traceroute', 'troll', 'tunkeutuminen', 'tunniste', 'turvatalletus', 'työnkulku', 'täsmälähetys', 'täydennysreitti', 'täytemerkki', 'täyttösuhde', 'ulkoinen pirstoutuminen', 'ulkoistaa', 'uudelleenhajautus', 'vaakasivu', 'vaatimusanalyysi', 'vaativuusluokka', 'vahva yhtenäinen komponentti', 'vahvasti yhtenäinen', 'vahvistusoppiminen', 'vaikutusalue', 'vakaa', 'vakoiluohjelma', 'valevirus', 'valintaruutu', 'valmisjärjestelmä', 'valmiusaika', 'vapaakäyntinen', 'varmistus', 'vasteaika', 'vastuunrajausilmoitus', 'vaununpalautus', 'velho', 'verkko', 'verkkoonpääsykerros', 'verkkourkinta', 'versaali kirjain', 'vieruslista', 'vierusmatriisi', 'vierussolmu', 'viite', 'viiteavain', 'viitetyyppinen', 'vikasietoinen', 'vinoviiva', 'virittävä puu', 'virtuaalimuisti', 'vuokaavio', 'vuoronanto', 'vuoverkko', 'välimuisti', 'välinepalkki', 'väliohjelmisto', 'välistys', 'välitallennus', 'ydin', 'yhdistely', 'yhdyskäytävä', 'yhdysmerkki', 'yhteentörmäys', 'yhteiskäyttö', 'yhteydetön kielioppi', 'yksivärinen', 'yliluokka', 
        'ylivuoto', 'yläindeksi', 'ympäröivä', 'yritysjärjestelmä', 'zombie', 'äänentunnistus'
    );
    
    public static function newWord() : void
    {
        $randnum = mt_rand(1, 200);
        $sql = "SELECT * FROM letter WHERE id = $randnum";
        $stmt = self::connect()->prepare($sql);
        $stmt->execute();
        $letter = $stmt->fetchAll();
        foreach($letter as $l) {

            $checkUserID = self::checkUserID($_REQUEST['user']);
            if($checkUserID !== false) {
                $checkWordId = self::checkWordID($l['word']);
                $checkFavourite = self::checkFavourite($checkWordId['id'], $checkUserID['id']);
                
                if($checkFavourite === true) {
                    $inputFeed = new UserFeed($l['id'], $_COOKIE['user'], date('d.m.Y'));
                    self::$result = json_encode(
                        array(
                            'msg' => 'Poista',
                            'word' => $l['word'],
                            'date' => date('d.m.Y'),
                            'id' => $l['id'],
                            'def' => $l['def']
                        )
                    );
                } else {
                    $inputFeed = new UserFeed($l['id'], $_COOKIE['user'], date('d.m.Y'));
                    self::$result = json_encode(
                        array(
                            'msg' => 'Lisää',
                            'word' => $l['word'],
                            'date' => date('d.m.Y'),
                            'id' => $l['id'],
                            'def' => $l['def']
                        )
                    );
                }
            } else { 
                self::$result = json_encode(
                    array(
                        'msg' => 'Lisää',
                        'word' => $l['word'],
                        'date' => date('d.m.Y'),
                        'id' => $l['id'],
                        'def' => $l['def']
                    )
                );
            }
        }
    }

    public static function printWord() : void
    {
        echo self::$result;
    }
}

Word::newWord();