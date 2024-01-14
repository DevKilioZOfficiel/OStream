
<?php
$db = \Config\Database::connect();
$builder = $db->table('invoices');
$builder->where('user', $user['id']);
$count_achats = $builder->countAllResults(); ?>

<section class="mpl-banner mpl-banner-top mpl-banner-parallax mpl-banner-small">
  <div class="mpl-image" data-speed="0.8">
    <img src="<?= base_url(); ?>/assets/images/dark/bg-banner-2.jpg" alt="" class="jarallax-img">
  </div>
  <div class="mpl-banner-content mpl-box-lg">
    <div class="container">
      <div class="mpl-user" data-sr="user-header" data-sr-interval="120" data-sr-duration="1200" data-sr-distance="20">
        <div class="mpl-user-wrap" data-sr-item="user-header">
          <div class="mpl-media">
            <div class="mpl-media-head">
              <a href="<?= $info_user['avatar']; ?>" class="mpl-media-image" data-fancybox data-animation-effect="fade">
                <span class="mpl-image">
                  <img src="<?= $info_user['avatar']; ?>" alt="">
                </span>
                <svg class="icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8 3H5C4.46957 3 3.96086 3.21071 3.58579 3.58579C3.21071 3.96086 3 4.46957 3 5V8M21 8V5C21 4.46957 20.7893 3.96086 20.4142 3.58579C20.0391 3.21071 19.5304 3 19 3H16M16 21H19C19.5304 21 20.0391 20.7893 20.4142 20.4142C20.7893 20.0391 21 19.5304 21 19V16M3 16V19C3 19.5304 3.21071 20.0391 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21H8" />
                </svg>
              </a>
              <div>
                <div class="mpl-media-title h5"><?= $info_user['pseudo']; ?><?= $info_user['tag']; ?></div>
                <div class="mpl-media-subtitle"><?= $info_user__permissions['badge__url']; ?> <?= $info_user__permissions['nom']; ?></div>
              </div>
            </div>
          </div>
          <!--<ul class="mpl-user-activity">
          <li>
          <span class="h5">69</span><span>Posts</span>
        </li>
        <li>
        <span class="h5">12</span><span>Games</span>
      </li>
      <li>
      <span class="h5">689</span><span>Followers</span>
    </li>
  </ul>-->
</div>
<!--<ul class="mpl-user-links">
<li data-sr-item="user-header">
<a href="#">Exemple 1</a>
</li>
</ul>-->
</div>
</div>
</div>
</section>
<div class="container" data-sr data-sr-duration="1000" data-sr-distance="20">
  <ul class="nav nav-tabs mpl-user-navigation" role="tablist">
    <li role="presentation" class="nav-item">
      <a href="#general" class="nav-link active" aria-controls="general" role="tab" data-bs-toggle="tab" aria-selected="true"><?= $info_user['pseudo']; ?><?= $info_user['tag']; ?></a>
    </li>
    <!--<li role="presentation" class="nav-item">
      <a href="#about" class="nav-link" aria-controls="about" role="tab" data-bs-toggle="tab" aria-selected="false">A Propos</a>
    </li>-->
  </ul>
</div>
<div class="mpl-box-md">
  <div class="container">
    <div class="row hgap-lg vgap-lg">
      <div class="col-lg-12"> <!-- mpl-content -->

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade show active" id="general">
            <?= html_entity_decode($info_user['bio']); ?>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="about">
            <?= html_entity_decode($info_user['bio']); ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
