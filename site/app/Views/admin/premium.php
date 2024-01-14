<?php if($permissions['PERM__EDIT_DEVTIME_PREMIUM'] != 1){
return redirect()->to(base_url('/settings'))->withInput()->with('error', lang('Language.error__page_not_found'));
} ?>
<link rel="stylesheet" href="<?= base_url('/uploads/assets_admin/'); ?>dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url('/uploads/assets_admin/'); ?>dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
<?php $request = \Config\Services::request();
$db = \Config\Database::connect();
$builder_count_users = $db->table('user');
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
                        <li class="breadcrumb-item active">Membres</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-md-12 col-lg-12 mt-3">
              <?php $builder_user = $db->table('premium');
              $builder_user->orderBy('id', 'DESC');
              $query_user = $builder_user->get();
              foreach ($query_user->getResult() as $row_user){
                if(isset($_POST['edit_'.$row_user->id])){
                  $builder_user->set('name', $request->GetPost('name'));
                  $builder_user->set('duration', $request->GetPost('duration'));
                  $builder_user->set('duration_totale', $request->GetPost('duration_totale'));
                  $builder_user->set('reduction', $request->GetPost('reduction'));
                  $builder_user->set('reduction__type', $request->GetPost('reduction__type'));
                  $builder_user->set('col', $request->GetPost('col'));
                  $builder_user->set('price', $request->GetPost('price'));
                  $builder_user->set('contents', $request->GetPost('contents'));
                  $builder_user->where('id', $row_user->id);
                  $builder_user->update();
                  echo '<div class="col-md-12 alert alert-success">Vous avez mis à jour avec succès le '.$request->GetPost('name').'</div>';
                }
              }
              ?>


                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Abonnements</h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body p-0">
													<table id="example" class="display table dataTable table-striped table-bordered" >
														<thead>
																<tr>
																		<th>#</th>
																		<th>Nom</th>
																		<th>Durée (jours)</th>
																		<th>Promotion</th>
																		<th>Prix initial</th>
																		<th>Date</th>
																		<th>Actions</th>
																</tr>
														</thead>
														<tbody>
                              <?php $builder_user = $db->table('premium');
                              $builder_user->orderBy('id', 'DESC');
                              $query_user = $builder_user->get();
                              foreach ($query_user->getResult() as $row_user){
                              ?>
														  	<tr>
                                    <td><?= $row_user->id; ?></td>
                                    <td><?= $row_user->name; ?></td>
                                    <td><?= $row_user->duration; ?></td>
                                    <td><?= $row_user->reduction; ?></td>
                                    <td><?= $row_user->price; ?></td>
                                    <td><?= $row_user->date; ?></td>
                                    <td><a data-toggle="modal" data-target="#premium<?= $row_user->id; ?>">Modifier</a></td>
                                </tr>
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
        <?php $builder_user = $db->table('premium');
        $builder_user->orderBy('id', 'DESC');
        $query_user = $builder_user->get();
        foreach ($query_user->getResult() as $row_user){
        ?>
        <!-- Modal -->
<div style="background-color: rgb(0 0 0 / 72%);" class="modal fade" id="premium<?= $row_user->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $row_user->name; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputEmail4">Nom du premium</label>
              <input class="form-control rounded" type="text" name="name" value="<?= $row_user->name; ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Durée du premium (jours)</label>
              <input class="form-control rounded" type="number" name="duration" value="<?= $row_user->duration; ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Durée (texte)</label>

              <select name="duration_totale" class="form-control rounded">
                <option value="per_day" <?php if($row_user->duration_totale == "per_day"){ ?>selected<?php } ?>><?php if($row_user->duration_totale == "per_day"){ ?>*<?php } ?> <?= Lang('Language.per_day'); ?></option>
                <option value="per_week" <?php if($row_user->duration_totale == "per_week"){ ?>selected<?php } ?>><?php if($row_user->duration_totale == "per_week"){ ?>*<?php } ?> <?= Lang('Language.per_week'); ?></option>
                <option value="per_month" <?php if($row_user->duration_totale == "per_month"){ ?>selected<?php } ?>><?php if($row_user->duration_totale == "per_month"){ ?>*<?php } ?> <?= Lang('Language.per_month'); ?></option>
                <option value="per_3months" <?php if($row_user->duration_totale == "per_3months"){ ?>selected<?php } ?>><?php if($row_user->duration_totale == "per_3months"){ ?>*<?php } ?> <?= Lang('Language.per_3months'); ?></option>
                <option value="per_6months" <?php if($row_user->duration_totale == "per_6months"){ ?>selected<?php } ?>><?php if($row_user->duration_totale == "per_6months"){ ?>*<?php } ?> <?= Lang('Language.per_6months'); ?></option>
                <option value="per_12months" <?php if($row_user->duration_totale == "per_12months"){ ?>selected<?php } ?>><?php if($row_user->duration_totale == "per_12months"){ ?>*<?php } ?> <?= Lang('Language.per_12months'); ?></option>
                <option value="per_15months" <?php if($row_user->duration_totale == "per_15months"){ ?>selected<?php } ?>><?php if($row_user->duration_totale == "per_15months"){ ?>*<?php } ?> <?= Lang('Language.per_15months'); ?></option>
              </select>
            </div>
            <div class="form-group col-md-9">
              <label for="inputEmail4">Prix du Premium</label>
              <input class="form-control rounded" type="number" step="0.01" name="price" value="<?= $row_user->price; ?>">
            </div>
            <div class="form-group col-md-3">
              <label for="inputEmail4">Col</label>

              <select name="col" class="form-control rounded">
                <option value="0" <?php if($row_user->col == 0){ ?>selected<?php } ?>><?php if($row_user->col == "0"){ ?>*<?php } ?> 0 (caché)</option>
                <option value="3" <?php if($row_user->col == 3){ ?>selected<?php } ?>><?php if($row_user->col == "3"){ ?>*<?php } ?> 3</option>
                <option value="4" <?php if($row_user->col == 4){ ?>selected<?php } ?>><?php if($row_user->col == "4"){ ?>*<?php } ?> 4</option>
                <option value="6" <?php if($row_user->col == 6){ ?>selected<?php } ?>><?php if($row_user->col == "6"){ ?>*<?php } ?> 6</option>
                <option value="9" <?php if($row_user->col == 9){ ?>selected<?php } ?>><?php if($row_user->col == "9"){ ?>*<?php } ?> 9</option>
                <option value="12" <?php if($row_user->col == 12){ ?>selected<?php } ?>><?php if($row_user->col == "12"){ ?>*<?php } ?> 12</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Type de promotion</label>

              <select name="reduction__type" class="form-control rounded">
                <option value="pourcentage" <?php if($row_user->reduction__type == "pourcentage"){ ?>selected<?php } ?>><?php if($row_user->reduction__type == "pourcentage"){ ?>*<?php } ?> Pourcentage (%)</option>
                <option value="money" <?php if($row_user->reduction__type == "money"){ ?>selected<?php } ?>><?php if($row_user->reduction__type == "money"){ ?>*<?php } ?> Argent</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Promotion</label>
              <input class="form-control rounded" type="number" min="0" max="100" step="0.01" name="reduction" value="<?= $row_user->reduction; ?>">
            </div>
            <div class="form-group col-md-12">
              <label for="inputEmail4">Contenu</label>

              <textarea name="contents" class="form-control rounded"><?= $row_user->contents; ?></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
        <button type="submit" name="edit_<?= $row_user->id; ?>" class="btn btn-primary">Saugarder</button>
      </div>
      </form>
    </div>
  </div>
</div>
      <?php } ?>
