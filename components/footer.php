<?php
if (isset($_SESSION['msg'])) {
    echo '<div class="mt-5 alert alert-' . ($_SESSION['logged'] ? "success" : "danger") . '" role="alert">' . $_SESSION['msg'] . '</div>';
    unset($_SESSION['msg']);
}
?>

<footer class="bg-body-tertiary bg-gradient text-center py-3 mt-5">
    <p class="mb-0">© 2025 - Conseil Départemental. Tous droits réservés. [DEV]</p>
</footer>


<script src="./js/toggleLogin.js"></script>
<script src="./js/togglePwd.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>