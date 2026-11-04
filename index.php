<?php
    require_once "controllers/homeController.php";

    $basePath = "./";
    $pageTitle = "Home";

    $navLinks = [
        ["title" => "Inicio", "url" => "index.php"],
        ["title" => "Importar CSV", "url" => "src/import.php"]
    ];

    $extraCss = [$basePath . "css/home.css"];

    include $basePath . "components/Header.php";
?>

<main class="homeContainer">
    <h1 class="homeTitle">Resumen Datos</h1>
    
    <section class="metricsGrid">
        <section class="metricCard">
            <h3>Productos Registrados</h3>
            <p class="metricValue">1,245</p>
        </section>
        <section class="metricCard">
            <h3>Importaciones Realizadas</h3>
            <p class="metricValue"><?php echo count($importData); ?></p>
        </section>
    </section>

    <section class="recentSection">
        <h2>Últimas Importaciones</h2>
        <section class="tableContainer">
            <table class="recentTable">
                <thead>
                    <tr>
                        <th>Archivo</th>
                        <th>Fecha</th>
                        <th>Registros</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($importData)): ?>
                        <?php foreach ($importData as $importItem): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($importItem['fileName']); ?></td>
                                <td><?php echo htmlspecialchars($importItem['processedAt']); ?></td>
                                <td><?php echo htmlspecialchars($importItem['totalRows']); ?></td>
                                <td><?php echo htmlspecialchars($importItem['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No hay importaciones registradas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </section>
</main>

<?php
    include $basePath . "components/Footer.php";
?>