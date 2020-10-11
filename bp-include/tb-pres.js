function ttlibro() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("titulolibro");
    filter = input.value.toUpperCase();
    table = document.getElementById("tb-pres");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function uslibro() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("uslibro");
    filter = input.value.toUpperCase();
    table = document.getElementById("tb-pres");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

