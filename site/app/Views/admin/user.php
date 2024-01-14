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
   <div class="page-titles">
		 <ol class="breadcrumb">
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Utilisateurs</a></li>
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $info_user['pseudo']; ?></a></li>
		 </ol>
   </div>
                <!-- row -->

   <div class="row">
     <div class="col-lg-4">
       <div class="card">
         <div class="card-body">
           <div class="d-flex flex-column align-items-center text-center">
             <img src="https://www.gravatar.com/avatar/<?= md5($info_user['email']); ?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
             <div class="mt-3">
               <h4><?= $info_user['pseudo']; ?></h4>
               <p class="text-secondary mb-1"><?= $permission['nom']; ?></p>
               <?php if($permissions['PERM__SUPERADMIN'] == "1"){ ?>
                 <p class="text-secondary mb-1">IP: <?= $info_user['ip']; ?></p>
               <?php } ?>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="col-lg-8">
       <?php if(isset($_POST['submit'])){
         $builder = $db->table('user');
         if($info_user['pseudo'] != $request->GetPost('pseudo')){
           echo "<div class='alert alert-success'>Vous avez modifié le pseudo du compte avec succès !</div>";
           $builder->set('pseudo', $request->GetPost('pseudo'));
           $builder->where('id', $info_user['id']);
           $builder->update();
         }
         //if($info_user['url'] != $request->GetPost('url')){

        //   $builder->where('url', convert_accented_characters(url_title($request->GetPost('url'))));
        //   $verif_url = $builder->countAllResults();

        //   if($verif_url == 0){
        //     echo "<div class='alert alert-success'>Vous avez modifié l'URL du compte avec succès !</div>";
        //     $builder->set('url', convert_accented_characters(url_title($request->GetPost('url'))));
        //     $builder->where('id', $info_user['id']);
        //     $builder->update();
        //     header('Location:'.base_url('admincp/user/'.convert_accented_characters(url_title($request->GetPost('url')))));
        //     exit;
        //   }else{
        //     echo "<div class='alert alert-danger'>L'URL est déjà utilisé ! Choisissez un autre.</div>";
        //   }
         //}
         if($info_user['email'] != $request->GetPost('email')){
           echo "<div class='alert alert-success'>Vous avez modifié l'email du compte avec succès !</div>";
           $builder->set('email', $request->GetPost('email'));
           $builder->where('id', $info_user['id']);
           $builder->update();
         }
         if($request->GetPost('password') != "" && $info_user['email'] != sha1($request->GetPost('password'))){
           echo "<div class='alert alert-success'>Vous avez modifié le mot de passe du compte avec succès !</div>";
           $builder->set('password', sha1($request->GetPost('password')));
           $builder->where('id', $info_user['id']);
           $builder->update();
         }
         if($info_user['grade'] != $request->GetPost('ranks')){
           echo "<div class='alert alert-success'>Vous avez modifié le grade du compte avec succès !</div>";
           $builder->set('grade', $request->GetPost('ranks'));
           $builder->where('id', $info_user['id']);
           $builder->update();
         }
         if($info_user['tag'] != $request->GetPost('tag')){
           echo "<div class='alert alert-success'>Vous avez modifié le tag du compte avec succès !</div>";
           $builder->set('tag', $request->GetPost('tag'));
           $builder->where('id', $info_user['id']);
           $builder->update();
         }
         if($info_user['solde'] != $request->GetPost('solde')){
           echo "<div class='alert alert-success'>Vous avez modifié le solde du compte avec succès !</div>";
           $builder->set('solde', $request->GetPost('solde'));
           $builder->where('id', $info_user['id']);
           $builder->update();
         }
         if($info_user['etat'] != $request->GetPost('etat')){
           echo "<div class='alert alert-success'>Vous avez modifié l'état du compte avec succès !</div>";
           $builder->set('etat', $request->GetPost('etat'));
           $builder->where('id', $info_user['id']);
           $builder->update();
         }
       }
       ?>
       <?php if(isset($_POST['delete_data'])){
         $builder = $db->table('applications');$builder->where('user', $info_user['id']);$count = $builder->countAllResults();$builder->delete();
         $count_total = $count;
         echo "<div class='alert alert-success'>Vous avez supprimé ".$count_total." données !</div>";
       } ?>
       <?php
       $sessionmodel = new \App\Models\SessionModel();
       $info_user = $sessionmodel->user($info_user['id']); ?>
       <div class="card">
         <div class="card-body">
           <form method="POST">
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Pseudo</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input type="text" name="pseudo" class="form-control" value="<?= $info_user['pseudo']; ?>" />
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Tag</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input type="text" name="tag" max="5" min="5" class="form-control" value="<?= $info_user['tag']; ?>" />
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Email</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input type="email" name="email" class="form-control" value="<?= $info_user['email']; ?>" />
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Nouveau mot de passe</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe" />
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Solde du compte</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input name="solde" min="-1000" max="100000" step="0.01" class="form-control" type="number" value="<?= $info_user['solde']; ?>" />
             </div>
           </div>


           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Grade</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <select name="ranks" class="form-control">
                 <?php $builder = $db->table('permissions');
                 $query = $builder->get();
                 foreach ($query->getResult() as $row){ ?>
                 <option style="color:#000000;" value="<?= $row->id_grade; ?>" <?php if($row->id_grade == $info_user['grade']){ ?>selected<?php } ?>><?= $row->nom; ?></option>
                 <?php } ?>
               </select>
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Etat</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <select name="etat" class="form-control">
                 <option style="color:#000000;" value="0" <?php if($info_user['etat'] == "0"){ ?>selected<?php } ?>>Compte validé</option>
                 <option style="color:#000000;" value="1" <?php if($info_user['etat'] == "1"){ ?>selected<?php } ?>>Compte non validé</option>
                 <option style="color:#000000;" value="2" <?php if($info_user['etat'] == "2"){ ?>selected<?php } ?>>Compte banni</option>
                 <option style="color:#000000;" value="3" <?php if($info_user['etat'] == "3"){ ?>selected<?php } ?>>Compte désactivé</option>
               </select>
             </div>
           </div>

           <div class="row">
             <div class="col-sm-3"></div>
             <div class="col-sm-9 text-secondary">
               <input type="submit" style="display:inline;" name="submit" class="btn btn-primary px-4" value="Mettre à jour" />
               <!--<input type="submit" style="display:inline;" name="delete_data" class="btn btn-danger px-4" value="Supprimer toute les données du compte" />-->
             </div>
           </div>
         </form>
         </div>
       </div>
     </div>
    </div>
  </div>
</div>
