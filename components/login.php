<?php
// login.php
?>
<h2>Connection :</h2>
<form action="./submit.php" method="post">
    <div class="form-group my-4">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" required>
    </div>
    <div class="form-group mb-4">
        <label for="password">Password</label>
        <div class="input-group flex-nowrap">
            <input type="password" class="form-control" id="password" name="password" aria-label="pwd" required>
            <span class="input-group-text" id="togglePassword">
                <i class="fa fa-eye"></i>
            </span>
        </div>
        <a href="./pwdForgot.php" class="py-1 px-0 btn btn-link link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
            Mot de passe oublié ?</a>
    </div>


    <input type="hidden" name="itsLogin" value="true">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
