<?php
function loadRSVPs() {
  $files = glob(dirname(__FILE__).'/../data/rsvps/*/*.json');
  $rsvps = [];
  foreach($files as $file) {
    $data = json_decode(file_get_contents($file), true);
    preg_match('/([a-z0-9]+)\/post\.json/', $file, $match);
    $folder = $match[1];
    $data['hash'] = $folder;
    if($photos=glob(dirname(__FILE__).'/../data/rsvps/'.$folder.'/photo.*')) {
      $data['author_photo'] = str_replace('photo', $folder, basename($photos[0]));
    } else {
      $data['author_photo'] = false;
    }
    $rsvps[] = $data;
  }
  usort($rsvps, function($a, $b) {
    return strtotime($a['received']) > strtotime($b['received']);
  });
  return $rsvps;
}
