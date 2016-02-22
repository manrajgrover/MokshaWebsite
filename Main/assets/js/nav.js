var nav = document.getElementById('panel'),
	competitions = document.getElementById('competitions-page'),
	event_category = document.getElementById('event-category-page'),
	event_page = document.getElementById('event-page');


for (var i = nav.getElementsByTagName('li').length - 1; i >= 0; i--) {
	nav.getElementsByTagName('li')[i].onclick = function(){
		switch(this.innerHTML){
			case "Home":
				competitions.style.left= "10%";
				event_category.style.left = "100%";
				event_page.style.left = "100%";
				
				competitions.style.visibility = "visible";
				event_category.style.visibility = "hidden";
				event_page.style.visibility = "hidden";
				break;
			case "Events":
				competitions.style.left="-100%";
				event_category.style.left = "0%";
				event_page.style.left = "100%";
				
				event_category.style.visibility = "visible";
				competitions.style.visibility = "hidden";
				event_page.style.visibility = "hidden";
				break;
			case "Competitions":
				competitions.style.left = "-100%";
				event_category.style.left = "-100%";
				event_page.style.left = "0%";
				
				event_page.style.visibility = "visible"
				event_category.style.visibility = "hidden";
				competitions.style.visibility = "hidden";
				break;
		}
	};
}
// nav.getElementsByTagName('li')[1].onclick = function(){
// 	alert("Hi");
// };
// alert("Hey");