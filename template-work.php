<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=.8, maximum-scale=1, user-scalable=no">
  <title>JODI_ACADEMY: <?php echo $data['title']; ?></title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/opensans-light.css">
  <link rel="stylesheet" type="text/css" href="css/jodistyle.css">
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php?browse">JODI.ACADEMY</a>
      </div>
      <div class="dropdown viewmenu">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">View <span class="glyphicon dropchev glyphicon-chevron-down" aria-hidden="true"></span></button>
        <ul id="work-category-filter" class="dropdown-menu" aria-labelledby="dropdownMenu1" role="menu">
<?php

foreach ($data['media'] as $category):

  $has_previews = false;
  foreach ($category['media'] as $media) {
    if (!in_array(explode('/', $media['mime'])[0], array('audio', 'image', 'video'))) {
      continue;
    }
    $has_previews = true;
  }

  if ($has_previews):

?>
          <li role="presentation">
            <a role="menuitem" id="work-category-filter-<?php echo format_class($category['name']); ?>" class="nav-<?php echo format_class($category['name']); ?>"><?php echo $category['title']; ?></a>
          </li>
<?php

  endif;

endforeach;

?>
          <li>
            <a id="work-category-filter-all" class="nav-all">All</a>
          </li>
        </ul>
      </div>
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="meta col-md-6 stamp">
      <div class="meta row">
<?php

if (!empty($data['reference'])):

?>
        <div class="seeAlso">
          see also: [
<?php

  for ($i=0; $i < count($data['reference']); $i++):
    $reference = $data['reference'][$i];

?>
            <a href="<?php echo $reference['url']; ?>"><?php echo $reference['title']; ?></a><?php echo ($i+1 < count($data['reference'])) ? ', ' : ''; ?>
<?php

  endfor;

?>
          ]
        </div>
<?php

endif;

foreach ($data['url_work'] as $url):

?>
        <a href="<?php echo $url; ?>" target="_blank" class="h3">
        <div class="primaryURL">
          <?php echo rtrim(str_replace('http://', '', str_replace('https://', '', str_replace('www.', '', $url))), '/'); ?>
        </div></a>
<?php

endforeach;

?>
        <p class="metadata"></p>
        <pre id="metadata">
$jodi.meta({
  title: '<span class="jsonstring"><?php echo $data['title']; ?></span>',   
  createdDate: '<span class="jsonstring"><?php echo $data['year']; ?></span>',
  type: '<span class="jsonstring"><?php echo $data['type']; ?></span>',
<?php

if (!empty($data['materials'])) :

?>
  materials: ['<span class="jsonstring"><?php echo implode('</span>\', \'<span class="jsonstring">', $data['materials']); ?></span>'],
<?php

endif;

// add all media everything besides audio, image, video
foreach ($data['media'] as $category) {
  $found = false;

  foreach ($category['media'] as $media) {
    if (in_array(explode('/', $media['mime'])[0], array('audio', 'image', 'video'))) {
      continue;
    }

    if (!$found) {
      echo '  ' . $category['name'] . ': [';
      $found = true;
    } else {
      echo ', ';
    }

    echo '<a data-toggle="modal" class="modalURL media-type-' . format_class(explode('/', $media['mime'])[0]) . ' media-type-' .  format_class($media['mime']) . ' media-category-' . format_class($category['name']) . '" data-target="#media-' . substr(sha1($media['fn']), 0, 6) . '">' . $media['fn'] . '</a>';
  }

  if ($found) {
    echo '],' . "\n";
  }
}

?>
  ...
});
</pre>
        <p></p>
      </div>
    </div>
    <div class="description col-md-6 stamp">
      <div class="row descrow">
        <p></p>
        <h1><?php echo $data['title']; ?></h1>
<?php

if (!empty($data['description'])):

?>
        <?php echo $data['description']; ?>
<?php

endif;

?>
      </div>
    </div>
    <div id="tilecontainer" style="clear: left; padding-top: 20px;">
<?php

// previews
foreach ($data['media'] as $category) {

  foreach ($category['media'] as $media) {

    // skip everything besides audio, image, video
    if (!in_array(explode('/', $media['mime'])[0], array('audio', 'image', 'video'))) {
      continue;
    }

?>
      <a data-toggle="modal" class="modalURL" data-target="#media-<?php echo substr(sha1($media['fn']), 0, 6); ?>"><div class="work-preview work-category-<?php echo format_class($category['name']); ?> artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 700px; display:none;">
        <div style="padding-top: <?php echo ($media['height']/$media['width'])*100.0; ?>%;"></div>
        <img data-src="<?php echo $media['url']; ?>" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: <?php echo $media['width']; ?>px;" src="">
      </div></a>
<?php

  }

}

