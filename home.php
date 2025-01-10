<?php
session_start();

include_once './components/head.php';
?>


<h1>Bienvenue <?= $_SESSION['login'] ?></h1>

<h3>Votre commune : <?= $_SESSION['commune'] ?></h3>

<?php
if (isset($_SESSION['msg'])) {
    echo '<div class="alert alert-' . ($_SESSION['logged'] ? "success" : "danger") . '" role="alert">' . $_SESSION['msg'] . '</div>';
    unset($_SESSION['msg']);
}

include_once './components/footer.php';
?>
