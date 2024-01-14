<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>

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
</style>

<section class="position-relative pb-0">
        <div class="gen-login-page-background" style="background-image: url('<?= base_url(); ?>/uploads/assets/images/background/asset-54.jpg');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <?php if (session()->has('error')) :
                    echo "<div class='alert alert-danger'>".session('error')."</div>";
                  endif ?>
                  <?php if (session()->has('errors')) : ?>
                      <?php foreach (session('errors') as $error) : ?>
                        <div class='alert alert-danger'><?= $error ?></div>
                      <?php endforeach ?>
                  <?php endif ?>
                  <?php if (session()->has('success')) :
                    echo "<div class='alert alert-success'>".session('success')."</div>";
                  endif ?>
                    <div class="text-center">
                        <form method="POST" action="<?= base_url('register_post'); ?>" id="pms_login">
                            <h4>Inscription à oStream</h4>
                            <p class="login-username">
                                <label for="user_login">Pseudo</label>
                                <input type="text" name="pseudo" class="input">
                            </p>
                            <p class="login-username">
                                <label for="user_login">Adresse email</label>
                                <input type="email" name="email" class="input">
                            </p>
                            <p class="login-password">
                                <label for="user_pass">Mot de passe</label>
                                <input type="password" name="password" class="input">
                            </p>
                            <p class="login-password">
                                <label for="user_pass">Confirmation du mot de passe</label>
                                <input type="password" name="password2" class="input">
                            </p>
                            <p class="login-password">
                                <label for="user_pass">Code parrain (Ex: 1) FACULTATIF</label>
                                <input type="number" name="parrain" class="input">
                            </p>
                            <p class="login-remember">
                                <label><input name="checkbox" type="checkbox"> J'accepte les conditions et la politique.</label>
                            </p>
                            <p class="login-submit">
                                <button type="submit" class="ostreamv2 button button-primary">Inscription</button>
                                <a href="<?= base_url('auth/discord'); ?>" id="wp-submit" class="ostreamv2 button button-primary" style="background: #5865F2;"><i class="fa-brands fa-discord"></i> Inscription Discord</a>
                            </p>
                            <a href="<?= base_url('login'); ?>">Connexion</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
