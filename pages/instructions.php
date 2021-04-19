<?php
namespace Stanford\AIMIHome;
/** @var \Stanford\AIMIHome\AIMIHome $module */

?>

<div style='margin:20px 0; max-width:98%'>
    <h4>Stanford AIMI Partner Instructions</h4>

    <p>In order to use this module in conjunction with the Stanford AIMI EM please download this <br><a target="_blank" href="<?=$module->getUrl("StanfordAIMIPhoneHome.REDCap.xml",true,true);?>">REDCap Project XML (right-click and "Save Link As")</a> to create the required instruments and set up the repeating instances</p>

    <p>Once a Partner Institution has completed a DRA/Business Agreement, Create a unique token for them using generator (TBD) and add a record to the Partners Instrument.</p>
    <p>Then provide the Partner Institution with the [partner_token] and the [api_endpoint] as shown below.</p>

    <br>
    <br>




    <p>This endpoint will be used by the partner institution to push results from using pretrained models back to this project for Stanford analysis</p>
    <h4>Stanford Partner Results Uploader Endpoint</h4>
    <pre><?php echo $module->getUrl("endpoints/uploader.php",true, true ) ?></pre>


</div>