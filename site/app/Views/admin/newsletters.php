<?php if($permissions['PERM__CREATE_NEWSLETTERS'] != 1){ 
return redirect()->to(base_url('/settings'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<?php
$db = \Config\Database::connect();
$builder_count_users = $db->table('mails__users');
$count_total_visites = $builder_count_users->countAllResults();
?>
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dev-Time 8.0</h4> <p>Bienvenue sur le nouveau panel !</p></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Dev-Time Administration</a></li>
                        <li class="breadcrumb-item active">Emails</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-md-12 col-lg-12 mt-3">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Liste des adresses emails</h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body p-0">
													<table id="example" class="display table dataTable table-striped table-bordered" >
														<thead>
																<tr>
																		<th>#</th>
																		<th>Email</th>
																		<th>Utilisateur</th>
																		<th>Date</th>
																		<th>Actions</th>
																</tr>
														</thead>
														<tbody>
                              <?php
                              $builder_mails = $db->table('mails__users');
                              $builder_user = $db->table('user');

                              $query_mails = $builder_mails->get();
                              foreach ($query_mails->getResult() as $row_mails){
                              $builder_user->where('id', $row_mails->user);
                              $query_user = $builder_user->get();
                              foreach ($query_user->getResult() as $row_user){ ?>
														  	<tr>
                                    <td><?= $row_mails->id; ?></td>
                                    <td><?= $row_mails->email; ?></td>
                                    <td><?= $row_user->pseudo; ?></td>
                                    <td><?= $row_mails->date; ?></td>
                                    <td><a href="<?= base_url('/admincp/email/'.$row_mails->id.''); ?>">Modifier</a></td>
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
        <!-- END: Card DATA-->
    </div>
</main>
