function Toast(msg,cor) {
    var x = document.getElementById("snackbar");
    x.className = "show";
    $('#snackbar').addClass(cor)
    $('#snackbar').html(msg)
    setTimeout(function(){ 
        x.className = x.className.replace("show", ""); 
        $('#snackbar').removeClass(cor)
    }, 3000);
}