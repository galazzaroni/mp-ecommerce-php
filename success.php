<?php 
include 'config.php';
require_once 'vendor/autoload.php';
echo "pago exitoso";
MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);

$data = MercadoPago\Payment::find_by_id($_GET['collection_id']);
//var_dump($data);

?>
<h1>El pago fue exitoso.</h1>

<table>
    <tr>
      <td>payment_method_id</td>
      <td><?php echo $data->payment_method_id ?></td>
    </tr>
    <tr>
      <td>payment_type_id</td>
      <td><?php echo $data->payment_type_id ?></td>
    </tr>
    <tr>
      <td>payment_method_reference_id</td>
      <td><?php echo $data->transaction_details->payment_method_reference_id ?></td>
    </tr>
    <tr>
      <td>external_reference</td>
      <td><?php echo $_GET['external_reference']; ?></td>
    </tr>
    <tr>
      <td>payment_id o collection_id</td>
      <td><?php echo $_GET['collection_id']; ?></td>
    </tr>
</table>
