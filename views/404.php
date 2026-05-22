<!doctype html>
<html lang="en" dir="ltr">
<head>
    <?php 
        $title = "404";
        include "inc/head.php"; 
    ?>
</head>
<body>

<div class="body">
    <header>
        <img src="<?=BASE_URL?>views/img/pir-logo.png" alt="PlayIf Radio">
        <nav>
            <?php include "inc/topnav.php"; ?>
        </nav>
        <div class="clear"></div>
    </header>

    <content>

        <section class="left-col" style="width: 40%;">
            <h3>Ooopsie!</h3>
            <p>You went to a part of the site which does not exist.</p>
            <p><a href="<?=BASE_URL?>">Go home</a></p>
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
    });
</script>

</body>
</html>
