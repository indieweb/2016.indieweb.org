<div class="rsvps">
<?php
include(dirname(__FILE__).'/rsvps.php');
$rsvps = loadRSVPs();
foreach($rsvps as $rsvp):
  $url = array_key_exists('url', $rsvp['data']) && $rsvp['data']['url'] ? $rsvp['data']['url'] : $rsvp['source'];
  ?>
  <div class="rsvp">
    <div class="profile-photo">
      <?php if($rsvp['author_photo']): ?>
        <?php if($rsvp['data']['author']['url']): ?>
          <a href="<?= $rsvp['data']['author']['url'] ?>">
            <img src="/img.php?img=<?= $rsvp['author_photo'] ?>" width="48" class="photo">
          </a>
        <?php endif; ?>
      <?php else: ?>
        <img src="/assets/no-photo.png" width="48" class="photo">
      <?php endif; ?>
    </div>
    <div class="profile-info">
      <div>
        <?php if($rsvp['data']['author']['url']): ?>
          <a href="<?= $rsvp['data']['author']['url'] ?>">
           <?= $rsvp['data']['author']['name'] ?: '' ?>
          </a>
        <?php endif; ?>
      </div>
      <div><a href="<?= $url ?>"><?= $url ?></a></div>
    </div>
  </div>
  <?php
endforeach;
?>
</div>