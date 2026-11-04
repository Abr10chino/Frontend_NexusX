<?php

    require_once __DIR__ . "/../services/apiGateway.php";

    $apiResponseImports = callApi("/import-service/v1/umes/imports");
    $apiResponseProducts = callApi("/product-service/v1/umes/products");
    $importData = [];
    $productData = [];

    if (is_array($apiResponseImports) && isset($apiResponseImports['success']) && $apiResponseImports['success'] === true) {
        $rawImports = $apiResponseImports['data'] ?? [];
        $importData = array_slice($rawImports, 0, 5);
    }

    $productList = [];

    if (is_array($apiResponseProducts) && isset($apiResponseProducts['success']) && $apiResponseProducts['success'] === true) {
        $productList = $apiResponseProducts['data'] ?? [];
    }

    $productAmount = count($productList);

?>