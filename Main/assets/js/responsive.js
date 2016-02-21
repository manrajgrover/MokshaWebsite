function load()
{
	 $("#toggle").click(function(){
        $("#panel").slideToggle("slow");
    });

}


var width = $(window).width();
var ld = load;
$(document).ready(load);
$(document).resize(load);