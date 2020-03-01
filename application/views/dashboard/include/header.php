<html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!---------------------- Bootstrap DataTable -------------------------------->
    <link rel="stylesheet" href="<?php echo $homepage;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $homepage;?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $homepage;?>assets/css/adminArea.css">
    <!--------------------------------------------------------------------------->

    <!----------------------- Preventivi ---------------------------------------->
    <link rel="stylesheet" href="<?php echo $homepage;?>assets/css/chartist.min.css">
    <!--------------------------------------------------------------------------->

    <!----------------------- Font Awesome --------------------------------------->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!--------------------------------------------------------------------------->

    <!---------------------- FullCalendar --------------------------------------->
    <link href='<?php echo $homepage;?>assets/css/fullcalendar/core.css' rel='stylesheet' />
    <link href='<?php echo $homepage;?>assets/css/fullcalendar/daygrid.css' rel='stylesheet' />
    <!--------------------------------------------------------------------------->

    <!---------------------- Google Font --------------------------------------->
    <link href="//fonts.googleapis.com/css?family=Lato:400,900,400italic,700italic" rel="stylesheet">
    <!--------------------------------------------------------------------------->
</head>

    <!----------------------- https://gionkunz.github.io/chartist-js/ ----------------------->
    <script src="<?php echo $homepage;?>assets/js/Chart.bundle.min.js"></script>
    <script src="<?php echo $homepage;?>assets/js/chartist.min.js"></script>
    <!-------------------------------------------------------------------------------------->

    <!------------------------------ https://getbootstrap.com/ ----------------------------->
    <script src="<?php echo $homepage;?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $homepage;?>assets/js/popper.min.js"></script>
    <script src="<?php echo $homepage;?>assets/js/bootstrap.js"></script>
    <!-------------------------------------------------------------------------------------->

    <!--------------------------- https://notifyjs.jpillora.com/ --------------------------->
    <script src="<?php echo $homepage;?>assets/js/notify.js"></script>
    <!-------------------------------------------------------------------------------------->

    <!----------------- https://datatables.net/examples/styling/bootstrap4 ----------------->
    <script src="<?php echo $homepage;?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $homepage;?>assets/js/dataTables.bootstrap4.min.js"></script>
    <!-------------------------------------------------------------------------------------->

    <!-------------------------- https://sweetalert.js.org/guides/ ------------------------->
    <script src="<?php echo $homepage;?>assets/js/sweetalert.min.js"></script>
    <!-------------------------------------------------------------------------------------->

    <!------------------------------------ FullCalendar ------------------------------------>
    <script src='<?php echo $homepage; ?>assets/js/fullcalendar/core.js'></script>
    <script src='<?php echo $homepage; ?>assets/js/fullcalendar/daygrid.js'></script>
    <script src='<?php echo $homepage; ?>assets/js/fullcalendar/interaction.js'></script>

    <!-------------------------------------------------------------------------------------->

<body class="skin-blue">
<div class="wrapper">


    <header class="main-header">
        <a href="#" class="logo">
            <img class="img-logo" src="<?php echo $homepage;?>assets/img/panel_logo.png" />
        </a>

        <nav class="navbar navbar-static-top" role="navigation">

            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
            </div>
        </nav>
    </header>



    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li role="presentation"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                <li class="header">Admin Area</li>

                <!-- l'ID deve essere identico al titolo della pagina-->
                <li id="Aside_Home" role="presentation"><a href="<?php echo $homepage;?>dashboard/"><i class="fa fa-home"></i>Home</a></li>
                <li id="Aside_Preventivi" role="presentation"><a href="<?php echo $homepage;?>dashboard/preventivi/analytics"><i class="fas fa-chart-bar"></i>
                        <span class="server-id">Preventivi</span><br>
                        <span class="server-tag">Statistiche</span></a></li>

                <li class="header">Portafoglio</li>
                <li id="Aside_Richieste_Pagamento" role="presentation"><a href="<?php echo $homepage;?>dashboard/wallet/request"><i class="fas fa-wallet"></i> Richieste Pagamento</a></li>
                <li class="header">Account</li>
                <li id="Aside_Gestione_Account" role="presentation"><a href="<?php echo $homepage;?>dashboard/account"><i class="fas fa-tasks"></i> Gestione Account</a></li>
                <li id="Aside_Gestione_Impegni" role="presentation"><a href="<?php echo $homepage;?>dashboard/calendar"><i class="far fa-calendar-alt"></i> Gestisci Impegni</a></li>
                <li id="Aside_Profilo" role="presentation"><a href="<?php echo $homepage;?>dashboard/settings"><i class="fas fa-user-circle"></i> Il Tuo Profilo</a></li>
                <li id="Aside_Storico" role="presentation"><a href="<?php echo $homepage;?>dashboard/logs"><i class="fas fa-history"></i> Attività</a></li>
                <li role="presentation"><a href="<?php echo $homepage;?>account/logout"><i class="fas fa-sign-out-alt"></i> Esci</a></li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper" style="min-height: 279px;">

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary" style="padding-top:15px">
                        <div class="box-body">

                            <?php $view; ?>