// modals
foreach ($data['media'] as $category) {

  foreach ($category['media'] as $media) {

?>
      <div class="work-modal work-category-<?php echo format_class($category['name']); ?> modal permalink modal-type-exhibition" id="media-<?php echo substr(sha1($media['fn']), 0, 6); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
<?php

    if ($media['mime'] == 'application/pdf') {

      echo '<object data="' . $media['url'] . '" type="application/pdf" width="780" height="585">';
      echo '<p><a href="' . $media['url'] . '">Download</a></p>';
      echo '</object>';

    } else if (substr($media['mime'], 0, 6) == 'image/') {

      echo '<div class="modalIMGs"><img class="modalIMG img-responsive" data-src="' . $media['url'] . '" alt="' . $media['description'] . '" src=""></div></a>';

    } else if ($media['mime'] == 'text/plain') {

      echo '<pre class="textcontainer">';
      $s = @file_get_contents($media['url']);
      if ($s !== false) {
        echo htmlentities($s, ENT_COMPAT|ENT_IGNORE);
      }
      echo '</pre>';

    }

?>
            </div>
          </div>
        </div>
      </div>
<?php

  }

}

?>
    </div>
  </div>

  <script src="js/jquery.min.js">
  </script>
  <script src="js/bootstrap.min.js">
  </script>
  <script type="text/javascript">
  $( document ).ready(function() {

    // pause video when modal is closed
    $('.modal').on('hidden.bs.modal', function () {
      $('video').trigger('pause');
      //history.pushState({}, '', window.location.pathname);
      window.location.hash = '';
    });

    // create modal permalink
    $(".modalURL").click(function() {
    history.pushState({}, '', $(this).attr("data-target"));
    });

    //when modal is closed, remove hash by setting location to origin
    // $origin = window.location.pathname;
    // $(".closer").click(function() {
    //  history.pushState({}, '', $origin);
    // });

    // modal permalink
    $(".modal.permalink").each(function(){
      if(window.location.hash.indexOf($(this).attr("id")) != -1){
        
        $id = $(this).attr("id");
        $hash = window.location.hash.substr(1);

        if ($id == $hash){
          $(this).modal('show');
        };
      }
    });

    var prim = $('.rep-primary').parent().detach();
    if (prim) {
      $(prim).insertAfter('#metadata');
    }

  });

  $('.modal').on('shown.bs.modal', function(e) {
    $(this).find('img').each(function() {
      // load the large version of the image when we open the modal
      if ( $(this).attr('data-src') ) {
        $(this).attr('src', $(this).attr('data-src'));
        $(this).removeAttr('data-src');
      }

      // constrain the image also on its height to prevent scrollbars
      $(this).css('max-height', 'calc('+$(window).height()+'px - 70px)');
    });

    $(this).find('object').each(function() {
      $(this).attr('width', $(window).width()*0.5);
      $(this).attr('height', $(window).height()-70);
    });
  });

  // contrain the image also on its height to prevent scrollbars
  $(window).on('resize', function(e) {
    $('.modal img').css('max-height', 'calc('+$(window).height()+'px - 70px)');
  });


  /* category filter */

  $('#work-category-filter').on('click', function(e) {
    var targetCategory = e.target.id.substring(21, e.target.id.length);

    // show previews, hide others
    if (targetCategory == 'all') {
      $('.work-preview').show();
    } else {
      $('.work-preview').not('.work-category-' + targetCategory).hide();
      $('.work-preview').filter('.work-category-' + targetCategory).show();
    }

    // load the preview version of the image when we select the category
    var toLoad;
    if (targetCategory == 'all') {
      toLoad = $('.work-preview');
    } else {
      toLoad = $('.work-preview').filter('.work-category-' + targetCategory);
    }
    $(toLoad).each(function() {
      // find any child img that has a data-src attribute
      $(this).find('img').each(function() {
        if ( $(this).attr('data-src') ) {
          $(this).attr('src', $(this).attr('data-src'));
          $(this).removeAttr('data-src');
        }
      });
    });

    // scroll to beginning of previews
    window.scrollTo(0, $('#tilecontainer').offset().top-50);
  });

  </script>
</body>
</html>
