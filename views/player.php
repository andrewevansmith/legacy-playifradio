<?php include 'views/inc/head.php'; ?>
<div class="container">
    <section class="panel">
        <h1>Generated Station</h1>
        <?php if (!empty($songs)): ?>
            <ul>
                <?php foreach ($songs as $song): ?>
                    <li>
                        <strong><?=htmlentities($song['artist'])?></strong>
                        <?=htmlentities($song['name'])?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No archived tracks are available in this public reference copy.</p>
        <?php endif; ?>
    </section>
</div>
<?php include 'views/inc/footer.php'; ?>

