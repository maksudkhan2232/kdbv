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
        //alert(result.sliderjs);

        $("#slider-for").html(result.sliderfor);    
        $("#slider-nav").html(result.slidernav);    
        $("#product-details").html(result.productdetails);  
        //$("#slider-js").html(result.sliderjs);      
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
function addtocart(productid){
  
  var qty = $("#qty"+productid).val();
  if(typeof qty != "undefined"){
    qty =qty;
  }else{
    qty=1;
  }
  var data = 'productquantity='+qty;
      data += '&productid='+productid;

  $.ajax({
    type:'POST',
    url:base_url+'order/addtocartproduct/',
    data:data,
    dataType: "json",
    success:function(result){
      var msg = result.msg;
      if(msg=='cartinsert'){
        Swal.fire({
          icon: 'success',
          title: 'Poduct successfully added to your cart',
          showConfirmButton: false,
          timer: 500
        })
        alert(result.ftotalproduct);
        $("#totalcartitem").html(result.ftotalproduct);
        viewheadercart();
      }else if(msg=='cartupdate'){
        Swal.fire({
          icon: 'success',
          title: 'Poduct successfully update to your cart',
          showConfirmButton: false,
          timer: 500
        })
        alert(result.ftotalproduct);
        $("#totalcartitem").html(result.ftotalproduct);
        viewheadercart();
      }else if(msg=='error'){
        Swal.fire({
          icon: 'error',
          title: 'Something went wrong',
          showConfirmButton: false,
          timer: 500
        })
      }else{
        Swal.fire({
          icon: 'error',
          title: 'Something went wrong',
          showConfirmButton: false,
          timer: 500
        })
      }      
      return false;
    }
  });
}
function removetocart(rowid){  
  var qty = 0;    
  var data = 'rowid='+rowid;
  if(rowid!=''){
    $.ajax({
      type:'POST',
      url:base_url+'order/removetocartproduct/',
      data:data,
      dataType: "json",
      success:function(result){
        var msg = result.msg;
        if(msg=='cartremove'){
          Swal.fire({
            icon: 'success',
            title: 'Poduct successfully remove to your cart',
            showConfirmButton: false,
            timer: 500
          })
          $("#totalcartproduct").html(result.ftotalproduct);
          viewheadercart();
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Something went wrong',
            showConfirmButton: false,
            timer: 500
          })
        }    
        return false;
      }
    });
  }else{
    Swal.fire({
      icon: 'error',
      title: 'Something went wrong',
      showConfirmButton: false,
      timer: 500
    })
  }  
}
function viewheadercart(){  
  $.ajax({
    type:'POST',
    url:base_url+'order/viewheadercart/',
    data:data,
    dataType: "json",
    success:function(result){
      $("#viewheadercart").html(result);
      return false;
    }
  });
  
}
