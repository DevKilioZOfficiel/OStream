<?php if($permissions['is_admin'] != 1){
return redirect()->to(base_url('/dashboard'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<link href="<?= base_url('assets_admin'); ?>/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<?php
$db = \Config\Database::connect();
$request = \Config\Services::request();
$builder_count_matchss = $db->table('user');
$count_total_visites = $builder_count_matchss->countAllResults();
$permissionsmodel = new \App\Models\PermissionsModel();
?>
<div class="content-body">
  <div class="container-fluid">
   <div class="page-titles">
		 <ol class="breadcrumb">
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Permissions</a></li>
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)">Liste</a></li>
		 </ol>
   </div>
                <!-- row -->

   <div class="row">
      <div class="col-lg-12">
				<?php
		$builder = $db->table('permissions');
		$builder->limit(1);
		$builder->orderBy('id', 'DESC');
		$query = $builder->get();
		foreach ($query->getResult() as $row){
			$id = $row->id;
			$last_id = $id;
		}
		?>
				<?php if(isset($_POST['add_grade'])){ ?>
				<?php
				$builder = $db->table('permissions');
				$data = [
					'id_grade' => $last_id,
					'nom' => $request->GetPost('name_grade')
				];

				$builder->insert($data);
				 ?>
					<div class="alert alert-success">Le grade <?= $request->GetPost('name_grade'); ?> vient d'être ajouté avec succès !</div>
				<?php } ?>

				<?php
				$builder2 = $db->table('permissions');
				$builder2->orderBy('id', 'DESC');
				$query2 = $builder2->get();
				foreach ($query2->getResult() as $row2){ ?>
				<?php if(isset($_POST['user_'.$row2->id.''])){
				$builder = $db->table('permissions');
				$fields = $db->getFieldData('permissions');
				foreach ($fields as $field){
			  	$builder->set($field->name, $request->GetPost($field->name));
			  }
				$builder->where('id', $row2->id);
				$builder->update();
				?>
				<div class="alert alert-success">Modification du grade <?= $row2->nom; ?> avec succès !</div>
				<?php } ?>
				<?php } ?>

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Permissions</h4>
						<?php if($permissions['PERM__ADD_RANKS'] == 1){ ?><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Ajouter un grade</button><?php } ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
							<table class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
                    <th>Permissions</th>
                    <th colspan="99">Résultats</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$fields = $db->getFieldData('permissions');
									foreach ($fields as $field){ ?>
										<tr>
											<td><?= $field->name; ?></td>
											<?php $result_db = $permissionsmodel->get_permissions__list($field->name); ?>
											<?php foreach ($result_db as $result_db2){ ?>
											<?php if($field->name == "id"){ ?>
											<?php $name = $result_db2[$field->name]; ?>
											<td data-bs-toggle="modal" data-bs-target="#edit<?= $result_db2[$field->name]; ?>">Modifier</td>
											<?php }else{ ?>
											<td><?= $result_db2[$field->name]; ?></td>
											<?php } ?>
											<?php } ?>
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

<!-- Modal -->
<?php
$builder = $db->table('permissions');
$query2 = $builder->get();
foreach ($query2->getResult() as $row2){ ?>
<?php if($permissions['PERM__ADD_RANKS'] == 1){ ?>
	<div class="modal fade" id="edit<?= $row2->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modification du grade <?= $row2->nom; ?></h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
			<form method="post">
	      <div class="modal-body">
					<div class="row">
					<?php if($permissions['PERM__EDIT_PERMS'] == 1){ ?>
				<?php
				$fields = $db->getFieldData('permissions');
				foreach ($fields as $field){ ?>
				<?php $result_db = $permissionsmodel->get_permissions__list2($field->name, $row2->id); ?>
				<?php foreach ($result_db as $result_db2){ ?>


		          <div class="col-md-6" style="padding-top:5px;">
				    <label><?= $field->name; ?></label>
		            <input <?php if($field->name == "id" OR $field->name == "id_grade"){ ?>readonly<?php } ?>
								<?php if($field->name == "id" OR $field->name == "id_grade" OR $field->name == "nom" OR $field->name == "color" OR $field->name == "badge__url"){ ?>
									type="text"
								<?php }else{ ?>type="number" min="0" max="10000000000000000000000000000000"<?php } ?> name="<?= $field->name; ?>" class="form-control" id="inputPassword2" placeholder="<?= $field->name; ?>" value="<?= $result_db2[$field->name]; ?>">
				  </div>
				<?php } ?>
				<?php } ?>
				<?php } ?>
					</div>
	      </div>
	      <div class="modal-footer">
					<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
			    <button type="submit" name="user_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
	      </div>
			</form>
	    </div>
	  </div>
	</div>
<?php } ?>
<?php } ?>

<!-- Modal -->
<?php if($permissions['PERM__ADD_RANKS'] == 1){ ?>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau grade</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="name_grade" class="form-control" id="inputPassword2" placeholder="Nom du grade">
		  </div>
		</div>

      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
        <button type="submit" name="add_grade" class="btn btn-primary">Ajouter le grade !</button>
      </div>
	</form>
    </div>
  </div>
</div>
<?php } ?>
