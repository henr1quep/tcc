<?php
error_reporting(E_ALL);
/*================ VARIAVEIS ====================*/

$limiteestabelecido = 5000;
$precoenergisa = 0.75896;

include('consulta.php');

//var_dump($mediahoraW);
//var_dump($mediahoraV);
//var_dump($mediaDiaW);
//var_dump($mediahoraV);
/* 
    $myfile = fopen("correnteagora.txt", "r") or die("Nao achou arquivo!");
    $tr = fread($myfile,filesize("correnteagora.txt"));
    fclose($myfile);
*/

for($i=0;$i<=12;$i++){
    $mediaMesKWH[$i] = $mediaMesW[$i]*24/1000;
    $mediaMesKWHsem[$i] = $mediaMesW[$i]*24/1000;
    $mediaMesKWH[$i] = number_format($mediaMesKWH[$i], 2);
}    


$sumDia = array();
for($i=0;$i<=30;$i++){    
    if($i == 0){
        if($mediaDiaW[$i+1] == 0){
            $sumDia[$i] = 0;
        }else{
            $sumDia[$i] = $mediaDiaW[$i+1]/1000;
            $sumDia[$i] = number_format($sumDia[$i], 2);
        }
        
    }else{
        if($mediaDiaW[$i+1] == 0){
            $sumDia[$i] = 0 + $sumDia[$i-1] ;
        }else{
            $sumDia[$i] =  ($mediaDiaW[$i+1]/1000) + $sumDia[$i-1] ;
            $sumDia[$i] = number_format($sumDia[$i], 2);
        }
        
    }
}

//var_dump($mediaDiaW);
//var_dump($sumDia);
//var_dump($mediaMesKWH);
//var_dump($mediaMesKWHsem);
//var_dump($mediaMesW);

$valoratual = $mediaMesKWHsem[date('n')-1]  * $precoenergisa;
$valoratual = number_format($valoratual,2,",","."); 

//var_dump($mediaMesKWHsem[date('n')-1]);
//var_dump($sumDia);

$vars =[    
    'arraymediames' => $mediaMesKWH,
    'arraymediamessem' => $mediaMesKWHsem, 
    'arraymediadia' => $mediaDiaW,
    'arraymediahoraV' => $mediahoraV,
    'arraymediahoraW' => $mediahoraW,
    'sumDia' => $sumDia,
    'var2' => $mediahoraV[2]    
];


?>



