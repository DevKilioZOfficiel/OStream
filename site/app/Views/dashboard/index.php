<?php
$db = \Config\Database::connect();
$builder = $db->table('invoices');
$builder->where('user', $user['id']);
$count_achats = $builder->countAllResults(); ?>
<style>
.text-bg-danger {
    color: #fff!important;
    background-color: RGBA(220,53,69,var(--bs-bg-opacity,1))!important;
}
</style>
<script src="https://cdn.tiny.cloud/1/9vw8oczjmxak7rf0gu7edvi60s713fxjxucq0parv31rkkhe/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>
<?php
$builder2 = $db->table('avis');
$builder2->where('user', $user['id']);
$count_avis = $builder2->countAllResults(); ?>
<?php $paypal_id_prod = "AZ3R-41PcjlWDSvGE1T1D_OBY1Y40ChOf07igGlwJXfetR49rIXa0G6mvjWWMJHylGC9SoAuvEzoF4By";
$paypal_id_prod2 = "ASuiCZJLqlOapr683fq_hi6sh5-AG3bGBX8vYaBNg3_TwIzk_MJ9WgfB73dPyF_Qsj6eBqjN-GauD2gJ"; ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= $paypal_id_prod; ?>&currency=EUR"></script>

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
              <a href="<?= $user['avatar']; ?>" class="mpl-media-image" data-fancybox data-animation-effect="fade">
                <span class="mpl-image">
                  <img src="<?= $user['avatar']; ?>" alt="">
                </span>
                <svg class="icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8 3H5C4.46957 3 3.96086 3.21071 3.58579 3.58579C3.21071 3.96086 3 4.46957 3 5V8M21 8V5C21 4.46957 20.7893 3.96086 20.4142 3.58579C20.0391 3.21071 19.5304 3 19 3H16M16 21H19C19.5304 21 20.0391 20.7893 20.4142 20.4142C20.7893 20.0391 21 19.5304 21 19V16M3 16V19C3 19.5304 3.21071 20.0391 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21H8" />
                </svg>
              </a>
              <div>
                <div class="mpl-media-title h5"><?= $user['pseudo']; ?></div>
                <div class="mpl-media-subtitle"><?= $permissions['nom']; ?></div>
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
      <a href="#general" class="nav-link active" aria-controls="general" role="tab" data-bs-toggle="tab" aria-selected="true">Paramètres</a>
    </li>
    <li role="presentation" class="nav-item">
      <a href="#share" class="nav-link" aria-controls="share" role="tab" data-bs-toggle="tab" aria-selected="false">Partage de compte (<span id="count_share"></span>/<?= $premium_user_info['share_user']; ?>)</a>
    </li>
    <li role="presentation" class="nav-item">
      <a href="#credit" class="nav-link" aria-controls="credit" role="tab" data-bs-toggle="tab" aria-selected="false">Crédit</a>
    </li>
  </ul>
