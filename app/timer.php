<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

date_default_timezone_set('America/Denver');
$then = strtotime('2023-11-18 07:59:59');
$now = time();
$left = ($then - $now);

if ($now > $then):
    header('Location: sponsors.php');
else:

$thours = $left / 3600;
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

    #time{
      position: fixed;
      bottom:0px;
      right:10px;
      font-family:'Roboto', helvetica, sans-serif;
      z-index:10000000;
      font-size:4em;
      text-align: right;
      opacity:0.001;
    }

    #time:before{
      font-size:0.5em;
      display:block;
    }

    #time.center{
      position:absolute;
      top:50%;
      transform: translateY(-50%);
      left:0px;
      text-align:center;
      font-size:10em;
    }

    #wifi {
      display: block;
      position: fixed;
      bottom: 0px;
      left: 0px;
      font-family: 'Roboto', helvetica, sans-serif;
      z-index: 9999999;
      font-size: 2.5em;
      text-align: left;
      padding: 10px;
      opacity: 0.001;
    }

    #wifi > div:first-of-type {
      font-size: .7em;
    }

    #wifi.center {
      display: none;
    }
  </style>
</head>
<body>
  <?php echo '<!-- '.($left).' -->'; ?>
  <div id="time"<?= ($thours < 1)?' class="center"':'' ?>></div>
  <div id="wifi"><div>Wifi Credentials</div><div>CodeCamp</div><div>Welcome2Vasion</div></div>
  <div id="slides">
    <div class="slides-container">
      <?php if ($thours >= 1): ?><img src="images/codecamp.png" data-time="20000" alt="">

      <?php
//        if ($thours >= 5 and $thours <= 24) {
//          echo '<img src="images/judging-register.png" alt="" data-time="60000">';
//          echo "\n\t  ";
//        }

        $photos = [];

        $images = scandir('logos');
        foreach($images AS $image):
          if(!preg_match('/^\./', $image)):
            $dtime = '';
            $class = '';
            if(preg_match('/(platinum)/', $image)):
              $dtime = ' data-time="10000"';
              $class = ' class="platinum"';   
            elseif(preg_match('/(gold)/', $image)):
              $dtime = ' data-time="7000"';
              $class = ' class="gold"';
            else:
              $dtime = ' data-time="5000"';
            endif;
            
            $photos[] = '<img src="logos/'.$image.'" alt=""'.$dtime.$class.'>';
          endif;
        endforeach;

        shuffle($photos);

        foreach($photos AS $photo):
          echo $photo;
          echo "\n\t  ";
        endforeach;
      endif;
      ?><img src="images/blank.png" data-time="50000" alt="">
    </div>
  </div>

  <script src="javascripts/jquery.min.js"></script>
  <script src="javascripts/jquery.easing.1.3.js"></script>
  <script src="javascripts/jquery.animate-enhanced.min.js"></script>
  <script src="javascripts/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
  <script data-version="<?= mt_rand(); ?>">
  jQuery(function($){
    <?php echo "var endtime = $left;"; ?>

    <?php if ($thours >= 1) { ?>
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

      if(currentslide == 0){
        $('#time,#wifi').removeClass('center').fadeTo(500, 1);
      }

      // last slide
      if (currentslide === numberofslides-1) {
        $('#time').fadeTo(250, 0.001).addClass('center').fadeTo(250, 1);
        $('#wifi').fadeTo(500, 0.001);

        setTimeout(function(){
          $('#time,#wifi').fadeTo(500, 0.001, function(){
            window.location.reload(true);
          });
        }, 30000);
      }
    });
    <?php } else { ?>
    $('#time,#wifi').fadeTo(500, 1);
    setTimeout(
      function(){
        $('#time,#wifi').fadeTo(500, 0.001, function(){
          window.location.reload(true);
        });
      },
    60000);
    <?php } ?> 


    function getTimeRemaining(t){
      t = parseInt(t);
      var seconds = Math.floor( (t) % 60 );
      var minutes = Math.floor( (t/60) % 60 );
      var hours = Math.floor( (t/(60*60)) % 24 );
      var days = Math.floor( t/(60*60*24) );
      var obj = {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
      };
      return obj;
    }

    function pad(n) {
      n = n + '';
      return n.length >= 2 ? n : new Array(2 - n.length + 1).join('0') + n;
    }

    function updateClock(clock){
        var t = getTimeRemaining(endtime);
        endtime = endtime - 1;
        
        if(t.total<=0){
          clock.innerHTML = '00:00:00';
          clearInterval(timeinterval);
        }else{
          var hours = t.hours + t.days*24;
          var pre = '';
          var str = 'Time Remaining: ';
          if (hours >= 24) {
            str = 'You may start in: ';
            hours = hours - 24;
          }
          document.styleSheets[0].addRule('#time:before','content: "'+str+'";');
          clock.innerHTML = pad(hours) + ':' + pad(t.minutes) + ':' + pad(t.seconds);
        }
    }

    var clock = document.getElementById('time');
    updateClock(clock);
    var timeinterval = setInterval(function(){ updateClock(clock); },1000);


  });
  </script>
</body>
</html>
<?php
endif;
?>
