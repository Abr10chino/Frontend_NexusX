<?php

    require_once __DIR__ . "/../services/apiGateway.php";

    $apiResponseHistory = callApi("/import-service/v1/umes/imports");

    $importsList = $apiResponseHistory["data"] ?? [];

?>