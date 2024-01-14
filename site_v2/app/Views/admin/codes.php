<?php if($permissions['PERM__CODES'] != 1){
return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<?php
$db = \Config\Database::connect();
$request = \Config\Services::request();
$builder_count_users = $db->table('user');
$count_total_visites = $builder_count_users->countAllResults();
?>
<div class="content-body">
  <div class="container-fluid">
   <div class="page-titles">
		 <ol class="breadcrumb">
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Codes</a></li>
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)">Liste</a></li>
		 </ol>
   </div>
                <!-- row -->

   <div class="row">
      <div class="col-lg-12">
        <?php if(isset($_POST['add_grade'])){ ?>
				<?php
				$builder = $db->table('codes');
				$data = [
					'code' => $request->GetPost('code'),
  				'pourcentage' => $request->GetPost('pourcentage'),
  				'limitation_user' => $request->GetPost('limitation_user'),
  				'premium_id' => $request->GetPost('premium_id')
				];

				$builder->insert($data);
				 ?>
					<div class="alert alert-success">Le grade <?= $request->GetPost('name_grade'); ?> vient d'être ajouté avec succès !</div>
				<?php } ?>
        <?php $builder_user = $db->table('codes');
        $builder_user->orderBy('id', 'DESC');
        $query_user = $builder_user->get();
        foreach ($query_user->getResult() as $row){
          if(isset($_POST['delete'.$row->id])){
            $builder = $db->table('codes');
            $builder->where('id', $row->id);
            $builder->delete();
            echo "<div class='alert alert-success'>Suppression du code avec succès !</div>";
          }
        }
        ?>

				<div class="card">
          <div class="card-header">
            <h4 class="card-title">Code</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Ajouter un code</button>
          </div>
          <div class="card-body">
            <div class="table-responsive table-hover fs-14 card-table">
							<table class="table display mb-4 dataTablesCard " id="example5">
								<thead>
									<tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Réduction</th>
                    <th>Actions</th>
									</tr>
								</thead>
								<tbody>
                  <?php $builder_user = $db->table('codes');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row){
                  ?>
									<tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->code; ?></td>
                    <td><?= $row->pourcentage; ?>%</td>
                    <td>
                      <div class="dropdown mb-auto">
												<div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black"></path>
														<path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black"></path>
														<path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black"></path>
													</svg>
												</div>
												<div class="dropdown-menu" style="">
													<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete<?= $row->id; ?>">Supprimer</a>
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

<?php $builder_user = $db->table('codes');
$builder_user->orderBy('id', 'DESC');
$query_user = $builder_user->get();
foreach ($query_user->getResult() as $row){
?>
<div class="modal fade" id="delete<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Êtes-vous sur de supprimer le code <?= $row->code; ?> ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
			<form method="POST">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" name="delete<?= $row->id; ?>" class="btn btn-primary">OUI !</button>
      </div>
		</form>
    </div>
  </div>
</div>
<?php } ?>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau code</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="code" class="form-control" id="inputPassword2" placeholder="Nom du code">
		  </div>
		</div><br>
  <div class="form-row">
        <div class="col-md-12">
          <input type="number" name="pourcentage" class="form-control" id="inputPassword2" placeholder="pourcentage">
    </div>
  </div><br>
<div class="form-row">
      <div class="col-md-12">
        <input type="number" name="limitation_user" class="form-control" id="inputPassword2" placeholder="Limite d'utilisation du code (0 pour Illimité)">
  </div>
</div>
<br>
<div class="form-row">
      <div class="col-md-12">
        <select name="premium_id" class="form-control">
          <option value="0">Tout les abonnements</option>
          <?php $builder_user = $db->table('premium');
          $builder_user->orderBy('id', 'DESC');
          $query_user = $builder_user->get();
          foreach ($query_user->getResult() as $row){ ?>
          <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
          <?php } ?>
        </select>
  </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="submit" name="add_grade" class="btn btn-primary">Ajouter le code !</button>
      </div>
	</form>
    </div>
  </div>
</div>
