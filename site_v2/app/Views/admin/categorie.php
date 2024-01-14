<?php if($permissions['PERM__EDIT_USERS'] != 1){
return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<?php

$request = \Config\Services::request();
$db = \Config\Database::connect(); ?>
<?php if(!empty($categorie['name'])){ ?>
<style>
.toggle.btn {
    padding-right: 95%;
}
</style>
<div class="content-body">
	<div class="container-fluid">
		<div class="row page-titles mx-0">
			<div class="col-sm-12 p-md-0">
        <ol class="breadcrumb">
   		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Catégorie</a></li>
   		 	<li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $categorie['name']; ?></a></li>
				</ol>
			</div>
		</div>
		<div class="row">
      <div class="col-lg-4">
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
               <form method="POST" action="<?= base_url('import/categorie?id='.$categorie['slug'].''); ?>" enctype="multipart/form-data">
                 <input style="display: none;" name="zipfile" type="file" class="custom-file-input" id="userlogo" accept=".png,.jpg">
                 <button type="submit" name="send_file" class="btn btn-primary w-100 mb-2">Importer le fichier</button>
               </form>
             </div>
      </div>
      <div class="col-lg-8">
        <?php if(isset($_POST['submit'])){
          $builder = $db->table('categories');
          if($categorie['name'] != $request->GetPost('name')){
            error_reporting(0);
            echo "<script>document.location.href='".base_url('admincp/categorie/'.url_title(strip_tags($request->getPost('name')), '-', true))."';</script>";
            echo "<div class='alert alert-success'>Vous avez modifié le nom de la catégorie !</div>";
            $builder->set('name', strip_tags($request->GetPost('name')));
            $builder->set('slug', url_title(strip_tags($request->getPost('name')), '-', true));
            $builder->where('id', $categorie['id']);
            $builder->update();
          }

          if($request->GetPost('is_premium') == "on"){ $premium = 1; }else{ $premium = 0; }
          if($request->GetPost('trends') == "on"){ $trends = 1; }else{ $trends = 0; }
          if($request->GetPost('is_film') == "on"){ $is_film = 1; }else{ $is_film = 0; }
          if($request->GetPost('is_serie') == "on"){ $is_serie = 1; }else{ $is_serie = 0; }
          if($request->GetPost('is_live') == "on"){ $is_live = 1; }else{ $is_live = 0; }

          if($premium != $categorie['is_premium']){
            echo "<div class='alert alert-success'>Vous avez modifié le Premium de la catégorie !</div>";
            $builder->set('is_premium', $premium);
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
          if($trends != $categorie['trends']){
            echo "<div class='alert alert-success'>Vous avez modifié la Tendance de la catégorie !</div>";
            $builder->set('trends', $trends);
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
          if($is_film != $categorie['is_film']){
            echo "<div class='alert alert-success'>Vous avez modifié la catégorie Film de la catégorie !</div>";
            $builder->set('is_film', $is_film);
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
          if($is_serie != $categorie['is_serie']){
            echo "<div class='alert alert-success'>Vous avez modifié la catégorie Série de la catégorie !</div>";
            $builder->set('is_serie', $is_serie);
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
          if($is_live != $categorie['is_live']){
            echo "<div class='alert alert-success'>Vous avez modifié la catégorie Live de la catégorie !</div>";
            $builder->set('is_live', $is_live);
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
          if($is_manga != $categorie['is_manga']){
            echo "<div class='alert alert-success'>Vous avez modifié la catégorie Manga/Animé de la catégorie !</div>";
            $builder->set('is_manga', $is_manga);
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
          if($request->GetPost('id_season') != $categorie['id_season']){
            echo "<div class='alert alert-success'>Vous avez modifié le numéro de la saison !</div>";
            $builder->set('id_season', $request->GetPost('id_season'));
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
          if($request->GetPost('serie_name') != $categorie['serie_name']){
            echo "<div class='alert alert-success'>Vous avez modifié le nom de la série !</div>";
            $builder->set('serie_name', $request->GetPost('serie_name'));
            $builder->where('id', $categorie['id']);
            $builder->update();
          }
        }
        ?>
        <?php
        $sessionmodel = new \App\Models\SessionModel();
        $categorie = $sessionmodel->categories($categorie['slug']); ?>
        <div class="card">
          <div class="card-body">
            <form method="POST">
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Nom</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" name="name" class="form-control" value="<?= $categorie['name']; ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 for="is_premium" class="mb-0"><label for="is_premium" class="form-check-label"><label class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-euro-sign" title="Premium"></i> Premium</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input id="is_premium" type="checkbox" name="is_premium" class="form-check-input" <?php if($categorie['is_premium'] == "1"){ echo "checked"; }else{ echo ""; } ?> />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 for="trends" class="mb-0"><label for="trends" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-comet" title="Tendance"></i> Tendance</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input id="trends" type="checkbox" name="trends" class="form-check-input" <?php if($categorie['trends'] == "1"){ echo "checked"; }else{ echo ""; } ?> />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 for="is_film" class="mb-0"><label for="is_film" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-video" title="Film"></i> Film</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input id="is_film" type="checkbox" name="is_film" class="form-check-input" <?php if($categorie['is_film'] == "1"){ echo "checked"; }else{ echo ""; } ?> />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 for="is_serie" class="mb-0"><label for="is_serie" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-films" title="Série"></i> Série</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input id="is_serie" type="checkbox" name="is_serie" class="form-check-input" <?php if($categorie['is_serie'] == "1"){ echo "checked"; }else{ echo ""; } ?> />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 for="is_live" class="mb-0"><label for="is_live" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-signal-stream" title="Stream"></i> Live</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input id="is_live" type="checkbox" name="is_live" class="form-check-input" <?php if($categorie['is_live'] == "1"){ echo "checked"; }else{ echo ""; } ?> />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">




                <h6 for="is_manga" class="mb-0"><label for="is_manga" class="form-check-label">

                  <span class="fa-layers fa-fw">
                    <i class="fa-light fa-tv" style="color:#00FF00;"></i>
                    <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 left-3"></i>
                    <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 right-3"></i>
                  </span>
                   Manga / Animé</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input id="is_manga" type="checkbox" name="is_manga" class="form-check-input" <?php if($categorie['is_manga'] == "1"){ echo "checked"; }else{ echo ""; } ?> />
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Nom de la série</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" name="serie_name" class="form-control" value="<?= $categorie['serie_name']; ?>" />
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Numéro de la saison</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" name="id_season" class="form-control" value="<?= $categorie['id_season']; ?>" />
              </div>
            </div>

            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-9 text-secondary">
                <input type="submit" style="display:inline;" name="submit" class="btn btn-primary px-4" value="Mettre à jour" />
                <input type="submit" style="display:inline;" name="delete_data" class="btn btn-danger px-4" value="Supprimer toute les données de la catégorie" />
              </div>
            </div>
          </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php }else{
echo "<script>document.location.href='".base_url('admincp/categories')."';</script>";
} ?>
<?php if(isset($_POST['delete_data']) || !empty($_GET['delete_data']) == true){

  echo "<script>document.location.href='".base_url('admincp/categories')."';</script>";
  //redirect()->to(base_url('admincp/categories'));
  $builder = $db->table('categories');
  $builder->where('id', $categorie['id']);
  $builder->delete();
} ?>
