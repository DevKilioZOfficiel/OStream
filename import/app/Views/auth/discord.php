<?php
error_reporting(0);
$db = \Config\Database::connect();
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();

if (session('isLoggedIn')) {
  $online_user = true;
}else{
  $online_user = false;
}
?>
<?php if($online_user === true){ ?>
<script>document.location.href='<?= base_url('dashboard'); ?>';</script>
<?php }else{ ?>
<?php
function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);


  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

  $headers[] = 'Accept: application/json';

  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return json_decode($response);
}

define('OAUTH2_CLIENT_ID', '1049654824683184188');
define('OAUTH2_CLIENT_SECRET', '53AeX8IOTzvm5zF8ip3zOOZXubK_JqIB');
define('OAUTH2_REDIRECT', ''.base_url().'/auth/discord');

$authorizeURL = 'https://discord.com/api/oauth2/authorize';
$tokenURL = 'https://discord.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';
$apiURLBaseGuilds = 'https://discord.com/api/users/@me/guilds';
$revokeURL = 'https://discord.com/api/oauth2/token/revoke';

if (!isset($_GET['code'])) {
  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => OAUTH2_REDIRECT,
    'response_type' => 'code',
    'scope' => 'identify guilds email'
  );

  // Redirect the user to Discord's authorization page
  header('Location: https://discord.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}else{
  // Exchange the auth code for a token
  $token = apiRequest($tokenURL, array(
    "grant_type" => "authorization_code",
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => OAUTH2_REDIRECT,
    'code' => $request->GetGet('code')
  ));
  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;


  //header('Location: ' . $_SERVER['PHP_SELF']);


  $discord_user_api = apiRequest($apiURLBase);
  $guilds = apiRequest($apiURLBaseGuilds);

  $builder = $db->table('user');
  $builder->where('discord_id', $discord_user_api->id);
  $signup = $builder->countAllResults();

  if(empty($discord_user_api->email) || empty($discord_user_api->username)){
    $params = array(
      'client_id' => OAUTH2_CLIENT_ID,
      'redirect_uri' => OAUTH2_REDIRECT,
      'response_type' => 'code',
      'scope' => 'identify guilds email'
    );
    header('Location: https://discord.com/api/oauth2/authorize' . '?' . http_build_query($params));
  }
  if($signup != 0){

    $builder_update_discord_id = $db->table('user');
    $builder_update_discord_id->where('discord_id', $discord_user_api->id);
    $query   = $builder_update_discord_id->get();
    foreach ($query->getResult() as $row) {
      $real_user_id = $row->id;
    }

    $session_set = $ServiceSession;
    $session_set->set('isLoggedIn', true);
    $session_set->set('userData', [
       'id' 	    	=> $real_user_id
    ]);

    if($discord_user_api->banner === null){
      $banner = "https://cdn.discordapp.com/embed/avatars/1.png";
    }else{
      $banner = "https://cdn.discordapp.com/banners/".$discord_user_api->id."/".$discord_user_api->banner.".png?size=512";
    }

    if($discord_user_api->banner_color === null){
      $banner_color = "#FF9F43";
    }else{
      $banner_color = $discord_user_api->banner_color;
    }

    if($discord_user_api->avatar === null){
      $avatar = "https://cdn.discordapp.com/embed/avatars/1.png";
    }else{
      $avatar = 'https://cdn.discordapp.com/avatars/'.$discord_user_api->id.'/'.$discord_user_api->avatar.'.png?size=1024';
    }

    if(empty($discord_user_api->premium_type)){
      $premium_type = 0;
    }else{
      $premium_type = $discord_user_api->premium_type;
    }
    $builder_update = $db->table('user');
    $builder_update->set('pseudo', strip_tags($discord_user_api->username));
    $builder_update->set('tag', '#'.$discord_user_api->discriminator.'');
    $builder_update->set('email', strip_tags($discord_user_api->email));
    $builder_update->set('avatar', $avatar);
    $builder_update->set('etat', $discord_user_api->verified);

    $builder_update->set('last_login', date('Y-m-d H:i:s'));
    $builder_update->where('discord_id', $discord_user_api->id);
    $builder_update->update();
    //return redirect()->to(base_url('settings')); ?>

    <script>document.location.href='<?= base_url('dashboard'); ?>';</script>
  <?php
}else{
    // Exchange the auth code for a token
    $membre_api = apiRequest($tokenURL, array(
      "grant_type" => "authorization_code",
      'client_id' => OAUTH2_CLIENT_ID,
      'client_secret' => OAUTH2_CLIENT_SECRET,
      'redirect_uri' => OAUTH2_REDIRECT,
      'code' => $request->GetGet('code')
    ));
    $logout_token = $token->access_token;
    $_SESSION['access_token'] = $token->access_token;


    //header('Location: ' . $_SERVER['PHP_SELF']);


    $discord_user_api = apiRequest($apiURLBase);
    $guilds = apiRequest($apiURLBaseGuilds);

    $membre_api2 = json_encode($discord_user_api);
    $membre_api = json_decode($membre_api2);

    if($membre_api->banner === null){
      $banner = "https://cdn.discordapp.com/embed/avatars/1.png";
    }else{
      $banner = "https://cdn.discordapp.com/banners/".$membre_api->id."/".$membre_api->banner.".png?size=512";
    }

    if($membre_api->banner_color === null){
      $banner_color = "#FF9F43";
    }else{
      $banner_color = $membre_api->banner_color;
    }

    if($discord_user_api->avatar === null){
      $avatar = "https://cdn.discordapp.com/embed/avatars/1.png";
    }else{
      $avatar = 'https://cdn.discordapp.com/avatars/'.$membre_api->id.'/'.$discord_user_api->avatar.'.png?size=128';
    }
    $builder_verif = $db->table('user');
    //$builder_verif->where('discord_id', $membre_api->id);
    $builder_verif->where('email', $membre_api->email);
    $user_exist = $builder_verif->countAllResults();
    if($user_exist === 0){
      if(empty($membre_api->premium_type)){
        $premium_type = 0;
      }else{
        $premium_type = $membre_api->premium_type;
      }
    $data = [
        'pseudo'  => $membre_api->username,
        'tag'  => '#'.$membre_api->discriminator.'',
        'email'  => $membre_api->email,
        'avatar'  => $avatar,
        'ip'  => $sessionmodel->get_ip(),
        'etat'  => $membre_api->verified,
        'register_type' => "discord",
        'discord_id' => $membre_api->id
    ];

    $builder->insert($data);
  }else{
    $builder_update = $db->table('user');
    $builder_update->set('discord_id', $membre_api->id);
    $builder_update->where('email', $membre_api->email);
    $builder_update->update();
  }

    $builder_update_discord_id = $db->table('user');
    $builder_update_discord_id->where('discord_id', $membre_api->id);
    $query   = $builder_update_discord_id->get();
    foreach ($query->getResult() as $row) {
      $real_user_id = $row->id;
    }
    $session_set = $ServiceSession;
    $session_set->set('isLoggedIn', true);
    $session_set->set('userData', [
       'id' 	    	=> $real_user_id
    ]);
    //return redirect()->to(base_url('settings')); ?>

    <script>document.location.href='<?= base_url('dashboard'); ?>';</script>
    <?php

  }
}
} ?>
