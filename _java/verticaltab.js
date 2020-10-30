function openSub(evt, subject) { //crio uma função onde irei passar o evento e o assunto
  var i, tabcontent, tablinks; // inicio 3 variaveis
  tabcontent = document.getElementsByClassName("tabcontent");// pego o assunto passado no click
  for (i = 0; i < tabcontent.length; i++) { // vejo quantos campos com o nome da classe 'tabcontent' existem e itero dentro dessa quantidade
    tabcontent[i].style.display = "none";// sem ser o q eu cliquei, o proximo indice irei escondelo
  }
  tablinks = document.getElementsByClassName("tablinks"); // vejo a quantidade de elementos como o nome da classe 'tablinks'
  for (i = 0; i < tablinks.length; i++) { // vejo quantos campos com o nome da classe 'tablinks' existem e itero dentro dessa quantidade
    tablinks[i].className = tablinks[i].className.replace(" active", "");//faço a desativação das classes não utilizadas
  }
  document.getElementById(subject).style.display = "block";// mostro apenas a classe passada no click
  evt.currentTarget.className += " active";// ativo o conteudo dessa aba para q seja mostrado
}
document.getElementById("defaultOpen").click();// chama a função e mostra apenas o elemnto declarado como default no HTML
