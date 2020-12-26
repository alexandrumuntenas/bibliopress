    <script>
        function handleResponse(response) {
            for (var i = 0; i < response.items.length; i++) {
                var item = response.items[i];
                document.getElementById("titulo").value = item.volumeInfo.title;
                document.getElementById("autor").value = item.volumeInfo.authors;
                document.getElementById("editorial").value = item.publisher;
                document.getElementById("anopub").value = item.volumeInfo.publishedDate;
                document.getElementById("descripcion").value = item.volumeInfo.description;
                document.getElementById("portada").value = item.volumeInfo.imageLinks.thumbnail;
                document.getElementById("apisresult").innerHTML += "<div id='snackbar' class='show'> Operación realizada de forma satisfactoria</div>";
            }
        }
    </script>
    <?php
    if (isset($_POST['gbook'])) {
        $busqueda = $_POST['gbook'];
    ?>
        <script src="https://www.googleapis.com/books/v1/volumes?q=<?php echo $busqueda; ?>&maxResults=1&callback=handleResponse"></script>
    <?php
    } #
    ?>