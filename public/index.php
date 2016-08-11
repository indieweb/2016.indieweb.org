<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>IndieWeb Summit 2016 - Portland, Oregon</title>

  <link rel="webmention" href="/webmention.php">

  <link rel="stylesheet" type="text/css" href="/semantic/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/icomoon/style.css">
  <link rel="stylesheet" type="text/css" href="/assets/styles.css">
  <link rel="stylesheet" href="/assets/leaflet/leaflet.css" />
  <script src="/assets/jquery-2.2.0.min.js"></script>
  <script src="/semantic/semantic.min.js"></script>
  <script src="/assets/leaflet/leaflet.js"></script>
  <script src='https://js.tito.io/v1' async></script>

  <meta property="og:url" content="http://2016.indieweb.org/">
  <meta property="og:type" content="website">
  <meta property="og:title" content="IndieWeb Summit - June 3-5, 2016 - Portland, Oregon">
  <meta property="og:description" content="The sixth annual gathering for independent web creators of all kinds, from graphic artists, to designers, UX engineers, coders, hackers, to share ideas, actively work on creating for their own personal websites, and build upon each others creations.">
  <meta property="og:image" content="http://2016.indieweb.org/assets/2014-indieweb-movement.jpg">

  <script>
  $(document)
    .ready(function() {

      // fix menu when passed
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;

      // create sidebar and attach to menu open
      $('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;

    })
  ;
  </script>
</head>
<body class="h-event">

<!-- Following Menu -->
<div class="ui large top fixed hidden menu">
  <div class="ui container">
    <?php include('../copy/nav.php'); ?>
<!--     
    <div class="right menu">
      <div class="item">
        <a class="ui primary button">Sign Up</a>
      </div>
    </div>
 -->
  </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
  <?php include('../copy/nav.php'); ?>
</div>


<!-- Page Contents -->
<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment gold-bkg">

    <div class="ui container">
      <div class="ui large secondary inverted pointing menu">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
        <?php include('../copy/nav.php'); ?>
      </div>
    </div>

    <div class="ui text container event-header">

      <h1 class="ui inverted header p-name">
        IndieWeb Summit
      </h1>

      <h2>June 3-5, 2016</h2>
      <h2>Portland, Oregon</h2>


      <p class="summary">The sixth annual gathering for independent web creators of all kinds, from graphic artists, to designers, UX engineers, coders, hackers, to share ideas, actively work on creating for their own personal websites, and build upon each others creations.</p>

    </div>

  </div>


  <div class="ui vertical stripe segment" id="register">
    <div class="ui text container">
      <h3 class="ui header">Register</h3>

      <tito-widget event="indiewebcamp/summit-2016"><a href="http://tickets.indieweb.org/indiewebcamp/summit-2016">Get Tickets</a></tito-widget>

      <br>
      <p>If you have a website already, you can register for the free "Indie RSVP" ticket by posting an RSVP on your own site!</p>
      <p>See <a href="https://indiewebcamp.com/RSVP">indiewebcamp.com/RSVP</a> for instructions on how to create an RSVP post. Once you've created the RSVP post which links to this page, send a Webmention and you'll appear below!</p>

    </div>
  </div>


  <div class="ui vertical stripe segment" id="rsvps">
    <div class="ui text container">
      <h3 class="ui header">Indie RSVPs</h3>

      <p>The people below have RSVP'd to IndieWeb Summit by posting an RSVP post on their own website, and sending a Webmention to this event.</p>

      <?php include('../lib/show-rsvps.php'); ?>
    </div>
  </div>



  <div class="ui vertical stripe segment" id="schedule">
    <div class="ui text container">
      <h3 class="ui header">Schedule</h3>
      <?php include('../copy/schedule.php'); ?>
    </div>
  </div>


  <div class="ui vertical stripe segment orange-bkg" id="social-media-section">
    <div class="ui text container">
      <div style="font-size: 2em; text-align: center;" class="carrot-white">
        #indiewebcamp
      </div>
      <div style="font-size: 4em; text-align: center;" class="social-media-icons">
        <a href="https://indiewebcamp.com"><i class="ui attach icon"></i></a>
        <a href="https://twitter.com/indiewebcamp"><i class="ui twitter icon"></i></a>
        <a href="https://www.facebook.com/indiewebcamp/"><i class="ui facebook icon"></i></a>
      </div>
    </div>
  </div>


  <div class="ui vertical stripe segment nopadding" style="border-bottom: 0;" id="location">
    <div id="map"></div>
  </div>



  <div class="ui vertical stripe segment" id="travel-assistance">
    <div class="ui text container">
      <h3 class="ui header">Travel Assistance</h3>
      <?php include('../copy/assistance.php'); ?>
    </div>
  </div>



  <div class="ui vertical stripe segment" id="sponsors">
    <div class="ui text container">
      <h3 class="ui header">Sponsors</h3>
      <?php include('../copy/sponsors.php'); ?>
    </div>
  </div>



  <div class="ui inverted vertical footer segment gold-bkg">
    <div class="ui container">
      <p>IndieWeb Summit &bull; June 3-5, 2016 &bull; Portland, Oregon</p>
      <ul>
        <li><a href="https://indiewebcamp.com/">IndieWebCamp Home Page</a></li>
        <li><a href="https://indiewebcamp.com/2016">2016 Summit Details</a></li>
        <li><a href="https://indiewebcamp.com/code-of-conduct">Code of Conduct</a></li>
        <li><a href="https://indiewebcamp.com/images/2/2d/indiewebcamp-sponsorship-prospectus.pdf">Sponsorship Prospectus</a> (PDF)</li>
      </ul>
    </div>
  </div>
</div>

<script>
var map = L.map('map', {
  scrollWheelZoom: false,
  center: [45.518616, -122.682158],
  zoom: 13
});

var tileProtocol = (window.location.protocol !== 'https:') ? 'http:' : 'https:';
var layer = L.tileLayer(tileProtocol+'//{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
});
map.addLayer(layer);

var marker = L.marker([45.518616, -122.682158]).addTo(map);
marker.bindPopup("<b>Vadio</b><br>919 SW Taylor St.<br>Portland, Oregon").openPopup();

var marker2 = L.marker([45.526159, -122.675330]).addTo(map);
marker2.bindPopup("<b>Pints</b><br>412 NW 5th Ave.<br>Portland, Oregon");

$(function(){
  $(".popup").popup();
});

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-16359758-38', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
