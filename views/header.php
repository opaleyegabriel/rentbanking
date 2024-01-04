<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-1.11.3.min.js"></script>
    <meta charset="utf-8">
    <meta name="author" content="Rent Banking">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Planning Rent payment from a distanced time to the pay day ">
    <link rel="shortcut icon" href="<?php echo URL; ?>public/images/white version.png" width="150em" height="150em">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/dashlite.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/hoogpay.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-91615293-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-91615293-4');
    </script>
    <?php
    if (isset($this->js))
    {
        foreach ($this->js as $js)
        {
            echo ' <script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
        }

    }
    ?>
</head>
<div id="header">

</div>
<div id="content">
