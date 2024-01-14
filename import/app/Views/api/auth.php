<?php
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$session = \Config\Services::session();
$db = \Config\Database::connect();
if(!empty($_SERVER['HTTP_REFERER'])){
  $findme = "ostream.online";
  $pos = strpos($_SERVER['HTTP_REFERER'], $findme);

  if($ref === "login"){
    $builder = $db->table('user');
    $builder->where('email', $request->GetPost('pseudo'));
    $verify__user_exist = $builder->countAllResults();
    if($verify__user_exist == 1){ // Verif si le compte existe

      $builder2 = $db->table('user');
      $builder2->where('email', $request->GetPost('pseudo'));
      $query = $builder2->get();
      foreach ($query->getResult() as $row){ // Affiche les données
        if (sha1($request->GetPost('password')) != $row->password) {
          echo "<div class='alert alert-danger'>Le mot de passe de votre compte est incorrecte.</div>";
        }else{
          if($row->etat == "0"){
            // login OK, save user data to session
            $session->set('isLoggedIn', true);
            $session->set('userData', [
              'id' => $row->id
            ]);

            $builder3 = $db->table('user');
            $builder3->set('last_login', date('Y-m-d H:i:s'));
            $builder3->where('email', $request->GetPost('pseudo'));
            $builder3->update();
            echo "<div class='alert alert-success'>Connexion réussie</div>";
          }elseif($row->etat == "1"){
            echo "<div class='alert alert-danger'>Oups. Ce compte n'est pas validé</div>";
          }elseif($row->etat == "2"){
            echo "<div class='alert alert-danger'>Oups. Ce compte est banni</div>";
          }else{
            echo "<div class='alert alert-danger'>Oups. Ce compte est désactivé par OStream.</div>";
          }
        }
      }
    }else{
      echo "<div class='alert alert-danger'>Oups. Ce compte n'existe pas. Vérifiez l'email.</div>";
    }
  }

  if($ref === "update"){
    if(!empty($request->GetPost('password')) && !empty($request->GetPost('password2'))){
    if (sha1($request->GetPost('password')) != sha1($request->GetPost('password2'))) {
      echo "<div class='alert alert-danger'>Le mot de passe de votre compte est incorrecte.</div>";
    }else{
      $builder3 = $db->table('user');
      $builder3->set('password', sha1($request->GetPost('password')));
      $builder3->where('id', $user['id']);
      $builder3->update();
      echo "<div class='alert alert-success'>Votre mot de passe vient d'être modifié avec succès.</div>";
    }
    }
    if(!empty(htmlentities($request->GetPost('bio')))){
      if (sha1(htmlentities($request->GetPost('bio'))) != sha1(htmlentities($user['bio'])) ) {
        $builder3 = $db->table('user');
        $builder3->set('bio', htmlentities($request->GetPost('bio'))) ;
        $builder3->where('id', $user['id']);
        $builder3->update();
        echo "<div class='alert alert-success'>Votre biographie vient d'être modifié avec succès.</div>";
      }
    }
  }

  if($ref === "add_share"){
    if(!empty($request->GetPost('email'))){
      $builder = $db->table('user__share');
      $builder->where('user', $user['id']);
      $builder->where('email', $request->GetPost('email'));
      $verify__user_exist = $builder->countAllResults();
      if($verify__user_exist == 0){
        $builder = $db->table('user__share');
        $data = [
          'user' => $user['id'],
          'email' => $request->GetPost('email'),
        ];
        $builder->insert($data);
        echo "<div class='alert alert-success'>Compte ajouté avec succès.</div>";
      }else{
      echo "<div class='alert alert-danger'>Ce compte est déjà dans votre liste.</div>";
      }
    }
  }

  if($ref === "remove_share"){
    if(!empty($request->GetPost('email'))){

      $builder = $db->table('user__share');
      $builder->where('user', $user['id']);
      $builder->where('email', $request->GetPost('email'));
      $builder->delete();
      echo "<div class='alert alert-success'>Compte supprimé avec succès.</div>";
    }
  }

  if($ref === "list_share"){
    $builder = $db->table('user__share');
    $builder->where('user', $user['id']);
    $query = $builder->get();
    foreach ($query->getResult() as $row) { ?>
      <?php // DEBUT PAIEMENT FONDS
      $builder2 = $db->table('user');
      $builder2->where('email', $row->email);
      $query2 = $builder2->get();
      foreach ($query2->getResult() as $row_user) { ?>

    <div class="col-12 col-sm-3">
      <div class="gen-icon-box-style-1">
          <div class="gen-icon-box-icon">
              <span class="gen-icon-animation" style="background: url('<?= $row_user->avatar; ?>');
              background-repeat: no-repeat;
              background-size: cover;">
              </span>
          </div>
          <div class="gen-icon-box-content">
              <h3 class="pt-icon-box-title mb-2">
                  <span><?= $row_user->pseudo; ?></span>
              </h3>
              <?php if (!session('userParrain.id')) { ?>
            <span class="btn btn-danger" onclick="remove_share('<?= $row_user->email; ?>');">Supprimer l'accès</span>
          <?php } ?>
          </div>
      </div>
    </div>
    <?php }
    }
  }
} ?>
