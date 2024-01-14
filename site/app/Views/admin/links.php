<?php if($permissions['admin'] != 1){
return redirect()->to(base_url('/settings'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<link href="<?= base_url('assets_admin'); ?>/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<?php
$db = \Config\Database::connect();
$request = \Config\Services::request();
$builder_count_users = $db->table('user');
$count_total_visites = $builder_count_users->countAllResults();
?>
<div class="page-wrapper">
			<div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Gestions</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">URL </li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">URL <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Ajouter un lien</button></h6>
				<hr/>
				<?php if(isset($_POST['add_link'])){ ?>
				<?php
				$builder = $db->table('md5__links');
				if(!empty($request->GetPost('url2'))){
					$md5 = $request->GetPost('url2');
				}else{
					$md5 = md5($request->GetPost('url2'));
				}
				$builder->where('mb5', $md5);
				$count = $builder->countAllResults();
				if($count == "0"){
				$data = [
					'original' => $request->GetPost('url'),
					'title' => $request->GetPost('title'),
					'mb5' => $md5,
					'user' => $user['id']
				];

				$builder->insert($data);
				 ?>
					<div class="alert alert-success">Le lien <?= $request->GetPost('url'); ?> vient d'être ajouté avec succès !</div>
				<?php }else{ ?>
				 <div class="alert alert-danger">Le lien <?= $request->GetPost('url'); ?> existe déjà !</div>
				<?php } ?>
			<?php } ?>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
                    <th>#</th>
                    <th>Original</th>
                    <th>URL</th>
                    <th>Clics</th>
                    <th>Informations</th>
                    <th>Actions</th>
									</tr>
								</thead>
								<tbody>
                  <?php $builder_user = $db->table('md5__links');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row_links){
										$builder__count_total_visites = $db->table('views');
										$builder__count_total_visites->where('url', base_url('link/'.$row_links->mb5));
										$clics = $builder__count_total_visites->countAllResults();
                  ?>
									<tr>
                    <td><?= $row_links->id; ?></td>
	                  <td><?= $row_links->original; ?></td>
	                  <td><?= $row_links->mb5; ?></td>
	                  <td><?= $clics; ?></td>
	                  <td>Gains estminé: <?= 0.003*$clics; ?></td>
	                  <td><?= $row_links->id; ?></td>
									</tr>
                  <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

      </div>
</div>

<script src="<?= base_url('assets_admin'); ?>/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('assets_admin'); ?>/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
  <script>
		$(function () {
			$('[data-bs-toggle="popover"]').popover();
			$('[data-bs-toggle="tooltip"]').tooltip();
		})
	</script>
	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <form method="post">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Nouveau lien</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

			    <div class="form-row">
	          <div class="col-md-12">
	            <input type="url" name="url" class="form-control" id="inputPassword2" placeholder="URL Original du lien" required>
			      </div>
					</div>
					<br>
					<div class="form-row">
						<div class="col-md-12">
	            <input type="text" name="title" class="form-control" id="inputPassword2" placeholder="Titre" required>
			      </div>
			    </div>
					<br>
					<div class="form-row">
						<div class="col-md-12">
	            <input type="text" name="url2" class="form-control" id="inputPassword2" placeholder="URL raccourci (non obligatoire)">
			      </div>
			    </div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
	        <button type="submit" name="add_link" class="btn btn-primary">Ajouter le lien !</button>
	      </div>
		</form>
	    </div>
	  </div>
	</div>
