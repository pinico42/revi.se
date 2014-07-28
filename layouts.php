<?php
class Layout {
	var $header;
	var $footer;

	function __construct($header, $footer){
		$this->header = $header;
		$this->footer = $footer;
	}

	function writeHeader(){
		echo $this->header;
	}

	function writeFooter(){
		echo $this->footer;
	}
}

function getLayout($layoutPage){
	try {
		$file = fopen($layoutPage, "r");
	} catch(Exception $e) {
		throw new Exception('Unknown layout file');
	}
	$fileText = fread($file, filesize($layoutPage));
	fclose($file);

	$textParts = explode("@content", $fileText);
	if(sizeof($textParts) < 2){
		throw new Exception('No @content marker in file');
	} else if(sizeof($textParts) > 2) {
		throw new Exception('Too many @content markers in file');
	} else {
		$header = $textParts[0];
		$footer = $textParts[1];
		return new Layout($header, $footer);
	}
}
?>