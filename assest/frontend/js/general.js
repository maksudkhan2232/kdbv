function productquickview(productid){
  var data = 'productid=' +productid;
  if (productid>0){    
    $.ajax({
      type:'POST',
      url:base_url+'Products/ProductQuickView/',
      data:data,
      dataType: "json",
      success:function(result){
        //$("#quickviewproduct").html(result);    
        $("#slider-for").html(result.sliderfor);    
        $("#slider-nav").html(result.slidernav);    
        $("#product-details").html(result.productdetails);    
        //$("#quickviewproduct").html(result);      
        var mask = '<div class="mask-overlay">';
        $('.quickview-wrapper').toggleClass('open');
        $(mask).hide().appendTo('body').fadeIn('fast');
        
        $('.mask-overlay, .close-qv').on('click', function() {
          $('.quickview-wrapper').removeClass('open');
          $('.mask-overlay').remove();
        });
        return false;
      }
    });    
  }
}