</div>
<div class="mpl-box-md">
  <div class="container">
    <div class="row hgap-lg vgap-lg">
      <div class="col-lg-12"> <!-- mpl-content -->
        <div id="result_ajax"></div>
        <?php if (session()->has('error')) :
          echo "<div class='alert alert-danger'>".session('error')."</div>";
        endif ?>
        <?php if (session()->has('success')) :
          echo "<div class='alert alert-success'>".session('success')."</div>";
        endif ?>
        <?php if (session()->has('errors')) : ?>
            <?php foreach (session('errors') as $error) : ?>
              <div class='alert alert-danger'><?= $error ?></div>
            <?php endforeach ?>
        <?php endif ?>
        <?php // DEBUT PAIEMENT FONDS
        $builder = $db->table('user__share');
        $builder->where('email', $user['email']);
        $query = $builder->get();
        foreach ($query->getResult() as $row) {
          if(isset($_POST['account_'.$row->id])){
            $builder = $db->table('user');
    				$builder->where('id', $row->user);
    				$query = $builder->get();
    				foreach ($query->getResult() as $row_user) { ?>
            <div class="alert alert-success">Changement de compte avec succès ! Connexion avec <?= $row_user->pseudo; ?></div>
          <?php }
          }
        } ?>
        <?php if(!empty($_GET['primaryaccount']) && session('userParrain.id')){ ?>
          <div class="alert alert-success">Vous êtes désormais sur votre compte principal !</div>
        <?php
        } ?>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade show active" id="general">
            <?php if (!session('userParrain.id')) { ?>
            <form data-sr="user-setting">
              <div class="mpl-snippet-fill">
                <h2>Changer vos paramètres</h2>
                <div class="row hgap-sm vgap-sm">
                  <div class="col-12 col-sm-6">
                    <label for="setting_password">Mot de passe actuel:</label>
                    <input class="form-control" type="password" id="old_mdp" placeholder="Mot de passe actuel"><span class="form-control-bg"></span>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="setting_new_password">Nouveau mot de passe:</label>
                    <input class="form-control" type="password" id="new_mdp" placeholder="Nouveau mot de passe"><span class="form-control-bg"></span>
                  </div>

                  <div class="col-12 col-sm-12">
                    <label for="setting_new_password">Biographie:</label>
                    <textarea class="form-control" id="bio"><?= $user['bio']; ?></textarea>
                  </div>
                </div>
                <button onclick="update()" type="button" class="mpl-link mt-30">Changer vos paramètres</button>
              </div>
            </form>

            <?php if($user['premium'] == "0"){ ?>
        <div class="col-xxl-12 col-lg-12 col-md-12 col-s-12 col-sm-12">
          <div class="text-bg-danger" style="padding:8px;margin-top:25px;border-radius:10px;">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Avatars</label>
              <h6>Devenez Premium pour modifier votre avatar</h6>
              <div style="float: right;display: flex;margin-top: -68px;">
                <i class="fa-duotone fa-circle-exclamation fa-4x fa-fade"></i>
              </div>
            </div>
          </div>
        </div>
            <?php }else{ ?>
            <form class="mpl-snippet-fill" style="margin-top:25px;" method="post" action="<?= base_url('import/user_avatar'); ?>" enctype="multipart/form-data">
              <input style="display: none;" name="avatar" type="file" class="custom-file-input" id="userlogo" accept=".png,.jpg">
              <div class="card form-control" style="height: auto;" onclick="document.getElementById('userlogo').click();" style="margin-bottom: 25px;">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card-body">
                      <h5 class="card-title">Importer une image en format .jpg ou .png</h5>
                      <p class="card-text">Taille maximale: 5Mo et 1024x1024px</p>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="mpl-link mt-30">Changer votre avatar</button>
            </form>
          <?php } ?>
          <?php }else{ ?>
            <div class="alert alert-warning">Impossible de modifier les informations de ce compte</div>
          <?php } ?>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="share">
          <?php if (!session('userParrain.id')) { ?>
            <form>
              <div class="mpl-snippet-fill" style="margin-bottom: 25px;">
                <h2>Ajouter un compte</h2>
                <div class="row hgap-sm vgap-sm">
                  <div class="col-12 col-sm-6">
                    <label for="setting_password">Adresse email:</label>
                    <input class="form-control" type="email" id="email" placeholder="Adresse email qui aura accès à votre compte"><span class="form-control-bg"></span>
                  </div>
                </div>
                <button onclick="add_share()" type="button" class="mpl-link mt-30">Ajouter l'utilisateur</button>
              </div>
            </form>
          <?php } ?>
            <div class="mpl-snippet-fill" style="margin-bottom: 25px;">
              <h2>Comptes ayant vos accès</h2>
              <div class="row hgap-sm vgap-sm" id="list_share">
              </div>
            </div>
            <?php if (!session('userParrain.id')) { ?>
            <div class="mpl-snippet-fill" style="margin-bottom: 25px;">
              <h2>Comptes auxquels vous avez accès</h2>
              <div class="row hgap-sm vgap-sm">
                <?php // DEBUT PAIEMENT FONDS
                $builder = $db->table('user__share');
                $builder->where('email', $user['email']);
                $query = $builder->get();
                foreach ($query->getResult() as $row) { ?>
                  <?php // DEBUT PAIEMENT FONDS
                  $builder2 = $db->table('user');
                  $builder2->where('id', $row->user);
                  $query2 = $builder2->get();
                  foreach ($query2->getResult() as $row_user) { ?>
                <div class="col-12 col-sm-3">
                  <div class="mpl-forum mpl-forum-topic">
                    <div class="mpl-forum-topic-author">
                      <span class="mpl-image">
                          <img src="https://www.gravatar.com/avatar/<?= md5($row_user->email); ?>?size=2048" alt="">
                      </span>
                      <div class="mpl-forum-topic-author-name h5" title="<?= $row_user->pseudo; ?>">
                          <a href="#"><?= $row_user->pseudo; ?></a>
                      </div>
                      <?php if (!session('userParrain.id')) { ?>
                      <div class="mpl-forum-topic-author-role">
                        <form method="POST">
                          <button class="btn btn-primary" type="submit" name="account_<?= $row->id; ?>">Connexion au compte</button>
                        </form>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
                <?php } ?>
              <?php } ?>
              </div>
            </div>
          <?php } ?>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="credit">
            <?php if (!session('userParrain.id')) { ?>
            <div class="mpl-snippet-fill">
              <h2>Crédit du compte (<?= $user['solde']; ?>€)</h2>
              <div class="row hgap-sm vgap-sm">
                <div class="col-12 col-sm-12">
                  <label for="setting_password">Solde à ajouter:</label>
                  <input class="form-control" type="number" step="0.01" min="1" max="1000" placeholder="Combien voulez-vous ajouter ? Minimum 1€ a maximum 1000€" id="add_credit" required><span class="form-control-bg"></span>
                </div>
              </div>
              <br><br>
              <div class="row hgap-sm vgap-sm">
                <div id="paypal-button-container"></div>
              </div>
            </div>
          <?php }else{ ?>
            <div class="alert alert-warning">Impossible de créditer ce compte</div>
          <?php } ?>
            <script>
              // Render the PayPal button into #paypal-button-container

              var FUNDING_SOURCES = [
              paypal.FUNDING.PAYPAL,
              paypal.FUNDING.VENMO,
              paypal.FUNDING.CREDIT,
              paypal.FUNDING.CARD
              ];

              // Loop over each funding source / payment method
              FUNDING_SOURCES.forEach(function(fundingSource) {

                // Initialize the buttons
                var button = paypal.Buttons({
                  fundingSource: fundingSource,

                  createOrder: function(data, actions) {
                    return actions.order.create({
                      purchase_units: [{
                        amount: {
                          value: document.getElementById("add_credit").value
                        }
                      }]
                    });
                  },

                  // Finalize the transaction
                  onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                      // Successful capture! For demo purposes:
                      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                      console.log('data: '+JSON.stringify(data, null, 2));
                      //var transaction = orderData.purchase_units[0].payments.captures[0];
                      //alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                      window.location = "<?= base_url(''); ?>/payement/?paymentID="+orderData.purchase_units[0].payments.captures[0].id+"&payerID="+data.payerID+"&token="+data.facilitatorAccessToken+"&price="+document.getElementById("add_credit").value+"";
                      // Replace the above to show a success message within this page, e.g.
                      // const element = document.getElementById('paypal-button-container');
                      // element.innerHTML = '';
                      // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                      // Or go to another URL:  actions.redirect('thank_you.html');
                    });
                  }
                });

                // Check if the button is eligible
                if (button.isEligible()) {

                  // Render the standalone button for that funding source
                  button.render('#paypal-button-container');
                }
              });
            </script>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<script>
  function update(){
    oData = new FormData();
    oData.append("password", document.getElementById("old_mdp").value);
    oData.append("password2", document.getElementById("new_mdp").value);
    oData.append("bio", tinymce.get("bio").getContent());

    var oReq = new XMLHttpRequest();
    oReq.open("POST", "<?= base_url(); ?>/api/auth/update", true);
    oReq.onload = function(oEvent) {
      console.log(oReq);
      console.log(oReq.status);
      console.log(oReq.responseText);
      if (oReq.status == 200) {
        document.getElementById("result_ajax").innerHTML = oReq.responseText;
      } else {
        document.getElementById("result_ajax").innerHTML = "<div class='alert alert-danger'>Erreur " + oReq.status+"</div>";
      }
    };
    oReq.send(oData);
  }

  <?php
  $builder = $db->table('user__share');
  $builder->where('user', $user['id']);
  $count_total_shared = $builder->countAllResults(); ?>

