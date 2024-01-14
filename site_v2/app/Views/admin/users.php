<?php if($permissions['PERM__EDIT_USERS'] != 1){
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
		 	<li class="breadcrumb-item"><a href="javascript:void(0)">Utilisateurs</a></li>
		 	<li class="breadcrumb-item active"><a href="javascript:void(0)">Liste</a></li>
		 </ol>
   </div>
                <!-- row -->

   <div class="row">
      <div class="col-lg-12">
				<div class="card">
          <div class="card-header">
            <h4 class="card-title">Utilisateurs</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive table-hover fs-14 card-table">
							<table class="table display mb-4 dataTablesCard " id="example5">
								<thead>
									<tr>
                    <th>#</th>
                    <th>Pseudo</th>
                    <th></th>
                    <th>Grade</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Actions</th>
									</tr>
								</thead>
								<tbody>
                  <?php $builder_user = $db->table('user');
                  $builder_user->orderBy('id', 'DESC');
                  $query_user = $builder_user->get();
                  foreach ($query_user->getResult() as $row_user){
                  ?>
									<tr>
                    <td><?= $row_user->id; ?></td>
                    <td style="<?php if($row_user->etat == "0"){ ?>color:#00FF00;<?php }else{ ?>color:#FF0000;<?php } ?>"><?= $row_user->pseudo; ?></td>

                    <td style="<?php if($row_user->etat == "0"){ ?>color:#00FF00;<?php }else{ ?>color:#FF0000;<?php } ?>">
                      <?php if($row_user->etat == "0"){ ?>
                        <i style="color:#00FF00;" class="fas fa-user-check"></i>
                      <?php }else{ ?>
                        <i style="color:#FF0000;" class="fas fa-user-times"></i>
                      <?php } ?>
                      <?php if($row_user->parrain != ""){ ?>
                        <?php $builder_user02 = $db->table('user');
                        $builder_user02->where('id', $row_user->parrain);
                        $query_user02 = $builder_user02->get();
                        foreach ($query_user02->getResult() as $parrainage){ ?>
                        <i data-bs-toggle="popover" title="Membre parrain de ce compte <?= $parrainage->pseudo; ?>" data-bs-title="Membre parrain de ce compte" data-bs-content="<?= $parrainage->pseudo; ?>" style="color:#4A8CCE;" class="fas fa-user-friends"></i>
                      <?php } ?>
                      <?php } ?>
                      <?php $builder_ipcheck = $db->table('user');
                      $builder_ipcheck->where('ip',$row_user->ip);
                      $count_egale_ip = $builder_ipcheck->countAllResults(); ?>
                      <?php if($count_egale_ip != 1){ ?>
                        <?php
                          $list_double_ip = "";
                          $builder_user03 = $db->table('user');
                          $builder_user03->where('ip', $row_user->ip);
                          $query_user03 = $builder_user03->get();
                          foreach ($query_user03->getResult() as $check_ip){
                          $list_double_ip .= "".$check_ip->pseudo." ";
                          }
                        ?>
                        <i data-bs-toggle="popover" title="IP Double détecté" data-bs-title="IP Double détecté" data-bs-content="<?= $list_double_ip; ?>" style="color:#C04ACE;" class="fas fa-mars-double"></i>
                      <?php } ?></td>
										<?php
										$sessionmodel = new \App\Models\SessionModel();
										$permissions_row_user = $sessionmodel->permission($row_user->grade); ?>
                    <td><?= $permissions_row_user['nom']; ?></td>
                    <td><?= $row_user->email; ?></td>
                    <td><?= $row_user->date; ?></td>
                    <td>
                      <div class="dropdown mb-auto">
												<div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black"></path>
														<path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black"></path>
														<path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black"></path>
													</svg>
												</div>
												<div class="dropdown-menu dropdown-menu-end" style="">
													<a class="dropdown-item" href="<?= base_url('/admincp/user/'.$row_user->id.''); ?>">Modifier</a>
													<a class="dropdown-item" href="<?= base_url('/admincp/user/'.$row_user->id.'?delete_data=true'); ?>">Supprimer les données</a>
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
<script>
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
