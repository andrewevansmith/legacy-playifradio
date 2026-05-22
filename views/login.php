<!doctype html>
<html lang="en" dir="ltr">
<head>
    <?php 
        $title = "Beta Artist Login";
        include "inc/head.php"; 
    ?>
    <link rel="stylesheet" href="<?=BASE_URL?>views/css/fileuploader.css">
    <script src="<?=BASE_URL?>views/js/fileuploader.js" type="text/javascript"></script>

</head>
<body>

<div class="body">
    <header>
        <a href="<?=BASE_URL?>"><img src="<?=BASE_URL?>views/img/pir-logo.png" alt="PlayIf Radio"></a>
        <nav>
            <?php include "inc/topnav.php"; ?>
        </nav>
        <div class="clear"></div>
    </header>

    <content>

        <section class="left-col" style="width: 40%;">
            <form action="<?=BASE_URL?>register/validate" method="post">
                <h3>Beta Artist Login</h3>
                <fieldset class="login">
                    <p>
                        <label for="email">Email</label>
                        <input name="email" id="email" class="required bigger">
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="bigger required" id="pass">
                    </p>
                    <p>
                        <button type="submit">Submit</button>
                    </p>
                    <p class="error">
                        <?php 
                        if (isset($error)) {
                            echo $error;
                        }
                        ?>
                    </p>
                </fieldset>
            </form>
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
