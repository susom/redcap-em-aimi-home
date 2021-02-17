<?php
namespace Stanford\AIMIHome;
/** @var \Stanford\AIMIHome\AIMIHome $module */

header("Access-Control-Allow-Origin: *");

$phpinput_json = file_get_contents('php://input');
if(!empty($phpinput_json)){
    $post = json_decode($phpinput_json, true);
    if(is_array($post)){
        $_POST = $post;
    }
}

$partner_token      = isset($_POST[$module::FIELD_PARTNER_TOKEN])   ? trim(filter_var($_POST[$module::FIELD_PARTNER_TOKEN], FILTER_SANITIZE_STRING)) : NULL ;
$base64_image       = isset($_POST[$module::FIELD_BASE64_IMAGE])    ? trim(filter_var($_POST[$module::FIELD_BASE64_IMAGE], FILTER_SANITIZE_STRING)) : NULL ;
$model_results      = isset($_POST[$module::FIELD_MODEL_RESULTS])   ? trim(filter_var($_POST[$module::FIELD_MODEL_RESULTS], FILTER_SANITIZE_STRING)) : NULL ;
$model_config       = isset($_POST[$module::FIELD_MODEL_CONFIG])    ? trim(filter_var($_POST[$module::FIELD_MODEL_CONFIG], FILTER_SANITIZE_STRING)) : NULL ;

$valid_id           = $module->verifyToken($partner_token);

if($valid_id){
    // Response is handled by $module
    $module->uploadRecord($valid_id, $base64_image, $model_results, $model_config);
}else{
    $module->emDebug("Invalid Request Parameters - check your syntax");
}