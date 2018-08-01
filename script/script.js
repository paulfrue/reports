function perspectiveReset(obj) {
    $(obj).attr("style", "");
}

function perspectiveChanger(obj) {    
    $(obj).attr("style", "z-index: 2; transform: translateX(-50%) scale(1.2); box-shadow: 0px 0px 50px 10px rgba(0,0,0,1);");
}

function menu() {
    var menu = document.getElementById("menu_wrapper");
    var menu_item = document.getElementsByClassName("menu_item_wrapper");
	var menu_close = document.getElementById("menu_close");
    if(menu.getAttribute("style") != "width: 230px;") {
        document.getElementById("bglayer").setAttribute("style", "display: block;");
        setTimeout(function() {
            document.getElementById("bglayer").setAttribute("style", "display: block; opacity: 1;");
        },100);
        setTimeout(function() { 
            menu.setAttribute("style", "width: 230px;");
			menu_close.setAttribute("style", "left: 235px;");
        },100);
        setTimeout(function() {
            for(var i = 0; i < menu_item.length; i++){
                menu_item[i].setAttribute("style", "opacity: 1;");
            }
        },200);
    }
    else {
        document.getElementById("menu_wrapper").setAttribute("style", "");
        document.getElementById("bglayer").setAttribute("style", "display: block;");
        setTimeout(function() {
           document.getElementById("bglayer").setAttribute("style", "");
		   menu_close.setAttribute("style", "");
        },100);
        for(var i = 0; i < menu_item.length; i++){
            menu_item[i].setAttribute("style", "");
        }
    }
}

function hour_count() {
    var total_hours = 0;
    var hours = document.getElementsByClassName("hours");
    for(var i = 0; i < hours.length; i++){
        if(!isNaN(hours[i].value) && hours[i].value != ""){
            var new_hours = parseFloat(hours[i].value);
            total_hours = total_hours + new_hours;
            document.getElementById("hour_counter").innerHTML = "Gesamtstunden:&nbsp;"+total_hours;
        }
    }
}

function rand(index) {
    $.get("modules_functions/function_random.php", function (data) {
        switch(index){
            case 0:
            document.getElementById("ajax0").setAttribute("value", data);
                break;
            case 1:
            document.getElementById("ajax1").setAttribute("value", data);
                break;
            case 2:
            document.getElementById("ajax2").setAttribute("value", data);
                break;
            case 3:
            document.getElementById("ajax3").setAttribute("value", data);
                break;
            case 4:
            document.getElementById("ajax4").setAttribute("value", data);
                break;
            case 5:
            document.getElementById("ajax5").setAttribute("value", data);
                break;
            case 6:
            document.getElementById("ajax6").setAttribute("value", data);
                break;
            case 7:
            document.getElementById("ajax7").setAttribute("value", data);
                break;
            case 8:
            document.getElementById("ajax8").setAttribute("value", data);
                break;
            case 9:
            document.getElementById("ajax9").setAttribute("value", data);
                break;
        }
    })
}

function text(txt){
    document.getElementById("ajax0").setAttribute("value", txt);
}