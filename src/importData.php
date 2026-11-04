<?php
    $basePath = "../";
    $pageTitle = "Historial de Importaciones";

    $navLinks = [
        ["title" => "Inicio", "url" => "../index.php"],
        ["title" => "Importar CSV", "url" => "src/import.php"],
        ["title" => "Ver Importaciones", "url" => "src/importData.php"],
        ["title" => "Ver Productos", "url" => "src/products.php"]
    ];

    $extraCss = [$basePath . "css/importData.css"];

    require_once __DIR__ . "/../controllers/importDataController.php";

    include $basePath . "components/Header.php";
?>

<main class="importContainer">
    <h1 class="importTitle">Historial de Importaciones</h1>

    <div class="resultsGrid" style="width: 100%;">
        <section class="statusSection" style="width: 100%;">
            <h2 class="sectionTitle">Archivos Procesados</h2>
            <div style="overflow-x: auto; padding: 12px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--borderColor);">
                            <th style="padding: 10px;">ID</th>
                            <th style="padding: 10px;">Nombre del Archivo</th>
                            <th style="padding: 10px;">Total Filas</th>
                            <th style="padding: 10px;">Aceptadas</th>
                            <th style="padding: 10px;">Rechazadas</th>
                            <th style="padding: 10px;">Fecha</th>
                            <th style="padding: 10px;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($importsList)): ?>
                            <?php foreach ($importsList as $item): ?>
                                <tr style="border-bottom: 1px solid var(--borderColor);">
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($item['importId'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($item['fileName'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($item['totalRows'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($item['acceptedRows'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($item['rejectedRows'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($item['processedAt'] ?? ''); ?></td>
                                    <td style="padding: 10px;">
                                        <a href="importDataDetail.php?id=<?php echo htmlspecialchars($item['importId']); ?>" class="submitButton" style="padding: 6px 12px; font-size: 14px; text-decoration: none; display: inline-block;">Ver Detalle</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="padding: 20px; text-align: center;">No hay importaciones registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<?php
    include $basePath . "components/Footer.php";
?>