/*

TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

*/

'use strict';
$(document).ready(function() {

    // Acordeon
    // Controla el comportamiento de un acordeón en la página
    var all_panels = $('.templatemo-accordion > li > ul').hide();

    $('.templatemo-accordion > li > a').click(function() {
      // Maneja el evento de clic en un elemento del acordeón
        console.log('Hello world!');
        var target =  $(this).next();
        if(!target.hasClass('active')){
            all_panels.removeClass('active').slideUp();
            target.addClass('active').slideDown();
        }
      return false;
    });
    // Fin acordeon

    // Detalle de los productos
    // Controla el comportamiento de los detalles del producto
    $('.product-links-wap a').click(function(){
      // Maneja el evento de clic en un enlace de imagen del producto
      var this_src = $(this).children('img').attr('src');
      $('#product-detail').attr('src',this_src);
      return false;
    });
    $('#btn-minus').click(function(){
      // Maneja el evento de clic en el botón "menos" de la cantidad del producto
      var val = $("#var-value").html();
      val = (val=='1')?val:val-1;
      $("#var-value").html(val);
      $("#product-quanity").val(val);
      return false;
    });
    $('#btn-plus').click(function(){
      // Maneja el evento de clic en el botón "más" de la cantidad del producto
      var val = parseInt($("#var-value").html());
      var max = parseInt($("#btn-plus").attr("max"));
      if (val < max) {
        val++;
        $("#var-value").html(val);
        $("#product-quanity").val(val);
      }
      return false;
    });
    $('.btn-size').click(function(){
      // Maneja el evento de clic en un botón de tamaño del producto
      var this_val = $(this).html();
      $("#product-size").val(this_val);
      $(".btn-size").removeClass('btn-secondary');
      $(".btn-size").addClass('btn-success');
      $(this).removeClass('btn-success');
      $(this).addClass('btn-secondary');
      return false;
    });
    // Fin detalle de los productos

});
