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
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" role="menu">
<?php

foreach ($data['media'] as $category):

?>
          <li role="presentation">
            <a role="menuitem" class="nav-<?php echo format_class($category['name']); ?>"><?php echo $category['title']; ?></a>
          </li>
<?php

endforeach;

?>
          <li>
            <a class="nav-all">All</a>
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

    echo '<a data-toggle="modal" class="modalURL media-type-' . format_class(explode('/', $media['mime'])[0]) . ' media-type-' .  format_class($media['mime']) . ' media-category-' . format_class($category['name']) . '" data-target="#media-491">' . $media['fn'] . '</a>';
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
      <a data-toggle="modal" class="modalURL" data-target="#media-476">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 700px; display:none;">
      <div style="padding-top: 133.333333333%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/43766_ca_object_representations_media_476_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 525px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-476" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/54733_ca_object_representations_media_476_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-490">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 700px; display:none;">
      <div style="padding-top: 104.633781764%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/11033_ca_object_representations_media_490_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 669px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-490" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/77973_ca_object_representations_media_490_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-274">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 487px; display:none;">
      <div style="padding-top: 69.5714285714%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/2/68459_ca_object_representations_media_274_medium.png" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-274" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/2/89279_ca_object_representations_media_274_original.png" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-276">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition rep-primary" style="max-height: 459px;">
      <div style="padding-top: 65.5714285714%;"></div><img src="http://jodi.academy/media/collectiveaccess/images/2/77024_ca_object_representations_media_276_medium.png" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-276" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/2/45484_ca_object_representations_media_276_original.png" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-471">
      <div class="artworkIMG dist packitem rep-image rep-type-artwork" style="max-height: 477px; display:none;">
      <div style="padding-top: 68.1428571429%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/70141_ca_object_representations_media_471_medium.png" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-artwork" id="media-471" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/13538_ca_object_representations_media_471_original.png" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-472">
      <div class="artworkIMG dist packitem rep-image rep-type-artwork" style="max-height: 525px; display:none;">
      <div style="padding-top: 75%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/11187_ca_object_representations_media_472_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-artwork" id="media-472" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/36572_ca_object_representations_media_472_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-473">
      <div class="artworkIMG dist packitem rep-image rep-type-artwork" style="max-height: 438px; display:none;">
      <div style="padding-top: 62.5714285714%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/41845_ca_object_representations_media_473_medium.png" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-artwork" id="media-473" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/11987_ca_object_representations_media_473_original.png" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-474">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 525px; display:none;">
      <div style="padding-top: 75%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/10966_ca_object_representations_media_474_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-474" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/72524_ca_object_representations_media_474_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-477">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 525px; display:none;">
      <div style="padding-top: 75%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/53178_ca_object_representations_media_477_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-477" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/75224_ca_object_representations_media_477_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-480">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 465px; display:none;">
      <div style="padding-top: 66.4285714286%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/83594_ca_object_representations_media_480_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-480" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/56909_ca_object_representations_media_480_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-481">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 700px; display:none;">
      <div style="padding-top: 133.333333333%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/53668_ca_object_representations_media_481_medium.png" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 525px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-481" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/17484_ca_object_representations_media_481_original.png" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-482">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 525px; display:none;">
      <div style="padding-top: 75%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/90740_ca_object_representations_media_482_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-482" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/74334_ca_object_representations_media_482_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-483">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 512px; display:none;">
      <div style="padding-top: 73.1428571429%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/63078_ca_object_representations_media_483_medium.png" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-483" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/16747_ca_object_representations_media_483_original.tiff" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-488">
      <div class="artworkIMG dist packitem rep-image rep-type-exhibition" style="max-height: 467px; display:none;">
      <div style="padding-top: 66.7142857143%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/66940_ca_object_representations_media_488_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-exhibition" id="media-488" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/90028_ca_object_representations_media_488_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-491"></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-ephemera" id="media-491" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <object data="http://jodi.academy/media/collectiveaccess/images/4/35526_ca_object_representations_media_491_original.pdf" type="application/pdf" width="780" height="585">
                <p><a href="http://jodi.academy/media/collectiveaccess/images/4/35526_ca_object_representations_media_491_original.pdf">Download</a></p>
              </object>
            </div>
          </div>
        </div>
      </div>
       <a data-toggle="modal" class="modalURL" data-target="#media-492">
      <div class="artworkIMG dist packitem rep-image rep-type-ephemera" style="max-height: 466px; display:none;">
      <div style="padding-top: 66.5714285714%;"></div><img data-src="http://jodi.academy/media/collectiveaccess/images/4/17506_ca_object_representations_media_492_medium.jpg" alt="" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; max-width: 700px;"></div></a> <!-- modal for representation -->
      <div class="modal permalink modal-type-ephemera" id="media-492" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a class="closer" data-dismiss="modal">&times;</a></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal">
              <div class="modalIMGs"><img class="modalIMG img-responsive" data-large-src="http://jodi.academy/media/collectiveaccess/images/4/8297_ca_object_representations_media_492_original.jpg" alt="[BLANK]"></div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close modalclose" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h2 class="modal-title" id="myModalLabel">Downloads for Audioswap5 (2009)</h2>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th>filename</th>
                <th>size</th>
                <th>content-type</th>
                <th>platform</th>
                <th>Reccommended system specifications</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
  <script src="js/jquery.min.js">
  </script>
  <script src="js/bootstrap.min.js">
  </script>
  <script type="text/javascript">
  $( document ).ready(function() {

    var timeout;
    // undo the hack on resize and recalculate afterwards
    $(window).on('resize', function() {
    clearTimeout(timeout);

    timeout = setTimeout(function() {
      $('.dist').each(function() {
        if ($(this).attr('data-saved-max-width')) {
          $(this).css('max-width', $(this).attr('data-saved-max-width'));
          $(this).attr('data-saved-max-width', '');
          $(this).css('width', '');
        }
      });

      moveCloserToDesc();
    }, 100);
    });

    // pause video when modal is closed
    $('.modal').on('hidden.bs.modal', function () {
      $('video').trigger('pause');
      history.pushState({}, '', window.location.pathname);
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

    $metaheight = $( ".meta.col-md-6" ).height();

    var prim = $('.rep-primary').parent().detach();
    if (prim) {
      $(prim).insertAfter('#metadata');
    }

  });

  // dynamically load the "large" version of images when opening a modal
  $('.modal').on('shown.bs.modal', function(e) {
    $(this).find('img').each(function() {
      var highres_url = $(this).attr('data-large-src');
      if (highres_url) {
        $(this).attr('src', highres_url);
        $(this).removeAttr('data-large-src');
        //$(this).parent().append('<div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; background-image: url('+highres_url+'); background-size: contain; background-repeat: no-repeat;">');
        //$(this).attr('data-highres', null);
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

  /* do a relayout when the filter changes */
  $('.dropdown-menu').on('click', function(e) {
    var cls = e.target.className;
    var sel = 'all';
    if (cls.indexOf('-') != -1) {
      sel = cls.substring(cls.indexOf('-')+1);
    }
    if (sel != 'all') {
      $('.artworkIMG').hide();
      $('.rep-type-' + sel).show();
      $('.rep-type-' + sel).find('img').each(function(e) {
        if ($(this).attr('data-src')) {
          $(this).attr('src', $(this).attr('data-src'));
          $(this).removeAttr('data-src');
        }
      });
      $('.modal-type-' + sel).find('img').each(function(e) {
        if ($(this).attr('data-src')) {
          $(this).attr('src', $(this).attr('data-src'));
          $(this).removeAttr('data-src');
        }
      });
    } else {
      $('.artworkIMG').show();
      $('.artworkIMG').find('img').each(function(e) {
        if ($(this).attr('data-src')) {
          $(this).attr('src', $(this).attr('data-src'));
          $(this).removeAttr('data-src');
        }
      });
      $('.modal' + sel).find('img').each(function(e) {
        if ($(this).attr('data-src')) {
          $(this).attr('src', $(this).attr('data-src'));
          $(this).removeAttr('data-src');
        }
      });
    }
    console.log($('.artworkIMG').first().offset());
    window.scrollTo(0, $('#tilecontainer').offset().top-50);
  });

  </script>
</body>
</html>
