var questionBox = document.getElementById('question');
var input = document.getElementById('answer');
var quizdiv = document.getElementById('quiz');
var currentQ = '';
var currentA = '';
var correct = 0;
var done = 0;
var keys = Object.keys(questions);

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = 0, len = this.length; i < len; i++) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}

function onEnter(e){
	if(e.keyCode == 13){
		submitAnswer();
	}
}

function getPercentage(correctqs, done){
	return (correctqs/done)*100;
}

function setBgColor(percentage){
	var color = "hsla("+Math.floor((percentage * 1.1))+", 63%, 69%, 1)";
	document.getElementsByTagName('body')[0].style.backgroundColor = color;
}

function simplify(string){
	var simpleString = string.replace(/[\.,-\/#!?$%\^&\*;:{}=\-_`~()]/g,"");
	return simpleString.toLowerCase();
}

function iscorrect(){
	input.style.backgroundColor = "hsla(110, 40%, 40%, 1)";
	input.style.backgroundImage = "url(images/tick.png)";
	correct = correct + 1;
	setBgColor(getPercentage(correct,done));
	window.setTimeout(writeQuestion, 2000);
}

function incorrect(){
	input.style.backgroundColor = "hsla(0, 60%, 50%, 1)";
	input.style.backgroundImage = "url(images/cross.png)";
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
	window.setTimeout(writeQuestion, 2000);
}

function showDone(){
	document.getElementById('quiz').remove();
	var pquiz = document.getElementById('post-quiz')
	pquiz.style.display = 'block';
	console.log('flip');
	pquiz.innerHTML = Math.round(getPercentage(correct, done)) + '%';
	pquiz.innerHTML += '<br/><a href="index.php"><button>Back to Home</button></a>';
	window.setTimeout(function(){pquiz.className = '';},50);
	$.ajax('updateAbilities.php?r='+correct+'&d='+done+'&u='+uid+'&m='+email);
}

function writeQuestion(){
	input.value = '';
	input.style.backgroundColor = 'transparent';
	input.style.backgroundImage = 'none';
	var q = keys[done];
	if(q == undefined){
		showDone();
	} else {
		currentQ = q
		var a = questions[q];
		currentA = a
	}
	question.innerHTML = q;
}

writeQuestion();