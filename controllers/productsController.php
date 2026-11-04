<?php

    require_once __DIR__ . "/../services/apiGateway.php";

    $productsList = [];
    $searchCode = $_GET['code'] ?? '';

    if (!empty($searchCode)) {
        $apiResponseProduct = callApi("/product-service/v1/umes/product?code=" . urlencode($searchCode));

        if ($apiResponseProduct && isset($apiResponseProduct["data"])) {
            $productsList[] = $apiResponseProduct["data"];
        }
    } else {
        $apiResponseProducts = callApi("/product-service/v1/umes/products");

        if ($apiResponseProducts && isset($apiResponseProducts["data"])) {
            $productsList = $apiResponseProducts["data"];
        }
    }

?>