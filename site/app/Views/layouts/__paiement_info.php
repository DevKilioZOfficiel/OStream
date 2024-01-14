<?php

$request = \Config\Services::request();
$db = \Config\Database::connect();

if(isset($_POST['paiement'])){
  if($user['solde'] >= $request->GetPost('prix_total')){
    $request->GetPost('prix_total');
    $request->GetPost('products');
    $user_solde = $user['solde']-$request->GetPost('prix_total');

    $builder_solde = $db->table('user');
    $builder_solde->set('solde', $user_solde);
    $builder_solde->where('id', $user['id']);
    $builder_solde->update();

    $api = json_decode($request->GetPost('products'));
    foreach ($api->items as $key => $value) {
      $inputs_array = array();
      $value->product_id;
      $value->price;
      $value->price_promotion;
      foreach ($value->inputs as $key_input => $value_input) {
        if($value_input != null){
          $inputs_array[] = array("name" => $value_input);
        }
      }
      $builder__invoces = $db->table('invoices');
      $code = "DTM-".rand(1,9999)."-".rand(1,9999);
      if(!empty($request->GetPost('code_promo'))){
        $builder__code = $db->table('codes');
        $builder__code->where('reduction', $request->GetPost('code_promo'));
        $query__code = $builder__code->get();
        if($builder__code->countAllResults() != 0){
          foreach ($query__code->getResult() as $row__code) {
            $code_promo = $request->GetPost('code_promo');
            if($row__code->type == "pourcentage"){
              $code_price = "-".$row__code->price."%";
            }else{
              $code_price = "-".$row__code->price."€";
            }
          }
        }
      }else{
        $code_promo = "";
        $code_price = "";
      }
      $data__invoices = [
          'code' => $code,
          'product_id' => $value->product_id,
          'user'  => $user['id'],
          'price'  => $value->price_promotion,
          'etat'  => "COMPLETED",
          'informations_paiement' => json_encode($inputs_array),
          'promotion_code' => $code_promo,
          'promotion_price' => $code_price
      ];
      $builder__invoces->insert($data__invoices);

      $builder__baskets = $db->table('baskets');
      $builder__baskets->where('user', $user['id']);
      $builder__baskets->delete();
    }
    echo "<div class='alert alert-success'>Votre achat à été effectué avec succès ! Retrouvez tout sur votre Dashboard</div>";
  }else{
  echo "<div class='alert alert-danger'>Votre solde est insuffisant. Rechargez votre solde.</div>";
  }
} ?>
