$( document ).ready(function() {

  menu_mobile();
  menu_activo();
  vermasLista();
  //subMenu();
  //whatssap();
  carrousel();
  acordiones();
  //comparador();
  caja_pestanas();
  scroller();

  if ($(window).width() > 768) {    
    $('.alturaMatch').matchHeight();
  }      
  
  
  if($(".wrapper_home").length > 0){
    precarga_home();
    slider();
  }

  if($(".seccion_promociones").length > 0){
    slider();
  }

  if($(".seccion_nuestros_locales").length > 0){
    mapa();
  }

  if($(".marcas_representadas_interna").length > 0){
    fancys();
  }

  if($('.jssor_box').length > 0){
    jssor_slides();
  }

  $(function () {
    "use strict";

    $("#video_player").on("canplaythrough", function () {
        console.log(5);
        var timer = false;  
        timer = setTimeout(function(){    
          $(".poster_fondo").fadeOut();
          $("#video_player")[0].play();

        }, 100);
    });
  });

});


$( window ).resize(function() {

});


function menu_activo(){
  if($('.seccion_nosotros').length > 0){
    $("li.menu_nosotros").addClass("activo on");
  }
  if($('.seccion_mercados').length > 0){
    $("li.menu_mercados").addClass("activo on");
  }
  if($('.seccion_productos').length > 0){
    $("li.menu_productos").addClass("activo on");
  }
  if($('.seccion_repuestos').length > 0){
    $("li.menu_repuestos  ").addClass("activo on");
  }
  if($('.seccion_servicios').length > 0){
    $("li.menu_servicios").addClass("activo on");
  }
  if($('.seccion_tecnologia').length > 0){
    $("li.menu_tecnologia").addClass("activo on");
  }
  if($('.seccion_novedades').length > 0){
    $("li.menu_novedades").addClass("activo on");
  } 
  if($('.seccion_promociones').length > 0){
    $("li.menu_promociones").addClass("activo on");
  }
  if($('.seccion_nuestros_locales').length > 0){
    $(".barra_header .botonera .menu_nuestros_locales").addClass("activo on");
  }
  if($('.seccion_escribenos').length > 0){
    $(".barra_header .botonera .menu_escribenos").addClass("activo on");
  }

  if($('.seccion_principal').length > 0){
    $("ul.producto_menu li.principal").addClass("activo");
  }
  if($('.seccion_informacion').length > 0){
    $("ul.producto_menu li.informacion").addClass("activo");
  }
  if($('.seccion_beneficios').length > 0){
    $("ul.producto_menu li.beneficios").addClass("activo");
  }
  if($('.seccion_comparar').length > 0){
    $("ul.producto_menu li.comparar").addClass("activo");
  }
  if($('.seccion_cotizar').length > 0){
    $("ul.producto_menu li.cotizar").addClass("activo");
  }
}



function precarga_home(){
  var imageload = {
    1 : 'images/banner.jpg',
  };
  var loader = new PxLoader();
  for( pos in imageload ){
    var pxImage = new PxLoaderImage( imageload[pos] );
    loader.add(pxImage);
  }
  loader.addProgressListener(function(e){
    var percentage = Math.ceil( ( e.completedCount / e.totalCount ) * 100 );
  });
  loader.addCompletionListener(function(){
    $('#loader').fadeOut("slow");
    var timer=false
    timer = setTimeout(function(){
      //homeAlturaGaleria();

    }, 10)
  });
  loader.start();
}




