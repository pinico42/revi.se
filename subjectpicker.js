// Copyright © 2014 Max Penrose

$(document).ready(function(){
  var availableSubjects = [
    "Maths",
    "English Literature",
    "English Language",
    "Geography",
    "History",
    "Biology",
    "Physics",
    "Chemistry",
    "Religious Studies",
    "French",
    "Music",
    "German",
    "Spanish",
    "Latin",
    "Greek",
    "Art",
  ];
  $( ".subjectPick" ).autocomplete({
    source: availableSubjects
  });
});
function newSubject(){
  var selectionCount = document.querySelectorAll("#subjectPicker > div").length + 1;


  var sub = document.createElement('div');
  sub.className = 'subjectPickerSubject';

  var input = document.createElement('input');
  input.placeholder = 'Subject';
  input.className = 'subjectPick';
  input.name = 's' + selectionCount;
  sub.appendChild(input);

  var select = document.createElement('select');
  select.name = 'b' + selectionCount;

  var optionAQA = document.createElement('option');
  optionAQA.value = 'aqa'
  var nodeAQA = document.createTextNode('AQA');
  optionAQA.appendChild(nodeAQA);
  select.appendChild(optionAQA);
  var optionAQA = document.createElement('option');
  optionAQA.value = 'other'
  var nodeAQA = document.createTextNode('Other');
  optionAQA.appendChild(nodeAQA);
  select.appendChild(optionAQA);

  sub.appendChild(select);

  document.getElementById('subPickarea').appendChild(sub);

  var availableSubjects = [
    "Maths",
    "English Literature",
    "English Language",
    "Geography",
    "History",
    "Biology",
    "Physics",
    "Chemistry",
    "Religious Studies",
    "French",
    "Music",
    "German",
    "Spanish",
    "Latin",
    "Greek",
    "Art",
  ];
  $( ".subjectPick" ).autocomplete({
    source: availableSubjects
  });
}