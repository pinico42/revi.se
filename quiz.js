var questionBox = document.getElementById('question');
var input = document.getElementById('answer');
var quizdiv = document.getElementById('quiz');
var currentQ = '';
var currentA = '';
var correct = 0;
var done = 0;
var keys = Object.keys(questions);


function getPercentage(correctqs, done){
	return (correctqs/done)*100;
}

function setBgColor(percentage){
	var color = "hsla("+Math.floor((percentage*1.1))+", 100%, 30%, 1)";
	document.getElementsByTagName('body')[0].style.backgroundColor = color;
}

function simplify(string){
	var simpleString = string.replace(/[\.,-\/#!?$%\^&\*;:{}=\-_`~()]/g,"");
	return simpleString.toLowerCase();
}

function iscorrect(){
	input.style.backgroundColor = "hsla(110, 100%, 30%, 1)";
	correct = correct + 1;
	setBgColor(getPercentage(correct,done));
	window.setTimeout(writeQuestion, 2000);
}

function incorrect(){
	input.style.backgroundColor = "hsla(0, 100%, 40%, 1)";
	setBgColor(getPercentage(correct,done));
}

function submitAnswer(){
	done++

	ca = simplify(currentA);
	a = simplify(input.value);
	if(ca == a){
		iscorrect();
	} else {
		incorrect();
	}
	console.log('next...')
	window.setTimeout(writeQuestion, 2000);
}

function writeQuestion(){
	console.log('go')
	var q = keys[done];
	if(!q){

	} else {
		currentQ = q
		var a = questions[q];
		currentA = a
	}
	question.innerHTML = q;
}

writeQuestion();