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
        
        $("#totalcartproduct").html(result.ftotalproduct);
        viewheadercart();
      }else if(msg=='cartupdate'){
        Swal.fire({
          icon: 'success',
          title: 'Poduct successfully update to your cart',
          showConfirmButton: false,
          timer: 500
        })
        $("#totalcartproduct").html(result.ftotalproduct);
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
function updatetocart(rowid){  
  
  var quantity = $("#quantity"+rowid).val();
  if(quantity==0 || quantity<0){
    removetocart(rowid);
  }
  var data = 'rowid='+rowid;
      data += '&quantity='+quantity;
  if(rowid!=''){
    $.ajax({
      type:'POST',
      url:base_url+'order/updatetocartproduct/',
      data:data,
      dataType: "json",
      success:function(result){
        var msg = result.msg;
        if(msg=='cartupdate'){
          Swal.fire({
            icon: 'success',
            title: 'Poduct successfully update to your cart',
            showConfirmButton: false,
            timer: 500
          })
          $("#totalcartproduct").html(result.ftotalproduct);
          $("#pricetotal"+rowid).html(result.pricetotal);
          $("#price"+rowid).html(result.price);
          viewheadercart();
          viewsubtotalcart();
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
          $("#cart"+rowid).remove();
          viewheadercart();
          viewsubtotalcart();
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
    dataType: "json",
    success:function(result){
      $("#viewheadercart").html(result);
      return false;
    }
  });  
}
function viewsubtotalcart(){  
  $.ajax({
    type:'POST',
    url:base_url+'order/viewsubtotalcart/',
    dataType: "json",
    success:function(result){
      $("#cartsubtotal").html(result);
      return false;
    }
  });  
}
function orderspecialnote(){  
  var ordernote = $("#ordernote").val();    
  var data = 'ordernote='+ordernote;
  if(ordernote!=''){
    $.ajax({
      type:'POST',
      url:base_url+'order/orderspecialnote/',
      data:data,
      dataType: "json",
      success:function(result){
        var msg = result.msg;
        if(msg=='success'){
          Swal.fire({
            icon: 'success',
            title: result.message,
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
  }else{
    Swal.fire({
      icon: 'error',
      title: 'Something went wrong',
      showConfirmButton: false,
      timer: 500
    })
  }  
}
function registration(){
  var name = $('#name').val();
  var address = $('#address').val();
  var country = $('#country').val();
  var state = $('#state').val();
  var city = $('#city').val();
  var pincode = $('#pincode').val();
  var mobileno = $('#mobileno').val();
  var email = $('#email').val();
  var password = $('#password').val();

  var emailRegex=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  
  if (name=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Name.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (address=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Address.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (state=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Select Your State.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (city=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your City Name.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (pincode=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Pincode.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (mobileno=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Valid Mobile Number.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (mobileno!= '' && !mobileno.match('^[0-9]+$')) { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter valid Mobile Number.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  var mobileno_len = $("#mobileno").val().length;
  if(mobileno_len>10 || mobileno_len<=9) {
    Swal.fire({
      icon: 'error',
      title: 'Please Enter valid Mobile Number.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (email=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Email Id.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if(!emailRegex.test(email)){
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Valid Email Id.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (password=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Password.',
      showConfirmButton: false,
      timer: 500
    }) 
    return false;
  }
}
function login(){
  var email = $('#email').val();
  var password = $('#passwords').val();
  var emailRegex=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  
  if (email=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Email Id.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if(!emailRegex.test(email)){
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Valid Email Id.',
      showConfirmButton: false,
      timer: 500
    })
    return false;
  }
  if (password=='') { 
    Swal.fire({
      icon: 'error',
      title: 'Please Enter Your Password.',
      showConfirmButton: false,
      timer: 500
    }) 
    return false;
  }
}
$(function() {
  $('#PlaceOrder').click(function(){
    var name = $('#sname').val();
    var address = $('#saddress').val();
    var country = $('#scountry').val();
    var state = $('#sstate').val();
    var city = $('#scity').val();
    var pincode = $('#spincode').val();
    var mobileno = $('#smobileno').val();
    var email = $('#semail').val();
    var emailRegex=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  
    if (name=='') { 
      Swal.fire({
        icon: 'error',
        title: 'Please Enter Your Name.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if (address=='') { 
      Swal.fire({
        icon: 'error',
        title: 'Please Enter Your Address.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if (state=='') { 
      Swal.fire({
        icon: 'error',
        title: 'Please Select Your State.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if (city=='') { 
      Swal.fire({
        icon: 'error',
        title: 'Please Enter Your City Name.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if (pincode=='') { 
      Swal.fire({
        icon: 'error',
        title: 'Please Enter Your Pincode.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if (mobileno=='') { 
      Swal.fire({
        icon: 'error',
        title: 'Please Enter Valid Mobile Number.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if (mobileno!= '' && !mobileno.match('^[0-9]+$')) { 
      Swal.fire({
        icon: 'error',
        title: 'Please Enter valid Mobile Number.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    var mobileno_len = $("#mobileno").val().length;
    if(mobileno_len>10 || mobileno_len<=9) {
      Swal.fire({
        icon: 'error',
        title: 'Please Enter valid Mobile Number.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if (email=='') { 
      Swal.fire({
        icon: 'error',
        title: 'Please Enter Your Email Id.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    if(!emailRegex.test(email)){
      Swal.fire({
        icon: 'error',
        title: 'Please Enter Your Valid Email Id.',
        showConfirmButton: false,
        timer: 500
      })
      return false;
    }
    
    
  });
});


