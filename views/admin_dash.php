<!doctype html>
<html lang="en" dir="ltr">
<head>
    <?php 
        $title = "Admin Dashboard";
        include "inc/head.php"; 
    ?>
    <script src="<?=BASE_URL?>views/player/build/mediaelement-and-player.min.js"></script>
    <link rel="stylesheet" href="<?=BASE_URL?>views/player/build/mediaelementplayer.min.css" />
</head>
<body>

<div class="body">
    <header>
        <a href="<?=BASE_URL?>"><img src="<?=BASE_URL?>views/img/pir-logo.png" alt="PlayIf Radio"></a>
        <nav>
            <?php include "inc/topnav.php"; ?>
            <a href="<?=BASE_URL?>admin/logout">Logout</a>
        </nav>
        <div class="clear"></div>
    </header>

    <content>

        <section class="left-col" style="width: 40%;">
            <h3>Admin Area</h3>
            <ul class="artists">
                <?php foreach ($artists as $artist): ?>
                <li>
                    <strong><?php echo $artist['name']; ?></strong>
                    <ul class="tracks">
                        <?php foreach ($artist['tracks'] as $track): ?>
                        <li>
                            <a class="listen" href="<?=BASE_URL?>admin/listen/<?php echo $track['track_id']; ?>">listen</a>
                            <a href="<?=BASE_URL?>admin/approve/<?php echo $track['track_id']; ?>">approve</a>
                            <a class="disapprove" href="<?=BASE_URL?>admin/disapprove/<?php echo $track['track_id']; ?>">disapprove</a>
                            <?php echo $track['name']; ?> 
                            <div class="result"></div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section class="right-col">
            <p>
                <img class="no" src="<?=BASE_URL?>views/img/headphones.jpg" alt="Indie Music Radio!">
            </p>
        </section>
    </content>
    <footer class="clear divider">
        <?php include "inc/footer.php"; ?>
    </footer>

</div>

<script>
    $(document).ready(function() {
        // Fire on submit
        $('button').click( function() {
            var valid = true;
            // Check all required
            $('.required').each( function() {
                if ($(this).val() == '')
                {
                    valid = false;
                    $('.error').html("All fields are required!");
                    return false;
                }
            });
            if (!valid) return false;
            return true;
        });
        $('input,textarea').focus( function() {
            if ($(this).attr('type') == 'checkbox') return;
            var label = $(this).attr('name');
            $("label[for=" + label + "]").css('font-weight', 'bold');
        }); 
        $('input,textarea').blur( function() {
            var label = $(this).attr('name');
            $("label[for=" + label + "]").css('font-weight', 'normal');
        });

        $('.tracks').hide();

        $('.artists>li').click( function() {
            $(this).children('ul').toggle();    
        });

        $('.tracks a').click( function() {
            if ($(this).hasClass('listen'))
                var x = $(this).next().next().next();
            else if ($(this).hasClass('disapprove'))
                var x = $(this).next();
            else
                var x = $(this).next().next();
            $.ajax({
                url: $(this).attr('href'),
                success: function(data) {
                    x.html(data);
                    $('audio').mediaelementplayer();
                }
            });
            return false;
        });
    });
</script>

</body>
</html>
