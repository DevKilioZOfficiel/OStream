<?php if($permissions['PERM__EDIT_CATEGORIES'] != 1){
return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<?php
$db = \Config\Database::connect();
$builder_count_users = $db->table('user');
$count_total_visites = $builder_count_users->countAllResults();
?>
<div class="content-body">
  <div class="container-fluid">
   <div class="page-titles">
		 <ol class="breadcrumb">
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Catégories</a></li>
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
            <?php if($permissions['PERM__EDIT_CATEGORIES'] == 1){ ?><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Ajouter une catégorie</button><?php } ?>
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
                  <?php $builder_user = $db->table('categories');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row_user){
                  ?>
									<tr>
                    <td><?= $row_user->id; ?></td>
                    <td><?= $row_user->name; ?></td>
                    <td><?= $row_user->slug; ?></td>

                    <td>
                      <?php if($row_user->is_premium){ ?>
                        <i style="color:#00FF00;" class="fa-solid fa-euro-sign" title="Premium"></i>
                      <?php }else{ ?>
                        <i style="color:#FF0000;" class="fa-solid fa-euro-sign" title="Premium"></i>
                      <?php } ?>
                        <?php if($row_user->trends){ ?>
                          <i style="color:#00FF00;" class="fa-solid fa-comet" title="Tendance"></i>
                        <?php }else{ ?>
                          <i style="color:#FF0000;" class="fa-solid fa-comet" title="Tendance"></i>
                        <?php } ?>
                          <?php if($row_user->is_live){ ?>
                            <i style="color:#00FF00;" class="fa-solid fa-signal-stream" title="Stream"></i>
                          <?php }else{ ?>
                            <i style="color:#FF0000;" class="fa-solid fa-signal-stream" title="Stream"></i>
                          <?php } ?>
                            <?php if($row_user->is_film){ ?>
                              <i style="color:#00FF00;" class="fa-solid fa-video" title="Film"></i>
                            <?php }else{ ?>
                              <i style="color:#FF0000;" class="fa-solid fa-video" title="Film"></i>
                            <?php } ?>
                              <?php if($row_user->is_serie){ ?>
                                <i style="color:#00FF00;" class="fa-solid fa-films" title="Série"></i>
                              <?php }else{ ?>
                                <i style="color:#FF0000;" class="fa-solid fa-films" title="Série"></i>
                              <?php } ?>

                          <?php if($row_user->is_manga){ ?>
                            <span class="fa-layers fa-fw">
                              <i class="fa-light fa-tv" style="color:#00FF00;"></i>
                              <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 left-3"></i>
                              <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 right-3"></i>
                            </span>
                          <?php }else{ ?>
                            <span class="fa-layers fa-fw">
                              <i class="fa-light fa-tv" style="color:#FF0000;"></i>
                              <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 left-3"></i>
                              <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 right-3"></i>
                            </span>
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
													<a class="dropdown-item" href="<?= base_url('/admincp/categorie/'.$row_user->slug.''); ?>">Modifier</a>
													<a class="dropdown-item" href="<?= base_url('/admincp/categorie/'.$row_user->slug.'?delete_data=true'); ?>">Supprimer</a>
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
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= base_url('import/new_categorie'); ?>" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouvelle catégorie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		      <div class="form-row">
            <div class="col-md-12">
              <input type="text" name="name" class="form-control" id="inputPassword2" placeholder="Nom de la catégorie">
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
           <input style="display: none;" name="zipfile" type="file" class="custom-file-input" id="userlogo" accept=".png,.jpg">
           <div class="form-row">
             <div class="col-md-12">
               <input type="checkbox" name="is_premium" class="form-check-input" id="is_premium"> <label for="is_premium" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-euro-sign" title="Premium"></i> Premium</label>
 		        </div>
 		       </div>
           <div class="form-row">
             <div class="col-md-12">
               <input type="checkbox" name="trends" class="form-check-input" id="trends"> <label for="trends" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-comet" title="Tendance"></i> Tendance</label>
 		        </div>
 		       </div>
           <div class="form-row">
             <div class="col-md-12">
               <input type="checkbox" name="is_film" class="form-check-input" id="film"> <label for="film" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-video" title="Film"></i> Film</label>
 		        </div>
 		       </div>
           <div class="form-row">
             <div class="col-md-12">
               <input type="checkbox" name="is_serie" class="form-check-input" id="serie"> <label for="serie" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-films" title="Série"></i> Série</label>
 		        </div>
 		       </div>
           <div class="form-row">
             <div class="col-md-12">
               <input type="checkbox" name="is_live" class="form-check-input" id="live"> <label for="live" class="form-check-label"><i style="color:#00FF00;" class="fa-solid fa-signal-stream" title="Stream"></i> Live</label>
 		        </div>
 		       </div>
           <div class="form-row">
             <div class="col-md-12">
               <input type="checkbox" name="is_manga" class="form-check-input" id="manga"> <label for="manga" class="form-check-label"><span class="fa-layers fa-fw">
                 <i class="fa-light fa-tv" style="color:#00FF00;"></i>
                 <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 left-3"></i>
                 <i class="fa-solid fa-circle" data-fa-transform="shrink-11 up-2 right-3"></i>
               </span> Manga</label>
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
