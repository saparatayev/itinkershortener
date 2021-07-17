<?php include ROOT . '/views/layouts/header.php'; ?>


    <?php if($successMessage): ?>
        <p class="alert alert-success mt-2"><?php echo $successMessage; ?></p>
    <?php endif; ?>
    <?php if($errorMessage): ?>
        <p class="alert alert-danger mt-2"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <?php if (isset($errors) && is_array($errors)): ?>
        <ul class="my-2">
            <?php foreach ($errors as $error): ?>
                <li class="alert alert-danger"> <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="text-center">
        <?php if (User::isGuest()): ?>
            <h1>Get started free? Please <a href="/user/register">Sign up</a> <br>
            or <a href="/user/login">Log in</a></h1>
        <?php else: ?>
            <form action="#" method="POST" class="form-signin">
                <h1 class="h3 mb-3 font-weight-normal">Enter long url</h1>
                <textarea name="long_url" class="form-control my-1" required><?php if(isset($long_url)) {echo $long_url;} ?></textarea>
                <input type="submit" class="btn my-3 btn-primary" name="submit">
            </form>
        <?php endif; ?>
    </div>


<?php include ROOT . '/views/layouts/footer.php'; ?>