<?php include 'views/inc/head.php'; ?>
<div class="container">
    <section class="panel">
        <h1>Player Dashboard</h1>
        <p>This archived dashboard is a lightweight placeholder for the original listener experience.</p>
        <form method="post" action="<?=BASE_URL?>player/start">
            <label for="artist">Mainstream artist</label>
            <input id="artist" name="artist" type="text">
            <button type="submit">Create Station</button>
        </form>
    </section>
</div>
<?php include 'views/inc/footer.php'; ?>

