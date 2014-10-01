<?php
  $gameAlias = trim(preg_replace('/[^a-z0-9-]+/', '-', strtolower($_POST['url'])), '-');
  $filename = 'games/'.$gameAlias.'.json';

  $gameDetails = array(
    'url'=>$gameAlias,
    'title'=>$_POST['title'],
    'numbers'=>(int)$_POST['show_numbers'],
    'tiles'=>$_POST['tile']
  );

  if(file_exists($filename)){
    echo '<script>parent.aliasError();</script>';
  } else {
    file_put_contents($filename, json_encode($gameDetails, true));
    echo '<script>parent.gameCreated("'.htmlspecialchars($gameAlias, ENT_QUOTES).'");</script>';
  }
?>