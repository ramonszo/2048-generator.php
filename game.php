<?php
  $gameAlias = trim(preg_replace('/[^a-z0-9-]+/', '-', strtolower($_GET['alias'])), '-');
  $gameDetails = array('url'=>'','numbers'=>1,'title'=>'2048','tiles'=>array());


  $filename = 'games/'.$gameAlias.'.json';
  if(file_exists($filename)){
    $gameDetails = json_decode(file_get_contents($filename), true);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $gameDetails['title']; ?></title>

  <link href="style/main.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="apple-touch-icon" href="meta/apple-touch-icon.png">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, maximum-scale=1, user-scalable=no, minimal-ui">

  <style>
  <?php
    foreach ($gameDetails['tiles'] as $tile => $image) {
      $img = (strpos($image, '://')===false)?'background-image: url(images/'.$image.'.jpg) !important;':'background-image: url('.$image.') !important; background-size: cover !important;';
echo '.tile-'.$tile.' .tile-inner { '.strip_tags($img).' }
  ';
    }
  ?>

  </style>
</head>
<body id="teh-game" <?php echo ($gameDetails['numbers'])?'':'class="no-numbers"'?>>
  <div class="container">
    <div class="heading">
      <h1 class="title"><?php echo $gameDetails['title']; ?></h1>
      <p class="game-intro">Join the images and get to the <strong>last tile!</strong></p>

      <!-- AddThis Button BEGIN -->
      <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
        <a class="addthis_button_facebook"></a>
        <a class="addthis_button_twitter"></a>
        <a class="addthis_button_google_plusone_share"></a>
        <a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
      </div>
      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-532bc5f645610bde"></script>
      <!-- AddThis Button END -->

      <div class="scores-container">
        <div class="score-container">0</div>
        <div class="best-container">0</div>
      </div>

    </div>

    <div class="game-container">
      <div class="game-message">
        <p></p>
        <div class="lower">
	        <a class="keep-playing-button">Keep going</a>
          <a class="retry-button">Try again</a>
        </div>
      </div>

      <div class="grid-container">
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
      </div>

      <div class="tile-container">

      </div>
    </div>

    <p class="game-explanation">
      <div style="clear:both;margin:20px 0;">&nbsp;</div>
      <strong class="important">How to play:</strong> Use your <strong>arrow keys</strong> to move the tiles. When two tiles with the same image touch, they <strong>merge into one!</strong>
    </p>
    <hr>
    <p>
      Based on <a href="http://git.io/2048">2048</a> by <a href="http://gabrielecirulli.com" target="_blank">Gabriele Cirulli.</a>
    </p> 
    <p>
      Generator by <a href="http://ramon82.com">ramon82.com</a>
    </p>
  </div>

  <script src="js/animframe_polyfill.js"></script>
  <script src="js/keyboard_input_manager.js"></script>
  <script src="js/html_actuator.js"></script>
  <script src="js/grid.js"></script>
  <script src="js/tile.js"></script>
  <script src="js/local_score_manager.js"></script>
  <script src="js/game_manager.js"></script>
  <script src="js/application.js"></script>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-34841052-5', 'ramon82.com');
    ga('send', 'pageview');

  </script>

</body>
</html>
