<?php
    $basePath = "../";
    $pageTitle = "Consulta de Productos";

    $navLinks = [
        ["title" => "Inicio", "url" => "../index.php"],
        ["title" => "Historial de Importaciones", "url" => "importData.php"],
        ["title" => "Productos", "url" => "products.php"]
    ];

    $extraCss = [$basePath . "css/products.css"];

    require_once __DIR__ . "/../controllers/productsController.php";

    include $basePath . "components/Header.php";
?>

<main class="productsContainer">
    <h1 class="productsTitle">Catálogo de Productos</h1>

    <section class="searchSection" style="margin-bottom: 20px;">
        <form action="products.php" method="GET" style="display: flex; gap: 10px; align-items: center;">
            <label for="code" style="font-weight: bold;">Buscar por Código:</label>
            <input type="text" name="code" id="code" placeholder="Ej: BAR-303" value="<?php echo htmlspecialchars($searchCode); ?>" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; width: 200px;">
            <button type="submit" class="submitButton" style="padding: 8px 16px;">Buscar</button>
            <?php if (!empty($searchCode)): ?>
                <a href="products.php" class="submitButton" style="padding: 8px 16px; text-decoration: none; background-color: #666;">Limpiar Filtro</a>
            <?php endif; ?>
        </form>
    </section>

    <section class="resultsGrid" style="width: 100%;">
        <section class="statusSection" style="width: 100%;">
            <h2 class="sectionTitle">Productos Registrados</h2>
            <section style="overflow-x: auto; padding: 12px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--borderColor);">
                            <th style="padding: 10px;">ID</th>
                            <th style="padding: 10px;">Código (BarCode)</th>
                            <th style="padding: 10px;">Nombre</th>
                            <th style="padding: 10px;">Categoría</th>
                            <th style="padding: 10px;">Precio (Q)</th>
                            <th style="padding: 10px;">Stock</th>
                            <th style="padding: 10px;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productsList)): ?>
                            <?php foreach ($productsList as $product): ?>
                                <tr style="border-bottom: 1px solid var(--borderColor);">
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($product['id'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($product['barCode'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($product['productName'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($product['category']['categoryName'] ?? ''); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars(number_format((float)($product['price'] ?? 0), 2)); ?></td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($product['stock'] ?? ''); ?></td>
                                    <td style="padding: 10px;">
                                        <a href="productDetail.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="submitButton" style="padding: 6px 12px; font-size: 14px; text-decoration: none; display: inline-block;">Ver Detalle</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="padding: 20px; text-align: center;">No se encontraron productos.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </section>
    </section>
</main>

<?php
    include $basePath . "components/Footer.php";
?>