<?php
    $basePath = "../";
    $pageTitle = "Importar CSV";

    $navLinks = [
        ["title" => "Inicio", "url" => "../index.php"],
    ];

    $extraCss = [$basePath . "css/import.css"];

    $fileStatusText = "Archivo no cargado";
    $apiResponseText = "";
    $fileNameText = "";
    $processDateText = "";
    $totalRowsText = "";
    $acceptedRowsText = "";
    $rejectedRowsText = "";
    $errorDetailsText = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['csvFile']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileExtension === 'csv') {
                $fileStatusText = "Archivo cargado";
                $fileNameText = $fileName;
                $apiResponseText = json_encode([
                    "success" => true,
                    "message" => "Petición correcta"
                ], JSON_PRETTY_PRINT);
                
                $processDateText = date("Y-m-d H:i:s");
                $totalRowsText = "150";
                $acceptedRowsText = "142";
                $rejectedRowsText = "8";
                $errorDetailsText = json_encode([
                    ["row" => 14, "reason" => "Formato incorrecto"],
                    ["row" => 89, "reason" => "Código duplicado"]
                ], JSON_PRETTY_PRINT);
            } else {
                $fileStatusText = "Error: No se puede ese tipo de archivo, solo se aceptan archivos .csv";
            }
        } else {
            $fileStatusText = "Archivo no cargado";
        }
    }

    include $basePath . "components/Header.php";
?>

<main class="importContainer">
    <h1 class="importTitle">Importar Archivo CSV</h1>

    <form class="importForm" action="import.php" method="POST" enctype="multipart/form-data">
        <section class="dropZoneContainer">
            <input class="fileInput" type="file" name="csvFile" accept=".csv" required>
            <p class="dropText">Seleccione un archivo en formato .csv para continuar</p>
        </section>

        <button class="submitButton" type="submit">Hacer petición al API</button>
    </form>

    <div class="resultsGrid">
        <section class="statusSection">
            <h2 class="sectionTitle">Estado del Archivo</h2>
            <textarea class="statusBox" readonly><?php echo htmlspecialchars($fileStatusText); ?></textarea>
        </section>

        <section class="responseSection">
            <h2 class="sectionTitle">Respuesta del API</h2>
            <textarea class="responseBox" readonly><?php echo htmlspecialchars($apiResponseText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Nombre del Archivo</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($fileNameText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Fecha o Momento del Proceso</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($processDateText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Cantidad Total de Filas Evaluadas</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($totalRowsText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Cantidad de Registros Aceptados</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($acceptedRowsText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Cantidad de Registros Rechazados</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($rejectedRowsText); ?></textarea>
        </section>

        <section class="errorSection">
            <h2 class="sectionTitle">Detalle de Errores (Fila y Razón)</h2>
            <textarea class="errorBox" readonly><?php echo htmlspecialchars($errorDetailsText); ?></textarea>
        </section>
    </div>
</main>

<?php
    include $basePath . "components/Footer.php";
?>