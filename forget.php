<?php
require 'inc/bootstrap.php';
if(!empty($_POST) && !empty($_POST['email'])){
    $db = App::getDatabase();
    $auth = App::getAuth();
    $session = Session::getInstance();
    if($auth->resetPassword($db, $_POST['email'])){
        $session->setFlash('success', "Les instructions du rappel de mot de passse vous ont été envoyées par email");
        App::redirect('login.php');
    }else{
        $session->setFlash('danger', "Aucun compte ne correspond à cette adresse");
    }
}
?>

<?php require 'inc/header.php'; ?>

<h1>Mot de passe oublié</h1>

<form action="" method="POST">

    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="form-group">
    <button type="submit" class="btn btn-primary">Me connecter</button>
    </div>
</form>


<?php require 'inc/footer.php'; ?>
