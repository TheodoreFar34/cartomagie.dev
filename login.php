<?php
require 'inc/bootstrap.php';
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);
if ($auth->user()){
    App::redirect('account.php');
}
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    $user = $auth->login($db, $_POST['username'], $_POST['password'], isset($_POST['remember']));
    $session = Session::getInstance();
    if ($user){
        $session->setFlash('success', "Vous êtes maintenant connecté");
        App::redirect('account.php');
    }else{
        $session->setFlash('danger', "Identifiant ou mot de passe incorrect");
    }
}
?>

<?php require 'inc/header.php'; ?>

<h1>Se connecter</h1>

<form action="" method="POST">
        <label for="username">Pseudo ou email :</label>
        <input placeholder="Votre pseudo ou email" type="text" name="username" class="form-control" id="username"><br>
        <label for="password">Mot de passe <a href="forget.php">(J'ai oublié mon mot de passe)</a>:</label>
        <input placeholder="Votre mot de passe" type="password" name="password" class="form-control" id="password"><br>
        <label for="remember" class="css-label">Se souvenir de moi
            <input class="css-checkbox" type="checkbox" name="remember" id="remember" value="1">
        </label><br>
        <button type="submit" class="btn btn-primary">Me connecter</button>
</form>


<?php require 'inc/footer.php'; ?>
