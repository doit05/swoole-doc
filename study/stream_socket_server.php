<?php
$serv = stream_socket_server("tcp://0.0.0.0:8000",$errcode, $errstr)
or die("create server failed");
//
// print($serv);
// echo '----------';
// print_r($_SERVER);
while(true){
    $conn = stream_socket_accept($serv);
    if(pcntl_fork() == 0){
        $request = fread($conn);
        $response = 'hello';
        fwrite($response);
        fclose($conn);
        exit(0);
    }
}
