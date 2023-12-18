<?php
    /*error_reporting(1);       
        
    */
    date_default_timezone_set('America/Recife');
    $conexao = mysqli_connect('localhost', 'u559028162_root', 'Teste123');
    $banco = mysqli_select_db($conexao, 'u559028162_tcc');
    mysqli_set_charset($conexao, 'utf8');
    $sql = mysqli_query($conexao, "select * from medicao") or die("Erro");
    while ($dados = mysqli_fetch_assoc($sql)) {
        /*echo $dados['data'].' - ';
            echo $dados['tensao'].' - ';
            echo $dados['corrente'].' - ';
            echo $dados['watts'].' - ';*/
    }


    //ULTIMO REGISTRO

    $sqlultmio = mysqli_query($conexao, "SELECT * FROM medicao ORDER by data desc LIMIT 1") or die("Erro");
    while ($dadoagora = mysqli_fetch_assoc($sqlultmio)) {
        $agora['data'] = $dadoagora['data'];
        $agora['tensao'] = $dadoagora['tensao'];
        $agora['corrente'] = $dadoagora['corrente'];
        $agora['watts'] = $dadoagora['watts'];
    }



    //VALORES MAXIMOS ANO

    $sqlmaxV = mysqli_query($conexao, "SELECT m.* FROM medicao m WHERE m.tensao = (select max(subp.tensao) from medicao subp where YEAR(subp.data) = '".date('Y')."' );") or die("Erro");
    while ($dadomax = mysqli_fetch_assoc($sqlmaxV)) {
        $maxV['data'] = $dadomax['data'];
        $maxV['tensao'] = $dadomax['tensao'];
    }
    $sqlmaxA = mysqli_query($conexao, "SELECT m.* FROM medicao m WHERE m.corrente = (select max(subp.corrente) from medicao subp where YEAR(subp.data) = '".date('Y')."' );") or die("Erro");
    while ($dadomax = mysqli_fetch_assoc($sqlmaxA)) {
        $maxA['data'] = $dadomax['data'];
        $maxA['corrente'] = $dadomax['corrente'];
    }
    $sqlmaxW = mysqli_query($conexao, "SELECT m.* FROM medicao m WHERE m.watts = (select max(subp.watts) from medicao subp where YEAR(subp.data) = '".date('Y')."' );") or die("Erro");
    while ($dadomax = mysqli_fetch_assoc($sqlmaxW)) {
        $maxW['data'] = $dadomax['data'];
        $maxW['watts'] = $dadomax['watts'];
    }



    //CONSUMO DIÁRIO   MEDIA POR HORA 
        $mediahoraV = array();
        $mediahoraW = array();
        for($i=0;$i<=24;$i++){
            $mediahoraV[$i] = 0;
            $mediahoraW[$i] = 0;
        }

        $sqlHora = mysqli_query($conexao, "SELECT idmedicao, AVG(tensao) as tensao, AVG(watts) as watts, HOUR(data) as hora FROM medicao WHERE DATE_SUB(`data`,INTERVAL 1 HOUR) And DATE(data) = CURDATE() GROUP BY HOUR(data) ORDER BY idmedicao ASC;") or die("Erro");
        while ($dadohora = mysqli_fetch_assoc($sqlHora)) {
            $hora = $dadohora['hora'];
            $mediahoraV[$hora] = $dadohora['tensao'];
            $mediahoraW[$hora] = $dadohora['watts'];
            
        }
    
    

    // CONSUMO MENSAL MEDIA POR MES

        $mediaMesV = array();
        $mediaMesW = array();
        for($i=0;$i<=12;$i++){
            $mediaMesV[$i] = 0;
            $mediaMesW[$i] = 0;
        }
        $sqlMes = mysqli_query($conexao, "SELECT idmedicao, AVG(tensao) as tensao, AVG(watts) as watts, MONTH(data) as mes FROM medicao WHERE DATE_SUB(`data`,INTERVAL 1 MONTH) And YEAR(data) = YEAR(CURDATE()) GROUP BY MONTH(data) ORDER BY idmedicao ASC;") or die("Erro");
        while ($dadoMES = mysqli_fetch_assoc($sqlMes)) {
            $mes = $dadoMES['mes'];
            $mediaMesV[$mes-1] = $dadoMES['tensao'];
            $mediaMesW[$mes-1] = $dadoMES['watts'];
            
            
        }


        // CONSUMO MENSAL MEDIA POR DIA

        $mediaDiaV = array();
        $mediaDiaW = array();
        for($i=0;$i<=30;$i++){
            $mediaDiaV[$i] = 0;
            $mediaDiaW[$i] = 0;
        }
        $sqlDia = mysqli_query($conexao, "SELECT idmedicao, AVG(tensao) as tensao, AVG(watts) as watts, DAY(data) as dia FROM medicao WHERE DATE_SUB(`data`,INTERVAL 1 DAY) And MONTH(data) = MONTH(CURDATE()) GROUP BY DAY(data) ORDER BY idmedicao ASC;") or die("Erro");
        while ($dadoDIA = mysqli_fetch_assoc($sqlDia)) {
            $dia = $dadoDIA['dia'];
            $mediaDiaV[$dia] = $dadoDIA['tensao'];
            $mediaDiaW[$dia] = $dadoDIA['watts'];
            
        }

            
        //var_dump($mediaDiaW);



?>