setTimeout(function(){
  document.getElementById("count_share").innerHTML = "<?= $count_total_shared;?>";
  list_share();
},100);

  function add_share(){
    if(document.getElementById("email").value == ""){

    }else{
    oData = new FormData();
    oData.append("email", document.getElementById("email").value);

    var oReq = new XMLHttpRequest();
    oReq.open("POST", "<?= base_url(); ?>/api/auth/add_share", true);
    oReq.onload = function(oEvent) {
      console.log(oReq);
      console.log(oReq.status);
      console.log(oReq.responseText);
      if (oReq.status == 200) {
        document.getElementById("result_ajax").innerHTML = oReq.responseText;
        document.getElementById("count_share").innerHTML = "<?= $count_total_shared+1;?>";
        list_share();
      } else {
        document.getElementById("result_ajax").innerHTML = "<div class='alert alert-danger'>Erreur " + oReq.status+"</div>";
      }
    };
    oReq.send(oData);
    }
  }

  function remove_share(element){
    oData = new FormData();
    oData.append("email", element);
    var oReq = new XMLHttpRequest();
    oReq.open("POST", "<?= base_url(); ?>/api/auth/remove_share", true);
    oReq.onload = function(oEvent) {
      console.log(oReq);
      console.log(oReq.status);
      console.log(oReq.responseText);
      if (oReq.status == 200) {
        document.getElementById("result_ajax").innerHTML = oReq.responseText;
        document.getElementById("count_share").innerHTML = "<?= $count_total_shared-1;?>";
        list_share();
      } else {
        document.getElementById("result_ajax").innerHTML = "<div class='alert alert-danger'>Erreur " + oReq.status+"</div>";
      }
    };
    oReq.send(oData);
  }

  function list_share(){
    oData = new FormData();
    var oReq = new XMLHttpRequest();
    oReq.open("POST", "<?= base_url(); ?>/api/auth/list_share", true);
    oReq.onload = function(oEvent) {
      console.log(oReq);
      console.log(oReq.status);
      console.log(oReq.responseText);
      if (oReq.status == 200) {
        document.getElementById("list_share").innerHTML = oReq.responseText;
      } else {
        document.getElementById("list_share").innerHTML = "<div class='alert alert-danger'>Erreur " + oReq.status+"</div>";
      }
    };
    oReq.send(oData);
  }
</script>
