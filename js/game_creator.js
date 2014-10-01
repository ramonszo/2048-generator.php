function gameCreated(alias){
  //$('#create-game').fadeOut();
  location.href='http://2048.ramon82.com/'+alias;
}

function validAlias(alias){
    reg = /^[\w ]+$/;
    return reg.test(alias);    
}

function isUrl(s) {
    var regexp = /((http|https):\/\/)?[A-Za-z0-9\.-]{3,}\.[A-Za-z]{2}/; 
    return s.indexOf(' ') < 0 && regexp.test(s);
}

function uploadSuccess(tileNum, tileFile){
  var tile = $('#tiles .tile-'+tileNum);
  var url = (!isUrl(tileFile))?'images/'+tileFile+'.jpg':tileFile;

  tile.css('background-image', 'url('+url+')');
  tile.parent().removeClass('uploading');

  tile.addClass('uploaded');
  tile.parent()[0].reset();

  $('#tile-img-'+tileNum).val(tileFile);
}

function aliasError(){
  $('.gu.error').fadeIn();
  $('.game-url input')[0].focus();
}

function verifyGame(v){
  if(!validAlias($(v).val())){
    $('.gu.typo').fadeIn();
    $('.game-url input')[0].focus();
  } else {
    $('.gu.typo').fadeOut();

    $.ajax('games/'+$(v).val()+'.json', {
      complete: function(status){
        if(status=='success'){
          $('.gu.error').fadeIn();
          $('.game-url input')[0].focus();
        } else {
          $('.gu.error').fadeOut();
        }
      } 
    });
  }
}

$(document).ready(function(){
    var tiles = [2, 4, 8, 16, 32, 64, 128, 256, 512, 1024, 2048];
    $.each(tiles, function(i, v){
      $('#tiles').append('<form target="upload-frame" class="tile-form" action="upload.php" method="post" enctype="multipart/form-data">\
        <div class="tile tile-loading uploaded"></div>\
        <div class="tile tile-'+v+'"><div class="tile-inner">'+v+'</div></div>\
        <input class="file" type="file" name="tile-img"><br>or\
        <input class="paste-url" data-tile="'+v+'" type="text" placeholder="Paste your image/gif URL" name="tile-url">\
        <input type="hidden" name="tile-num" value="'+v+'">\
      </form>');

      $('#real-form').append('<input type="hidden" name="tile['+v+']" id="tile-img-'+v+'">');
    });

    $('.paste-url').blur(function(){
      if(isUrl($(this).val())){
        uploadSuccess($(this).attr('data-tile'), $(this).val());
      }
    });

    $('.tile-form').each(function(){
      $(this).find('.file').change(function(){
        $(this).parent()[0].submit();
        $(this).parent().addClass('uploading');
      });
    });

    $('#show_n').change(function(){
      $('#tiles').toggleClass('no-numbers');
    });

    $('#big-submit').click(function(){
      if($('#real-form input').eq(0).val()==''){
        $('#real-form input').eq(0).focus();
      } else {
        if(!validAlias($('.game-url input').val())){
          $('.gu.typo').fadeIn();
          $('.game-url input')[0].focus();
        } else {
          $.ajax('games/'+$('.game-url input').val()+'.json', {
            complete: function(status){
              if(status=='success'){
                $('.gu.error').fadeIn();
                $('.game-url input')[0].focus();
              } else {
                $('.gu.error').fadeOut();
                $('#real-form')[0].submit();
              }
            } 
          });
        }
      }
    });

    $('.game-url input').blur(function(){
      verifyGame(this);
    });
});