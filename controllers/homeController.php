<?php

    require_once __DIR__ . "/../services/apiGateway.php";

    $apiResponse = callApi("/import-service/v1/umes/imports");
    $importData = [];

    if (is_array($apiResponse) && isset($apiResponse['success']) && $apiResponse['success'] === true) {
        $rawImports = $apiResponse['data'] ?? [];
        $importData = array_slice($rawImports, 0, 5);
    }

?>