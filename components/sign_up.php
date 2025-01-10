<?php
// sign_up.php
?>

<h2>S'inscrire :</h2>
<form action="./submit.php" method="post">
    <div class="form-group my-4">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group my-4">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" required>
    </div>
    <div class="form-group mb-4">
        <label for="password">Password</label>
        <div class="input-group flex-nowrap">
            <input type="password" class="form-control" id="passwordS" name="password" aria-label="pwd"
                   value="<?= gen_mdp() ?>" required>
            <span class="input-group-text" id="togglePasswordS">
                <i class="fa fa-eye"></i>
            </span>
        </div>
        <?php include_once './components/helpPwd.php'; ?>
    </div>
    <input type="hidden" name="itsSign_up" value="true">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>