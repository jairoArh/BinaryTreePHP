/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    // Activate the side menu 
    $(".button-collapse").sideNav();
});

function getChecked( ) {
    var radio = document.getElementsByName('list');
    for (index in radio) {
        if (radio[ index ].checked) {
            return radio[ index ].value;
        }
    }
}

function deleteRows(mt) {
    for (var i = mt.rows.length - 1; i > 0; i--) {

        mt.deleteRow(i);
    }
}

function addRow( table, line ) {
    var row = document.createElement("tr");
    var col = document.createElement("td");
    col.appendChild(document.createTextNode(line.id));
    row.appendChild(col);

    var col = document.createElement("td");
    col.appendChild(document.createTextNode(line.br));
    row.appendChild(col);

    var col = document.createElement("td");
    col.appendChild(document.createTextNode(line.ds));
    row.appendChild(col);

    var col = document.createElement("td");
    col.appendChild(document.createTextNode(line.vl));
    row.appendChild(col);

    table.appendChild(row);
}

function clearFields( ) {
    document.getElementById("idHardware").value = "";
    document.getElementById("brand").value = "";
    document.getElementById("description").value = "";
    document.getElementById("value").value = "";
}

function validateFields( ) {
    if (document.getElementById('idHardware').value.length == 0) {
        return false;
    } else if (document.getElementById('brand').value.length == 0) {
        return false;
    } else if (document.getElementById('description').value.length == 0) {
        return false;
    } else if (document.getElementById('value').value.length == 0) {
        return false;
    }

    return true;
}

function insertNode( ) {
    if (validateFields(  ) ) {
        var idNode = document.getElementById('idHardware').value;
        var brand = document.getElementById('brand').value;
        var description = document.getElementById('description').value;
        var value = parseFloat(document.getElementById('value').value);
        var send = "idNode=" + idNode + "&brand=" + brand + "&description=" + description + "&value="
                + value + "&optList=" + getChecked( ) + "&option=INSERT";
        var xhr = new XMLHttpRequest( );
        xhr.open("POST", "proccess.php", true);
        xhr.onreadystatechange = function ( ) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                var dates = JSON.parse( response );
                if (dates.length > 0) {
                    var myTable = document.getElementById("tabList");
                    deleteRows( myTable );
                    for (index in dates) {
                        addRow( myTable, dates[ index ] );
                    }
                    clearFields( );
                } else {
                    alert("El ID del Hardware ya fue Registrado")
                }
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(send);
    } else {
        alert("!!Existen Campos Vacios!!")
    }
}

 function listNodes( ) {
    var xhr = new XMLHttpRequest( );
    xhr.open("GET", "proccess.php?optList=" + getChecked( ) + "&option=LIST", true);
    xhr.onreadystatechange = function ( ) {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            var dates = JSON.parse(response);
            if (dates.length > 0) {
                var myTable = document.getElementById("tabList");
                deleteRows(myTable);
                for (index in dates) {
                    addRow(myTable, dates[ index ]);
                }
            } else {
                alert("El ID del Hardware ya fue Registrado")
            }
        }
    }
    xhr.send(null);
}

function findNode( ) {
    var id = document.getElementById("search");
    if (id.value.length > 0) {
        var xhr = new XMLHttpRequest( );
        xhr.open("GET", "proccess.php?id=" + id.value + "&option=FIND_NODE");
        xhr.onreadystatechange = function ( ) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                var object = JSON.parse(response);
                if (object) {
                    alert("IdNode....: " + object.id + "\nMarca---: " + object.brand + "\nDescripción...: "
                            + object.desc + "\nValor.....: " + object.value);
                } else {
                    alert("Nodo Inexistente");
                }
            }
        }
        xhr.send(null);
    } else {
        alert("Debe especificar el Id del Hardware");
    }
}

function gradeNode( ) {
    var id = document.getElementById("search");
    if (id.value.length > 0) {
        var xhr = new XMLHttpRequest( );
        xhr.open("GET", "proccess.php?id=" + id.value + "&option=GRADE_NODE");
        xhr.onreadystatechange = function ( ) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                if (response != -1) {
                    alert("El Grad del Nodo es " + response);
                } else {
                    alert("NO Existe el Nodo");
                }
            }
        }
        xhr.send(null);
    } else {
        alert("Debe especificar el Id del Hardware");
    }
}

function findFather( ) {
    var id = document.getElementById("search");
    if (id.value.length > 0) {
        var xhr = new XMLHttpRequest( );
        xhr.open("GET", "proccess.php?id=" + id.value + "&option=FIND_FATHER");
        xhr.onreadystatechange = function ( ) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                var object = JSON.parse(response);
                if (object) {
                    if (object.id != null) {
                        alert("IdNode....: " + object.id + "\nMarca---: " + object.brand + "\nDescripción...: "
                                + object.desc + "\nValor.....: " + object.value);
                    } else {
                        alert("El Nodo es la RAIZ, no tiene padre");
                    }
                } else {
                    alert("Nodo Inexistente");
                }
            }
        }
        xhr.send(null);
    } else {
        alert("Debe especificar el Id del Hardware");
    }
}

function weightTree( ) {

    var xhr = new XMLHttpRequest( );
    xhr.open("GET", "proccess.php?option=WEIGHT_TREE");
    xhr.onreadystatechange = function ( ) {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            alert("El Peso del Arbol es " + response);
        }
    }
    xhr.send(null);
}

function heightNode( ) {
    var id = document.getElementById("search");
    if (id.value.length > 0) {
        var xhr = new XMLHttpRequest( );
        xhr.open("GET", "proccess.php?id=" + id.value + "&option=HEIGHT_NODE");
        xhr.onreadystatechange = function ( ) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                if (response != -1) {
                    alert("La Altura del Nodo es " + response);
                } else {
                    alert("NO Existe el Nodo");
                }
            }
        }
        xhr.send(null);
    } else {
        alert("Debe especificar el Id del Hardware");
    }
}
function heightTree( ) {
    var xhr = new XMLHttpRequest( );
    xhr.open("GET", "proccess.php?option=HEIGHT_TREE");
    xhr.onreadystatechange = function ( ) {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response != 0) {
                alert("La Altura del Arbol es " + response);
            } else {
                alert("El Arbol no contiene Nodos, está vacío");
            }
        }
    }
    xhr.send(null);
}

function levelNode( ) {
    var id = document.getElementById("search");
    if (id.value.length > 0) {
        var xhr = new XMLHttpRequest( );
        xhr.open("GET", "proccess.php?id=" + id.value + "&option=LEVEL_NODE");
        xhr.onreadystatechange = function ( ) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                if (response != -1) {
                    alert("El Nivel del Nodo es " + response);
                } else {
                    alert("NO Existe el Nodo");
                }
            }
        }
        xhr.send(null);
    } else {
        alert("Debe especificar el Id del Hardware");
    }
}

function deleteNode( ) {
    var id = document.getElementById("search");
    if (id.value.length > 0) {
        var xhr = new XMLHttpRequest( );
        xhr.open("GET", "proccess.php?id=" + id.value + "&option=DELETE_NODE");
        xhr.onreadystatechange = function ( ) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                var object = JSON.parse(response);
                if (object) {
                    alert("Se Eliminó..\n\nIdNode....: " + object.id + "\nMarca---: " + object.brand + "\nDescripción...: "
                            + object.desc + "\nValor.....: " + object.value);
                    listNodes( );
                } else {
                    alert("Nodo Inexistente");
                }
            }
        }
        xhr.send(null);
    } else {
        alert("Debe especificar el Id del Hardware");
    }
}
