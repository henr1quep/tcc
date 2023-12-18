
<?php
    error_reporting(1);

    date_default_timezone_set('America/Recife');
    $hora =  date('Y-m-d H:i:s');
    $conexao = mysqli_connect('localhost', 'u559028162_root', 'Teste123');
    $banco = mysqli_select_db($conexao, 'u559028162_tcc');
    mysqli_set_charset($conexao, 'utf8');

    

    $idcliente = $_REQUEST['idcliente'];
    $voltage = $_REQUEST['volt'];
    $corrente = $_REQUEST['amp'];
    //$energisa = $_REQUEST['tarifa'];


    if($idcliente){
        $hashvem = $_REQUEST['hashcliente'];
        $hashnum = (int)$idcliente*5;
        $hashcalc = hash('sha256',$hashnum);        
        //$hashcalc = sha1($hashnum);

        if($hashvem == $hashcalc){


    if ($voltage && $corrente) {
        $watt = $voltage * $corrente;
        $query = "INSERT INTO medicao (`idconsumidor`,`data`,`tensao`, `corrente`, `watts`) VALUES ('".$idcliente."' ,'" . $hora . "','" . $voltage . "','" . $corrente . "','" . $watt . "') ";
        $result = mysqli_query($conexao, $query) or die('Errant query:  ' . $query);
            if($result){
                echo "Gravou com sucesso <br/>";
                $myfile = fopen("correnteagora.txt", "w");        
                fwrite($myfile, $watt);
                fclose($fp);            
                echo "Txt OK";
            }

        }
    }

    }
    //$sql = mysqli_query($conexao, "select * from medicao") or die("Erro");
?>
