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
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)">Séries</a></li>
		 </ol>
   </div>
                <!-- row -->

   <div class="row">
      <div class="col-lg-12">
				<div class="card">
          <div class="card-header">
            <h4 class="card-title">Séries</h4>
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
                  <?php $builder_categories = $db->table('categories');
                  $builder_categories->where('is_serie', '1');
                  $builder_categories->orderBy('id', 'DESC');
                  $query_categories = $builder_categories->get();
                  foreach ($query_categories->getResult() as $row_categories){ ?>
                  <?php $builder_user = $db->table('list');
                  $builder_user->where('id_categorie', $row_categories->id);
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
