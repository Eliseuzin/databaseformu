async function enviardados() {
  // Check if there's data in localStorage to send
  if (localStorage.hasOwnProperty("listaformu")) {
    document.getElementById("msg").innerHTML = "<p style='color:green'>[info]: Registro encontrado para sincronizar!</p>";
    
    // Retrieve the stored data and parse it
    var dadoslocalstorage = JSON.parse(localStorage.getItem("listaformu"));
    
    try {
      // Make the fetch request
      const response = await fetch("editar.php", {
        method: "POST",
        body: JSON.stringify(dadoslocalstorage),
        headers: {
          "Content-Type": "application/json"
        }
      });
      
      // Check the response status
      if (response.ok) {
        const data = await response.json();
        document.getElementById("msg").innerHTML = data.msg;
        
        // Optional: If success, clear the data from localStorage
        // localStorage.removeItem("listaformu");
      } else {
        throw new Error(`Failed to send data: ${response.statusText}`);
      }
    } catch (error) {
      // Handle any errors that occur during the fetch or JSON parsing
      document.getElementById("msg").innerHTML = `<p style='color:red'>[error]: ${error.message}</p>`;
    }
  } else {
    document.getElementById("msg").innerHTML = "<p style='color:red'>[error]: Nenhum registro encontrado para sincronizar!</p>";
  }
}
