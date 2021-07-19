var fixedNav = false,
    carouselfototimer,
    wHeight,
    wWidth,
    mapcolor_water = "dda9a9",
    mapcolor_white = "f2f2f2",
    mapcolor_dark = "d6d6d6",
    mapcolor_contrast = "04eefd",
    map_defaultzoom = 16;

if (!jqMi){
var jqMi = jQuery.noConflict();
}

(function($){

//    console.log("general.js, using jQuery v."+jqMi.fn.jquery);
// no console.log in IE8: http://stackoverflow.com/questions/690251/what-happened-to-console-log-in-ie8
//    $(document).keypress("d",function(e){
//      if(e.ctrlKey){
//        var $hgdebug = $('.hg_debug');
//        if ($hgdebug.is(':visible')){
//            $hgdebug.hide();
//        } else {
//            $hgdebug.show();
//        }
//      }
//    });

    $(document).keypress(function(e){
        if(e.ctrlKey && e.charCode == 104){
            $body = $('body');
            if ($body.hasClass('hideAll')){
                $body.removeClass('hideAll');
            } else {
                $body.addClass('hideAll');
            }
        }
    });


    initCarousel();
    initNav();
    var $window = $(window);
    var wHeight = $window.height();
    var wWidth = $window.width();
    $("#holdmap").css("height",wHeight+"px");

    if ($(".list-large").hasClass("filterable")){
        $('.category-nav').on("click", 'li a',function(e){
            var curcat = $(this).data('catalias');
            $(e.delegateTarget).find(".current").removeClass("current");
            $(this).addClass("current");
            var $listlarge = $(".list-large");
            $listlarge.find('li').show();
            $listlarge.find('li:not([data-itemcat="'+curcat+'"])').hide();
            e.preventDefault();
            return false;
        });
    }



    $(".nav-select").each(function(){
        var $thisnav = $(this);
        var $newselect=  $("<select />");
        var $firstchoice = $thisnav.find("h2").text();

        // Create default option "Go to..."
        $("<option />", {
            "selected": "selected",
            "value"   : "",
            "text"    : $firstchoice+'...'
        }).appendTo($newselect);

        // Populate dropdown with menu items
        $thisnav.find("li > a").each(function() {
            var el = $(this);
            $("<option />", {
                "value"   : el.attr("href"),
                "text"    : el.text()
            }).appendTo($newselect);
        });
        $newselect.appendTo($thisnav);
        //To make dropdown actually work
        //To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
        $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
        });

    });




    if (!Modernizr.mq('only screen and (min-width: 768px)')){
       // so we're not using googlemaps, we'll set an image as the background
       var randlat = makeRandomNumber(2430,7260)/1000;
       var randlng = makeRandomNumber(49410,53660)/1000;
        var newStaticMap = "http://maps.googleapis.com/maps/api/staticmap?center="+randlng+","+randlat+"&zoom="+map_defaultzoom+"&format=png&sensor=false&size="+wWidth+"x"+wHeight+"&maptype=roadmap&style=element:labels|visibility:off&style=element:geometry|color:0x"+mapcolor_white+"&style=feature:water|color:0x"+mapcolor_water+"&style=feature:road|color:0x"+mapcolor_dark+"&style=feature:administrative.country|element:geometry.stroke|color:0x"+mapcolor_contrast+"";

        $("#map_canvas").css("background-image", "url("+newStaticMap+")");
        $("#holdmap").addClass("shown");

    }

    $(".shownav").click(function(){
        var $navtoshow;
        if ($(this).hasClass("metanav")){
           $navtoshow =  $("#meta-nav");
        } else {
            $navtoshow =  $("#main-nav");
        }

        if ($navtoshow.hasClass("navshowed")){
            $(this).removeClass("hidenav");
            $navtoshow.removeClass("navshowed");
        } else {
            $(this).addClass("hidenav");
            $navtoshow.addClass("navshowed");
        }
        return false;
    });

