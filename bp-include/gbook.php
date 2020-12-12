    <script>
        function handleResponse(response) {
            for (var i = 0; i < response.items.length; i++) {
                var item = response.items[i];
                // in production code, item.text should have the HTML entities escaped.
                document.getElementById("gtitulo").value = item.volumeInfo.title;
                document.getElementById("gautor").value = item.volumeInfo.authors;
                document.getElementById("geditorial").value = item.publisher;
                document.getElementById("ganopub").value = item.volumeInfo.publishedDate;
                document.getElementById("gdescripcion").value = item.volumeInfo.description;
                document.getElementById("gapisresult").innerHTML += "<div id='snackbar' class='show'> Operación realizada de forma satisfactoria</div>";
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