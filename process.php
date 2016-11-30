<?php
require 'inc/bootstrap.php';
$auth = App::getAuth();
$auth->restrict();
$paypal = new PaypalSubscription(PAYPAL_USERNAME, PAYPAL_PASSWORD, PAYPAL_SIGNATURE, App::getOffers());
$paypal->doSuscribe($_GET['token']);