function initNav(){
    if (typeof Modernizr === "undefined"){ // in case we didn't load modernizr (like on db's)
        Modernizr = {mq : function () {}};
    }
    if (Modernizr.touch ){
        $("#main-nav > ul").on("click","li", function(){
            if ($(this).parent().hasClass("menu")){

            } else {
                if ($(this).hasClass("showul")){
                    $(this).removeClass("showul");
                    $(this).addClass("hideul");
                    $(this).blur();
                } else {
                    $(this).addClass("showul");
                    $(this).removeClass("hideul");
                }
            }

        });
    } else {
        $("#main-nav > ul").on("mouseenter mouseleave","li", function(e){
            if (e.type == "mouseleave"){
                $(this).removeClass("showul");
            } else {
                $(this).addClass("showul");
            }
        });
    }
    if (!Modernizr.mq('only screen and (min-width: 760px)')){
        // scrolls document to footer
        $(document).on("click","#meta-nav",function(){
            $("html, body").animate({
                scrollTop: $(document).height()+"px"
            },'slow',function(){
            });
        });
        $("#footer").on("click",".omhoog",function(){
            $("html, body").animate({
                scrollTop: "0px"
            },'slow',function(){
            });
        });

        $(document).on("click","#main-nav",function(e){
            var $mainnav = $(this);
            if (e.target.nodeName == "NAV"){
                if ($(this).hasClass("showmain")){

                   $mainnav.find(">ul").slideUp('slow',function(){
                       $mainnav.removeClass("showmain");
                       $mainnav.find(">ul").css("display","");
                   });
                   $("#site-search").slideUp('slaw',function(){

                   });
               } else {
                   $mainnav.find(">ul").slideDown('slow',function(){
                       $mainnav.addClass("showmain");
                       $mainnav.find(">ul").css("display","");
                   });
                   $("#site-search").slideDown('slaw',function(){

                   });
               }
            } else {
                //alert("no sliding")
            }
        });
    }

    var fixnavdistance = 35; //parseFloat($("#main-nav").css("marginTop"));

    if (fixedNav){
        if ($(document).scrollTop() > fixnavdistance){
            fixNav(fixnavdistance);
        }
    }
    $(window).scroll(function(){
        if ($(window).scrollTop() > fixnavdistance){
            if (!fixedNav){
                fixNav(fixnavdistance);
            }
        } else {
            $("body").addClass('expanded');
            $("#meta-nav").removeClass("navshowed");
        }
    });

}
function initCarousel(){
    var cnt = 0;
    var myinterval = false;
    checkInterval();
    $(".carousel").find(".carousel-thumb li").each(function(){
        var largesrc = $(this).data("largesrc");
        var $thisinfo = $(this).find('.infoholder').html();
        var $newli = $("<li />");
        if (cnt === 0){
            $newli.addClass("current");
            $(this).addClass("current");
            cnt++;
        }
        var $largefig = $('<figure></figure>');
        $largefig.append('<img src="'+largesrc+'" />');
        $newli.append($largefig);
        $newli.append($thisinfo);

        $('.carousel-large ul').append($newli);
    });
    $(".carousel")
        .on('click','.description',function(){
            var $thisdescr = $(this);
            if ($thisdescr.hasClass("isVis")){
    //            clearTimeout(carouselfototimer)
    //            $thisdescr.removeClass('isVis');
            } else {
                $thisdescr.addClass('isVis');
                carouselfototimer = setTimeout(function(){
                    $thisdescr.fadeOut('slow',function(){
                        $thisdescr.removeClass("isVis").css("display","");
                    });
                },4000);
            }
        })
        .on('click','.carousel-large li figure',function(e){

            var $carousel = $(this).parents("ul"),
                $curli = $carousel.find('.current'),
                $curthumb = $(this).parents('.carousel').find('.carousel-thumb').find('.current'),
                $nextli = $curli.next(),
                $nextthumb = $curthumb.next();
            if ($nextli.length){
                $nextli.addClass("current");
            } else {
                $carousel.find("li:first").addClass("current");
            }

            if ($nextthumb.length){
                $nextthumb.addClass("current");
            } else {
                $curthumb.parents('.carousel-thumb').find("li:first").addClass("current");
            }
            checkInterval();
            $curthumb.removeClass("current");
            clearTimeout(mytime);
            var mytime = setTimeout(function(){
                $curli.removeClass("current").appendTo($carousel);
            },200);
        })
        .on('click','.carousel-thumb li',function(){
            var curimg = $(this).index();
            $(this).parents('ul').find(".current").removeClass("current");
            $(this).addClass("current");
            var $carousellarge = $(this).parents(".carousel").find(".carousel-large");
            var $curcur = $carousellarge.find(".current");
            $carousellarge.find('li:eq('+curimg+')').addClass("current");
            checkInterval();
            clearTimeout(mytime);
            var mytime = setTimeout(function(){
                $curcur.removeClass("current");
            },200);
        });
    function checkInterval(){
        if (myinterval){
            clearTimeout(myinterval);
            myinterval = setTimeout(startInterval,5000);
        } else {
            myinterval = setTimeout(startInterval,5000);
        }
    }
    function startInterval(){
        var $nextslide = $('.carousel-thumb li.current').next();
        if ($nextslide.length<1){
            $nextslide = $('.carousel-thumb li:first');
        }
        $nextslide.trigger("click");
    }
}


function fixNav(fixnavdistance){
   $("body").removeClass('expanded');
   if ($(window).scrollTop() <= fixnavdistance) {
       $(window).scrollTop(fixnavdistance + 1);
   }
}




})(jqMi); // end document ready

function makeRandomNumber(min,max){
    return Math.floor(Math.random() * (max - min + 1) + min);
}

(function($) {
    function toggleLabel() {
        var input = $(this);
        setTimeout(function() {
            var def = input.attr('title');
            if (!input.val() || (input.val() == def)) {
                input.prev('label').css('visibility', '');
                if (def) {
//                    var dummy = $('<label></label>').text(def).css('visibility','hidden').appendTo('body');
//                    input.prev('span').css('margin-left', dummy.width() + 3 + 'px');
//                    dummy.remove();
                }
            } else {
                input.prev('label').css('visibility', 'hidden');
            }
        }, 0);
    }

    function resetField() {
        var def = $(this).attr('title');
        if (!$(this).val() || ($(this).val() == def)) {
            $(this).val(def);
            $(this).prev('label').css('visibility', '');
        }
    }

    $(document).on('keydown','input, textarea', toggleLabel);
    $(document).on('paste','input, textarea', toggleLabel);
    $(document).on('change','select', toggleLabel);
    $(document).on('focusin','input, textarea', function() {
        $(this).prev('label').css('color', '#ccc');
    });
    $(document).on('focusout','input, textarea', function() {
        $(this).prev('label').css('color', '#999');
    });

    $(function() {
        $('.smallform .formline input, .smallform .formline textarea').each(function() { toggleLabel.call(this); });
    });

})(jqMi);