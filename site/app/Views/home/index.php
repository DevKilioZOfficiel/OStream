<?php $db = \Config\Database::connect(); ?>
        <section style="position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    min-height: 100vh;
    overflow: hidden;
    background-color: #1f1d29; padding-top: 100px;">
          <div style="background: url('<?= base_url('uploads/assets/images/ostream.jpg'); ?>');background-repeat: no-repeat;width: 100vw;height: 100vh;background-size: cover;">
            <div class="mpl-banner-content mpl-box-lg" style="margin-top: 108px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <h1 class="display-1">oStream</h1>
                            <p class="lead"> Bienvenue sur oStream, retrouvez vos matchs, films ou encore vos séries </p>
                            <a class="btn btn-md btn-brand" href="<?= base_url('register'); ?>">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </section>


<!-- Carousel -->
                <div class="mpl-box-sm">
                    <div class="container">
                        <!--
    Carousel

    Additional attributes:
        data-autoplay
        data-loop
        data-dots
        data-arrows
        data-speed
        data-slides
        data-autoHeight
        data-grabCursor
        data-scrollbar
-->
                        <div class="row vgap-md" style="margin-bottom: 2rem;">
                          <h2>Live en tendance</h2>
                          <?php // DEBUT PAIEMENT FONDS
                          $builder = $db->table('categories');
                          $builder->where('trends', 1);
                          $builder->orderBy('id', 'ASC');
                          $builder->limit(9);
                          $query = $builder->get();
                          foreach ($query->getResult() as $key => $row) { ?>
                            <div class="col-12 col-sm-6 col-md-4">
                              <a href="<?= base_url('live/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                                <span class="mpl-post-image">
                                    <span class="mpl-image">
                                        <img src="<?= $row->image; ?>" alt="">
                                    </span>
                                </span>
                                <span class="mpl-post-content">
                                    <span class="mpl-post-title h4"><?= $row->name; ?> <?php if($row->is_premium != "0"){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                                    <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                                </span>
                              </a>
                            </div>
                          <?php } ?>
                        </div>

                        <div class="row vgap-md" style="margin-bottom: 2rem;">
                          <h2>Lives</h2>
                          <?php // DEBUT PAIEMENT FONDS
                          $builder = $db->table('categories');
                          $builder->where('is_live', 1);
                          $builder->orderBy('id', 'ASC');
                          $query = $builder->get();
                          foreach ($query->getResult() as $row) { ?>
                            <div class="col-12 col-sm-6 col-md-4">
                              <a href="<?= base_url('live/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                                <span class="mpl-post-image">
                                    <span class="mpl-image">
                                        <img src="<?= $row->image; ?>" alt="">
                                    </span>
                                </span>
                                <span class="mpl-post-content">
                                    <span class="mpl-post-title h4"><?= $row->name; ?> <?php if($row->is_premium != "0"){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                                    <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                                </span>
                              </a>
                            </div>
                          <?php } ?>
                        </div>

                        <?php // DEBUT COUNT
                        $builder = $db->table('categories');
                        $builder->where('is_serie', 1);
                        $count_films = $builder->countAllResults(); ?>
                        <?php if($count_films != 0){ ?>
                        <div class="row vgap-md" style="margin-bottom: 2rem;">
                          <h2>Séries</h2>
                          <?php // DEBUT PAIEMENT FONDS
                          $builder = $db->table('categories');
                          $builder->where('is_serie', 1);
                          $builder->orderBy('id', 'ASC');
                          $query = $builder->get();
                          foreach ($query->getResult() as $row) { ?>
                            <div class="col-12 col-sm-6 col-md-4">
                              <a href="<?= base_url('live/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                                <span class="mpl-post-image">
                                    <span class="mpl-image">
                                        <img src="<?= $row->image; ?>" alt="">
                                    </span>
                                </span>
                                <span class="mpl-post-content">
                                    <span class="mpl-post-title h4"><?= $row->name; ?> <?php if($row->is_premium != "0"){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                                    <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                                </span>
                              </a>
                            </div>
                          <?php } ?>
                        </div>
                      <?php } ?>
                        <?php // DEBUT COUNT
                        $builder = $db->table('categories');
                        $builder->where('is_film', 1);
                        $count_films = $builder->countAllResults(); ?>
                        <?php if($count_films != 0){ ?>
                        <div class="row vgap-md" style="margin-bottom: 2rem;">
                          <h2>Films</h2>
                          <?php // DEBUT PAIEMENT FONDS
                          $builder = $db->table('categories');
                          $builder->where('is_film', 1);
                          $builder->orderBy('id', 'ASC');
                          $query = $builder->get();
                          foreach ($query->getResult() as $row) { ?>
                            <div class="col-12 col-sm-6 col-md-4">
                              <a href="<?= base_url('live/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                                <span class="mpl-post-image">
                                    <span class="mpl-image">
                                        <img src="<?= $row->image; ?>" alt="">
                                    </span>
                                </span>
                                <span class="mpl-post-content">
                                    <span class="mpl-post-title h4"><?= $row->name; ?> <?php if($row->is_premium != "0"){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                                    <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                                </span>
                              </a>
                            </div>
                          <?php } ?>
                        </div>
                      <?php } ?>
                      <?php // DEBUT COUNT
                      $builder = $db->table('categories');
                      $builder->where('is_manga', 1);
                      $count_films = $builder->countAllResults(); ?>
                      <?php if($count_films != 0){ ?>
                      <div class="row vgap-md" style="margin-bottom: 2rem;">
                        <h2>Mangas / Animés</h2>
                        <?php // DEBUT PAIEMENT FONDS
                        $builder = $db->table('categories');
                        $builder->where('is_manga', 1);
                        $builder->orderBy('id', 'ASC');
                        $query = $builder->get();
                        foreach ($query->getResult() as $row) { ?>
                          <div class="col-12 col-sm-6 col-md-4">
                            <a href="<?= base_url('live/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                              <span class="mpl-post-image">
                                  <span class="mpl-image">
                                      <img src="<?= $row->image; ?>" alt="">
                                  </span>
                              </span>
                              <span class="mpl-post-content">
                                  <span class="mpl-post-title h4"><?= $row->name; ?> <?php if($row->is_premium != "0"){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                                  <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                              </span>
                            </a>
                          </div>
                        <?php } ?>
                      </div>
                    <?php } ?>
                    </div>
                </div>
                <!-- /Carousel -->
