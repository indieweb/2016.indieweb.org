<div class="rsvps">
<?php

function gravatar($email) {
  return 'https://www.gravatar.com/avatar/'.md5($email).'.jpg?d='.urlencode('http://2016.indieweb.org/assets/no-photo.png');
}

$rsvps = loadRSVPs('nyc2');
$websites = [];
foreach($rsvps as $rsvp) {
  if($rsvp['data']['author']['url']) {
    $websites[] = $rsvp['data']['author']['url'];
  }
}

if(file_exists(dirname(__FILE__).'/../data/rsvpsnyc2/tickets.json')):
$tickets = json_decode(file_get_contents(dirname(__FILE__).'/../data/rsvpsnyc2/tickets.json'));
$hidden = 0;
foreach($tickets as $ticket):
  if($ticket->show == 'yes'):
    if(!in_array($ticket->website, $websites)):
      if($ticket->website) {
        $websites[] = $ticket->website;
      }
    ?>
    <div class="rsvp">
      <div class="profile-photo">
        <? if($ticket->website): ?><a href="<?= $ticket->website ?>"><? endif; ?>
          <img src="<?= gravatar($ticket->email) ?>" width="48" class="photo">
        <? if($ticket->website): ?></a><? endif; ?>
      </div>
      <div class="profile-info">
        <div>
          <? if($ticket->website): ?><a href="<?= $ticket->website ?>"><? endif; ?>
            <?= $ticket->name ?>
          <? if($ticket->website): ?></a><? endif; ?>
        </div>    
      </div>    
    </div>
    <?php
    endif;
  else:
    $hidden++;
  endif;
endforeach;
endif;
?>
  <div class="rsvp">
    <div class="profile-info">
      and <?= $hidden ?> private registrations
    </div>
  </div>
</div>
<div style="clear:both;"></div>
