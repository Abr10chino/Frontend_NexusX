<?php

    require_once __DIR__ . "/../services/apiGateway.php";

    $apiResponseImport = callApi("/import-service/v1/umes/imports?fileName=" . urlencode($customFileName), "POST", $convertedJson);

    $fileStatusText = $apiResponseImport["message"];
    $fileNameText = $apiResponseImport["data"]["fileName"];
    $apiResponseText = json_encode($apiResponseImport, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $totalRowsText = $apiResponseImport["data"]["totalRows"];
    $acceptedRowsText = $apiResponseImport["data"]["acceptedRows"];
    $rejectedRowsText = $apiResponseImport["data"]["rejectedRows"];
    $errorsText = $apiResponseImport["data"]["errors"];
    $importIdText = $apiResponseImport["data"]["importId"];
    $dateTimeObject = new DateTime($apiResponseImport["data"]["processedAt"]);
    $dateImport = $dateTimeObject->format('Y-m-d H:i:s');

?>