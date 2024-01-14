<?php
$request = \Config\Services::request();
$sessionmodel = new \App\Models\SessionModel();
$session = \Config\Services::session();
$db = \Config\Database::connect();
if(!empty($_SERVER['HTTP_REFERER'])){
  $findme = "ostream.online";
  $postmodel = new \App\Models\PostModel();
  $pos = strpos($_SERVER['HTTP_REFERER'], $findme);
  if($pos == true){
    if($ref === "add"){
      $item = strip_tags($request->GetPost('item'));
      $inputs = strip_tags($request->GetPost('inputs'));

      $builder_verif = $db->table('products');
      $builder_verif->where('id', $item);
      $product_found = $builder_verif->countAllResults();
      if($product_found == 1){
        $builder = $db->table('baskets');
        $data = [
          'user' => $user['id'],
          'item' => $item,
          'inputs' => stripslashes($inputs)
        ];
        $builder->insert($data);
        ?>
        <div class="toast-header">
          <img src="https://www.gravatar.com/avatar/<?= md5($user['email']); ?>?size=16" class="rounded me-2" alt="https://www.gravatar.com/avatar/<?= md5($user['email']); ?>">
          <strong class="me-auto">Produit au panier</strong>
          <small>a l'instant</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          Vous avez ajouté le produit au panier avec succès !
          <div class="mt-2 pt-2 border-top">
            <span class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basketModal">Ouvrir le panier</span>
          </div>
        </div>
        <?php
      }
    }
    if($ref === "delete"){
      $item = strip_tags($request->GetPost('item'));
        $builder = $db->table('baskets');
        $builder->where('id', $item);
        $builder->delete();
        ?>
        <div class="toast-header">
          <img src="https://www.gravatar.com/avatar/<?= md5($user['email']); ?>?size=16" class="rounded me-2" alt="https://www.gravatar.com/avatar/<?= md5($user['email']); ?>">
          <strong class="me-auto">Produit supprimé</strong>
          <small>a l'instant</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          Vous avez enlevé le produit de votre panier avec succès !
        </div>
        <?php

    }
    if($ref === "list"){
      $total_price = 0;
      $price_total0 = 0;
      $price_total = 0;
      $price_tva = 0;
      $price_sous_total = 0;
      $pourcentage_prix = 0;
      $prix_des_options = 0;
      $key_sql = 0;
      $items_inputs = array();
      $items = array();
      $promotion_reduction = 0;

      $builder = $db->table('baskets');
      $builder->where('user', $user['id']);
      $builder->orderBy('id', 'DESC');
      $query = $builder->get();
      foreach ($query->getResult() as $row) {
        $builder__product = $db->table('products');
        $builder__product->where('id', $row->item);
        $query__product = $builder__product->get();
        foreach ($query__product->getResult() as $row__product) {
          if($row__product->promotion__resume === 0){
            $pourcentage_prix = $row__product->price;
          }else{
            if($row__product->promotion === "pourcentage"){

              $pourcentage_prix = round($row__product->price-($row__product->price*$row__product->promotion__resume)/100,2);
            }else{
              $pourcentage_prix = round($row__product->price-$row__product->promotion__resume,2);
            }
          }
          $variable = json_decode($row__product->images);
          foreach ($variable->images as $key => $image) {
            if($key === 0){
              $product_image = $image->url;
            }else{
            }
          }

          $items_inputs[] = array(
            "id"               =>  $row->id,
            "product_id"       =>  $row__product->id,
            "title"            =>  $row__product->title,
            "price"            =>  $row__product->price,
            "price_promotion"  =>  $pourcentage_prix,
            "images"           =>  $product_image,
            "inputs"           =>  array(json_decode($row->inputs, true))
          );
          $items_inputs_api = json_decode('{"items":'.json_encode($items_inputs).'}');
          foreach($items_inputs_api->items as $key => $item__info) { //Items de api
          	foreach($item__info->inputs as $key => $input) { // Inputs des items
              $builder__product2 = $db->table('products');
              $builder__product2->where('id', $item__info->product_id);
              $query__product2 = $builder__product2->get();
              foreach ($query__product2->getResult() as $row__product2) {
                if(!empty($row__product2->inputs_api)){
                $api_inputs = json_decode($row__product2->inputs_api); // VERIF SQL PRODUIT
                foreach($api_inputs as $key3 => $inp_api) {
	                 foreach($inp_api as $key2 => $input_sql) {
                     if(md5($input_sql->name) == md5($input[$key])){
                       //echo "OUI POUR: ".$input_sql->name." (".$input[$key].") à ".$input_sql->price."€";
                       $prix = $input_sql->price;
                     }else{
                       //if(md5($input_sql->name) === md5($input[$key])){
                       //}else{
                       //}
                       //echo "NON POUR: ".$input_sql->name." (".$input[$key].") à 0€";
                     }
                   } // fin input_sql
                } // Fin inp_api7
              }else{
                $prix = 0;
              }
              } // Fin product sql
          	} // fin input->
          } // FIN API items_inputs
          $prix_des_options += $prix;
          $price_total0 += $pourcentage_prix;

          $items[] = array(
            "id"               =>  $row->id,
            "product_id"       =>  $row__product->id,
            "title"            =>  $row__product->title,
            "price"            =>  $row__product->price,
            "price_promotion"  =>  $pourcentage_prix,
            "images"           =>  $product_image,
            "inputs"           =>  array(json_decode($row->inputs, true))
          );
        } // FIN products
      }
      $price_total += $price_total0;

      if(!empty($request->GetPost('code_promo'))){
        $builder__code = $db->table('codes');
        $builder__code->where('reduction', $request->GetPost('code_promo'));
        $query__code = $builder__code->get();
        if($builder__code->countAllResults() != 0){
        foreach ($query__code->getResult() as $row__code) {
          if($row__code->type === "pourcentage"){
            $promotion_reduction += $row__code->price*$price_total/100;
            $price_total -= $promotion_reduction;
            $price_tva += $price_total-($price_total/1.2);
            $price_sous_total += $price_total-$price_tva;
          }else{
            $promotion_reduction += $row__code->price;
            $price_total -= $promotion_reduction;
            $price_tva += $price_total-($price_total/1.2);
            $price_sous_total += $price_total-$price_tva;
          }
        }
       }else{
         $price_tva += $price_total-($price_total/1.2);
         $price_sous_total += $price_total-$price_tva;
       }
      }else{

        $price_tva += $price_total-($price_total/1.2);
        $price_sous_total += $price_total-$price_tva;
      }

      $price_total += $prix_des_options;
      ?>
{"baskets":{"promotion":"<?= round($promotion_reduction); ?>","sous_total":"<?= round($price_sous_total,2); ?>","options_prix":"<?= round($prix_des_options,2); ?>","tva":"<?= round($price_tva,2); ?>","total":"<?= round($price_total,2); ?>","currency":"€"},"items":<?= json_encode($items); ?>}
    <?php }

  }
} ?>
