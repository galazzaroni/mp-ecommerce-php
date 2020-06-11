<?php

use function Composer\Autoload\includeFile;

require_once './vendor/autoload.php';
include_once './config.php';

class MP {
        function __construct() {
            MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
            MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);
        }

        public function payment($data) {
            $preference = new MercadoPago\Preference();
            $item = new MercadoPago\Item();
            $item->title = $data['item']['title'];
            $item->quantity = (int)$data['item']['cant'];
            $item->unit_price = 1;

            $payer = new MercadoPago\Payer();
            $payer->name = $data['payer']['name'];
            $payer->surname = $data['payer']['surname'];
            $payer->email = $data['payer']['email'];
            $payer->phone = array(
                "area_code" => $data['payer']['area_code'],
                "number" => $data['payer']['phone_number']
            );
            $payer->address = array(
                "street_name" => $data['payer']['street_name'],
                "street_number" => $data['payer']['street_number'],
                "zip_code" => $data['payer']['zip_code']
            );


            $preference->items = array($item);
            $preference->payer = $payer;
            $preference->back_urls = array(
                "success" => URL . "/success.php",
                "failure" => URL . "/failure.php",
                "pending" => URL . "/pending.php",
            );
            $preference->auto_return = "approved";
            $preference->payment_methods = array(
                "excluded_payment_methods" => array(array("id" => "amex")),
                "excluded_payment_types" => array(array("id" => "atm")),
                "installments" => 6);
            $preference->external_reference = "galazzaroni@gmail.com";
            $preference->save();
            return $preference;
        }

    }

?>