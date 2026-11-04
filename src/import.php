<?php
    $basePath = "../";
    $pageTitle = "Importar CSV";

    $navLinks = [
        ["title" => "Inicio", "url" => "../index.php"],
        ["title" => "ImportCSV", "url" => "src/import.php"]
    ];

    $extraCss = [$basePath . "css/import.css"];

    require_once __DIR__ . "/../helpers/csvHelper.php";

    $fileStatusText = "Archivo no cargado";
    $apiResponseText = "";
    $fileNameText = "";
    $importIdText = "";
    $totalRowsText = "";
    $acceptedRowsText = "";
    $rejectedRowsText = "";
    $dateImport = "";
    $errorsText = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK && !empty($_POST['fileNameInput'])) {
            $customFileName = $_POST['fileNameInput'];
            $fileExtension = strtolower(pathinfo($_FILES['csvFile']['name'], PATHINFO_EXTENSION));
            $tmpFilePath = $_FILES['csvFile']['tmp_name'];

            if ($fileExtension === 'csv') {
                $convertedJson = convertCsvToJson($tmpFilePath);

                if ($convertedJson !== null) {
                    require_once __DIR__ . "/../controllers/importController.php";
                } else {
                    $fileStatusText = "Error: El archivo CSV no cumple con las cabeceras o estructura requerida.";
                }
            } else {
                $fileStatusText = "Error: No se puede ese tipo de archivo, solo se aceptan archivos .csv";
            }
        } else {
            $fileStatusText = "Por favor complete el nombre del archivo y seleccione un CSV.";
        }
    }

    include $basePath . "components/Header.php";
?>

<main class="importContainer">
    <h1 class="importTitle">Importar Archivo CSV</h1>

    <form class="importForm" action="import.php" method="POST" enctype="multipart/form-data">
        <section class="resultSection" style="width: 100%; margin-bottom: 24px;">
            <h2 class="sectionTitle">Nombre del Archivo (Identificador)</h2>
            <input class="resultBox" type="text" name="fileNameInput" placeholder="Ej: prueba2" required style="width: 90%; margin: 0 auto 12px auto; display: block;">
        </section>

        <section class="dropZoneContainer">
            <input class="fileInput" type="file" name="csvFile" accept=".csv" required>
            <p class="dropText">Seleccione un archivo en formato .csv para continuar</p>
        </section>

        <button class="submitButton" type="submit">Procesar CSV</button>
    </form>

    <div class="resultsGrid">
        <section class="statusSection">
            <h2 class="sectionTitle">Estado del Archivo</h2>
            <textarea class="statusBox" readonly><?php echo htmlspecialchars($fileStatusText); ?></textarea>
        </section>

        <section class="responseSection">
            <h2 class="sectionTitle">Lista Convertida a JSON</h2>
            <textarea class="responseBox" readonly><?php echo htmlspecialchars($apiResponseText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Nombre del Archivo</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($fileNameText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">ID de Importación</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($importIdText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Total de Filas</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($totalRowsText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Filas Aceptadas</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($acceptedRowsText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Filas Rechazadas</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($rejectedRowsText); ?></textarea>
        </section>

        <section class="resultSection">
            <h2 class="sectionTitle">Fecha de Procesamiento</h2>
            <textarea class="resultBox" readonly><?php echo htmlspecialchars($dateImport); ?></textarea>
        </section>

        <section class="resultSection errorSection">
            <h2 class="sectionTitle">Detalle de Errores</h2>
            <ul class="resultBox errorBox" style="overflow-y: auto; list-style: none; padding: 8px; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                <?php if (is_array($errorsText) && !empty($errorsText)): ?>
                    <?php foreach ($errorsText as $error): ?>
                        <li style="background-color: var(--bgSecondary); padding: 6px 10px; border-radius: 4px;">
                            <span><strong>Código:</strong> <?php echo htmlspecialchars($error['barCode'] ?? $error['barcode'] ?? 'N/A'); ?></span><br>
                            <span><strong>Razón:</strong> <?php echo htmlspecialchars($error['reason'] ?? $error['message'] ?? 'N/A'); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li style="display: flex; align-items: center; height: 100%;"><?php echo htmlspecialchars(is_string($errorsText) && !empty($errorsText) ? $errorsText : 'Sin errores'); ?></li>
                <?php endif; ?>
            </ul>
        </section>
    </div>
</main>

<?php
    include $basePath . "components/Footer.php";
?>