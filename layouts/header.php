<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.jpg">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/buttons.css">
    <?php
        // Include CSS files if any are provided
        if (!empty($cssFiles)) {
            foreach ($cssFiles as $cssFile) {
                echo '<link rel="stylesheet" href="' . $cssFile . '">' . PHP_EOL;
            }
        }
        if (!empty($additionalLinks)) {
            foreach ($additionalLinks as $link) {
                echo $link . PHP_EOL;
            }
        }
    ?>

</head>
<body>
