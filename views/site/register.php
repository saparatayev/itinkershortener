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

        <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
        <input type="text" name="email" class="form-control my-1" placeholder="Email" value="<?php echo $email; ?>" required>
        <input type="password" name="password" class="form-control my-1" placeholder="Password" value="<?php echo $password; ?>" required>
        <button class="btn btn-primary" name="submit" type="submit">Sign up</button>
        <a href="/user/login" class="mx-2">Login</a>
    </form>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>