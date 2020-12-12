function fill(Value) {
    $('#search').val(Value);
    $('#display').hide();
}
$(document).ready(function () {
    $("#search").keyup(function () {
        var name = $('#search').val();
        if (name == "") {
            $("#display").html("");
        }
        else {
            $.ajax({
                type: "POST",
                url: "../bp-include/ajax.php",
                data: {
                    search: name
                },
                success: function (html) {
                    $("#display").html(html).show();
                }
            });
        }
    });

});

function gbooks() {
            var isbn = $('#ISBN').val();
                $.ajax({
                    type: "POST",
                    url: "../bp-include/gbook.php",
                    data: {
                        gbook: isbn
                    },
                    success: function (html) {
                        $("#gapisresult").html(html).show();
                    }
                });
            };

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
window.onload = function () {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function () { x.className = x.className.replace("show", ""); }, 4900);
}