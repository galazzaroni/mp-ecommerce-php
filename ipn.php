<?php 
include 'config.php';
$post_data = $_POST['data'];

if (!empty($post_data)) {
    $filename = 'log.json';
    $handle = fopen($filename, "w");
    fwrite($handle, $post_data);
    fclose($handle);
    echo $file;
}

require_once 'vendor/autoload.php';
                                    
MercadoPago\SDK::setAccessToken(ACCESS_TOKEN); 
MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);

?>
<?php


    switch($_POST["type"]) {
        case "payment":
            $data = MercadoPago\Payment::find_by_id($_POST["id"]);
            break;
        case "plan":
            $data = MercadoPago\Plan::find_by_id($_POST["id"]);
            break;
        case "subscription":
            $data = MercadoPago\Subscription::find_by_id($_POST["id"]);
            break;
        case "invoice":
            $data = MercadoPago\Invoice::find_by_id($_POST["id"]);
            break;
    }



?>