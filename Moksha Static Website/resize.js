if (document.documentElement.clientWidth>=1000)
{
	var imgb = document.getElementById("bckimg");
	var overlay = document.getElementById("overlay");
	imgb.style.height = window.innerHeight+"px";
	overlay.style.height = imgb.style.height;
}
