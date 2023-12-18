<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    
    $conexao = mysqli_connect('localhost', 'u559028162_root', 'Teste123');
    $banco = mysqli_select_db($conexao, 'u559028162_tcc');
    mysqli_set_charset($conexao, 'utf8');

    $precoenergisa = 0.762;

    //$sqlMes = mysqli_query($conexao, "SELECT idmedicao, AVG(tensao) as tensao, AVG(watts) as watts, MONTH(data) as mes FROM medicao WHERE DATE_SUB(`data`,INTERVAL 1 MONTH) And YEAR(data) = YEAR(CURDATE()) GROUP BY MONTH(data) ORDER BY idmedicao ASC;") or die("Erro");
    $sqlMes = mysqli_query($conexao, "SELECT idmedicao, AVG(tensao) as tensao, AVG(watts) as watts, MONTH(data) as mes FROM medicao WHERE MONTH(data) = MONTH(CURDATE()) GROUP BY MONTH(data) ORDER BY idmedicao ASC;") or die("Erro");
    while ($dadoMES = mysqli_fetch_assoc($sqlMes)) {
        $mes = $dadoMES['mes'];        
        $mediaMesW[$mes] = $dadoMES['watts'];        
    }


    $mediaMesKWH[date('n')] = $mediaMesW[date('n')]*24/1000;
    //$valoratual = $mediaMesW[date('n')] / date('t') /24  * $precoenergisa;
    $valoratual = $mediaMesKWH[date('n')] * $precoenergisa;
    $valoratual = number_format($valoratual,2,",",".");
    $var = $valoratual;
    
    // convertemos em json e colocamos na tela
    echo json_encode($var);
    
?>
