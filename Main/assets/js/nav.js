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
				event_page.style.left = "200%";
				break;
			case "Events":
				competitions.style.left="-100%";
				event_category.style.left = "0%";
				event_page.style.left = "100%";
				break;
			case "Competitions":
				competitions.style.left = "-200%";
				event_category.style.left = "-100%";
				event_page.style.left = "0%";
				break;
		}
	};
}
// nav.getElementsByTagName('li')[1].onclick = function(){
// 	alert("Hi");
// };
// alert("Hey");