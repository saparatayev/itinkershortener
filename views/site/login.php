<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="text-center">
    <form action="#" method="post" class="form-signin">

        <?php if (isset($errors) && is_array($errors)): ?>
            <ul class="my-2">
                <?php foreach ($errors as $error): ?>
                    <li class="alert alert-danger"> <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <input type="text" name="login" class="form-control my-1" placeholder="Login" value="<?php echo $login; ?>">
        <input type="password" name="password" class="form-control my-1" placeholder="Password" value="<?php echo $password; ?>">
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
    </form>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>