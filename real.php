
<?php
    error_reporting(E_ALL);

    date_default_timezone_set('America/Recife');
    $fileName = "correnteagora.txt";
    $endTime = time() + 60; // Rodar por 60 segundos
    
    while (time() < $endTime) {
        $randomValue = rand(220000, 1320000) / 100; // Gera um valor aleatório entre 10 e 60 com duas casas decimais
        file_put_contents($fileName, $randomValue);
        sleep(1);
    }
    
?>
