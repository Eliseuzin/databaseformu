async function enviardados(){
  // alert("Dados enviados")
  //acessa o if quando há dados no localstorage para enviar para o banco de dados
  if(localStorage.hasOwnProperty("listaformu")){
    document.getElementById("msg").innerHTML="<p style='color:green'>[error]: registro encontrado para sincronizar!</p>"
    //recuperar o usuário dp localStorage
    //json.parse=tranfosrmar uma string em um objeto
    var  dadoslocalstorage=JSON.parse(localStorage.getItem("listaformu"));
    // console.log(dadoslocalstorage);
    //usar fetch para fazer requesiçao par aum arquivo/API
    //await para espera o preocessamento
    await fetch("editar.php",{
      method:"POST",
      body:JSON.stringify(dadoslocalstorage),
      headers:{
        "Content-Type":"application/json"
      }
    }).then((resposta)=>{
      console.log(resposta)
      //ler a mensagem  da resposta arquivo/API, preciso criar uma promise
      resposta.json().then(data=>{
        document.getElementById("msg").innerHTML=data.msg;
      });
      //acessa o if quando o arquivo/API retornar sucesso
      if(resposta.status==200){

      }else{
      }
    });
  }else{
    document.getElementById("msg").innerHTML="<p style='color:#f00'>[error]: nenhum registro encontrado para sincronizar!</p>"
  }
}
