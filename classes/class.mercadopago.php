<?php

use function Composer\Autoload\includeFile;

require_once '../vendor/autoload.php';
include_once '../config.php';

class MP {
        function __construct() {
            MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
        }
    }

?>