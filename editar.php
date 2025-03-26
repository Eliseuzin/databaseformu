<?php 
//incluir a conecçao com banco de dados
include_once "conectardb.php";
//enviar o cabeçalho http json ao nevegador
//nao há necessidade de aspas internamente
header("Content-Type:application/json");
//receber as informaçoes do servidor
// var_dump($_SERVER);
$contenttype=isset($_SERVER["CONTENT_TYPE"])? $_SERVER["CONTENT_TYPE"]:"";

if($contenttype==="application/jsons"){
  
}else{
  //codigo 400, indica que a solicitaçao esta incorreta
  http_response_code(400);
  echo json_encode(["msg"=>"<p style='color:#f00'>[error]: Usuário não cadastrado com sucesso!!!</p>"]);
}

?>