<!doctype html>
<html lang="en" dir="ltr">
<head>
    <?php 
        $title = "Beta Artist Registration";
        include "inc/head.php"; 
    ?>
</head>
<body>

<div class="body">
    <header>
        <a href="<?=BASE_URL?>"><img src="<?=BASE_URL?>views/img/pir-logo.png" alt="PlayIf Radio"></a>
        <nav>
            <?php include "inc/topnav.php"; ?>
            <a href="<?php echo BASE_URL; ?>register/login/">Artist Login</a>
        </nav>
        <div class="clear"></div>
    </header>

    <content>

        <p class="intro">
            PlayIf Radio is a way to listen and a way to be heard. By listing their
            mainstream influences, underground talent can both upload their music and 
            have it discovered. PlayIf Radio isn't designed to cater to mega-million
            dollar pop stars, just type in the name of an artist you like and discover 
            the underground!&nbsp;
            <a href="<?=BASE_URL?>site/" class="box">Learn more about PlayIf Radio</a>
        </p>

        <h1>Beta Artist Registration</h1>

        <section class="left-col">
            <form action="<?=BASE_URL?>register/process" method="post">
                <h3 class="space">Artist Information</h3>
                <fieldset class="artist">
                    <p>
                        <label for="name">Artist Name</label>
                        <input name="name" class="required">
                    </p>
                    <p>
                        <label for="city">City</label>
                        <input name="city" class="required">
                    </p>
                    <p>
                        <label for="state">State</label>
                        <label class="clarifier">or Country</label>
                        <input name="state" class="required">
                    </p>
                    <p>
                        <label for="genre">Genre</label>
                        <input for="" name="genre" class="required">
                    </p>
                    <p>
                        <label for="artist1">Similar artist #1</label>
                        <label class="clarifier">(mainstream)</label>
                        <input name="artist1" class="required">
                    </p>
                    <p>
                        <label for="artist2">Similar artist #2</label>
                        <label class="clarifier">(mainstream)</label>
                        <input name="artist2" class="required">
                    </p>
                    <p>
                        <label for="artist3">Similar artist #3</label>
                        <label class="clarifier">(mainstream)</label>
                        <input name="artist3">
                    </p>
                    <p>
                        <label for="description">Description</label>
                        <textarea name="description"></textarea>
                    </p>
                </fieldset>
        </section>
        <section class="right-col">

            <h3 class="space">Contact Information</h3>
            <fieldset class="contact">
                <p>
                    <label for="contact_name">Full name</label>
                    <input name="contact_name" class="required">
                </p>
                <p>
                    <label for="email">Email</label>
                    <input name="email" class="required">
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" class="required" id="pass">
                </p>
                <p>
                    <label for="password2">Password</label>
                    <label class="clarifier">(confirm)</label>
                    <input type="password" name="password2" class="required" id="pass2">
                </p>
            </fieldset>
            <p class="small-copy">
                By checking, "I agree" below, you are agreeing that the information and content 
                you are providing to PlayIf Radio is your own original content and is not copied, 
                pirated, or stolen material. It also gives us permission to stream the content that 
                you are submitting from our database. PlayIf Radio will delete any information or 
                content that is copied, pirated, stolen or in certain cases, if a user submits 
                material that is unable to be streamed. If a band is signed to a label while material 
                is on PlayIf Radio, the band or record label MUST contact us to have material 
                removed from the website or in rare cases in which the band receives permission from the 
                record label to keep music on PlayIf Radio. We at PlayIf Radio will NEVER sell or 
                exploit your information or content.
            </p>
            <p>
                <input type="checkbox" class="agree" name="agreed" id="agreed" value="1"> 
                <label for="agreed">I agree to these terms and conditions.</label>
            </p>
            <p class="buttons">
                <button type="submit">Submit</button>
            </p>
            <p class="error"></p>
            </form>
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
            if ($('#pass').val() != $('#pass2').val())
            {
                $('.error').html("Passwords must match!");
                return false;
            }
            if (!$('.agree').attr('checked'))
            {
                $('.error').html("You must accept the terms!");
                return false;
            }
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