<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript">
        var phpVars = <?php echo json_encode($vars); ?>;
    </script>
    <meta charset="utf-8" />
    <title>TCC - Henrique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Projeto TCC Engenharia Eletrica IFPB" name="description" />
    <meta content="Henrique" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- jvectormap -->
    <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

    <!-- DataTables -->
    <link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <style>
                
        #website-stats1:after {
            content: 'Potência [Watts]';
            position: absolute;
            top: 50%;
            left: -63px;
            font-family: monospace;
            font-weight: 200;
            font-size: 12px;
            /* Safari */
            -webkit-transform: rotate(-90deg);
            /* Firefox */
            -moz-transform: rotate(-90deg);
            /* IE */
            -ms-transform: rotate(-90deg);
            /* Opera */ 
            -o-transform: rotate(-90deg);
            /* Internet Explorer */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
            color: #999;
        }
        #website-stats1:before {
            content: 'Tempo [horas]';
            position: absolute;
            bottom: -17px;
            left: 50%;
            font-size: 12px;
            font-family: monospace;
            font-weight: 200;
            color: #999;

        }

        #flotRealTime:after {
            content: 'Potência [Watts]';
            position: absolute;
            top: 50%;
            left: -63px;
            font-family: monospace;
            font-weight: 200;
            /* Safari */
            -webkit-transform: rotate(-90deg);
            /* Firefox */
            -moz-transform: rotate(-90deg);
            /* IE */
            -ms-transform: rotate(-90deg);
            /* Opera */
            -o-transform: rotate(-90deg);
            /* Internet Explorer */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
            color: #999; 
            font-size: 12px;
        }
        #flotRealTime:before {
            content: 'Registros ';
            position: absolute;
            bottom: -17px;
            left: 50%;
            font-family: monospace;
            font-weight: 200;
            color: #999;
            font-size: 12px;
        }


        .progress {
            width: 60% !important;
        }

        .progress-value {
            width: 40% !important;
                
        }
    </style>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">




                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                        <span class="pro-user-name ml-1">
                            HENRIQUE PONTES <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="m-0">
                                Olá !
                            </h6>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="dripicons-user"></i>
                            <span>Minha Conta</span>
                        </a>

                        <!-- item-->


                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="dripicons-help"></i>
                            <span>Suporte</span>
                        </a>

                        <!-- item-->

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="dripicons-power"></i>
                            <span>Sair</span>
                        </a>

                    </div>
                </li>


            </ul>

            <ul class="list-unstyled menu-left mb-0">
                <li class="float-left">
                    <a href="index.html" class="logo">
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="22">
                        </span>
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="24">
                        </span>
                    </a>
                </li>
                <li class="float-left">
                    <span class="" style="color:#DDD;font-size:18px;line-height:70px">
                        <?php echo $today = date("d/m/Y"); ?>
                    </span>
                    <span class="" id="hora" style="color:#DDD;font-size:18px;line-height:70px">

                    </span>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="slimscroll-menu">

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul class="metismenu" id="side-menu">

                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="dripicons-mail"></i>
                                <span> Agradecimentos </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="email-inbox.html">Ler</a>
                                </li>

                            </ul>
                        </li>
                       

                        <li>
                            <a href="javascript: void(0);">
                                <i class="dripicons-graph-bar"></i>
                                <span> Gráficos </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="chart-flot.html">Mensal</a>
                                </li>
                                <li>
                                    <a href="chart-chartist.html">Anual</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="dripicons-user-group"></i>
                                <span> Autênticação </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="auth-login.html">Sair</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Início</a></li>
                                        <li class="breadcrumb-item active">Painel</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Painel</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12 col-md-3">
                            
                            <div class="card-box widget-chart-one gradient-success bx-shadow-lg">
                                <a href="#"  aria-expanded="false" id="skol">
                                    <i class="mdi mdi-refresh" style="float:right;font-size: 20px"></i>
                                </a>

                                <div class="widget-chart-one-content text-left">
                                    <p class="text-white mb-0 mt-2">Projeção Conta de Energia <b><?php echo date('m').'/'.date('Y'); ?></b></p>
                                    <h3 class="text-white">R$ <span id="att"><?php echo $valoratual; ?></span></h3>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">

                            <div class="card-box">
                                <h4 class="header-title">Registro Diário</h4> <span id="real" val="0"></span>

                                <div id="website-stats1" style="height: 350px;" class="flot-chart mt-5"></div>
                            </div> <!-- end card-box-->

                        </div> <!-- end col -->
                        <div class="col-lg-4">
                            <div class="card-box">
                                <h4 class="header-title">Consumo Tempo Real</h4>

                                <div id="flotRealTime" style="height: 350px;" class="flot-chart mt-5"></div>
                            </div> <!-- end card-box-->
                        </div> <!-- end col -->


                        <div class="col-lg-4">

                            <div class="card-box">

                                <h4 class="header-title mb-4">Limite Mensal</h4>

                                <div class="row text-center">
                                    <div class="col-6 mb-2 offset-3">
                                        <!-- <h3 class="font-weight-light"> 400 kWh</h3> -->
                                        <p class="text-muted text-overflow">Limite Consumo Previsto p/ Mês </p>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                                <div class="chartjs-chart datauses-area">
                                    <canvas id="datauses-area-1"></canvas>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="card-box">

                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a onClick="history.go(0);" class="dropdown-item">Atualizar</a>

                                    </div>
                                </div>
                                <h4 class="header-title mb-4">Última medição às <span style="color:#777"><?php echo date('d/m/Y H:i:s'); ?></span></h4>
                                <br clear="all" />

                                <div class="col-12">
                                    <h5 class="mb-1 mt-0">Consumo<small class="text-muted ml-2">W</small></h5>
                                    <div class="progress-w-percent">
                                        <span class="progress-value font-weight-bold"><?php echo $agora['watts']; ?> W </span>
                                        <div class="progress progress-sm">
                                            <?php 
                                                $max = 15000;
                                                $wagora = $agora['watts']/$max*100;
                                            ?>
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $wagora; ?>%;" aria-valuenow="<?php echo $wagora; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-0">Corrente <small class="text-muted ml-2">A</small></h5>
                                    <div class="progress-w-percent">
                                        <span class="progress-value font-weight-bold"><?php echo $agora['corrente']; ?> A </span>
                                        <div class="progress progress-sm">
                                            <?php 
                                                $max = 63;
                                                $aagora = $agora['corrente']/$max*100;
                                            ?>
                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $aagora; ?>%;" aria-valuenow="<?php echo $aagora; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-0">Tensão <small class="text-muted ml-2">V</small></h5>
                                    <div class="progress-w-percent">
                                        <span class="progress-value font-weight-bold"><?php echo $agora['tensao']; ?> V </span>
                                        <div class="progress progress-sm">
                                            <?php 
                                                $max = 240;
                                                $vagora = $agora['tensao']/$max*100;
                                            ?>
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $vagora; ?>%;" aria-valuenow="<?php echo $vagora; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>


                                </div> <!-- end col -->

                            </div> <!-- end card-box-->
                        </div>
                        <div class="col-lg-5">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Consumo p/ Mês (Ano <?php echo date('Y'); ?>)</h4>
                                
                                <div class="chartjs-chart-example chartjs-chart">
                                    <canvas id="bar-chart-example"></canvas>
                                </div>
                            </div> <!-- end card-box -->
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card-box">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a onClick="history.go(0);" class="dropdown-item">Atualizar</a>

                                    </div>
                                </div>
                                <h4 class="header-title mb-4">Pico Registro Ano</h4>


                                <div class="table-responsive">
                                    <table class="table table-centered table-hover mb-0" id="datatable">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0"></th>
                                                <th class="border-top-0">Máx</th>
                                                <th class="border-top-0">Data/Hora</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="ml-2">Tensão </span>
                                                </td>

                                                <td><?php echo $maxV['tensao']; ?> V</td>
                                                <td>
                                                    <?php                                                         
                                                        echo date('d/m/Y H:i:s', strtotime($maxV['data']));
                                                    ?>
                                                </td>                                                

                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="ml-2">Corrente</span>
                                                </td>                                                                                                
                                                <td><?php echo $maxA['corrente']; ?> A</td>
                                                <td>
                                                    <?php                                                         
                                                        echo date('d/m/Y H:i:s', strtotime($maxA['data']));
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="ml-2">Consumo</span>
                                                </td>                                                                                    
                                                <td><?php echo $maxW['watts']; ?> W</td>
                                                <td>
                                                    <?php                                                         
                                                        echo date('d/m/Y H:i:s', strtotime($maxW['data']));
                                                    ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div> <!-- end card-box-->

                        </div>
                        
                    </div>

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            &copy; TCC <a>Henrique Pontes</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <!-- Right bar overlay-->

    <!-- Vendor js -->
    <script src="assets/js/vendor.js"></script>

    <!-- Chart JS -->
    <script src="assets/libs/chart-js/Chart.bundle.min.js"></script>

    <!-- Dashboard Init JS -->


    <!-- flot chart -->
    <script src="assets/libs/flot-charts/jquery.flot.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.time.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.resize.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.selection.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.orderBars.js"></script>
    <script src="assets/libs/flot-charts/jquery.flot.crosshair.js"></script>



    <!-- init js -->
    <!-- <script src="assets/js/pages/flot.init.js"></script> -->
    <script src="assets/js/pages/plots.js"></script>
    <script src="assets/js/pages/plots2.js"></script>
    <script src="assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>


    <script type="text/javascript">    
            $('#skol').click(function () {                
                $.ajax({                    
                    url: "./ajaxrefresh.php"                        
                    , type: "POST"
                    , dataType: "json"
                    , success: function (data) {
                        if (data) {                            
                            $("#att").html(data);  
                            //alert(data);                  
                        } else {
                            alert("erro refresh");
                        }
                        return false;
                    }
                });
                return false;
            });
    </script>


    <script type="text/javascript">
        setInterval(function() {
            $.ajax({                    
                    url: "./ajax.php"                        
                    , type: "POST"
                    , dataType: "json"
                    , success: function (data) {
                        if (data) {                                                        
                            $("#real").attr('val',data);         
                        } else {
                            alert("erro refresh");
                        }
                        return false;
                    }
                });
                return false;
        }, 4000);
        setInterval(function() {
            $.ajax({                    
                    url: "./ajaxrefresh.php"                        
                    , type: "POST"
                    , dataType: "json"
                    , success: function (data) {
                        if (data) {                            
                            $("#att").html(data);  
                            //alert(data);                  
                        } else {
                            alert("erro refresh");
                        }
                        return false;
                    }
                });
                return false;
        }, 10000);
    </script>

    
    <script type="text/javascript">
        setInterval(function() {
            var date = new Date();
            $('#hora').html(
                date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds()
            );
        }, 1000);

    </script>


</body>

</html>