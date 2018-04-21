/**
 * @version $Id: joobb.js 183 2010-10-12 16:36:14Z sterob $
 * @package Joo!BB
 * @copyright Copyright (C) 2007-2010 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!BB directory 
 * for copyright notices and details.
 * Joo!BB is free software. This version may have been NOT modified.
 */

function addBBCode(element, tag, param) {
	var element = document.getElementById(element);
	
	// create the start tag
	if (param != null && param != '') {
	    var startTag = '['+tag+'='+param+']';
	} else {
	    var startTag = '['+tag+']';
	}	
	
	// create the end tag
	var endTag = '[/'+tag+']';
	
	if (typeof element.selectionStart != 'undefined') {
	
		// save current cursor position
		var curPos = element.selectionStart;
				
		// add bb code around the selection
		var selectedText = element.value.substring(element.selectionStart, element.selectionEnd);
		var bbCodeText = startTag + selectedText + endTag;
		element.value = element.value.substr(0, element.selectionStart) + bbCodeText + element.value.substr(element.selectionEnd);
		
		// set cursor
		if (selectedText.length == 0) {
			posNew = curPos + startTag.length;		// between start and end tag
		} else {
			posNew = curPos + bbCodeText.length;	// after end tag
		}
		
		element.setSelectionRange(posNew, posNew);
	} else if (typeof document.selection != 'undefined') {
		
		// we need to fucus the element first!
		element.focus();
		var range = document.selection.createRange();
		var storedRange = range.duplicate();
		
		storedRange.moveToElementText(element);
		storedRange.setEndPoint('EndToEnd', range);
		
		element.selStart = storedRange.text.length - range.text.length;
		element.selEnd = element.selStart + range.text.length;

		// add bb code around the selection
		var selectedText = element.value.substring(element.selStart, element.selEnd);
		var bbCodeText = startTag + selectedText + endTag;

		range.text = bbCodeText;
		
		// set cursor
		if (selectedText.length == 0) {
			posNew = element.selStart + startTag.length;	// between start and end tag
		} else {
			posNew = element.selStart + bbCodeText.length;	// after end tag
		}

		var textRange = element.createTextRange();
		textRange.move("character", posNew);
		textRange.select();		
	
	} else {
		element.value += startTag + endTag;
	}
	
	// set the focus back to the element
	element.focus();
	return;
}

function addEmotion(element, emotion) {
	var element = document.getElementById(element);
	
	if (typeof element.selectionStart != 'undefined') {
		
		// save current cursor position
		var curPos = element.selectionStart;
		
		// add emotion at the current position
		element.value = element.value.substring(0, element.selectionStart) + emotion + element.value.substring(element.selectionEnd);
		
		// set cursor directly after the added emotion
		posNew = curPos + emotion.length;
		element.setSelectionRange(posNew,posNew);
	} else if (typeof document.selection != 'undefined') {
		element.focus();
		range = document.selection.createRange();
		range.text = emotion;
	} else {
		element.value += emotion;
	}
	
	// set the focus back to the element
	element.focus();
	return;
}

function toggleDisplay(divId) {
	var div = document.getElementById(divId);
	div.style.display = (div.style.display=="block" ? "none" : "block");
}