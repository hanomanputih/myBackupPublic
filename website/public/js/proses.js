function displayLoading(msg){
        $("#info").hide();   
        $("#info").removeClass();
        $("#info").addClass("alert_warning");
        $("#info").html(msg);
        $("#info").slideDown(300);
}

function displayLoadingPopup(msg){
    $(".content h4").hide();   
    $(".content h4").removeClass();
    $(".content h4").addClass("yellow-alert");
    $(".content h4").html(msg);
    $(".content h4").slideDown(300);
}
function displayMessagePopup(attr,msg){
    $(".content h4").hide();   
    $(".content h4").removeClass();
    $(".content h4").addClass(attr);
    $(".content h4").html(msg);
    $(".content h4").slideDown(300);
}
function clearPopup(){
    $(".content h4").hide();
    $(".content input.nim").val("");
}
function displayLoadingLogin(msg){
    $("#info").hide();   
    $("#info").removeClass();
    $("#info").addClass("yellow-left");
    $("#info").html(msg);
    $("#info").slideDown(300);
}
function displayMessage(attr,msg){
    $("#info").hide();
    $("#info").removeClass();
    $("#info").addClass(attr);
    $("#info").html(msg);
    $("#info").slideDown(300);
}