<?php
namespace Stanford\AIMIHome;

require_once "emLoggerTrait.php";

class AIMIHome extends \ExternalModules\AbstractExternalModule {

    use emLoggerTrait;

	const FIELD_PARTNER_TOKEN         	= 'partner_token';
	const FIELD_PARTNER_GROUND_TRUTH    = 'partner_ground_truth';
	const FIELD_MODEL_RESULTS         	= 'model_results';
	const FIELD_MODEL_CONFIG         	= 'model_config';
	const FIELD_MODEL_TOP_PREDICTIONS 	= 'model_top_predictions';
    public function __construct() {
		parent::__construct();
		// Other code to run when object is instantiated
	}

	public function uploadRecord($valid_id, $model_results, $model_config, $model_top_predictions, $partner_ground_truth){
		$next_instance_id = $this->getNextInstanceId($valid_id);
		$ts 	= date("Y-m-d H:i:s");
		$data 	= array(
			"partner_id" 				=> $valid_id,
			"redcap_repeat_instance" 	=> $next_instance_id,
			"redcap_repeat_instrument" 	=> "ml_records",

			"import_ts"					=> $ts,		
			"model_config"				=> $model_config,
			"model_results"				=> $model_results,
			"model_top_predictions"		=> $model_top_predictions,	
			"partner_ground_truth" 		=> $partner_ground_truth
		);
        $result = \REDCap::saveData('json', json_encode(array($data)));
		// $this->emDebug("saved upload?", $result);
		return;
	}

	public function verifyToken($partner_token){
		//TODO FIND BY TOKEN AND RETURN partner_id
		$filter	= "[partner_token] = '$partner_token'";
		$fields	= array("partner_id");
		$params	= array(
            'return_format' => 'json',
			'fields'        => $fields,
            'filterLogic'   => $filter 
		);
        $q 			= \REDCap::getData($params);
		$records 	= json_decode($q, true);
		if(empty($records)){
			return false;
		}
		$record 	= current($records);
		return $record["partner_id"];
	}

	public function newPartnerToken(){
		$bytes = random_bytes(12);
		$token = bin2hex($bytes);
		return $token;
	}

	public function getNextInstanceId($partner_id){
		$params	= array(
			'return_format' => 'json',
			'records'		=> $partner_id,
			'fields'        => array("model_results", "partner_id"),
            'filterLogic'   => "[model_results] != ''"
		);
        $q 					= \REDCap::getData($params);
		$records 			= json_decode($q, true);
		$last_instance_id 	= count($records);
		$last_instance_id++;
		return $last_instance_id;
	}
}
