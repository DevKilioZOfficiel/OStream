<?php $db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<div class="gen-breadcrumb" style="background-image: url('<?= base_url('uploads/assets/images/ostream.jpg'); ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <div class="gen-breadcrumb-title">
                        <h1>
                            Mangas et Animés
                        </h1>
                    </div>
                    <div class="gen-breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fas fa-home mr-2"></i>Accueil</a></li>
                            <li class="breadcrumb-item active">Mangas et Animés</li>
                        </ol>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
    <section class="gen-section-padding-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <h2>Mangas et Animés</h2>
                    <div class="row">
                      <?php // DEBUT PAIEMENT FONDS
                      $builder = $db->table('categories');
                      $builder->where('is_manga', "1");
                      $builder->orderBy('id', 'DESC');
                      $query = $builder->get();
                      foreach ($query->getResult() as $row) { ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                <div class="gen-movie-contain">
                                    <div class="gen-movie-img">
                                        <img loading="lazy" src="<?= $row->image; ?>" alt="streamlab-image">
                                        <div class="gen-movie-action">
                                            <a href="<?= base_url('live/'.$row->slug); ?>" class="gen-button">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="gen-info-contain">
                                        <div class="gen-movie-info">
                                            <h3><a href="<?= base_url('live/'.$row->slug); ?>"><?= $row->name; ?></a></h3>
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

                      <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
