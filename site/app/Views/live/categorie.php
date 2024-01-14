<?php $db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<section class="mpl-banner mpl-banner-top mpl-banner-parallax mpl-banner-small">
                    <div class="mpl-image" data-speed="0.8" style="z-index: 0;">

                       <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100; clip-path: polygon(0px 0px, 100% 0px, 100% 100%, 0px 100%);">
                         <img src="<?= $categories['image']; ?>" alt="" class="jarallax-img" style="object-fit: cover; object-position: 50% 50%; max-width: none; position: absolute; top: 0px; left: 0px; width: 1355.15px; height: 748.667px; overflow: hidden; pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; margin-top: 286.167px; transform: translate3d(0px, -286.185px, 0px);">
                       </div>
                    </div>
                    <div class="mpl-banner-content mpl-box-lg" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10" data-sr="blog-banner" data-sr-interval="200" data-sr-duration="1200" data-sr-distance="20">
                                    <h1 class="display-1" data-sr-item="blog-banner" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1.2s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1.2s cubic-bezier(0.5, 0, 0, 1) 0s;">
                                      <?= $categories['name']; ?> <?php if($categories['is_premium']){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?>
                                    </h1>
                                    <p class="lead mb-0" data-sr-item="blog-banner" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 1.2s cubic-bezier(0.5, 0, 0, 1) 0s, transform 1.2s cubic-bezier(0.5, 0, 0, 1) 0s;">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
        <div class="row vgap-md">
          <?php // DEBUT PAIEMENT FONDS
          $builder = $db->table('list');
          $builder->where('id_categorie',$categories['id']);
          $builder->orderBy('id', 'DESC');
          $query = $builder->get();
          foreach ($query->getResult() as $row) { ?>
            <div class="col-12 col-sm-6 col-md-4">
              <a href="<?= base_url('streaming/'.$row->slug); ?>" class="mpl-post-item mpl-post-overlay">
                <span class="mpl-post-image">
                    <span class="mpl-image">
                        <img src="<?= $row->image; ?>" alt="">
                    </span>
                </span>
                <span class="mpl-post-content">
                    <span class="mpl-post-title h4"><?= $row->titre; ?> <?php if($row->is_premium){ ?><span class="badge badge-brand">PREMIUM</span><?php } ?></span>
                    <!--<div class="mpl-hexagon-rating mpl-hexagon-rating-small" data-hexagon="0"><span>0</span></div>-->
                </span>
              </a>
            </div>
          <?php } ?>
        </div>
    </div>
</div>
