<!doctype html>
<html lang="en" dir="ltr">
<head>
    <?php include "inc/head.php"; ?>
    <script type="text/javascript">var switchTo5x=false;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'a780a7bc-4801-49c3-8694-f4fa90ac81c5'});</script>
</head>
<body>

<div class="body">
    <header>
        <a href="<?=BASE_URL?>"><img src="<?=BASE_URL?>views/img/pir-logo.png" alt="PlayIf Radio"></a>
        <nav>
            <?php include "inc/topnav.php"; ?>
            <?php if (!isset($this->session->logged_in)): ?>
            <a href="<?php echo BASE_URL; ?>register/login/">Artist Login</a>
            <?php endif; ?>
            <?php if (isset($this->session->logged_in)): ?>
            <a href="<?php echo BASE_URL; ?>register/add_music/">Artist Area</a>
            <?php endif; ?>
        </nav>
        <div class="clear"></div>
    </header>

    <content>

        <p class="intro">
            PlayIf Radio is a way to listen and a way to be heard. By listing their
            mainstream influences, underground talent can both upload their music and 
            have it discovered. PlayIf Radio is currently in active development, and we
            are looking for underground artists for the beta release.
            <a href="<?=BASE_URL?>register" class="box">Add your music to PlayIf Radio!</a>
        </p>

        <section class="left-col">
            <h3>How it works</h3>
            <ol>
                <li><span>1</span><p>Search for a mainstream artist you like.</p></li>
                <li><span>2</span><p>PlayIf Radio will create a station with indie artists similar to that mainstream artist.</p></li>
                <li class="space"><span>3</span><p>Sit back and discover the underground!</p></li>
            </ol>
        </section>
        <section class="right-col">
            <h3>Tell your friends!</h3>
            <p>If you support what we're doing, spread the word.</p>
            <p>
            <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                    <a class="addthis_button_facebook"></a>
                    <a class="addthis_button_twitter"></a>
                    <a class="addthis_button_email"></a>
                    <a class="addthis_button_google_plusone"></a>
                </div>
                <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f1219b22b7b9900"></script>
                <!-- AddThis Button END -->
            </p>
            <br>
            <br>
            <br>
            <h3>Sign-up for a beta invite</h3>
            <p>
                <form style="width:85%;" action="<?=BASE_URL?>site/add_email" method="post" id="form">
                    <label for="email">Email</label>
                    <input style="width: 200px;float:none;" name="email" id="email">
                    <button type="submit" style="float:right;margin-top:-3px;">Submit</button>
                </form>
                <span class="msg"><?php echo $value; ?></span>
            </p>
        </section>
    </content>
    <footer class="clear divider">
        <?php include "inc/footer.php"; ?>
    </footer>

</div>

<script>
    $(document).ready(function() {
        $('input,textarea').focus( function() {
            if ($(this).attr('type') == 'checkbox') return;
            var label = $(this).attr('name');
            $("label[for=" + label + "]").css('font-weight', 'bold');
        }); 
        $('input,textarea').blur( function() {
            var label = $(this).attr('name');
            $("label[for=" + label + "]").css('font-weight', 'normal');
        });
        /*

        $('button').click( function() {
            var usr_email = $('#email').val();
            if (usr_email == "") return false;
            $.ajax({
                type: 'POST',
                url: "<?=BASE_URL?>site/add_email",
                data: {
                    'email': usr_email
                },
                success: function(data) {
                    $('.msg').html("Submission successful, thanks!");        
                }
            });
            return false;
        });

        */

    });
</script>

</body>
</html>
