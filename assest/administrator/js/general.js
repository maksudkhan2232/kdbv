
function GetCollectionWiseCategory(collectionid){
  var data = 'collectionid=' +collectionid;
  $.ajax({
    type:'POST',
    url:base_url+'administrator/master/GetCollectionWiseCategory/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#categoryid').html(result);
      return false;
    }
  });
}

function AddMoreExtraField() {
  //var extrafields = $('#extrafields').clone();

  var extrafields = '<div class="row"  id="extrafields">';
        extrafields +='<div class="col-md-5">';
          extrafields +='<div class="form-group">';
            extrafields +='<label for="extrafield">Field </label>';
            extrafields +='<input type="text" class="form-control" id="extrafield" name="extrafield[]" placeholder="Enter Field Name ">';
          extrafields +='</div>';
        extrafields +='</div>';
        extrafields +='<div class="col-md-5">';                  
          extrafields +='<div class="form-group">';
            extrafields +='<label for="extrafieldvalue">Value </label>';
            extrafields +='<input type="text" class="form-control" id="extrafieldvalue" name="extrafieldvalue[]"  placeholder="Enter Field Value">';
          extrafields +='</div>';
        extrafields +='</div>';
        extrafields +='<div class="col-md-2">';
          extrafields +='<div class="form-group">';
            extrafields +='<br>';
            extrafields +='<button type="button" class="btn btn-danger mr-2" id="RemoveExtraField">';
              extrafields +='<i class="fa fa-remove"></i>';
            extrafields +='</button>';
        extrafields +='</div>';
      extrafields +='</div>';
      extrafields +='</div>';
  $("#addmoreextrafield").before(extrafields);  
}
$(document).on('click', '#RemoveExtraField', function () {
    $(this).closest('#extrafields').remove();
});
function orderdetails_show(order_id) {
  var data = 'order_id=' +order_id;
  //alert(data); return false;
  if (order_id>0){    
    $.ajax({
      type:'POST',
      url:base_url+'administrator/orders/OrderSingleDetails/',
      data:data,
      dataType: "json",
      success:function(result){
        $("#OrderSingleDetails").html(result.orderhtml);      
        $('#modal-orderdetails').modal('show');
        return false;
      }
    });    
  }
}
function orderdetails_search(){
  var startdate = $('#startdate').val();
  var enddate = $('#enddate').val();
  if (startdate=='') { 
    Swal.fire('Please Select Start Date.');         
    return false;
  }
  if (enddate=='') { 
    Swal.fire('Please Select End Date.');         
    return false;
  }
  var data = 'startdate=' + $('#startdate').val();
      data += '&enddate=' + $('#enddate').val();
      data += '&orderno=' + $('#orderno').val();
      data += '&customername=' + $('#customername').val();
      data += '&customerphone=' + $('#customerphone').val();
      data += '&grandtotal=' + $('#grandtotal').val();
      data += '&order_type=' + $('#order_type').val();
      data += '&payment_types=' + $('#payment_types').val();
      data += '&order_status=' + $('#order_status').val();
      data += '&order_push=' + $('#push_on').val();

  $.ajax({
    type:'POST',
    url:base_url+'administrator/orders/OrderDetailsSearch/',
    data:data,
    dataType: "json",
    success:function(result){
      //alert(result.orderhtml);return false;
      $('#OrderDetailsList').html(result.orderhtml);
      $('#GrandTotal').html('Grand Total : ₹ '+result.GrandTotal);
      $('#OrderTotal').html('All Orders Details ( '+result.OrderTotal+' )');
      return false;     
    }
  });
}
function specialorderdetails_search(){
  var startdate = $('#startdate').val();
  var enddate = $('#enddate').val();
  if (startdate=='') { 
    Swal.fire('Please Select Start Date.');         
    return false;
  }
  if (enddate=='') { 
    Swal.fire('Please Select End Date.');         
    return false;
  }
  var data = 'startdate=' + $('#startdate').val();
      data += '&enddate=' + $('#enddate').val();
      data += '&orderno=' + $('#orderno').val();
      data += '&membername=' + $('#membername').val();
      data += '&membermobileno=' + $('#membermobileno').val();
      data += '&orderid=' + $('#orderid').val();
      data += '&memberstandard=' + $('#memberstandard').val();
      data += '&membersemester=' + $('#membersemester').val();
      data += '&memberdivision=' + $('#memberdivision').val();
      data += '&paymenttypes=' + $('#paymenttypes').val();
      data += '&orderstatus=' + $('#orderstatus').val();

  $.ajax({
    type:'POST',
    url:base_url+'administrator/specialorder/OrderDetailsSearch/',
    data:data,
    dataType: "json",
    success:function(result){
      //alert(result.orderhtml);return false;
      $('#OrderDetailsList').html(result.orderhtml);
      $('#GrandTotal').html('Grand Total : ₹ '+result.GrandTotal);
      $('#OrderTotal').html('All Orders Details ( '+result.OrderTotal+' )');
      return false;     
    }
  });
}
function is24hoursOpen() {
  // Get the checkbox
  var is24hoursopen = document.getElementById("is24hoursopen");
  // Get the output text
  var weekdayslist = document.getElementById("weekdayslist");

  // If the checkbox is checked, display the output text
  if(is24hoursopen.checked == true){
    weekdayslist.style.display = "none";
  } else {
    weekdayslist.style.display = "block";
  }
}
function weekdaysapplyall(weekdaysname) {
 
  $('.checkbox').each(function() {
      this.checked = true;                        
  });
  // First Ship Open Time
  
  
  var FSopentime = document.getElementById(weekdaysname+"FSopentime").options.selectedIndex;
  for (var i = 0; i<7; i++) {
    document.getElementsByClassName("FSopentime")[i].getElementsByTagName('option')[FSopentime].selected = 'selected';
  }
  

  var FSclosetime = document.getElementById(weekdaysname+"FSclosetime").options.selectedIndex;
  for (var i = 0; i<7; i++) {
    document.getElementsByClassName("FSclosetime")[i].getElementsByTagName('option')[FSclosetime].selected = 'selected';
  }
  

  var SSopentime = document.getElementById(weekdaysname+"SSopentime").options.selectedIndex;
  for (var i = 0; i<7; i++) {
    document.getElementsByClassName("SSopentime")[i].getElementsByTagName('option')[SSopentime].selected = 'selected';
  }
  

  var SSclosetime = document.getElementById(weekdaysname+"SSclosetime").options.selectedIndex;
  for (var i = 0; i<7; i++) {
    document.getElementsByClassName("SSclosetime")[i].getElementsByTagName('option')[SSclosetime].selected = 'selected';
  }
 
}
function weekdaysselectall() {
  $('.checkbox').each(function() {
      this.checked = true;                        
  }); 
}
function modal_delete(param1){
  document.getElementById('delete_link').href = base_url+param1;
}
function removebussinessphoto(PhotoGalleryId){
  var data = 'PhotoGalleryId=' +PhotoGalleryId;
  $.ajax({
    type:'POST',
    url:base_url+'administrator/listing/photogallerydelete/',
    data:data,
    dataType: "json",
    success:function(result){
      window.location.reload();
    }
  });
}
function deletebussiness(BussinessId){
  var data = 'bussinessid=' +BussinessId;
  $.ajax({
    type:'POST',
    url:base_url+'administrator/listing/deletebussiness/',
    data:data,
    dataType: "json",
    success:function(result){
      window.location.reload();
      return false;
    }
  });
}
function modal_status(param1){
  document.getElementById('status_link').href = base_url+param1;
  $("#modal-status").modal('show');
}
function offersearch(){
  var data = 'categoryname=' + $('#categoryname').val();
      data += '&bussinessname=' + $('#bussinessname').val();
      data += '&dealheading=' + $('#dealheading').val();
      data += '&startdate=' + $('#startdate').val();
      data += '&enddate=' + $('#enddate').val();
      data += '&offerday=' + $('#offerday').val();
      data += '&offercode=' + $('#offercode').val();
      data += '&highlights=' + $('#highlights').val();
      data += '&offertype=' + $('#offertype').val();

  $.ajax({
    type:'POST',
    url:base_url+'administrator/businessoffer/offersearch/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#BussinessOfferList').html(result);
      return false;     
    }
  });
}
function Advertisementsearch(){
  var data = 'AdvertisementTitle=' + $('#AdvertisementTitle').val();
      data += '&AdvertisementCategory=' + $('#AdvertisementCategory').val();
      data += '&AdvertisementPage=' + $('#AdvertisementPage').val();
      data += '&startdate=' + $('#startdate').val();
      data += '&enddate=' + $('#enddate').val();
  
  $.ajax({
    type:'POST',
    url:base_url+'administrator/advertisement/Advertisementsearch/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#AdvertisementList').html(result);
      return false;     
    }
  });
}
function bussinesssearch(){
  var data = 'categoryname=' + $('#categoryname').val();
      data += '&bussinessid=' + $('#bussinessid').val();
      data += '&ownerid=' + $('#ownerid').val();
      data += '&contactno=' + $('#contactno').val();
      data += '&keywords=' + $('#keywords').val();

  $.ajax({
    type:'POST',
    url:base_url+'administrator/listing/bussinesssearch/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#seachingbussinesslist').html(result);
      return false;     
    }
  });
}
function DeletePhotoGallery(PhotoGalleryId){
  var data = 'PhotoGalleryId=' +PhotoGalleryId;
  $.ajax({
    type:'POST',
    url:base_url+'administrator/listing/DeletePhotoGallery/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#galleryitem'+PhotoGalleryId).remove();
      return false;
    }
  });
}
function DeleteVideoGallery(VideoGalleryId){
  var data = 'VideoGalleryId=' +VideoGalleryId;
  $.ajax({
    type:'POST',
    url:base_url+'administrator/listing/DeleteVideoGallery/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#VideoGalleryId'+VideoGalleryId).remove();
      return false;
    }
  });
}
function unapprovebussinesssearch(){
  var data = 'categoryname=' + $('#categoryname').val();
      data += '&bussinessid=' + $('#bussinessid').val();
      data += '&entrystartdate=' + $('#entrystartdate').val();
      data += '&entryenddate=' + $('#entryenddate').val();

  $.ajax({
    type:'POST',
    url:base_url+'administrator/listing/unapprovebussinesssearch/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#seachingbussinesslist').html(result);
      return false;     
    }
  });
}




