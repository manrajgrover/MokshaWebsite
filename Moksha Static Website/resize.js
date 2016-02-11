var resizeFunc = function(){
	var imgb = document.getElementById("bckimg");
	var overlay = document.getElementById("overlay");
	if (document.documentElement.clientWidth>=1000)
	{
		imgb.style.height = window.innerHeight+"px";
		overlay.style.height = imgb.style.height;
	}
	else
	{
		imgb.style.height = "100%";
		overlay.style.height = "100%";
	}
}

window.onload = resizeFunc;
window.onresize = resizeFunc;

window.onload();
window.onresize();
