<?php
require_once('../lib/HTTP.php');

$xrayBaseURL = 'http://xray.dev';
$targetBaseURL = 'http://2016.indieweb.dev';

$http = new HTTP();

function error($msg, $code=400) {
  if($code == 400)
    header("HTTP/1.1 400 Bad Request");
  header("Content-type: text/plain");
  echo $msg."\n";
  die();
}

if(!isset($_POST['source']) || !isset($_POST['target'])) {
  error("Missing source or target properties");
}

$sourceURL = $_POST['source'];
$targetURL = $_POST['target'];

if($targetURL != $targetBaseURL && $targetURL != $targetBaseURL.'/') {
  error("Webmentions are only accepted for ".$targetBaseURL."/");
}

$response = $http->get($xrayBaseURL.'/parse?url='.urlencode($sourceURL).'&target='.urlencode($targetURL));
$data = json_decode($response['body'], true);

// XRay tells us if the URL didn't link to the target
if(isset($data['error'])) {
  error($data['error_description']);
}

$source = $data['data'];

// Check the source for in-reply-to and rsvp properties
if(!array_key_exists('in-reply-to', $source)) {
  error("Your post doesn't seem to have an in-reply-to property");
}

if(!in_array($targetURL, $source['in-reply-to'])) {
  error("It looks like your post does not have the event URL in the in-reply-to property");
}

if(!array_key_exists('rsvp', $source)) {
  error("Your post doesn't have an 'rsvp' property");
}

if($source['rsvp'] == 'yes') {

  // Store the response data to disk so that it's rendered on the event page
  $folder = dirname(__FILE__).'/../data/rsvps/'.md5($sourceURL);
  @mkdir($folder);

  if($source['author']['photo']) {
    $tmp = tempnam(sys_get_temp_dir(), 'img');
    $img = $http->get($source['author']['photo']);
    if($img['body']) {
      file_put_contents($tmp, $img['body']);
      $type = exif_imagetype($tmp);
      $ext = false;
      switch($type) {
        case IMAGETYPE_GIF:
          $ext = 'gif'; break;
        case IMAGETYPE_JPEG:
          $ext = 'jpg'; break;
        case IMAGETYPE_PNG:
          $ext = 'png'; break;
        case IMAGETYPE_ICO:
          $ext = 'ico'; break;
      }
      if($ext) {
        copy($tmp, $folder . '/photo.'.$ext);
      }
    }
  }

  $filename = $folder . '/post.json';
  $data = [
    'received' => date('c'),
    'source' => $sourceURL,
    'data' => $source
  ];
  file_put_contents($filename, json_encode($data));

  echo "Thanks! Your RSVP is listed on the event page now! Go ahead and register for the \"Indie RSVP\" ticket!\n";
} else {
  echo "Thanks! Your RSVP was received, but you won't be listed on the event page because your RSVP was not \"yes\"\n";
}
