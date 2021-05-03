<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class PruebaVehiculos extends Component
{
	public $carga_boletos = 0;
	public $boletos = [];
	public $NroBoleto = '';
	public $CRMID = '';
	public $viewModal = false;
	public $respuestaConfimada = false;


	// public function mount(){
	// 	$this->boletos = $this->obtener_boletos();
	// }

    public function render() {

    	// $this->boletos = json_decode($this->boletos);
    	// if ($this->carga_boletos == 0) {
    	// 	$this->obtener_boletos();
    	// 	// return dd($this->boletos);
    	// 	$this->carga_boletos = 1;
    	// }
    	$this->boletos = $this->obtener_boletos();

    	return dd($this->boletos);
    	return view('livewire.prueba-vehiculos');
    }

    public function obtener_boletos()
    {

    	// $username = "USdqOwO7vYWqOiVqKdJm";
		// $password = "mA3wJbiPgcXnTZg7y05R";
    	$username = env('API_TASA_USER');
		$password = env('API_TASA_PASSWORD');
		// $host = "http://200.7.15.135:9101/dcx/api/boletos?created_since=2010-05-11T08:00:00.000Z&detailed=true";
		$host = "http://200.7.15.135:9202/dcx/api/vehiculos";
		http://200.7.15.135:9202/dcx/api/vehiculos

		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $host);
		// curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
		// curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// $response = curl_exec($ch);
		// curl_close($ch);


		$auth = base64_encode("$username:$password");
		$context = stream_context_create([
		    "http" => [
		        "header" => "Authorization: Basic $auth"
		    ]
		]);
		$response = file_get_contents("$host", false, $context );

		// return dd($response);
        return json_decode($response);

        // return view('livewire.prueba-vehiculos');
    }

    public function confirmar($NroBoleto, $CRMID){
    	$this->NroBoleto = $NroBoleto;
    	$this->CRMID = $CRMID;
       	$this->viewModal = true;
    }

    public function enviarConfirmacion()
    {

		$curl = curl_init();

		$datos = ["General"=>
					["Boleto"=> $this->NroBoleto,
					"CRMID"=>$this->CRMID,
					"Fecha"=>"2021-09-14T00:00:00Z",
					"Observacion"=>"",
					"FechaEntregaEstimada"=>"2021-08-30T00:00:00Z",
					"Accion"=>"CONF"]];



		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://200.7.15.135:9102/dcx/api/boletos-return',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => json_encode($datos),
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic VVNkcU93Tzd2WVdxT2lWcUtkSm06bUEzd0piaVBnY1huVFpnN3kwNVI=',
		    'Content-Type: application/json'
		  ),
		));

		$response = json_decode(curl_exec($curl))[0]->success;
		curl_close($curl);

		if ($response) {
			$this->respuestaConfimada = true;
			$this->viewModal = false;
			$this->obtener_boletos();
		}

		// return dd($response);

    }
}
