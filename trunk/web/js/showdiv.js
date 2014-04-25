var intTimeStep = 20;
var isIe = (window.ActiveXObject) ? true : false;
var intAlphaStep = (isIe) ? 5 : 0.05;
var curSObj = null;
var curOpacity = null;
function startObjVisible(objId) {
	curSObj = document.getElementById(objId);
	setObjState();
}
function setObjState(evTarget) {
	//alert(curSObj.style.display );
	if (curSObj.style.display == "") {
		curOpacity = 1;
		setObjClose();
	} else {
		if (isIe) {
			curSObj.style.cssText = 'DISPLAY: none;Z-INDEX: 1; FILTER: alpha(opacity=0); POSITION: absolute;';
			curSObj.filters.alpha.opacity = 0;
		} else {
			curSObj.style.opacity = 0
		}
		curSObj.style.display = '';

		curOpacity = 0;
		setObjOpen();
	}
}

function setObjOpen() {
	if (isIe) {
		curSObj.filters.alpha.opacity += intAlphaStep;
		if (curSObj.filters.alpha.opacity < 100)
			setTimeout('setObjOpen()', intTimeStep);
	} else {
		curOpacity += intAlphaStep;
		curSObj.style.opacity = curOpacity;
		if (curOpacity < 1)
			setTimeout('setObjOpen()', intTimeStep);
	}
}

function setObjClose() {
	if (isIe) {
		curSObj.filters.alpha.opacity -= intAlphaStep;
		if (curSObj.filters.alpha.opacity > 0) {
			setTimeout('setObjClose()', intTimeStep);
		} else {
			curSObj.style.display = "none";
		}
	} else {
		curOpacity -= intAlphaStep;
		if (curOpacity > 0) {
			curSObj.style.opacity = curOpacity;
			setTimeout('setObjClose()', intTimeStep);
		} else {
			curSObj.style.display = 'none';
		}
	}
}