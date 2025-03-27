<?php 
//incluir a conecçao com banco de dados
include_once "conectardb.php";
//enviar o cabeçalho http json ao nevegador
//nao há necessidade de aspas internamente
//header("Content-Type:application/json");
//receber as informaçoes do servidor
// var_dump($_SERVER);
//trim retirar espaços no inicio e fim
$contenttype=isset($_SERVER["CONTENT_TYPE"])? trim($_SERVER["CONTENT_TYPE"]) : "";

//acessa o if quando o corpo da solicitaçao contpem uma string json
if($contenttype==="application/json"){
  //ler dos dados enviados via POST na requisiçao HTTP
  $conteudo=trim(file_get_contents("php://input"));
  //var_dump($conteudo);
  $conteudos_dados=json_decode($conteudo,true);
  // var_dump($conteudos_dados);
  
    //acessar o json para verificar se ele é valido
  if(!is_array($conteudos_dados)){
    
  //codigo 400, indica que a solicitaçao esta incorreta
  http_response_code(400);
  echo json_encode(["msg"=>"<p style='color:#f00'>[error]: Não foi possível cadastrado usuário!!!!!</p>"]);
  }else{
                //laço de repetiçao para ler os dados
          foreach($conteudos_dados as $chave=>$valor){
            
            //query para cadastrar no banco de dados utilizando PDO
            
            // $query_usuarios="INSERT INTO clientes (nome, cnpj, celular, cidade) VALUES (:nome,:cnpj.:celular,:cidade)";
            
            $query_usuarios="INSERT INTO `clientes`(`nome`, `cnpj`, `celular`, `cidade`) VALUES (':nome',':cnpj',':celular',':cidade')";
            
            //preparar a query PDO
            $cad_usuarios= $conexao->prepare($query_usuarios);

            //substituir o link da query pelo valor
            $cad_usuarios->bind_param(":nome",$valor["nomeform"]);
            $cad_usuarios->bind_param(":cnpj",$valor["cnpjform"]);
            $cad_usuarios->bind_param(":celular",$valor["celuform"]);
            $cad_usuarios->bind_param(":cidade",$valor["cidaformu"]);
            
            //executar a query para salvar no banco de dados
            $cad_usuarios->execute();
          }
    //codigo 200 indica que a solicitaçao esta correta
    http_response_code(200);
    echo json_encode(["msg"=>"<p style='color:green'>[Successfully]: Usuário cadastrado com sucesso!!!</p>"]);
  }
}else{
  //codigo 400, indica que a solicitaçao esta incorreta
  http_response_code(400);
  echo json_encode(["msg"=>"<p style='color:#f00'>[error]: Usuário não cadastrado com sucesso!!!!!!</p>"]);
}

?>