<!doctype html>
<html lang="en" dir="ltr">
<head>
    <?php 
        $title = $artist['name'] . " Music";
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
            <a href="<?=BASE_URL?>register/logout">Logout</a>
        </nav>
        <div class="clear"></div>
    </header>

    <content>

        <p class="intro">
            Welcome <?=$artist['contact_name']?>!
        </p>

        <h2 style="margin-bottom:0;"><?=$artist['name']?> Music</h2>

        <section class="left-col">
                <?php 
                    if (is_array($tracks)):
                    echo "<h4>Your tracks</h4><ul>";
                    foreach ($tracks as $track): 
                ?>
                <li>
                    <?php 
                        echo $track['name'];
                        if ($track['status'] == "inactive") {
                            echo " <span>under review</span>";
                        }
                    ?>
                </li>
                <?php 
                    endforeach; 
                    echo "</ul>";
                    endif;
                ?>
            <form action="<?=BASE_URL?>register/process_music/<?=$id?>" method="post">
                <div id="file-uploader-demo1">		
                    <noscript>			
                        <p>Please enable JavaScript to use file uploader.</p>
                        <!-- or put a simple form for upload here -->
                    </noscript>         
                </div>
                <input type="hidden" name="filename" id="filename">
                <div style="display: none;" class="dialog-wrapper">
                </div>
                <div id="track-name-dialog">
                    <label>Please enter the name of the track:</label>
                    <input name="name" id="track_name" class="required">
                    <p>
                        <button class="add_track" type="submit">Submit</button>
                    </p>
                </div>
                <script>        
                    function createUploader(){            
                        var count = 0;
                        var uploader = new qq.FileUploader({
                            element: document.getElementById('file-uploader-demo1'),
                            action: '<?=BASE_URL?>uploads/php.php',
                            onSubmit: function(id, fileName) {
                                $('.qq-upload-button').hide();
                            },
                            onComplete: function(id, fileName, result) {
                                $('#filename').val(result.filename);
                                $('.dialog-wrapper').toggle();
                                $('#track-name-dialog').toggle();
                            },
                            debug: true
                        });           
                    }
                    // in your app create uploader as soon as the DOM is ready
                    // don't wait for the window to load  
                    window.onload = createUploader;     
                </script> 
                <?php if (isset($v)): ?>
                <label style="color: green;"><?=$v;?> - add another</label><br>
                <?php endif; ?>
                <p style="font-size:10px">mp3 files are referred. Maximum file size is 15mb.</p>
            </form>
        </section>
        <section class="right-col">
            <p>
                <img src="<?=BASE_URL?>views/img/headphones.jpg" alt="Indie Music Radio!">
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
