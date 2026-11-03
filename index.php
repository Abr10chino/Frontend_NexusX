<?php
    $basePath = "./";
    $pageTitle = "Home";

    $navLinks = [
        ["title" => "Inicio", "url" => "index.php"],
        ["title" => "Importar CSV", "url" => "src/import.php"]
    ];

    $extraCss = [];

    include $basePath . "components/Header.php";

?>

<main>
    <h1>Bienvenido a NexusX</h1>
    <p>Plataforma de aplicaciones desarrollada para la gestión eficiente.</p>
</main>

<?php
    include $basePath . "components/Footer.php";
?>
