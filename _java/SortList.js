
function sortList() {
  var lista,nota;
  lista = document.getElementById("list_Notas");
  nota = lista.getElementsByTagName("li");
  document.write(nota.item(2).innerHTML.split(".")[2]);
}
