<?php $db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<?php

function random_popcorn($random_popcorn){
  $popcorn_img1 = "https://cdn.discordapp.com/attachments/1039241556462407804/1041726979172479006/pop-corn_1.png";
  $popcorn_img2 = "https://cdn.discordapp.com/attachments/1039241556462407804/1041726979537379388/pop-corn.png";
  if($random_popcorn === 1){
    return $popcorn_img1;
  }else{
    return $popcorn_img2;
  }
}

function image_css($random_image){
  $image_css1 = 'width: 53px;height: auto;position: absolute;bottom: 65px;left: -12px;rotate: -25deg;';
  $image_css2 = 'width: 73px;height: auto;position: absolute;top: -25px;right: -11px;rotate: 10deg;';
  $image_css3 = 'width: 92px;height: auto;position: absolute;top: 40%;left: -22px;rotate: -18deg;';

  if($random_image === 1){
    return $image_css1;
  }elseif($random_image === 2){
    return $image_css2;
  }else{
    return $image_css3;
  }
}
$div_css = 'float: none;position: relative;padding-bottom: 85px;'; ?>

    <section class="mpl-banner mpl-banner-top mpl-banner-parallax mpl-banner-small">
        <div class="mpl-image" data-speed="0.8">
            <img src="<?= base_url(); ?>/assets/images/dark/bg-banner-1.jpg" alt="" class="jarallax-img">
        </div>
        <div class="mpl-banner-content mpl-box-lg">
            <div class="container">
                <h1 class="display-1 mb-0">Premium</h1>
            </div>
        </div>
    </section>
    <div class="container mpl-box-md">
        <div class="row vgap">
          <?php if(!empty(strip_tags($request->GetGet('code')))){
            $promotion = 0;
            $code_valid = false;
            $premium_id = 0;
            $code = strip_tags($request->GetGet('code'));
            $builder = $db->table('codes');
            $builder->where('code', $code);
            $query = $builder->get();
            foreach ($query->getResult() as $row) {
              // verif si code déjà utilisé
              $builder2 = $db->table('invoices');
              $builder2->where('user', $user['id']);
              $builder2->where('promotion_code', $code);
              $code_count_user = $builder2->countAllResults();
              if($row->limitation_user > $code_count_user){
                $promotion = $row->pourcentage;
                $code_valid = true;
                if($row->premium_id === 0){
                  $premium_id = 0;
                }else{
                  $premium_id = $row->premium_id;
                }
              }else{
                $promotion = 0;
                $code_valid = false;
                $premium_id = 0;
              }
            }
          }else{
            $promotion = 0;
            $code_valid = false;
            $premium_id = 0;
          } ?>
          <?php if($code_valid == true){ ?>
            <?php if($premium_id == 0){
              $abonnement_id = "tous les abonnements";
            }else{
              $builder = $db->table('premium');
              $builder->where('id', $premium_id);
              $query = $builder->get();
              foreach ($query->getResult() as $row) {
                $abonnement_id = $row->name;
              }
            } ?>
            <div class="alert alert-success">
              Le code est valide ! Vous disposez de <?= $promotion; ?>% de réduction sur <?= $abonnement_id; ?>.
            </div>
          <?php } ?>
          <?php // DEBUT PAIEMENT FONDS
          $builder = $db->table('premium');
          $query = $builder->get();
          foreach ($query->getResult() as $row) {
            if(isset($_POST['p'.$row->id])){
              if (session('isLoggedIn')) {
                if(!empty(strip_tags($request->GetGet('code')))){
                  if($premium_id == 0){
                    $promotion_paid = $row->price-$row->price*$promotion/100;
                    $code_paid = strip_tags($request->GetGet('code'));
                    $premium_id = 0;
                  }else{
                    $promotion_paid = $row->price-$row->price*$promotion/100;
                    $code_paid = strip_tags($request->GetGet('code'));
                    $premium_id = $premium_id;
                  }
                }else{
                  $promotion_paid = $row->price;
                  $code_paid = "";
                }

              if($user['solde'] >= $promotion_paid){ ?>
                <div class="alert alert-success">Vous êtes désormais abonné au <?= $row->name; ?> !</div>
                <?php
                $data = [
									'code' => rand(1000,9999),
									'product_id' => $row->id,
									'type' => 0,
									'user' => $user['id'],
									'price'  => $row->price,
									'etat'  => "COMPLETED",
									'informations_paiement'  => "",
									'fee_paiement'  => "",
									'promotion_code'  => $code_paid,
									'promotion_price'  => $promotion_paid
								];
                $builder = $db->table('invoices');
								$builder->insert($data);

                $time_30d = time()+86400*31;
                $time_30d1 = 86400*31;

                if($user['premium_expiration'] == "0"){
                  $premium_duration = $user['premium_expiration']+$time_30d;
                }else{
                  $premium_duration = $user['premium_expiration']+$time_30d1;
                }
                $builder_solde = $db->table('user');
						    $builder_solde->set('solde', $user['solde']-$promotion_paid);
						    $builder_solde->set('premium', $row->id);
						    $builder_solde->set('premium_expiration', $premium_duration);
						    $builder_solde->where('id', $user['id']);
						    $builder_solde->update(); ?>
              <?php }else{ ?>
                <div class="alert alert-warning">Vous ne disposez pas d'assez de crédit pour cet abonnement.</div>
              <?php }
            }else{
              echo '<div class="alert alert-warning">Connexion requise pour l\'achat de l\'abonnement.</div>';
            }
            }
          } ?>
          <?php // DEBUT PAIEMENT FONDS
          $builder = $db->table('premium');
          $builder->orderBy('id', 'ASC');
          $query = $builder->get();
          foreach ($query->getResult() as $row) { ?>
            <?php $random_popcorn = rand(1,2);
            $random_image = rand(1,3); ?>
            <div class="col-12 col-md-6 col-xl-<?= $row->size; ?>" style="<?= $div_css; ?>">
              <img src="<?= random_popcorn($random_popcorn); ?>" style="<?= image_css($random_image); ?>">
                <div class="mpl-pricing">
                    <div class="mpl-pricing-head">
                        <h3><?= $row->name; ?></h3>
                    </div>
                    <?php
                    if(!empty(strip_tags($request->GetGet('code'))) && $premium_id === 0 || $premium_id == $row->id){
                      $promotion_paid = $row->price-$row->price*$promotion/100;
                      $code_paid = strip_tags($request->GetGet('code'));
                    }else{
                      $promotion_paid = $row->price;
                      $code_paid = "";
                    } ?>
                    <div class="mpl-pricing-head">
                      <div class="mpl-pricing-price h3"><?= $promotion_paid; ?>€/mois</div>
                    </div>
                    <div class="mpl-pricing-body">
                        <ul class="list-unstyled mpl-pricing-list2">
                          <?php $api = json_decode($row->description);
                          foreach ($api as $key => $value) { ?>
                            <?php if($value->value === ":ok:"){
                              $valeur = "<img width='16px' height='16px' src='".base_url('uploads/valide.png')."'>";
                            }elseif($value->value === ":non:"){
                              $valeur = "<img width='16px' height='16px' src='".base_url('uploads/rejeter.png')."'>";
                            }else{
                              $valeur = "<br>".$value->value;
                            } ?>
                            <li><b><?= $value->name; ?></b>: <?= $valeur; ?></li>
                          <?php } ?>
                        </ul>
                    </div>
                    <div class="mpl-pricing-footer">
                      <?php if($row->disabled == "0"){ ?>
                      <form method="POST">
                        <button type="submit" name="p<?= $row->id; ?>" class="btn btn-md btn-block btn-default">S'abonner</button>
                      </form>
                    <?php }else{ ?>
                      <a href="<?= base_url('register'); ?>" class="btn btn-md btn-block btn-default">S'inscrire</a>
                    <?php } ?>
                    </div>
                </div>
            </div>
          <?php } ?>
          <div class="col-md-12">
            <h2>Vous avez un code promotion ? Entrez le !</h2>
            <form method="GET">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" style="background-color: #282535;" class="form-control" name="code" placeholder="Code">
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">Entrer le code</button>
                </div>
              </div>
            </form>
          </div>

        </div>
    </div>
