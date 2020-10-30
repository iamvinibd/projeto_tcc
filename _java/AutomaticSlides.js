var SlideIndex = 0; //crio a variável SlideIndex com valor inicial 0
AutomaticSlides(); // Chamo a função para q ela fique acontecendo na página
function AutomaticSlides(){ // crio a função chamada AutomaticSlides
	var x; // declaro uma váriavel x
	var SlidesArray = document.getElementsByClassName("SlideShow"); // crio a variável SlideArray e guardo nela um array de todos os elementos da página que são da classe SlideShow
	for(x=0;x<SlidesArray.length;x++){ // começando xem 0 até x<quantidade de elementos no slide array
		SlidesArray[x].style.display = "none"; //para esse slide, mudo dentro do estilo o status do display para 'none' (todos ja começam com display:none no estilo)
	}
	SlideIndex++; // incremento o indice
	if (SlideIndex>SlidesArray.length){ // checo se ja cheguei no limite da quantidade de imagens
		SlideIndex = 1; // se tiver chego no limite volto para o segundo indice
	}
	SlidesArray[SlideIndex-1].style.display = "block"; // decremento o indice atual e para essa imagem mudo o estilo dela para display:block, nesse caso a imagem sera mostrada para o usuário
	setTimeout(AutomaticSlides,4000); // declaro um tempo de timeout até chamar a função automatic slide novamente 4 segundos
}
