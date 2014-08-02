// Copyright © 2014 Max Penrose

$('.topic').click(function(){
	console.log('resize')
	var elem = $(this).get(0);
	if(elem.className.indexOf('thin') > -1){ // is thin
		$('.topic').removeClass('thick');
		$('.topic').addClass('thin');
		elem.className = elem.className.replace('thin','thick');
	} else {
		elem.className = elem.className.replace('thick','thin');
	}
});