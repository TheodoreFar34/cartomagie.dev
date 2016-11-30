<?php
require_once 'inc/bootstrap.php';
$auth = App::getAuth()->restrict();
if (!empty($_POST)){

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password-confirm'] ){
        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
    }else{
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once 'inc/db.php';
        $req = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password, $user_id]);
        $_SESSION['flash']['success'] = "Votre mot de passe à bien été mis a jour";
    }

}

?>
<?php require 'inc/header.php'; ?>

<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>

<form action="" method="POST">



    <div class="form-group">
        <input type="password" name="password" placeholder="Changer de mot de passe" class="form-control">
    </div>

    <div class="form-group">
        <input type="password" name="password-confirm" placeholder="Confirmation du mot de passe" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Changer mon mot de passe</button>

</form>


<?php require 'inc/footer.php'; ?>
