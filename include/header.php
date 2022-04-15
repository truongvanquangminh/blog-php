<?php include 'Database.php'; ?>
<?php include 'helpers/Format.php'; ?>

<?php
$db = new Database();
$fm = new Format();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'scripts/meta.php'; ?>
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.nivo.slider.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                effect: 'random',
                slices: 10,
                animSpeed: 500,
                pauseTime: 5000,
                startSlide: 0, //Set starting Slide (0 index)
                directionNav: false,
                directionNavHide: false, //Only show on hover
                controlNav: false, //1,2,3...
                controlNavThumbs: false, //Use thumbnails for Control Nav
                pauseOnHover: true, //Stop animation while hovering
                manualAdvance: false, //Force manual transitions
                captionOpacity: 0.8, //Universal caption opacity
                beforeChange: function() {},
                afterChange: function() {},
                slideshowEnd: function() {} //Triggers after all slides have been shown
            });
        });
    </script>
</head>

<body>
    <div class="headersection templete clear">
        <a href="index.php">
            <div class="logo">
                <img src="images/logo.png" alt="Logo" />
                <h2>Blog chia sẻ lập trình</h2>
                <p>HTML, CSS, JS, Java, PHP Tutorial</p>
            </div>
        </a>
        <div class="social clear">
            <div class="searchbtn clear">
                <form action="" method="get">
                    <input type="text" placeholder="Search keyword..." />
                    <input type="submit" value="Search" />
                </form>
            </div>
        </div>
    </div>
    <div class="navsection templete">

        <?php

        // $path = $_SERVER['SCRIPT_FILENAME'];
        // $currentpage = basename($path, '.php');
        ?>
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            
            <li><a href="contact.php">Liên hệ</a></li>
        </ul>
    </div>