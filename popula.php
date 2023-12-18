
<?php
    error_reporting(E_ALL);

    date_default_timezone_set('America/Recife');
    
    $conexao = mysqli_connect('localhost', 'u559028162_root', 'Teste123');
    $banco = mysqli_select_db($conexao, 'u559028162_tcc');
    mysqli_set_charset($conexao, 'utf8');

    function random_float($min,$max) {
       return ($min+lcg_value()*(abs($max-$min)));
    }


    //$energisa = $_REQUEST['tarifa'];

    if (1==1) {


//for($i=1;$i<=29;$i++){
            for($s=6;$s<=9;$s++){           

    $voltage = number_format(random_float(209,232),2);
    $corrente = number_format(random_float(1,7),2);    

                $hora =  date('Y-m-d H:i:s');    
                $hora =  '2023-11-30 '.$s.':10:55';    

                $watt = $voltage * $corrente;
                $query = "INSERT INTO medicao (`idconsumidor`,`data`,`tensao`, `corrente`, `watts`) VALUES ('15','" . $hora . "','" . $voltage . "','" . $corrente . "','" . $watt . "') ";
                $result = mysqli_query($conexao, $query) or die('Errant query:  ' . $query);
                if($result){
                    echo "Gravou com sucesso <br/>";
                }
        }

        

//}

    }
    
?>