// function modal_delete(table,fvalue){
//   $('#deletetable').val(table);
//   $('#deletevalue').val(fvalue);
//   return false;
// }
function modal_status_link(){	
	var data  = 'statustable=' 		 + $('#statustable').val();
		data += '&statusfieldvalue=' 	 + $('#statusfieldvalue').val();
		data += '&statuschangetableid=' + $('#statuschangetableid').val();
		
	$.ajax({
	 	type:'POST',
	 	url:base_url+'generalfunction/statuschange/',
	 	data:data,
	 	dataType: "json",
	 	success:function(result){
      //alert(result);return false;
	 		window.location.reload();
	 		return false;		
	 	}
	});
}

function modal_delete_link(courseid){
	var data = 'deletetable=' + $('#deletetable').val();
		  data += '&deletevalue=' + $('#deletevalue').val();

	$.ajax({
	 	type:'POST',
	 	url:base_url+'generalfunction/deleterecord/',
	 	data:data,
	 	dataType: "json",
	 	success:function(result){
      //alert(result);return false;
	 		window.location.reload();
		    //return false;	 		
	 	}
	});
}


function minmax(value, min, max) 
{
    if(parseInt(value) < min || isNaN(parseInt(value))) {
      return min; 
    }else if(parseInt(value) > max) {
      return max; 
    }else{
      return value;
    } 
}
function DeleteBussinessTime(BussinessTimeID){
  var data = 'BussinessTimeID=' +BussinessTimeID;
  $.ajax({
    type:'POST',
    url:base_url+'administrator/listing/DeleteBussinessTime/',
    data:data,
    dataType: "json",
    success:function(result){
      $('#TimeD'+BussinessTimeID).remove();
      return false;
    }
  });
}



