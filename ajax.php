<?php header('Access-Control-Allow-Origin: *'); ?>
<?php

    $myfile = fopen("correnteagora.txt", "r") or die("Nao achou arquivo!");
    $tr = fread($myfile,filesize("correnteagora.txt"));
    fclose($myfile);    
    $var = $tr;    
    echo json_encode($var);
    
?>
