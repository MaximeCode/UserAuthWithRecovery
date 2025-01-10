<?php

// Création d'une session
session_start();
//unset($_SESSION['codeVerif']);

include_once './components/head.php';
?>

<h1 class="my-3">ArchivesTest</h1>

<div id="login_div">
    <?php include_once './components/login.php'; ?>
</div>

<div id="sign_up_div" style="display: none;">
    <?php include_once './components/sign_up.php'; ?>
</div>

<?php

include_once './components/footer.php'; ?>
