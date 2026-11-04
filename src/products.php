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
                                        <?php 
                                            $detailUrl = "products.php?";
                                            if (!empty($searchCode)) {
                                                $detailUrl .= "code=" . urlencode($searchCode) . "&";
                                            }
                                            $detailUrl .= "detailId=" . urlencode($product['id']);
                                        ?>
                                        <a href="<?php echo htmlspecialchars($detailUrl); ?>" class="submitButton" style="padding: 6px 12px; font-size: 14px; text-decoration: none; display: inline-block;">Ver Detalle</a>
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

    <?php if (!empty($productDetailInfo)): ?>
    <section style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
        <section style="background-color: white; padding: 24px; border-radius: 8px; width: 90%; max-width: 500px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            <h2 style="margin-top: 0; color: var(--textPrimary); border-bottom: 2px solid var(--borderColor); padding-bottom: 10px;">Detalle del Producto</h2>
            
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; margin-top: 16px;">
                <li><strong>ID:</strong> <?php echo htmlspecialchars($productDetailInfo['id'] ?? ''); ?></li>
                <li><strong>Código (BarCode):</strong> <?php echo htmlspecialchars($productDetailInfo['barCode'] ?? ''); ?></li>
                <li><strong>Nombre del Producto:</strong> <?php echo htmlspecialchars($productDetailInfo['productName'] ?? ''); ?></li>
                <li><strong>Categoría:</strong> <?php echo htmlspecialchars($productDetailInfo['category']['categoryName'] ?? ''); ?></li>
                <li><strong>Precio:</strong> Q<?php echo htmlspecialchars(number_format((float)($productDetailInfo['price'] ?? 0), 2)); ?></li>
                <li><strong>Stock Disponible:</strong> <?php echo htmlspecialchars($productDetailInfo['stock'] ?? ''); ?></li>
                <li><strong>Estado:</strong> <?php echo htmlspecialchars($productDetailInfo['status'] ?? ''); ?></li>
                <li><strong>Fecha de Registro:</strong> 
                    <?php 
                        $rawDate = $productDetailInfo['createdAt'] ?? '';
                        if (!empty($rawDate)) {
                            $dateObj = new DateTime($rawDate);
                            echo htmlspecialchars($dateObj->format('Y-m-d H:i:s'));
                        }
                    ?>
                </li>
            </ul>

            <a href="products.php<?php echo !empty($searchCode) ? '?code=' . urlencode($searchCode) : ''; ?>" class="submitButton" style="display: block; text-align: center; text-decoration: none; padding: 10px;">Cerrar Ventana</a>
        </section>
    </section>
    <?php endif; ?>

</main>

<?php
    include $basePath . "components/Footer.php";
?>