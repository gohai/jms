<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=.8, maximum-scale=1, user-scalable=no">
  <title>JODI_ACADEMY</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/opensans-light.css">
  <link rel="stylesheet" type="text/css" href="css/jodistyle.css">
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand unfilter">JODI.ACADEMY</a>
      </div>
      <div class="dropdown sortmenu">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">View<span class="glyphicon dropchev glyphicon-chevron-down" aria-hidden="true"></span></button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" role="menu">
          <li role="presentation">
            <a role="menuitem" class="nav-all"></a>
          </li>
          <li>
            <a class="unfilter">All</a>
          </li>
<?php

$types = array();
foreach ($data as $work) {
  if (!in_array($work['type'], $types)) {
    $types[] = $work['type'];
  }
}

foreach ($types as $type):

?>
          <li>
            <a class="menuitem-filter" id="filter-<?php echo format_class($type); ?>"><?php echo $type; ?></a>
          </li>
<?php

endforeach;

?>
        </ul>
      </div>
      <div class="dropdown viewmenu">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">Sort<span class="glyphicon dropchev glyphicon-chevron-down" aria-hidden="true"></span></button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" role="menu">
          <li role="presentation">
            <a role="menuitem" class="nav-all"></a>
          </li>
          <li>
            <a class="unsort"><span class="glyphicon glyphicon-random" aria-hidden="true"></span></a>
          </li>
          <li>
            <a class="sort-type">Type</a>
          </li>
          <li>
            <a class="sort-date">Date</a>
          </li>
          <li>
            <a class="sort-title">Title</a>
          </li>
        </ul>
      </div><!-- <p class="json"><pre>$container.jodi({ filterBy:<span class="jsonstring filterBystring">null</span> sortBy:<span class="jsonstring sortBystring">null</span>})</pre></p> -->
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="index.php?about"><span class="info" aria-hidden="true"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <p class="json"></p>
    <pre>
$container.jodi({
  filterBy: <span class="jsonstring filterBystring">null</span>,
  sortBy: <span class="jsonstring sortBystring">null</span>
});
    
</pre>
    <p></p>
    <div id="container" class="isotope">
      <div class="block stamp"></div>
<?php

foreach ($data as $work):

?>
      <a href="<?php echo get_url_from_name($work['name']); ?>">
      <div class="item <?php echo format_class($work['type']); ?>">
        <h1 class="title"><?php echo $work['title']; ?></h1>
        <p class="year"><?php echo $work['year']; ?></p>
        <p class="sortYear" style="display: none;"><?php echo $work['sortYear']; ?></p>
        <p class="type"><?php echo $work['type']; ?></p>
      </div></a>
<?php

endforeach;

?>
    </div>
  </div>
  <script src="js/jquery.min.js">
  </script> 
  <script src="js/bootstrap.min.js">
  </script> 
  <script src="js/isotope.min.js">
  </script> 
  <script type="text/javascript">
    $(document).ready(function() {

        //show media filter after passing description
  $(window).scroll(function() {
    if ($(window).scrollTop() >  150) {
        $(".mediaMenu").fadeIn("slow");
    }
    else if ($(window).scrollTop() < 150
     ){
        $(".mediaMenu").fadeOut("slow");
    }
  });

      var $container = $('#container');

      $container.isotope({
        itemSelector: '.item',
        stamp: '.stamp',
        layoutMode: 'fitRows',
        transitionDuration:'0.0s',
        getSortData: {
          sortYear: '.sortYear', 
          title: '.title',
          type: '.type'
        }
      });

      /* default to random ordering */
      $container.isotope('shuffle');

      /* filtering */

      $('.unfilter').click(function() {
        $container.isotope({ filter: '*' });
        $('.filterBystring').html('null');
      });

      $('.menuitem-filter').click(function() {
        var id = $(this).attr('id');
        // id is "filter-..."
        $container.isotope({ filter: '.' + id.substring(7) });
        $('.filterBystring').html(id.substring(7));
      });

      /* sorting */

      $('.unsort').click(function() {
        $container.isotope('shuffle');
        $('.sortBystring').html('null');
      });

      $('.sort-type').click(function() {
        $container.isotope({ sortBy : 'type' });
        $('.sortBystring').html('type');
      });

      $('.sort-date').click(function() {
        $container.isotope({ sortBy : 'sortYear' });
        $('.sortBystring').html('year');
      });

      $('.sort-title').click(function() {
        $container.isotope({ sortBy : 'title' });
        $('.sortBystring').html('title');
      });

    });
  </script>
</body>
</html>
