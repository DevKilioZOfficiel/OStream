<?php $db = \Config\Database::connect();
$sessionmodel = new \App\Models\SessionModel(); ?>
<?php if($request->getVar('pseudo') != $user['pseudo']){ ?>
<?php
$builder = $db->table('user');
$builder->set('pseudo', $sessionmodel->security($request->getVar('pseudo')));
$builder->where('id', $user['id']);
$builder->update(); ?>
  <div class="alert alert-info" role="alert">
    Le pseudo vient être mis à jour !
  </div>
<?php } ?>
<?php if($sessionmodel->security($request->getVar('url')) != $user['url']){ ?>
  <?php
  $builder = $db->table('user');

  $builder->where('url', $sessionmodel->security($request->getVar('url')));
  $verif_url = $builder->countAllResults();

  if($verif_url == 0){
  $builder->set('url', $request->getVar('url'));
  $builder->where('id', $user['id']);
  $builder->update(); ?>
  <div class="alert alert-info" role="alert">
    L'url vient être mis à jour !
  </div>
<?php }else{ ?>
  <div class="alert alert-danger" role="alert">
    L'url est indisponible. Choississez un autre.
  </div>
<?php } ?>
<?php } ?>
<?php if(sha1($request->getVar('password')) != $user['password'] && !empty($request->getVar('password'))){ ?>
  <?php
  $builder = $db->table('user');
  $builder->set('password', sha1($request->getVar('password')));
  $builder->where('id', $user['id']);
  $builder->update(); ?>
  <div class="alert alert-info" role="alert">
    Le mot de passe vient être mis à jour !
  </div>
<?php } ?>
<?php if($request->getVar('date') != $user['anniversaire']){ ?>
  <?php
  $builder = $db->table('user');
  $builder->set('anniversaire', $sessionmodel->security($request->getVar('date')));
  $builder->where('id', $user['id']);
  $builder->update(); ?>
  <div class="alert alert-info" role="alert">
    La date d'anniversaire vient être mis à jour !
  </div>
<?php } ?>
<?php if($request->getVar('biographie') != $user['biographie']){ ?>
  <?php
  $builder = $db->table('user');
  $builder->set('biographie', $sessionmodel->paragrapher($sessionmodel->security($request->getVar('biographie'))));
  $builder->where('id', $user['id']);
  $builder->update(); ?>
  <div class="alert alert-info" role="alert">
    La biographie vient être mise à jour !
  </div>
<?php } ?>
<?php if($request->getVar('newsletters') != $user['newsletters']){ ?>
  <?php
  if($request->getVar('newsletters') == "on"){
    $newsletters = "on";
  }else{
    $newsletters = "off";
  }
  $builder = $db->table('user');
  $builder->set('newsletters', $newsletters);
  $builder->where('id', $user['id']);
  $builder->update(); ?>

  <div class="alert alert-info" role="alert">
    Les newsletters viennent être mis à jour !
  </div>
<?php } ?>
