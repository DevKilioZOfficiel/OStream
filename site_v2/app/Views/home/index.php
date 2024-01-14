<?php $db = \Config\Database::connect(); ?>
<!-- owl-carousel Banner Start -->
  <section class="pt-0 pb-0">
     <div class="container-fluid px-0">
        <div class="row no-gutters">
           <div class="col-12">
              <div class="gen-banner-movies banner-style-2">
                 <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="1"
                    data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1" data-autoplay="true"
                    data-loop="true" data-margin="0">

                    <div class="item" style="background: url('<?= base_url('uploads/assets/images/ostream.jpg'); ?>')">
                       <div class="gen-movie-contain-style-2 h-100">
                          <div class="container h-100">
                             <div class="row flex-row-reverse align-items-center h-100">
                                <div class="col-xl-6">
                                   <!--<div class="gen-front-image">
                                      <img loading="lazy" src="<?= base_url('uploads/assets/images/ostream.jpg'); ?>" alt="owl-carousel-banner-image">
                                      <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="playBut popup-youtube popup-vimeo popup-gmaps">
                                         <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="213.7px"
                                            height="213.7px" viewBox="0 0 213.7 213.7"
                                            enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                                            <polygon class="triangle" id="XMLID_17_" fill="none" stroke-width="7"
                                               stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                               points="
                                                           73.5,62.5 148.5,105.8 73.5,149.1 "></polygon>
                                            <circle class="circle" id="XMLID_18_" fill="none" stroke-width="7"
                                               stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                               cx="106.8" cy="106.8" r="103.3">
                                            </circle>
                                         </svg>
                                         <span>
                                           Voir la vidéo
                                         </span>
                                      </a>
                                   </div>-->
                                </div>
                                <div class="col-xl-6">
                                   <div class="gen-tag-line"><span>NOUVEAU</span></div>
                                   <div class="gen-movie-info">
                                      <h3>oStream</h3>
                                   </div>
                                   <div class="gen-movie-meta-holder">
                                      <ul class="gen-meta-after-title">
                                         <li class="gen-sen-rating">
                                            <span>2.0.0</span>
                                         </li>
                                         <!--<li> <img loading="lazy" src="images/asset-2.png" alt="rating-image">
                                            <span>0</span>
                                         </li>-->
                                      </ul>
                                      <p>
                                        Bienvenue sur oStream le site de streaming.
                                      </p>
                                      <!--<div class="gen-meta-info">
                                         <ul class="gen-meta-after-excerpt">
                                            <li>
                                               <strong>Cast :</strong>
                                               Anna Romanson,Robert Romanson
                                            </li>
                                         </ul>
                                      </div>-->
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>

                </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <!-- owl-carousel Banner End -->


  <!-- owl-carousel Videos Section-1 Start -->
  <section class="gen-section-padding-2">
     <div class="container">
        <div class="row">
           <div class="col-xl-6 col-lg-6 col-md-6">
              <h4 class="gen-heading-title">Live en tendance</h4>
           </div>
        </div>
        <div class="row mt-3">
           <div class="col-12">
              <div class="gen-style-2">
                 <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="4"
                    data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                    data-loop="false" data-margin="30">

                    <?php // DEBUT PAIEMENT FONDS
                    $builder = $db->table('categories');
                    $builder->where('trends', 1);
                    $builder->orderBy('id', 'ASC');
                    $builder->limit(12);
                    $query = $builder->get();
                    foreach ($query->getResult() as $key => $row) { ?>
                    <div class="item">
                       <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                          <div class="gen-carousel-movies-style-2 movie-grid style-2">
                             <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                   <img loading="lazy" src="<?= $row->image; ?>" alt="owl-carousel-video-image">
                                   <div class="gen-movie-action">
                                      <a href="<?= base_url('live/'.$row->slug); ?>" class="gen-button">
                                         <i class="fa fa-play"></i>
                                      </a>
                                   </div>
                                </div>
                                <div class="gen-info-contain">
                                   <div class="gen-movie-info">
                                      <h3><a href="<?= base_url('live/'.$row->slug); ?>"><?= $row->name; ?></a>
                                      </h3>
                                   </div>
                                   <div class="gen-movie-meta-holder">
                                      <ul>
                                         <?php if($row->is_premium != "0"){ ?>
                                         <li>
                                            <a href="<?= base_url('premium'); ?>"><span>PREMIUM</span></a>
                                         </li>
                                       <?php } ?>
                                      </ul>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <!-- #post-## -->
                    </div>
                    <?php } ?>
                  </div>
              </div>
           </div>
        </div>
      </div>
    </section>
    <!-- owl-carousel Videos Section-1 Start -->
    <section class="gen-section-padding-2">
       <div class="container">

        <div class="row">
           <div class="col-xl-6 col-lg-6 col-md-6">
              <h4 class="gen-heading-title">Lives</h4>
           </div>
        </div>
        <div class="row mt-3">
           <div class="col-12">
              <div class="gen-style-2">
                 <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="4"
                    data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                    data-loop="false" data-margin="30">

                    <?php // DEBUT PAIEMENT FONDS
                    $builder = $db->table('categories');
                    $builder->where('is_live', 1);
                    $builder->orderBy('id', 'ASC');
                    $builder->limit(12);
                    $query = $builder->get();
                    foreach ($query->getResult() as $key => $row) { ?>
                    <div class="item">
                       <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                          <div class="gen-carousel-movies-style-2 movie-grid style-2">
                             <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                   <img loading="lazy" src="<?= $row->image; ?>" alt="owl-carousel-video-image">
                                   <div class="gen-movie-action">
                                      <a href="<?= base_url('live/'.$row->slug); ?>" class="gen-button">
                                         <i class="fa fa-play"></i>
                                      </a>
                                   </div>
                                </div>
                                <div class="gen-info-contain">
                                   <div class="gen-movie-info">
                                      <h3><a href="<?= base_url('live/'.$row->slug); ?>"><?= $row->name; ?></a>
                                      </h3>
                                   </div>
                                   <div class="gen-movie-meta-holder">
                                      <ul>
                                         <?php if($row->is_premium != "0"){ ?>
                                         <li>
                                            <a href="<?= base_url('premium'); ?>"><span>PREMIUM</span></a>
                                         </li>
                                       <?php } ?>
                                      </ul>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <!-- #post-## -->
                    </div>
                    <?php } ?>
                  </div>
              </div>
           </div>
        </div>
      </div>
    </section>
    <!-- owl-carousel Videos Section-1 Start -->
    <section class="gen-section-padding-2">
       <div class="container">
        <div class="row">
           <div class="col-xl-6 col-lg-6 col-md-6">
              <h4 class="gen-heading-title">Séries</h4>
           </div>
        </div>
        <div class="row mt-3">
           <div class="col-12">
              <div class="gen-style-2">
                 <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="4"
                    data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                    data-loop="false" data-margin="30">

                    <?php // DEBUT PAIEMENT FONDS
                    $builder = $db->table('categories');
                    $builder->where('is_serie', 1);
                    $builder->orderBy('id', 'ASC');
                    $builder->limit(12);
                    $query = $builder->get();
                    foreach ($query->getResult() as $key => $row) { ?>
                    <div class="item">
                       <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                          <div class="gen-carousel-movies-style-2 movie-grid style-2">
                             <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                   <img loading="lazy" src="<?= $row->image; ?>" alt="owl-carousel-video-image">
                                   <div class="gen-movie-action">
                                      <a href="<?= base_url('live/'.$row->slug); ?>" class="gen-button">
                                         <i class="fa fa-play"></i>
                                      </a>
                                   </div>
                                </div>
                                <div class="gen-info-contain">
                                   <div class="gen-movie-info">
                                      <h3><a href="<?= base_url('live/'.$row->slug); ?>"><?= $row->name; ?></a>
                                      </h3>
                                   </div>
                                   <div class="gen-movie-meta-holder">
                                      <ul>
                                         <?php if($row->is_premium != "0"){ ?>
                                         <li>
                                            <a href="<?= base_url('premium'); ?>"><span>PREMIUM</span></a>
                                         </li>
                                       <?php } ?>
                                      </ul>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <!-- #post-## -->
                    </div>
                    <?php } ?>
                  </div>
              </div>
           </div>
        </div>
      </div>
    </section>
    <!-- owl-carousel Videos Section-1 Start -->
    <section class="gen-section-padding-2">
       <div class="container">
        <div class="row">
           <div class="col-xl-6 col-lg-6 col-md-6">
              <h4 class="gen-heading-title">Films</h4>
           </div>
        </div>
        <div class="row mt-3">
           <div class="col-12">
              <div class="gen-style-2">
                 <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="4"
                    data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                    data-loop="false" data-margin="30">

                    <?php // DEBUT PAIEMENT FONDS
                    $builder = $db->table('categories');
                    $builder->where('is_film', 1);
                    $builder->orderBy('id', 'ASC');
                    $builder->limit(12);
                    $query = $builder->get();
                    foreach ($query->getResult() as $key => $row) { ?>
                    <div class="item">
                       <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                          <div class="gen-carousel-movies-style-2 movie-grid style-2">
                             <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                   <img loading="lazy" src="<?= $row->image; ?>" alt="owl-carousel-video-image">
                                   <div class="gen-movie-action">
                                      <a href="<?= base_url('live/'.$row->slug); ?>" class="gen-button">
                                         <i class="fa fa-play"></i>
                                      </a>
                                   </div>
                                </div>
                                <div class="gen-info-contain">
                                   <div class="gen-movie-info">
                                      <h3><a href="<?= base_url('live/'.$row->slug); ?>"><?= $row->name; ?></a>
                                      </h3>
                                   </div>
                                   <div class="gen-movie-meta-holder">
                                      <ul>
                                         <?php if($row->is_premium != "0"){ ?>
                                         <li>
                                            <a href="<?= base_url('premium'); ?>"><span>PREMIUM</span></a>
                                         </li>
                                       <?php } ?>
                                      </ul>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <!-- #post-## -->
                    </div>
                    <?php } ?>
                  </div>
              </div>
           </div>
        </div>
      </div>
    </section>
    <!-- owl-carousel Videos Section-1 Start -->
    <section class="gen-section-padding-2">
       <div class="container">
        <div class="row">
           <div class="col-xl-6 col-lg-6 col-md-6">
              <h4 class="gen-heading-title">Manga et Animés</h4>
           </div>
        </div>
        <div class="row mt-3">
           <div class="col-12">
              <div class="gen-style-2">
                 <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true" data-desk_num="4"
                    data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1" data-autoplay="false"
                    data-loop="false" data-margin="30">

                    <?php // DEBUT PAIEMENT FONDS
                    $builder = $db->table('categories');
                    $builder->where('is_manga', 1);
                    $builder->orderBy('id', 'ASC');
                    $builder->limit(12);
                    $query = $builder->get();
                    foreach ($query->getResult() as $key => $row) { ?>
                    <div class="item">
                       <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                          <div class="gen-carousel-movies-style-2 movie-grid style-2">
                             <div class="gen-movie-contain">
                                <div class="gen-movie-img">
                                   <img loading="lazy" src="<?= $row->image; ?>" alt="owl-carousel-video-image">
                                   <div class="gen-movie-action">
                                      <a href="<?= base_url('live/'.$row->slug); ?>" class="gen-button">
                                         <i class="fa fa-play"></i>
                                      </a>
                                   </div>
                                </div>
                                <div class="gen-info-contain">
                                   <div class="gen-movie-info">
                                      <h3><a href="<?= base_url('live/'.$row->slug); ?>"><?= $row->name; ?></a>
                                      </h3>
                                   </div>
                                   <div class="gen-movie-meta-holder">
                                      <ul>
                                         <?php if($row->is_premium != "0"){ ?>
                                         <li>
                                            <a href="<?= base_url('premium'); ?>"><span>PREMIUM</span></a>
                                         </li>
                                       <?php } ?>
                                      </ul>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <!-- #post-## -->
                    </div>
                    <?php } ?>
                  </div>
              </div>
           </div>
        </div>

     </div>
  </section>
  <!-- owl-carousel Videos Section-1 End -->