function GetLatLongUsingAddress(){
  var bussinessname = $('#bussinessname').val();
  var address = $('#address').val();
  var landmark = $('#landmark').val();
  var city = $('#city').val();
  var pincode = $('#pincode').val();
  var state = $('#state').val();
  var country = $('#country').val();
  if(bussinessname!='' && address!='' && landmark!='' && city!='' && pincode!='' && state!='' && country!=''){
    var data = 'bussinessname='+bussinessname;
        data += '&address='+address;
        data += '&landmark='+landmark;      
        data += '&city=' +city;
        data += '&pincode=' +pincode;
        data += '&state=' +state;
        data += '&country=' +country;
    $.ajax({
      type:'POST',
      url:base_url+'administrator/listing/GetLatLongUsingAddress/',
      data:data,
      dataType: "json",
      success:function(result){
        if(result.msg=='success'){
          $('#latitude').val(result.latitude);
          $('#longitude').val(result.longitude);
          $('#AjmMap').trigger('click');
         // GetMapUsingLatLong(result.latitude,result.longitude);
        }
        return false;
      }
    });
  }  
}
function GetMapUsingLatLong(latitude,longitude){
  var map;
  var marker;
  var laturl;
  var lngurl;
  var baseurl = "#";
  var linkurl;
  var comma = ", ";
  var lattitude = latitude;
  var longitude1 = longitude;
  //set map variables
  
  function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
    } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
    }
    var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    };
    var marker = new google.maps.Marker(options);
    map.setCenter(options.position);
  }
  //if it all fails
  google.maps.event.addDomListener(window, 'load', initialize);
}
function redemptionsearch(){
  var data = 'bussinessid=' + $('#bussinessid').val();
      data += '&offerid=' + $('#offerid').val();
      data += '&redeemdate=' + $('#redeemdate').val();
      data += '&offercode=' + $('#offercode').val();
  
  $.ajax({
    type:'POST',
    url:base_url+'administrator/redemption/redemptionsearch/',
    data:data,
    dataType: "json",
    success:function(result){
      //alert(result);return false;
      $('#RedemptionList').html(result);
      return false;     
    }
  });
}

