    <script>
       function handleResponse(response) {
          for (var i = 0; i < response.items.length; i++) {
             var item = response.items[i];
             // in production code, item.text should have the HTML entities escaped.
             document.getElementById("gtitulo").value = item.volumeInfo.title;
             document.getElementById("gautor").value = item.volumeInfo.authors;
             document.getElementById("geditorial").value = item.volumeInfo.publisher;
             document.getElementById("ganopub").value = item.volumeInfo.publishedDate;
             document.getElementById("gdescripcion").value = item.volumeInfo.description;
             document.getElementById("gapisresult").innerHTML += "<p style='color:green'>Operación Realizada Correctamente</p>";
          }
       }
    </script>
    <?php
      if (isset($_POST['gbook'])) {
         $busqueda = $_POST['gbook'];
      ?>
       <script src="https://www.googleapis.com/books/v1/volumes?q=Nunca+sere+tu+heroe&maxResults=1&callback=handleResponse&key=AIzaSyDYB4E8URx9x1eDZwvknMw_DQozltvYQLs"></script>
       <?php 
      } #<?php echo $busqueda; 
         ?>