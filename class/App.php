<?php
class App{

    static $db = null;

    static function getOffers(){
        return [
            [
                'name'=> 'Abonnement mensuel',
                'price'=> 10,
                'price_text'=> '10€/mois',
                'period' => 'Month'
            ],
            [
                'name'=> 'Abonnement annuel',
                'price'=> 100,
                'price_text'=> '100€/ans',
                'period' => 'Year'
            ]
        ];
    }

    static function getDatabase(){
        if (!self::$db){
            self::$db = new Database('root', '', 'cartomagie');
        }
        return self::$db;
    }

    static function redirect($page){
        header("Location: $page");
        exit();
    }

    static function getAuth(){
        return new Auth(Session::getInstance(), ['restriction_msg' => 'Vous n\'avez pas le droit d\'acceder à cette page']);
    }
    static function card($img, $dateDay, $dateMonth, $category, $title, $subtitle, $description, $comments, $time){
        echo "<article class=\"card\">
    <header class=\"card__thumb\">
        <a href=\"#\">
            <img src=\"$img\">
        </a>
    </header>
    <div class=\"card__date\">
        <span class=\"card__date__day\">$dateDay</span>
        <span class=\"card__date__month\">$dateMonth</span>
    </div>
    <div class=\"card__body\">
        <div class=\"card__category\"><a href=\"#\">$category</a></div>
        <h2 class=\"card__title\"><a href=\"#\">$title</a></h2>
        <div class=\"card__subtitle\">$subtitle</div>
        <p class=\"card__description\">
            $description
        </p>
    </div>
    <footer class=\"card__footer\">
        <span class=\"icon icon--time\"></span>$time
        <span class=\"icon icon--comment\"></span><a href=\"#\">$comments</a>
    </footer>
</article>";
    }



}