function getRiderDet()
{
    
}

// $(function() {
//     //$('#modal-neworderdetails').modal('show');
//     let notification = document.createElement('audio');
//     let notificationFileRoute = base_url+'assets/administrator/img/audio/neworder1.mp3';
//         notification.setAttribute('src', notificationFileRoute);
//         notification.setAttribute('type', 'audio/mp3');
//         notification.setAttribute('loop', 'true');
//         notification.setAttribute('muted', 'false');
    
//     $("#OrederRecieve").click(function(event) {
//         notification.pause();
//         notification.currentTime = 0;
//     });
//     const newOrderJson = [];
//     setInterval(function() {
//         $.ajax({
//             url: base_url+'administrator/orders/GetNewOrderDetails/',
//             type: 'POST',
//             dataType: 'json',
//             data: {listed_order_ids: [], _token: $('.csrfToken').val()},
//         })
//         .done(function(result) {
//             if (result.orderhtml!='') {
//                 $('#modal-neworderdetails').modal({
//                     backdrop: 'static',
//                     keyboard: false
//                 });
//                 //play sound
//                 notification.play();
//                 $('#NewOrderDetails').html(result.orderhtml);
//                 $('#modal-neworderdetails').modal('show');
//             } else {
//                 console.log("NO New Order")
//                 $('#modal-neworderdetails').modal('hide');
//             }
//         })
//         .fail(function() {
//             console.log("error");
//         })  
//     }, 15000 ); //all API every x seconds (config settings from admin)
// });



        