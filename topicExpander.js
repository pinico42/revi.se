$('.topic').click(function(){
	console.log('resize')
	if($(this).width() == '20vh'){ // thin - not selected
		$('.topics').width('20vh');
		$(this).width('30vh');
	}
});