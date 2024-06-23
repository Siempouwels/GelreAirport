<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Gelre Checkin - ' . $title ?? 'Gelre Checkin'; ?></title>
    <!-- default css files -->
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    <?php
    if (isset($cssFiles) && is_array($cssFiles)) {
        foreach ($cssFiles as $cssFile) {
            echo '<link rel="stylesheet" href="' . $cssFile . '">' . PHP_EOL;
        }
    }
    ?>
</head>

<body>