<?php
namespace Stanford\AIMIHome;
/** @var \Stanford\AIMIHome\AIMIHome $module */

?>

<div style='margin:20px 0; max-width:98%'>
    <h4>Stanford AIMI Partner Instructions</h4>

    <p>To add a new partner please provide them with these setup instructions and start up XML <br><a target="_blank" href="<?=$module->getUrl("REDCap_AIMI_SETUP.zip",true,true);?>">REDCap_AIMI_SETUP.zip (right-click and "Save Link As")</a></p>

    <p>Once the partner has completed set up of their REDCap AIMI Project and DRA/Business Agreement, create a unique token for them using generator (TBD) and add a record to the Partners Instrument in this project.</p>
    <p>Then provide the Partner Institution with the [partner_token] and the [api_endpoint] as shown below.</p>

    <br>
    <br>

    <p>This endpoint will be used by the partner institution to push prediction results + partner "ground truths" from using pretrained models back to this project for Stanford analysis</p>
    <h4>Stanford Partner Results Uploader Endpoint</h4>
    <pre><?php echo $module->getUrl("endpoints/uploader.php",true, true ) ?></pre>


</div>