<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle)
        ? htmlspecialchars($pageTitle)
        : "Forum MongoDB"; ?></title>
    <link rel="stylesheet" href="view/style.css">
</head>
<body>
    <?php include_once "header.php"; ?>
    <section class="container">
            <?php if (isset($page)) {
                require "./view/" . $page . ".php";
            } ?>
        </section>

    <?php include_once "footer.php"; ?>
</body>
