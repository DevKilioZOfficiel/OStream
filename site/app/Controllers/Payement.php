<?php namespace App\Controllers;
use Config\Email;
use Config\Services;
use Models\UserModel;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\HTTP\UserAgent;

class Payement extends BaseController{

	protected $session;
	//protected $builder;


	public function __construct(){
		// start session
		$this->session = Services::session();
		helper(['form', 'url']);
		//$db = db_connect();
		//protected $db;
		//$this->db =& $db;
	}

	public function index(){
		$sessionmodel = new \App\Models\SessionModel();
	  $db = \Config\Database::connect();

		$request = \Config\Services::request();

		if (session('isLoggedIn')) {
	  	$user = $sessionmodel->user(session('userData.id'));
			$permissions = $sessionmodel->permission($user['grade']);

			function validate($paymentID, $paypalClientID, $paypalSecret){
				$redirect__page = "dashboard";
				helper(['form', 'url']);
			  $db = \Config\Database::connect();
					$sessionmodel = new \App\Models\SessionModel();
			  	$user = $sessionmodel->user(session('userData.id'));
					$permissions = $sessionmodel->permission($user['grade']);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.paypal.com/v1/oauth2/token'); // api.sandbox. si sandbox ou simplement api. si prod
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID.":".$paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
		//echo "response:<br>";
		//echo $response;
        curl_close($ch);

        if(empty($response)){
            //echo "Erreur...";
						return redirect()->to("dashboard")->with("error", "Connexion à l'achat impossible !");
        }else{

            $jsonData = json_decode($response);

            $curl = curl_init('https://api-m.paypal.com/v2/payments/captures/'.$paymentID); // api.sandbox. si sandbox ou  	api-m. si produc
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
			//echo "<br>response 2:<br>";
			//echo $response;
            curl_close($curl);

            // Transaction data
            $result = json_decode($response);

							if($result->status == "COMPLETED"){
								//$id_payement = $related_resources->sale->id;
								$price_payment  = $result->seller_receivable_breakdown->gross_amount->value;
								$price_tva = $result->seller_receivable_breakdown->paypal_fee->value;
								$net = $result->seller_receivable_breakdown->net_amount->value;
								$currency_code = $result->amount->currency_code;

								$builder = $db->table('invoices');
								$builder->where('code', $paymentID);
								$signup = $builder->countAllResults();
								if($signup == 0){
								$data = [
									'code' => $paymentID,
									'product_id' => 0,
									'type' => 1,
									'user' => $user['id'],
									'price'  => $price_payment,
									'etat'  => $result->status,
									'informations_paiement'  => "",
									'fee_paiement'  => $price_tva
								];

								$builder->insert($data);

								$builder_solde = $db->table('user');
						    $builder_solde->set('solde', $user['solde']+$price_payment);
						    $builder_solde->where('id', $user['id']);
						    $builder_solde->update();

								$curl = curl_init();

								curl_setopt_array($curl, array(
								  CURLOPT_URL => 'https://discord.com/api/webhooks/1045066165011091477/4fY1_C7FGGZi9a2Ry7h98hdvrJHCPhl3m0KVRddG1a1VHArYZ0A1ihJ2qeCk2jrpc7Qq',
								  CURLOPT_RETURNTRANSFER => true,
								  CURLOPT_ENCODING => '',
								  CURLOPT_MAXREDIRS => 10,
								  CURLOPT_TIMEOUT => 0,
								  CURLOPT_FOLLOWLOCATION => true,
								  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								  CURLOPT_CUSTOMREQUEST => 'POST',
								  CURLOPT_POSTFIELDS =>'{
								  "embeds": [
								    {
								      "color": "3092790",
								      "author": {
								        "name": "PAIEMENT - PAYPAL"
								      },
								      "description": "Un nouvel achat vient d\'être effectué sur le site ! Voici les éléments du paiement.",
								      "thumbnail": {},
								      "fields": [
								        {
								          "inline": true,
								          "name": "UTILISATEUR:",
								          "value": "'.$user['pseudo'].''.$user['tag'].'"
								        },
								        {
								          "inline": true,
								          "name": "SOMME",
								          "value": "'.$price_payment.' '.$currency_code.'"
								        },
								        {
								          "inline": true,
								          "name": "FRAIS PAYPAL:",
								          "value": "'.$price_tva.' '.$currency_code.'"
								        },
								        {
								          "inline": true,
								          "name": "ETAT:",
								          "value": "'.$result->status.'"
								        },
								        {
								          "inline": true,
								          "name": "ID PAIEMENT",
								          "value": "'.$paymentID.'"
								        }
								      ],
								      "image": {
								        "url": "https://i.imgur.com/kdJejsd.png"
								      },
								      "timestamp": "",
								      "footer": {}
								    }
								  ]
								}',
								  CURLOPT_HTTPHEADER => array(
								    'Content-Type: application/json',
								    'Cookie: __cfruid=18a9a93dab3661c37bc5fab78f6f729769400c80-1669233904; __dcfduid=387969ecf5ff11ec97d08a9f88667416; __sdcfduid=387969ecf5ff11ec97d08a9f88667416b8dc66a74a9628e5b3eb3bb631594c0969185791db4081135c36b0a17ba20a15'
								  ),
								));

								$response = curl_exec($curl);

								curl_close($curl);

								return redirect()->to($redirect__page)->with("success", "Achat effectué avec succès !");
							}else{
								return redirect()->to($redirect__page)->with("error", "Achat échoué !");
							}
							}else{
								 return redirect()->to($redirect__page)->with("error", "L'achat n'est pas validé !");
							}




        }

    }

		if(strip_tags($_GET['paymentID']) == 0 && strip_tags($_GET['payerID']) == 0 && strip_tags($_GET['token']) == 0 && !empty(strip_tags($_GET['price']))) {

		}else{
			// SI PAIEMENT VIA PAYPAL ALORS...
			$sandbox_client = "ASuiCZJLqlOapr683fq_hi6sh5-AG3bGBX8vYaBNg3_TwIzk_MJ9WgfB73dPyF_Qsj6eBqjN-GauD2gJ";
			$sandbox_secret = "EDkNQAb94DsW2MkNYbaYcQ1lZID2HV1nNftOFwdGA5bl8E6GgKjOCs0kI9fBxHt2xAwRLbK5hx2dhmRp";
			$production_client = "AZ3R-41PcjlWDSvGE1T1D_OBY1Y40ChOf07igGlwJXfetR49rIXa0G6mvjWWMJHylGC9SoAuvEzoF4By";
			$production_secret = "EI56PYhDsyqC-Qe7fkfYcNILFP2iszpWZdol_-FXCo-jZ0_lfdxH0khgkJNihPWoqQprhXOhpnqezicY";
	    return validate(strip_tags($_GET['paymentID']), $production_client, $production_secret);
	  }
  	}else{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

	}

	//--------------------------------------------------------------------

}
