<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>2048 Generator</title>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
  <link href="style/main.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="apple-touch-icon" href="meta/apple-touch-icon.png">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, maximum-scale=1, user-scalable=no, minimal-ui">

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="js/game_creator.js"></script>
</head>
<body>
  <div class="container">
    <div class="heading">
      <h1 class="title">2048 Generator</h1>
    </div>
    <p class="game-intro">Choose the images 
    & share the game with your friends :D</p>

    <div id="create-game">
      <form id="real-form" method="post" action="create.php" target="upload-frame">
        <input name="title" placeholder="Game Title" type="text">
        <div class="game-url">
          <span>http://2048.ramon82.com/</span>
          <input name="url" placeholder="GameURL" type="text">
        </div>

        <div class="gu error">Someone already used this URL.</div>
        <div class="gu typo">Only numbers and letters.</div>

        <label for="show_n" id="shw"><input checked value="1" type="checkbox" name="show_numbers" id="show_n"> Show tile numbers</label>
      </form>

      <div id="tiles"></div>

      <center><input type="button" id="big-submit" value="Create game!"></center>

      <iframe name="upload-frame" src="index2.html" width="0" height="0" frameborder="0" style="display:none"></iframe>
    </div>

    <hr>
    <p>
      Based on <a href="http://git.io/2048">2048</a> by <a href="http://gabrielecirulli.com" target="_blank">Gabriele Cirulli.</a>
    </p> 
    <p>
      Generator by <a href="http://ramon82.com">ramon82.com</a>
    </p>
  </div>

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
