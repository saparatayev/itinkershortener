<?php include ROOT . '/views/layouts/header.php'; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <p class="alert alert-success mt-2"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>
    <?php if(isset($_SESSION['error_message'])): ?>
        <p class="alert alert-danger mt-2"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>

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
        <input type="text" name="email" class="form-control my-1" placeholder="Email" value="<?php echo $email; ?>">
        <input type="password" name="password" class="form-control my-1" placeholder="Password" value="<?php echo $password; ?>">
        <button class="btn btn-primary mx-2" name="submit" type="submit">Sign in</button>
        <a href="/user/register" class="mx-2">No account? Register</a>
    </form>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>