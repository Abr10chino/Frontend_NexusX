<?php

    require_once __DIR__ . "/../services/apiGateway.php";

    $productsList = [];
    $searchCode = $_GET['code'] ?? '';
    $detailId = $_GET['detailId'] ?? '';
    $productDetailInfo = null;

    if (!empty($searchCode)) {
        $apiResponseProduct = callApi("/product-service/v1/umes/product?code=" . urlencode($searchCode), "GET");

        if ($apiResponseProduct && isset($apiResponseProduct["data"])) {
            $productsList[] = $apiResponseProduct["data"];
        }
    } else {
        $apiResponseProducts = callApi("/product-service/v1/umes/products", "GET");

        if ($apiResponseProducts && isset($apiResponseProducts["data"])) {
            $productsList = $apiResponseProducts["data"];
        }
    }

    if (!empty($detailId)) {
        $apiResponseDetail = callApi("/product-service/v1/umes/product/" . urlencode($detailId), "GET");

        if ($apiResponseDetail && isset($apiResponseDetail["data"])) {
            $productDetailInfo = $apiResponseDetail["data"];
        }
    }

?>