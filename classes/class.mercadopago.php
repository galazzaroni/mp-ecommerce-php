<?php

use function Composer\Autoload\includeFile;

require_once '../vendor/autoload.php';
include_once '../config.php';

class MP {
        function __construct() {
            MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
        }

        public function payment($data) {
            $preference = new MercadoPago\Preference();
            $item = new MercadoPago\Item();
            $item->title = $data['item']['title'];
            $item->quantity = (int)$data['item']['quantity'];
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
            $preference->back_urls = array(
                "success" => "https://overmu.com/usercp/mpok",
                "failure" => "https://overmu.com/usercp/mpok",
                "pending" => "https://overmu.com/usercp/mpok",
            );
            $preference->save();
            return $preference;
        }

    }

?>