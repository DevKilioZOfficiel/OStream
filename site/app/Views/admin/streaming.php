<?php if($permissions['PERM__EDIT_USERS'] != 1){
return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<style>
.toggle.btn {
    padding-right: 95%;
}
</style>
<?php
$request = \Config\Services::request();
$db = \Config\Database::connect();
$builder_count_users = $db->table('user');
$count_total_visites = $builder_count_users->countAllResults();
?>
<div class="content-body">
	<div class="container-fluid">
		<div class="row page-titles mx-0">
			<div class="col-sm-12 p-md-0">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Live</a></li>
    		 	<li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $streams['titre']; ?></a></li>
				</ol>
			</div>
		</div>
		<div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="<?= $streams['image']; ?>" alt="Admin" class="p-1 bg-primary" width="100%">
              <div class="mt-3">
                <h4><?= $streams['titre']; ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <?php if(isset($_POST['submit'])){
          $builder = $db->table('list');
          if($streams['titre'] != $request->GetPost('titre')){
            error_reporting(0);
            echo "<script>document.location.href='".base_url('admincp/live/'.url_title(strip_tags($request->getPost('titre')), '-', true))."-".$streams['id']."';</script>";
            echo "<div class='alert alert-success'>Vous avez modifié le nom du stream !</div>";
            $builder->set('titre', strip_tags($request->GetPost('titre')));
            $builder->set('slug', url_title(strip_tags($request->getPost('titre')), '-', true).'-'.$streams['id']);
            $builder->where('id', $streams['id']);
            $builder->update();
          }

          if($request->GetPost('is_premium') == "on"){ $premium = 1; }else{ $premium = 0; }

          if($premium != $streams['is_premium']){
            echo "<div class='alert alert-success'>Vous avez modifié le Premium du Stream !</div>";
            $builder->set('is_premium', $premium);
            $builder->where('id', $streams['id']);
            $builder->update();
          }

          if($request->GetPost('id_categorie') != $streams['id_categorie']){
            echo "<div class='alert alert-success'>Vous avez modifié la catégorie du stream !</div>";
            $builder->set('id_categorie', $request->GetPost('id_categorie'));
            $builder->where('id', $streams['id']);
            $builder->update();
          }

          if($request->GetPost('server_id') != $streams['server_id']){
            echo "<div class='alert alert-success'>Vous avez modifié le serveur du stream !</div>";
            $builder->set('server_id', $request->GetPost('server_id'));
            $builder->where('id', $streams['id']);
            $builder->update();
          }

          if($request->GetPost('stream_url') != $streams['stream_url']){
            echo "<div class='alert alert-success'>Vous avez modifié l'url/clé du stream !</div>";
            $builder->set('stream_url', $request->GetPost('stream_url'));
            $builder->where('id', $streams['id']);
            $builder->update();
          }

          if($request->GetPost('launch') != $streams['launch']){
            echo "<div class='alert alert-success'>Vous avez modifié la date de lancement du stream !</div>";
            $builder->set('launch', strtotime($request->GetPost('launch')));
            $builder->where('id', $streams['id']);
            $builder->update();
          }

          if($request->GetPost('end') != $streams['end']){
            echo "<div class='alert alert-success'>Vous avez modifié la date de fin du stream !</div>";
            $builder->set('end', strtotime($request->GetPost('end')));
            $builder->where('id', $streams['id']);
            $builder->update();
          }

          if($request->GetPost('stream_type') != $streams['stream_type']){
            echo "<div class='alert alert-success'>Vous avez modifié le type de stream !</div>";
            $builder->set('stream_type', strtotime($request->GetPost('stream_type')));
            $builder->where('id', $streams['id']);
            $builder->update();
          }
        }
        ?>
        <?php
        $sessionmodel = new \App\Models\SessionModel();
        $streams = $sessionmodel->streams($streams['slug']); ?>
        <div class="card">
          <div class="card-body">
            <form method="POST">
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Nom</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" name="titre" class="form-control" value="<?= $streams['titre']; ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 for="is_premium" class="mb-0"><label for="is_premium" class="form-check-label"><label class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-euro-sign" title="Premium"></i> Premium</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input id="is_premium" type="checkbox" name="is_premium" class="form-check-input" <?php if($streams['is_premium'] == "1"){ echo "checked"; }else{ echo ""; } ?> />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Serveur</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <select class="form-control" name="server_id">
                  <?php $builder_user = $db->table('servers');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row_server){ ?>
                    <option value="<?= $row_server->id; ?>" <?php if($row_server->id === $streams['server_id']){ ?>selected<?php } ?>><?= $row_server->name; ?> (<?= $row_server->url; ?>)</option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Catégorie</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <select class="form-control" name="id_categorie">
                  <?php $builder_user = $db->table('categories');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row_server){ ?>
                    <option value="<?= $row_server->id; ?>" <?php if($row_server->id === $streams['id_categorie']){ ?>selected<?php } ?>><?= $row_server->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Clé/URL</h6>
              </div>
              <div class="col-sm-6 text-secondary">
                <input type="text" name="stream_url" class="form-control" value="<?= $streams['stream_url']; ?>" id="gen_key" />
              </div>
              <div class="col-md-3">
                <button type="button" onclick="create_UUID()" style="width:100%;" class="btn btn-info">Générer une clé</button>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Type de stream</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <select class="form-control" name="stream_type">
                  <option value="vps" <?php if("vps" === $streams['stream_type']){ ?>selected<?php } ?>>VPS</option>
                  <option value="custom_https_url" <?php if("custom_https_url" === $streams['stream_type']){ ?>selected<?php } ?>>Lien customisé</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Date de lancement</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="datetime-local" name="launch" class="form-control" value="<?php if($streams['launch'] != ""){ echo date('Y-m-d H:i:s',$streams['launch']); } ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Date de fin</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="datetime-local" name="end" class="form-control" value="<?php if($streams['end'] != ""){ echo date('Y-m-d H:i:s',$streams['end']); } ?>" />
              </div>
            </div>

            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-9 text-secondary">
                <input type="submit" style="display:inline;" name="submit" class="btn btn-primary px-4" value="Mettre à jour" />
                <input type="submit" style="display:inline;" name="delete_data" class="btn btn-danger px-4" value="Supprimer toute les données live" />
              </div>
            </div>
          </form>
          </div>
        </div>
        <div class="card" style="height: auto;" onclick="document.getElementById('userlogo').click();" style="margin-bottom: 25px;">
               <div class="row">
                 <div class="col-md-12">
                   <div class="card-body">
                     <h5 class="card-title">Importer une image en format .jpg ou .png</h5>
                     <p class="card-text">Taille maximale: 5Mo</p>
                   </div>
                 </div>
               </div>
             </div>
             <div class="row">
               <form method="POST" action="<?= base_url('import/streams?id='.$streams['slug'].''); ?>" enctype="multipart/form-data">
                 <input style="display: none;" name="zipfile" type="file" class="custom-file-input" id="userlogo" accept=".png,.jpg">
                 <button type="submit" name="send_file" class="btn btn-primary w-100 mb-2">Importer le fichier</button>
               </form>
             </div>
      </div>
    </div>
  </div>
</div>

<script>
function create_UUID(){
    var dt = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (dt + Math.random()*16)%16 | 0;
        dt = Math.floor(dt/16);
        return (c=='x' ? r :(r&0x3|0x8)).toString(16);
    });
    //return uuid;
    document.getElementById('gen_key').value = uuid;
}
</script>

<?php if(isset($_POST['delete_data']) || !empty($_GET['delete_data']) == true){

  echo "<script>document.location.href='".base_url('admincp/lives')."';</script>";
  //redirect()->to(base_url('admincp/categories'));
  $builder = $db->table('list');
  $builder->where('id', $streams['id']);
  $builder->delete();
} ?>
