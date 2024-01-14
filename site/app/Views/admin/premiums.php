<?php if($permissions['PERM__PREMIUMS'] != 1){
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
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Premiums</a></li>
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)">Liste</a></li>
		 </ol>
   </div>
                <!-- row -->

   <div class="row">
      <div class="col-lg-12">
				<?php $builder_user = $db->table('premium');
				$builder_user->orderBy('id', 'DESC');
				$query_user = $builder_user->get();
				foreach ($query_user->getResult() as $row){
				if(isset($_POST['edit'.$row->id])){
					$builder = $db->table('premium');
					echo "<div class='alert alert-success'>Vous avez modifié l'abonnement ".$row->name." avec succès !</div>";
					$builder->set('name', $request->GetPost('name'));
					$builder->set('price', $request->GetPost('price'));
					$builder->set('description', $request->GetPost('description'));
					$builder->set('size', $request->GetPost('size'));
					$builder->set('disabled', $request->GetPost('disabled'));
					$builder->set('share_user', $request->GetPost('share_user'));
					$builder->set('duration_stream', $request->GetPost('duration_stream'));
					$builder->where('id', $row->id);
					$builder->update();

				} ?>
			<?php } ?>
				<div class="card">
          <div class="card-header">
            <h4 class="card-title">Premiums</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive table-hover fs-14 card-table">
							<table class="table display mb-4 dataTablesCard " id="example5">
								<thead>
									<tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Actions</th>
									</tr>
								</thead>
								<tbody>
                  <?php $builder_user = $db->table('premium');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row){
                  ?>
									<tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->name; ?></td>
                    <td><?= $row->price; ?></td>
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
													<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#premium<?= $row->id; ?>">Modifier</a>
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

<?php $builder_user = $db->table('premium');
$builder_user->orderBy('id', 'DESC');
$query_user = $builder_user->get();
foreach ($query_user->getResult() as $row){
?>
<div class="modal fade" id="premium<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $row->name; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
			<form method="POST">
      <div class="modal-body">

				<div class="row mb-3">
					<div class="col-sm-3">
						<h6 class="mb-0">Nom</h6>
					</div>
					<div class="col-sm-9 text-secondary">
						<input type="text" name="name" class="form-control" value="<?= $row->name; ?>" />
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-sm-3">
						<h6 class="mb-0">Prix</h6>
					</div>
					<div class="col-sm-9 text-secondary">
						<input type="number" step="0.01" min="0" name="price" class="form-control" value="<?= $row->price; ?>" />
					</div>
				</div>



				<div class="row mb-3">
					<div class="col-sm-3">
						<h6 class="mb-0">Description</h6>
					</div>
					<div class="col-sm-9 text-secondary">
						<textarea name="description" class="form-control"><?= $row->description; ?></textarea>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-sm-3">
						<h6 class="mb-0">Taille (visuel seulement)</h6>
					</div>
					<div class="col-sm-9 text-secondary">
						<select name="size" class="form-control">
							<option value="1" <?php if($row->size === "1"){ ?>selected<?php } ?>>1</option>
							<option value="2" <?php if($row->size === "2"){ ?>selected<?php } ?>>2</option>
							<option value="3" <?php if($row->size === "3"){ ?>selected<?php } ?>>3</option>
							<option value="4" <?php if($row->size === "4"){ ?>selected<?php } ?>>4</option>
							<option value="5" <?php if($row->size === "5"){ ?>selected<?php } ?>>5</option>
							<option value="6" <?php if($row->size === "6"){ ?>selected<?php } ?>>6</option>
							<option value="7" <?php if($row->size === "7"){ ?>selected<?php } ?>>7</option>
							<option value="8" <?php if($row->size === "8"){ ?>selected<?php } ?>>8</option>
							<option value="9" <?php if($row->size === "9"){ ?>selected<?php } ?>>9</option>
							<option value="10" <?php if($row->size === "10"){ ?>selected<?php } ?>>10</option>
							<option value="11" <?php if($row->size === "11"){ ?>selected<?php } ?>>11</option>
							<option value="12" <?php if($row->size === "12"){ ?>selected<?php } ?>>12</option>
						</select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-sm-3">
						<h6 class="mb-0">Bouton</h6>
					</div>
					<div class="col-sm-9 text-secondary">
						<select name="disabled" class="form-control">
							<option value="1" <?php if($row->disabled === "1"){ ?>selected<?php } ?>>S'inscrire</option>
							<option value="0" <?php if($row->disabled === "0"){ ?>selected<?php } ?>>Payer</option>
						</select>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-sm-3">
						<h6 class="mb-0">Partage de compte</h6>
					</div>
					<div class="col-sm-9 text-secondary">
						<input type="number" step="1" min="0" name="share_user" class="form-control" value="<?= $row->share_user; ?>" />
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-sm-3">
						<h6 class="mb-0">Durée de stream par mois</h6>
					</div>
					<div class="col-sm-9 text-secondary">
						<input type="number" step="1" min="0" name="duration_stream" class="form-control" value="<?= $row->duration_stream; ?>" />
					</div>
				</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" name="edit<?= $row->id; ?>" class="btn btn-primary">Sauvegarder</button>
      </div>
		</form>
    </div>
  </div>
</div>
<?php } ?>
