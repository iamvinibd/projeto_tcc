var SlideIndex = 0;
AutomaticSlides();
function AutomaticSlides(){
	var x;
	var SlidesArray = document.getElementsByClassName("SlideShow");
	for(x=0;x<SlidesArray.length;x++){
		SlidesArray[x].style.display = "none";
	}
	SlideIndex++;
	if (SlideIndex>SlidesArray.length){
		SlideIndex = 1;
	}
	SlidesArray[SlideIndex-1].style.display = "block";
	setTimeout(AutomaticSlides,4000);
}
