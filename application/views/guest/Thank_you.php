<html>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
<link rel="stylesheet" href="<?php echo $homepage; ?>assets/css/bootstrap.css">

<style>
    .footer {
        position: absolute;
        bottom: 10px;
        left: 0;
        width: 100%;
    }

    .contenuto{
        width: 100%;
        position: absolute;
        text-align: center;
        margin-top: 250px;
    }
</style>


<body class="jumbotron text-center">

    <div class="contenuto">
        <div class="fa-4x">
            <i class="<?php echo $icon; ?>"></i>
        </div>

        <h1 class="display-3"><?php echo $body; ?></h1>
    </div>


    <footer class="footer"><hr>
        <span style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">
            E-Type - Sviluppo Software Mobile App e Web Design
        </span>
    </footer>

</body>

</html>