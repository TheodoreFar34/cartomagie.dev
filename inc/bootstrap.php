<?php
spl_autoload_register('app_autoload');

define('PAYPAL_USERNAME', 'tfarmachidi.dev-facilitator_api1.gmail.com');
define('PAYPAL_PASSWORD', '6TPFN2VCJ7ALYM8K');
define('PAYPAL_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AC.BiGASt3TaKpojhMMzITDiaZiM');

function app_autoload($class){
    require "class/$class.php";
}