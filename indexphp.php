<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="revisit-after" content="1" />
    <meta name="classification" content="Service" />
    <meta name="robots" content="ALL" />
    <meta name="distribution" content="Global" />
    <meta name="rating" content="General" />
    <meta name="author" content="Comtermica" />
    <meta name="language" content="pt-br" />
    <meta name="doc-class" content="Completed" />
    <meta name="Copyright" content="Copyright (c) Menew" />
    <meta name="Revisit" content="1 Day" />
    <meta name="Googlebot" content="all" />

    <meta name="theme-color" content="#0074B9" />
    <title>TCC</title>

    <meta name="author" content="Comtermica">
    <meta name="keywords" content="Comtermica" />


    <meta property="og:type" content="website" />

    <meta property="og:site_name" content="Comtermica" />
    <meta property="og:title" content="Comtermica" />
    <meta property="og:url" content="https://www.comtermica.com.br/" />
    <meta property="og:description" content="Comtermica" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">


</head>

<body>



    TESTE GIL BALA
    <br />2022-05-31 01:09:10<br />



    GRAFICO MASSA PRA IMPRESSIONAR<br />
    
    <?php
    error_reporting(1);    
    $apikey_check = "tPmAT5Ab3j7F9";
    date_default_timezone_set('America/Recife');
    $gil =  date('Y-m-d H:i:s');          
    $conexao = mysqli_connect('localhost','root','');
    $banco = mysqli_select_db($conexao,'tcc');
    mysqli_set_charset($conexao,'utf8');
    
            $voltage = $_REQUEST['volt'];
            $corrente = $_REQUEST['amp'];
    
        if($voltage && $corrente){
    
            $query = "insert into medicao (`data`,`tensao`, `corrente`) VALUES ('".$gil."','".$voltage."','".$corrente."') ";
            $result = mysqli_query($conexao,$query) or die('Errant query:  '.$query);
        }

    
    
        $sql = mysqli_query($conexao,"select * from medicao") or die("Erro");
            while($dados=mysqli_fetch_assoc($sql))
        {
            echo $dados['data'].' - ';
            echo $dados['tensao'].' - ';
            echo $dados['corrente'].' - ';
                echo "<br/>acima os dados do banco<br/>";
            }
        
        ?>




<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

$(function () {
    $("body").delegate(".gostar","click", function(){
    //$('.gostar').click(function () {
        var idd = $(this).attr('rel');
        $.ajax({
            url: "consulta.php"
            , data: {
                id: $(this).attr('rel')
            }
            , type: "POST"
            , dataType: "json"
            , success: function (data) {
                if (data == 'JA') {
                    $('#gostaram' + idd).html('');
                    $('#subt' + idd).html('JÁ GOSTOU!');
                } else {
                    $('#gostaram' + idd).html(data);
                }
                return false;
            }
        });
        return false;
    });
});

</script>




</body>