<?php include ROOT . '/views/layouts/header.php'; ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col" class="username-col">Long url</th>
            <th scope="col" class="email-col">Short code</th>
            <th scope="col">Link clicks</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($links as $link): ?>
            <tr>
                <td><?php echo $link['long_url']; ?></td>
                <td><a href="<?php echo $prefix . $link['short_code']; ?>"><?php echo $prefix . $link['short_code']; ?></a></td>
                <td><?php echo $link['counter']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include ROOT . '/views/layouts/footer.php'; ?>