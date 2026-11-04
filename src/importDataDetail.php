<?php
    $basePath = "../";
    $pageTitle = "Detalle de Importación";

    $navLinks = [
        ["title" => "Inicio", "url" => "../index.php"],
        ["title" => "Historial", "url" => "importData.php"],
        ["title" => "Ver Importaciones", "url" => "src/importData.php"],
    ];

    $extraCss = [$basePath . "css/importDataDetail.css"];

    require_once __DIR__ . "/../controllers/importDataDetailController.php";

    include $basePath . "components/Header.php";
?>

<main class="importContainer">
    <h1 class="importTitle">Importación de <?php echo htmlspecialchars($fileNameText); ?> (ID: <?php echo htmlspecialchars($importIdText); ?>)</h1>

    <section class="resultsGrid">
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
            <section class="resultBox errorBox" style="overflow-y: auto; height: 140px; resize: none;">
                <?php if (is_array($errorsText) && !empty($errorsText)): ?>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 6px;">
                        <?php foreach ($errorsText as $error): ?>
                            <li style="background-color: #fff; padding: 6px 8px; border-radius: 4px; border: 1px solid #ddd;">
                                <section style="margin-bottom: 2px;"><strong>Código:</strong> <?php echo htmlspecialchars($error['barCode'] ?? $error['barcode'] ?? 'N/A'); ?></section>
                                <section><strong>Razón:</strong> <?php echo htmlspecialchars($error['reason'] ?? $error['message'] ?? 'N/A'); ?></section>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <span>Sin errores registrados</span>
                <?php endif; ?>
            </section>
        </section>
    </section>

    <section style="margin-top: 24px; text-align: left;">
        <a href="importData.php" class="submitButton" style="display: inline-block; padding: 8px 16px; font-size: 14px; text-decoration: none;">← Volver al Historial</a>
    </section>
</main>

<?php
    include $basePath . "components/Footer.php";
?>