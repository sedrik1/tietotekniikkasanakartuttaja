<?php
    include_once('staticQueries.class.php');

    class SearchWord extends StaticQueries
    {
        public static string $searchResult;

        public static function SearchForWord()  : void
        {
            if(!empty($_REQUEST['q'])) {
                $sql = "SELECT * FROM letter";
                $stmt = self::connect()->prepare($sql);
                $stmt->execute();
                $letter = $stmt->fetchAll();
                foreach ($letter as $l) {
                    if (strpos($l['word'], $_REQUEST['q']) !== false) {

                        $checkUserID = self::checkUserID($_REQUEST['user']);
                        if($checkUserID !== false) {
                            $checkWordId = self::checkWordID($l['word']);
                            $checkFavourite = self::checkFavourite($checkWordId['id'], $checkUserID['id']);
            
                            if($checkFavourite === true) {
                                self::$searchResult = '
                                    <span id="'.$l['id'].'" 
                                    name="'.$l['word'].'" 
                                    class="addFavourite" 
                                    data="fav" 
                                    type="submit" 
                                    title="Poista sana suosikeistasi" 
                                    onclick="add(this)" 
                                    style="color: black;">★</span>
                                    <h4 class="wordTitle">'.$l['word'] . " | " . date('d.m.Y') .'</h4>
                                    <p class="contentText">'.$l['def'].'</p>    
                                ';
                                echo self::$searchResult;
                            } else {
                                self::$searchResult = '
                                    <span id="'.$l['id'].'" 
                                    name="'.$l['word'].'" 
                                    class="addFavourite" 
                                    data="fav" 
                                    type="submit" 
                                    title="Lisää sana suosikkeihisi" 
                                    onclick="add(this)" 
                                    style="color: gold;">★</span>
                                    <h4 class="wordTitle">'.$l['word'] . " | " . date('d.m.Y') .'</h4>
                                    <p class="contentText">'.$l['def'].'</p>    
                                ';
                                echo self::$searchResult;
                            }
                        } else { 
                            self::$searchResult = '
                                <span id="'.$l['id'].'" 
                                name="'.$l['word'].'" 
                                class="addFavourite" 
                                data="fav" 
                                type="submit" 
                                title="Lisää sana suosikkeihisi" 
                                onclick="add(this)" 
                                style="color: gold;">★</span>
                                <h4 class="wordTitle">'.$l['word'] . " | " . date('d.m.Y') .'</h4>
                                <p class="contentText">'.$l['def'].'</p>
                            ';
                            echo self::$searchResult;
                        }
                    }
                }
            }
            exit();
        }
    }
SearchWord::SearchForWord();