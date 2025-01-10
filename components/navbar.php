<?php
// navbar.php
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="./home.php">Home</a>
                        </li>';
                }
                ?>
            </ul>
        </div>
        <div>
            <?php
            if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                echo '<a class="btn btn-outline-danger" href="./logout.php">Se déconnecter</a>';
            } else {
                echo '<div class="btn-group" role="group">' . ($curPageName === 'pwdForgot.php'
                        ? '<a class="btn btn-outline-primary" href="/">Se connecter</a>
                           <a class="btn btn-outline-primary" href="/">S\'inscrire</a>'
                        : '<button type="button" class="btn btn-outline-primary" onclick="toggleLogin()">Se connecter</button>
                           <button type="button" class="btn btn-outline-primary" onclick="toggleSignup()">S\'inscrire</button>') . '
                    </div>';
            }
            ?>
        </div>
    </div>
</nav>