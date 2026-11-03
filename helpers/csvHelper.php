<?php

function convertCsvToJson(string $filePath): ?string {
    $rows = [];
    $handle = fopen($filePath, "r");

    if ($handle !== false) {
        $headers = fgetcsv($handle, 1000, ",");
        
        $expectedHeaders = ["barCode", "productName", "categoryId", "price", "stock"];
        
        if ($headers !== $expectedHeaders) {
            fclose($handle);
            return null;
        }

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            if (count($data) < 5) {
                continue;
            }

            $row = [
                "barCode" => trim($data[0]),
                "productName" => trim($data[1]),
                "categoryId" => (int)$data[2],
                "price" => (float)$data[3],
                "stock" => (int)$data[4]
            ];
            $rows[] = $row;
        }

        fclose($handle);
    }

    if (empty($rows)) {
        return null;
    }

    return json_encode($rows, JSON_UNESCAPED_UNICODE);
}