<?php
// pwdForgot.php

session_start();

include_once './components/head.php';

isset($_SESSION['codeVerif']) ? var_dump($_SESSION['codeVerif']) : var_dump('no codeVerif');
?>

    <h2 class="my-3">Mot de passe oublié ?</h2>

<?php // Si le code de vérification n'a pas été envoyé
if (!isset($_SESSION['codeVerif'])) : ?>
    <form action="./submit.php" method="post">
        <div class="form-group my-4">
            <label for="loginByMail">Entrer votre login (adresse mail)</label>
            <input type="text" class="form-control" id="loginByMail" name="loginByMail" required>
            <div id="emailHelp" class="form-text">
                Un code de vérification vous sera envoyé par mail pour réinitialiser votre mot de passe
            </div>
        </div>

        <input type="hidden" name="itsForgotPwd" value="true">
        <button type="submit" class="btn btn-primary">Envoyer un code de réinitialisation</button>
    </form>
<?php // Si le code de vérification a bien été envoyé
else : ?>
    <form action="./submit.php" method="post">
        <div class="form-group my-4">
            <label for="codeVerif">Code de vérification</label>
            <input type="text" class="form-control" id="codeVerif" name="codeVerif" required>
        </div>
        <div class="form-group my-4">
            <label for="newPwd">Nouveau mot de passe</label>
            <div class="input-group flex-nowrap">
                <input type="password" class="form-control" id="newPwd" name="newPwd" aria-label="newpwd"
                       value="<?= gen_mdp() ?>" required>
                <span class="input-group-text" id="togglePasswordF">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <?php include_once './components/helpPwd.php'; ?>
        </div>

        <input type="hidden" name="itsResetPwd" value="true">
        <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
    </form>

    <script src="./js/togglePwdF.js"></script>
<?php endif;

if (isset($_SESSION['mail'])) {
    if ($_SESSION['mail']) {
        echo '<div class="alert alert-info mt-5" role="alert">Un mail de vérification vous a été envoyé</div>';
    } else {
        echo '<div class="alert alert-danger mt-5" role="alert">Erreur lors de l\'envoi du mail</div>';
    }
    unset($_SESSION['mail']);
}

include_once './components/footer.php';