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
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Maintenance</a></li>
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)">Paramètres</a></li>
		 </ol>
   </div>
                <!-- row -->

   <div class="row">
     <div class="col-lg-12">
       <?php if(isset($_POST['submit'])){
         $builder = $db->table('maintenance_mode');

           echo "<div class='alert alert-success'>Vous avez modifié le pseudo du compte avec succès !</div>";
           $builder->set('title', $request->GetPost('title'));
           $builder->set('description', $request->GetPost('description'));
           $builder->set('expiration', $request->GetPost('expiration'));
           $builder->set('register', $request->GetPost('register'));
           $builder->set('maintenance_mode', $request->GetPost('maintenance_mode'));
           $builder->where('id', 1);
           $builder->update();
       }
       ?>
       <?php
       $sessionmodel = new \App\Models\SessionModel();
       $maintenance_mode = $sessionmodel->maintenance_mode(1); ?>
       <div class="card">
         <div class="card-body">
           <form method="POST">
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Titre</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input type="text" name="pseudo" class="form-control" value="<?= $maintenance_mode['title']; ?>" />
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Description</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input type="text" name="tag" class="form-control" value="<?= $maintenance_mode['description']; ?>" />
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Date de fin de maintenance</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <input type="datetime" name="expiration" class="form-control" value="<?= $maintenance_mode['expiration']; ?>" />
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Pré-inscription</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <select name="register" class="form-control">
                 <option style="color:#000000;" value="0" <?php if($maintenance_mode['register'] == "0"){ ?>selected<?php } ?>>Non</option>
                 <option style="color:#000000;" value="1" <?php if($maintenance_mode['register'] == "1"){ ?>selected<?php } ?>>Oui</option>
               </select>
             </div>
           </div>
           <div class="row mb-3">
             <div class="col-sm-3">
               <h6 class="mb-0">Mode maintenance activé</h6>
             </div>
             <div class="col-sm-9 text-secondary">
               <select name="maintenance_mode" class="form-control">
                 <option style="color:#000000;" value="0" <?php if($maintenance_mode['maintenance_mode'] == "0"){ ?>selected<?php } ?>>Non</option>
                 <option style="color:#000000;" value="1" <?php if($maintenance_mode['maintenance_mode'] == "1"){ ?>selected<?php } ?>>Oui</option>
               </select>
             </div>
           </div>

           <div class="row">
             <div class="col-sm-3"></div>
             <div class="col-sm-9 text-secondary">
               <input type="submit" style="display:inline;" name="submit" class="btn btn-primary px-4" value="Mettre à jour" />
             </div>
           </div>
         </form>
         </div>
       </div>
     </div>
    </div>
  </div>
</div>
