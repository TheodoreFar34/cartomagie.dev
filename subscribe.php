<?php
require 'inc/bootstrap.php';
$auth = App::getAuth();
$auth->restrict();

if(isset($_POST['offer'])){
    $paypal = new PaypalSubscription(PAYPAL_USERNAME, PAYPAL_PASSWORD, PAYPAL_SIGNATURE, App::getOffers());
    $paypal->subscribe($_POST['offer']);
}

require 'inc/header.php';

?>


<h1>Boutique</h1>

    <form action="" method="POST">
        <ul>
           <?php foreach (App::getOffers() as $k => $offer):?>
                <li><input type="radio" name="offer" value="<?= $k ?>"> <?= $offer['name'] ?> - <?= $offer['price_text'] ?></li>
           <?php endforeach; ?>
        </ul>
        <button class="btn btn-primary">S'abonner</button>
    </form>

<?php require 'inc/footer.php'; ?>