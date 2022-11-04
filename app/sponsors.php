<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Code Camp Slideshow</title>
  <link rel="stylesheet" href="css/superslides.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <style>
    body{
      margin:0px;
    }
  </style>
</head>
<body>
  <div id="slides">
    <div class="slides-container">
      <?php
        $photos = [];

        $images = scandir('logos');
        foreach ($images AS $image) {
          if (!preg_match('/^\./', $image)) {
            $dtime = ' data-time="5000"';
            $class = '';
            $photos[] = '<img src="logos/'.$image.'" alt=""'.$dtime.$class.'>';
          }
        }

        shuffle($photos);

        foreach ($photos AS $photo) { 
          echo $photo;
          echo "\n\t  ";
        }
      ?>
    </div>
  </div>

  <script src="javascripts/jquery.min.js"></script>
  <script src="javascripts/jquery.easing.1.3.js"></script>
  <script src="javascripts/jquery.animate-enhanced.min.js"></script>
  <script src="javascripts/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
  <script>
  jQuery(function($){
   
    $('#slides').superslides({
      play: 7000,
      animation_speed: 1000,
      animation_easing: 'swing',
      scrollable: false,
      pagination: false
    });

    $(document).on('animated.slides', function(){
      // Get total number of slides
      numberofslides = $('#slides').superslides('size');
      // Get current slide
      currentslide = $('#slides').superslides('current');
    });
  });
  </script>
</body>
</html>
