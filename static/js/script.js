/*function clickOncity(e,id) {
    //console.log(e);
    $("#city").val(e.target.innerHTML);
    $("#cityId").val(id);
}
$(document).ready(function() {
    $("#city").on("input",function() {
       var inpVal;
       var url = "http://localhost/site_news/api/getAllCity/";
       inpVal = $(this).val();
       $.get(
           url + inpVal,
           function(res) {
               var str = "";
               if (res) {
                   //$("#cityList").html("");
                   var arr = JSON.parse(res);

                    for (var i=0;i<arr.length;i++) {
                        var city = arr[i];
                        //console.log(city['city']);
                        //$("#cityList").append("<li>" + city['city'] + "</li>");
                        str += "<li class='cityName' onclick='clickOncity(event,"+ city['id'] +")'>" + city['city'] + "</li>";
                    }
                   $("#cityList").html(str);
               } else {
                   $("#cityList").html("");
               }
           }
       );
   });

});*/
function getEvent(e,idUser) {
    if (!e) e = window.event;
    //alert(e.target.id);
     if (e.target.name=='subs') subsFun(e.target.id, idUser);
     if (e.target.name=='unsubs') unsubsFun(e.target.id, idUser);
    
}
function subsFun(idAutor,idUser) {
    //var url = "https://site-news-vtshark.c9users.io/subscribe/";
    //var url = "/subscribe/";
    var url = "http://localhost/site_news/subscribe/";
    $.post(url, { idUser: idUser, idAutor: idAutor},
    function(res) {
        //console.log(res);
        var str = "<span class='glyphicon glyphicon-ok'></span>\
                    <button name='unsubs' id='"+idAutor+"' type='button' \
                    class='btn btn-default btn-xs' title='Отписаться'>\
                    <span class='glyphicon glyphicon-remove'></span>\
                    </button>";
        var div = $("#divright"+idAutor).html(str);
    });

}
function unsubsFun(idAutor,idUser) {
    //var url = "https://site-news-vtshark.c9users.io/subscribe/";
    //var url = "/subscribe/unsubs/";
    var url = "http://localhost/site_news/subscribe/unsubs/";
    $.post(url, { idUser: idUser, idAutor: idAutor},
    function(res) {
        //console.log(res);
        var str = "<button name='subs' id='"+idAutor+"' type='button'"+
                    "class='btn btn-default btn-xs' title='Подписаться'>" +
                    "<span class='glyphicon glyphicon-plus'></span>" +
                    "</button>";
        var div = $("#divright"+idAutor).html(str);
    });

}
