<?php if($permissions['PERM__EDIT_LIVES'] != 1){
return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<?php
$db = \Config\Database::connect();
$builder_count_users = $db->table('user');
$count_total_visites = $builder_count_users->countAllResults();
?>
<script src="https://cdn.tiny.cloud/1/9vw8oczjmxak7rf0gu7edvi60s713fxjxucq0parv31rkkhe/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>

<div class="content-body">
  <div class="container-fluid">
   <div class="page-titles">
		 <ol class="breadcrumb">
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Lives</a></li>
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)">Liste</a></li>
		 </ol>
   </div>
                <!-- row -->

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
				<div class="card">
          <div class="card-header">
            <h4 class="card-title">Catégories</h4>
            <?php if($permissions['PERM__EDIT_LIVES'] == 1){ ?><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Ajouter un live</button><?php } ?>
          </div>
          <div class="card-body">
            <div class="table-responsive table-hover fs-14 card-table">
							<table class="table display mb-4 dataTablesCard " id="example5">
								<thead>
									<tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th></th>
                    <th>Actions</th>
									</tr>
								</thead>
								<tbody>
                  <?php $builder_user = $db->table('list');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row_user){
                  ?>
									<tr>
                    <td><?= $row_user->id; ?></td>
                    <td><?= $row_user->titre; ?></td>
                    <td><?= $row_user->slug; ?></td>

                    <td>
                      <?php if($row_user->is_premium){ ?>
                        <i style="color:#00FF00;" class="fa-solid fa-euro-sign" title="Premium"></i>
                      <?php }else{ ?>
                        <i style="color:#FF0000;" class="fa-solid fa-euro-sign" title="Premium"></i>
                      <?php } ?>
                    </td>
                    <td>
                      <div class="dropdown mb-auto">
												<div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black"></path>
														<path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black"></path>
														<path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black"></path>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-end">
													<a class="dropdown-item" href="<?= base_url('/admincp/live/'.$row_user->slug.''); ?>">Modifier</a>
													<a class="dropdown-item" href="<?= base_url('/admincp/live/'.$row_user->slug.'?delete_data=true'); ?>">Supprimer</a>
												</div>
											</div>
                    </td>
									</tr>
                  <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <form method="post" action="<?= base_url('import/new_live'); ?>" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau live</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		      <div class="form-row">
            <div class="col-md-12">
              <label>Nom</label>
              <input type="text" name="titre" class="form-control" id="inputPassword2" placeholder="Nom du live">
		        </div>
		       </div>
           <div class="form-row">
             <div class="col-md-12">
               <label>Tags</label>
               <input type="text" name="tags" class="form-control" id="inputPassword2" placeholder="Tags 1, Tag 2">
 		        </div>
 		       </div>
           <div class="card form-control" style="height: auto;" onclick="document.getElementById('userlogo').click();" style="margin-bottom: 25px;">
             <div class="row">
               <div class="col-md-12">
                 <div class="card-body">
                   <h5 class="card-title">Importer une image en format .jpg ou .png</h5>
                   <p class="card-text">Taille maximale: 5Mo</p>
                 </div>
               </div>
             </div>
           </div>

           <div class="form-row">
             <div class="col-md-12">
               <label>Description</label>
               <textarea class="form-control" name="description"></textarea>
 		        </div>
 		       </div>

           <input style="display: none;" name="zipfile" type="file" class="custom-file-input" id="userlogo" accept=".png,.jpg">
           <div class="form-row">
             <div class="col-md-12">
               <label>Premium ou non</label>
               <br>
               <input type="checkbox" name="is_premium" class="form-check-input" id="is_premium"> <label for="is_premium" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-euro-sign" title="Premium"></i> Premium</label>
 		        </div>
 		       </div>

           <div class="form-row">
             <div class="col-md-12">
               <label>Catégorie</label>
               <select class="form-control" name="id_categorie">
                 <?php $builder_user = $db->table('categories');
                 $builder_user->orderBy('id', 'DESC');
                 $query_user = $builder_user->get();
                 foreach ($query_user->getResult() as $row_server){ ?>
                   <option value="<?= $row_server->id; ?>"><?= $row_server->name; ?></option>
                 <?php } ?>
               </select>
 		        </div>
 		       </div>

           <div class="form-row">
             <div class="col-md-12">
               <label>Serveur de stream</label>
               <select class="form-control" name="server_id">
                 <?php $builder_user = $db->table('servers');
                 $builder_user->orderBy('id', 'DESC');
                 $query_user = $builder_user->get();
                 foreach ($query_user->getResult() as $row_server){ ?>
                   <option value="<?= $row_server->id; ?>"><?= $row_server->name; ?> (<?= $row_server->url; ?>)</option>
                 <?php } ?>
               </select>
 		        </div>
 		       </div>

           <div class="form-row">
             <div class="col-md-12">
               <label>Type de stream</label>
               <select class="form-control" name="stream_type">
                 <option value="vps">VPS</option>
                 <option value="custom_https_url">Lien customisé</option>
               </select>
 		        </div>
 		       </div>

           <div class="row form-row">
            <div class="col-md-12">
              <label>URL/Clé de stream</label>
            </div>
             <div class="col-md-8">
               <input type="text" name="stream_url" class="form-control" id="gen_key" placeholder="">
 		        </div>
            <div class="col-md-4">
              <button type="button" onclick="create_UUID()" style="width:100%;" class="btn btn-info">Générer une clé</button>
            </div>
 		       </div>

           <div class="form-row">
             <div class="col-md-12">
               <label>Date de lancement</label>
               <input type="datetime-local" name="launch" class="form-control"  placeholder="">
 		        </div>
 		       </div>

           <div class="form-row">
             <div class="col-md-12">
               <label>Date de fin</label>
               <input type="datetime-local" name="end" class="form-control"  placeholder="">
 		        </div>
 		       </div>
      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
        <button type="submit" name="add" class="btn btn-primary">Ajouter !</button>
      </div>
	</form>
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