function menu_mobile(){
  var timer = false;  
  timer = setTimeout(function(){    

    $(".menu_mobile .sanguche").on({
      click: function(e){         

        $(".wrapper").addClass("wrap_mobile");
        $("body").addClass("nonescroll");
        $("header").addClass("mobile");
        $(".menu_mobile").addClass("activado");
        //$(".sombra").fadeIn();

        var alturaWindow = $(window).height();
        $("header .contenedor_header").css({"height": alturaWindow});
        $("ul.menu li .contenedor_sub_menu").hide();
        $("ul.menu li ul.sub_menu li").removeClass('abierto');
        $("ul.menu li").removeClass('abierto');
        $("ul.menu li ul.ultra_menu").hide('slow');

        $(".menu_mobile .sanguche").hide();
        $(".menu_mobile .mobile_tools").fadeIn();
      }
    })    

    $(".menu_mobile .mobile_tools .btn_close").on({
      click: function(e){        
        $(".wrapper").removeClass("wrap_mobile");
        $("body").removeClass("nonescroll");
        //$(".sombra").fadeOut();
        $("ul.menu li .contenedor_sub_menu").hide();
        $("ul.menu li ul.sub_menu li").removeClass('abierto');
        $("ul.menu li").removeClass('abierto');
        $("ul.menu li ul.ultra_menu").hide('slow');
        $("header").removeClass("mobile");
        $(".menu_mobile").removeClass("activado"); 
        $(".menu_mobile .sanguche").fadeIn();
        $(".menu_mobile .mobile_tools").hide(); 
      }
    })  

  }, 200);


$("ul.menu li .menu_padre").on({
  click: function(){
    if($(this).parent().hasClass("abierto")){
      $(this).parent().find(".contenedor_sub_menu").slideUp();
      $(this).parent().find("ul.sub_menu li").removeClass('abierto');
      $(this).parent().removeClass('abierto');
      $(this).parent().find("ul.ultra_menu").slideUp('slow');
    }
    else{
      $(this).parent().find(".contenedor_sub_menu").slideDown('slow');
      $(this).parent().toggleClass( "abierto" );
      $(this).parent().siblings().find(".contenedor_sub_menu").slideUp('slow');
      $(this).parent().siblings().find("ul.ultra_menu").slideUp('slow');
      $(this).parent().siblings().removeClass('abierto');
      $(this).parent().siblings().find("ul.sub_menu li").removeClass('abierto');
    }
  }
})

$("ul.menu li ul.sub_menu li .menu_hijo").on({
  click: function(){
    if($(this).parent().hasClass("abierto")){
      $(this).parent().find("ul.ultra_menu").slideUp();
      $(this).parent().removeClass('abierto');
    }
    else{
      $(this).parent().find("ul.ultra_menu").slideDown('slow');
      $(this).parent().toggleClass( "abierto" );
      $(this).parent().siblings().find("ul.ultra_menu").slideUp('slow');
      $(this).parent().siblings().removeClass('abierto');
    }      
  }
})

  /*$(".menu_mobile .mobile_tools .buscador").on({
    click: function(e){        
      $(".menu_mobile .mobile_tools .buscador").addClass("opened");
    }
  })*/

$("ul.menu li").hover(function() {
  $(this).siblings("li").removeClass("activo");
}, function() {
  $(this).siblings("li.on").addClass("activo");
});
}



function slider(){  
  $('.slider').bxSlider({
    mode: 'fade',
    pager: true,
    speed: 300,
    auto: true,
    pause: 7000,
    controls: true,
    touchEnabled: false,
    responsive: true,    
  });

   $('.slider_promociones').bxSlider({
    mode: 'fade',
    pager: true,
    speed: 300,
    auto: false,
    pause: 7000,
    controls: true,
    touchEnabled: false,
    responsive: true,    
  });
}



function fancys(){
  $('.fancybox').fancybox();

  if(location.hash){
    $(location.hash).click();
  }

  $(".fancybox_video").click(function() {
    $.fancybox({
      'padding'   : 0,
      'autoScale'   : false,
      'transitionIn'  : 'none',
      'transitionOut' : 'none',
      'title'     : this.title,
      'width'     : 640,
      'height'    : 385,
      'href'      : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
      'type'      : 'swf',
      'swf'       : {
        'wmode'       : 'transparent',
        'allowfullscreen' : 'true',
      }
    });
    return false;
  }); 
}



function subMenu(){  
  var widthSubMenu = $("ul.menu").width();
  var firstLiWidth = $("ul.menu li:nth-child(1)").width();
  var secondLiWidth = $("ul.menu li:nth-child(2)").width();
  var sumaLiWidth = firstLiWidth + secondLiWidth + 42.4;
  var margenLeft = "-" + sumaLiWidth + "px";  

  $(".contenedor_sub_menu").css("width",widthSubMenu);
  //$(".contenedor_sub_menu").css("left",margenLeft);
}


