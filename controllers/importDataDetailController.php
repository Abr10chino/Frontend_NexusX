<?php

    require_once __DIR__ . "/../services/apiGateway.php";

    $fileNameText = "";
    $importIdText = "";
    $totalRowsText = "";
    $acceptedRowsText = "";
    $rejectedRowsText = "";
    $dateImport = "";
    $errorsText = [];

    if (isset($_GET['id'])) {
        $importIdUrl = $_GET['id'];
        $apiResponseImport = callApi("/import-service/v1/umes/imports/" . $importIdUrl, "GET");

        if ($apiResponseImport && isset($apiResponseImport["data"])) {
            $fileNameText = $apiResponseImport["data"]["fileName"] ?? "";
            $importIdText = $apiResponseImport["data"]["importId"] ?? "";
            $totalRowsText = $apiResponseImport["data"]["totalRows"] ?? "";
            $acceptedRowsText = $apiResponseImport["data"]["acceptedRows"] ?? "";
            $rejectedRowsText = $apiResponseImport["data"]["rejectedRows"] ?? "";
            $errorsText = $apiResponseImport["data"]["errors"] ?? [];

            if (!empty($apiResponseImport["data"]["processedAt"])) {
                $dateTimeObject = new DateTime($apiResponseImport["data"]["processedAt"]);
                $dateImport = $dateTimeObject->format('Y-m-d H:i:s');
            }
        }
    }

?>