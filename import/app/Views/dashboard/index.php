<?php
$db = \Config\Database::connect();
$builder = $db->table('invoices');
$builder->where('user', $user['id']);
$count_achats = $builder->countAllResults(); ?>
<style>
.ostreamv2{
  padding: 12px 30px;
    font-family: var(--title-fonts);
    font-size: 16px;
    background: var(--primary-color);
    color: var(--white-color);
    text-transform: capitalize;
    color: var(--white-color) !important;
    display: inline-block;
    border: none;
    width: auto;
    height: auto;
    line-height: 2;
    text-transform: uppercase;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
    transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
}
.ostreamfile{
  background: var(--black-color);
border: 1px solid var(--black-color);
color: var(--white-color);
width: 100%;
float: left;
font-size: 16px;
padding: 0 15px;
height: 54px;
line-height: 54px;
outline: none;
-webkit-border-radius: 0px;
-moz-border-radius: 0px;
border-radius: 0px;
transition: all 0.5s ease-in-out;
transition: all 0.5s ease-in-out;
-moz-transition: all 0.5s ease-in-out;
-ms-transition: all 0.5s ease-in-out;
-o-transition: all 0.5s ease-in-out;
-webkit-transition: all 0.5s ease-in-out;
}
.text-bg-danger {
    color: #fff!important;
    background-color: RGBA(220,53,69,var(--bs-bg-opacity,1))!important;
}

.nav-ostream {
    background: transparent;
    color: var(--white-color);
    border-width: 0px;
    border-bottom: 7px solid var(--primary-color);
    border-radius: 0;
}
.nav-ostream.active {
    background: transparent;
    color: var(--white-color);
    border-width: 0px;
    border-bottom: 7px solid var(--primarydark-color);
    border-radius: 0;
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

<div class="gen-breadcrumb" style="background-image: url('<?= base_url('uploads/assets/images/ostream.jpg'); ?>');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>
                                Paramètres
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('profile/'.$user['id'].''); ?>"><i class="fas fa-home mr-2"></i>Profil</a></li>
                                <li class="breadcrumb-item active">Paramètres</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="gen-section-padding-3 gen-library">
      <div class="container">
        <div class="row">
            <div class="col-lg-12">
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

<ul class="nav mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-ostream active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Paramètres</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-ostream" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Partage de compte (<span id="count_share"></span>/<?= $premium_user_info['share_user']; ?>)</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-ostream" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Crédit</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">

    <?php if (!session('userParrain.id')) { ?>
    <form>
          <div class="gen-register-form">
              <h2>Paramètres</h2>
              <label>Mot de passe actuel</label>
              <input type="password" id="old_mdp" value="">

              <label>Nouveau mot de passe</label>
              <input type="password" id="new_mdp" value="">

              <label>Biographie</label>
              <textarea class="form-control" id="bio"><?= $user['bio']; ?></textarea>

              <div class="login-submit">
                  <button type="button" class="ostreamv2 button button-primary" onclick="update()">Modifier les paramètres</button>
              </div>
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
        <div class="card ostreamfile" style="height: auto;" onclick="document.getElementById('userlogo').click();" style="margin-bottom: 25px;">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body">
                <h5 class="card-title">Importer une image en format .jpg ou .png</h5>
                <p class="card-text">Taille maximale: 5Mo et 1024x1024px</p>
              </div>
            </div>
          </div>
        </div>
        <div class="login-submit">
          <button type="submit" class="ostreamv2 button button-primary">Changer votre avatar</button>
        </div>
      </form>
    <?php } ?>
    <?php }else{ ?>
      <div class="alert alert-warning">Impossible de modifier les informations de ce compte</div>
    <?php } ?>

  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

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

          <div class="login-submit">
            <button onclick="add_share()" type="button" class="ostreamv2 button button-primary">Ajouter l'utilisateur</button>
          </div>
        </div>
      </form>
    <?php } ?>
      <div style="margin-bottom: 25px;">
        <h2>Comptes ayant vos accès</h2>
        <div class="row hgap-sm vgap-sm" id="list_share">
        </div>
      </div>
      <?php if (!session('userParrain.id')) { ?>
      <div style="margin-bottom: 25px;">
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
                        <form method="POST">
                          <button class="btn btn-primary" type="submit" name="account_<?= $row->id; ?>">Connexion au compte</button>
                        </form>
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
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

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
    </section>

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
