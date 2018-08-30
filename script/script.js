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

function form_enable_company() {
    document.getElementById("shift").setAttribute("style", "");
    document.getElementById("shift_time").setAttribute("style", "");
}

function form_disable_school() {
    document.getElementById("shift").setAttribute("style", "display: none;");
    document.getElementById("shift_time").setAttribute("style", "display: none;");
}

function form_disable_check() {
    setTimeout(function() {
        if (document.getElementById("check1").checked) {
            document.getElementById("shift_time_custom").setAttribute("style", "display:none;");
        }
        else if (document.getElementById("check2").checked) {
            document.getElementById("shift_time_custom").setAttribute("style", "display:none;");
        }
        else if (document.getElementById("check3").checked) {
            document.getElementById("shift_time_custom").setAttribute("style", "display:none;");
        }
        else if (document.getElementById("check4").checked) {
            document.getElementById("shift_time_custom").setAttribute("style", "display:none;");
        }
        else {
            document.getElementById("shift_time_custom").setAttribute("style", "");
        }
    },100);
}

function suggest(index, value) {
    $.get("modules_functions/function_suggest.php?value="+value+"", function (data) {
        document.getElementById("suggest"+index).innerHTML = data;
    })
}

function apply_suggest(index) {
    var text = document.getElementById("suggest"+index).innerHTML;
    document.getElementById("ajax"+index).value = text;
    document.getElementById("suggest"+index).innerHTML = "";
}

function suggest_clear() {
    for (var i = 0; i <= 20; i++) {
        document.getElementById("suggest"+i).innerHTML = "";
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
        document.getElementById("ajax"+index).setAttribute("value", data);
    })
}