function whatssap(){
  document.getElementById("whatssap_number").style.visibility = "hidden";
  var ua = navigator.userAgent.toLowerCase();
  var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
  if(isAndroid) {
    document.getElementById("whatssap_number").style.visibility = "visible";
    alert("wassap");
  }
}



function vermasLista(){
  $('.fade-anchor').click(function(e){
    e.preventDefault();
    $(this).parent().css('max-height','100%');

    $(this).hide();
    $(this).parent().find(".vermenos").fadeIn()
  });
  $(".vermenos").click(function(e){
    e.preventDefault();
    $(this).hide();
    $(this).parent().css('max-height','150px');
    $(this).parent().find(".fade-anchor").show()
  })
}


function carrousel(){
  var owl = $('.owl-carousel');
    owl.owlCarousel({
    margin: 10,
    loop: true,
    nav: true,
    autoplay: false,
    autoplayTimeout: 5000,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      800: {
        items: 3
      },
      1000: {
        items: 3
      }
    }
  })
}


function mapa() {
  var uluru = {lat: -12.113292, lng: -77.034483};
  var map = new google.maps.Map(document.getElementById('ubication_map'), {
    zoom: 16,
    center: uluru
  });
  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });
}




function jssor_slides(){
    var _SlideshowTransitions = [
      { $Duration: 1200, $Opacity: 2 }    
    ];
    var options = {
        $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
        $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
        $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

        $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
        $ArrowKeyNavigation: true,                    //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
        $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

        $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
            $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
            $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
            $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
            $ShowLink: true,                                //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
        },

        $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
        },

        $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
            $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
            $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

            $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
            $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
            $DisplayPieces: 5,                             //[Optional] Number of pieces to display, default value is 1
            $ParkingPosition: 150,                          //[Optional] The offset position to park thumbnail
            $Orientation: 1
        }
    };

    var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth, 1010));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
    //responsive code end       
}


function acordiones(){
  $("ul.acordion li:nth-child(1)").toggleClass( "activo" );
  $("ul.acordion li:nth-child(1) .contenido").slideDown('slow');
  $("ul.acordion li .titulo").on({
    click: function(e){
    console.log("cli");
      if($(this).parent().hasClass("activo")){
        $(this).parent().find(".contenido").slideUp('slow');
        $(this).parent().removeClass( "activo" );
      }
      else{
        $("ul.acordion li .contenido").slideUp('slow');
        $("ul.acordion li").removeClass( "activo" );
        $(this).parent().find(".contenido").slideDown('slow');
        $(this).parent().toggleClass( "activo" );
      }
    }
  })
}


function comparador(){
  $(".comparar .campo_check").on({
    click: function(){
      $(".comparador").addClass("activo");
    }
  })
}


function caja_pestanas(){

   $("ul.lista_detalle > li:first-child").show();

  $("ul.lista_pestanas li").on({
    click: function(){
      var nindex = $(this).index();
      console.log(nindex);
      $("ul.lista_pestanas li").removeClass("activo");
      $("ul.lista_detalle > li").hide();
      $(this).addClass("activo")
      $("ul.lista_detalle > li:eq("+nindex+")").show();
    }
  })
}


function scroller(){
  var containers = $('html, body');
  $('.scroller').on('click', 'a', function(e) {
    var el = $($(this).attr('href'));
    if (el.length > 0) {
      e.preventDefault();
      containers.animate({
        scrollTop: el.offset().top
      }, 700);
    }
  });
}

function validarRUC(ruc) {
    //11 dígitos y empieza en 10,15,16,17 o 20
    if (!(ruc >= 1e10 && ruc < 11e9
       || ruc >= 15e9 && ruc < 18e9
       || ruc >= 2e10 && ruc < 21e9))
        return false;
    
    for (var suma = -(ruc%10<2), i = 0; i<11; i++, ruc = ruc/10|0)
        suma += (ruc % 10) * (i % 7 + (i/7|0) + 1);
    return suma % 11 === 0;
    
}