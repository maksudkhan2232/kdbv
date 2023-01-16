<!doctype html>
<html>
  <head>
    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile | <?php echo $WebsiteInformation['firm_name'];?></title>
    <?php $this->load->view('common/common_css');?>
    <link rel="stylesheet" href="<?php echo  base_url(); ?>assest/frontend/css/font-awesome.min.css">
    <style type="text/css">
    .list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #3f3f3f  !important;
    border-color: #3f3f3f  !important;
    }
    .account-details a {
    font-family: 'Work Sans', sans-serif;
    font-weight: 600;
    color: #fff;
    background: #d19e66;
    height: 50px;
    font-size: 18px;
    text-transform: uppercase;
    text-align: center;
    line-height: 50px;
    padding: 0 20px;
    margin-top: 0px !important;
    }
    .account-details a:hover {
    background: #3f3f3f;
    color: #fff!important;
    }
    </style>
  </head>
  <body id="home-version-1" class="home-version-1" data-style="default">
    <div class="site-content">
      <?php $this->load->view('common/header');?>
      <!--=========================-->
      <!--=        Breadcrumb         =-->
      <!--=========================-->
      <section class="breadcrumb-area">
        <div class="container-fluid custom-container">
          <div class="row">
            <div class="col-xl-12">
              <div class="bc-inner">
                <p><a href="<?php echo base_url(); ?>">Home  |</a> Profile</p>
              </div>
            </div>
            <!-- /.col-xl-12 -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>
      <!--=========================-->
      <section class="account-area">
        <div class="container-fluid custom-container">
          <div class="row">
            <div class="col-lg-12 col-12">
              <?php
              if($message!=''){
              ?>
              <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo $message;?>
              </div>
              <?php
              }
              ?>

              <?php if($this->session->flashdata('success')){ ?>
                      <div class="row justify-content-center mb-2">
                        <div class="col-lg-12">
                          <div class="alert alert-icon alert-success text-success alert-dismissible fade show" role="alert"  id="myDiv"> <i class="mdi mdi-check-all mr-2"></i> <strong>Success </strong><?php echo  $this->session->flashdata('success'); ?> </div>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if($this->session->flashdata('errors')){ ?>
                      <div class="row justify-content-center mb-2">
                        <div class="col-lg-12">
                          <div class="alert alert-icon alert-danger text-danger alert-dismissible fade show" role="alert"  id="myDiv"> <i class="mdi mdi-check-all mr-2"></i> <strong>Error </strong> <?php echo  $this->session->flashdata('errors'); ?> </div>
                        </div>
                      </div>
                      <?php } ?>
            </div>
            <style type="text/css">
            .account-details a{
            margin-top: 20px;
            }
            </style>
            <div class="col-xl-3">
              <div class="account-details">
                <p>
                  Welcome <?php echo ucwords($CustomerDetails['name']);?>
                </p>
                <div class="list-group">
                  <a href="<?php echo base_url(); ?>customer/" class="list-group-item list-group-item-action">
                    Orders
                  </a>
                  <a href="<?php echo base_url(); ?>customer/favoriteproducts/" class="list-group-item list-group-item-action">Favorite Product</a>
                  <a href="<?php echo base_url(); ?>customer/profile/" class="list-group-item list-group-item-action active">Profile</a>
                  <a href="<?php echo base_url(); ?>customer/password/" class="list-group-item list-group-item-action">Reset Password</a>
                  <a href="<?php echo base_url(); ?>customer/logout" class="list-group-item list-group-item-action">LogOut</a>
                </div>
              </div>
              <!-- /.cart-subtotal -->
            </div>
            <!-- /.col-xl-3 -->
            <div class="col-xl-9">
              <section class="contact-area">
                <div class="container-fluid custom-container">
                  <div class="checkout-area section-padding">
                    <div class="container">
                      <div class="checkout-wrap">
                        <div class="row">
                          <div class="col-lg-12 col-12">
                            <div class="caupon-wrap s2" id="">
                              <div class="biling-item">
                                <div class="coupon coupon-3">
                                  <label id="toggle2">Profile Details</label>
                                </div>
                                <form action="<?php echo base_url(); ?>customer/profile/" id="myForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" onSubmit="return profile();">
                                  <div class="billing-adress" id="">
                                    <div class="contact-form form-style text-left" id="newuserregistrationform">
                                      <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                          <label for="name">Name <span class="text-danger">*</span></label>
                                          <input type="text" placeholder="Enter Your Name." id="name" name="data[name]" maxlength="55" value="<?php echo $CustomerDetails['name'];?>">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                          <label for="address">Address <span class="text-danger">*</span></label>
                                          <input type="text" placeholder="Enter Your Address." id="address" name="data[address]" value="<?php echo $CustomerDetails['address'];?>">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                          <label for="country">Country <span class="text-danger">*</span></label>
                                          <select name="data[country]" id="country" class="form-control" onChange="return getcountrywisestate(this.value);">
                                            <?php
                                            foreach ($CountryDetails as $skey => $svalue) {
                                            if($svalue['id']==$CustomerDetails['country']){
                                            $sel='selected';
                                            }else{
                                            $sel='';
                                            }
                                            echo '<option value="'.$svalue['id'].'" '.$sel.'>'.ucwords($svalue['name']).'</option>';
                                            }
                                            ?>
                                          </select>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                          <label for="state">State <span class="text-danger">*</span></label>
                                          <select name="data[state]" id="state" class="form-control">
                                            <option value="">Select State</option>
                                            <?php
                                            $sele='';
                                            foreach ($StateDetails as $skey => $svalue) {
                                            if(isset($CustomerDetails['state']) && $CustomerDetails['state']!=''){
                                            if($svalue['id']==$CustomerDetails['state']){
                                            $sele="selected";
                                            }else{
                                            $sele='';
                                            }
                                            }
                                            echo '<option value="'.$svalue['id'].'" '.$sele.'>'.ucwords($svalue['name']).'</option>';
                                            }
                                            ?>
                                          </select>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                          <label for="city">City <span class="text-danger">*</span></label>
                                          <input type="text" placeholder="Enter Your City Name."  id="city" name="data[city]" value="<?php echo $CustomerDetails['city'];?>">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                          <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                          <input type="text" placeholder="Enter Your Pincode."  id="pincode" name="data[pincode]" value="<?php echo $CustomerDetails['pincode'];?>">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12 mb-3">
                                          <label for="mobileno">Mobile No. <span class="text-danger">*</span></label>
                                          <input type="text" placeholder="Enter Your Mobile No."  id="mobileno" name="data[mobileno]" value="<?php echo $CustomerDetails['mobileno'];?>">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12 mb-3">
                                          <label for="email">Email Id <span class="text-danger">*</span></label>
                                          <input type="email" placeholder="Enter Your Email."  value="<?php echo $CustomerDetails['email'];?>" readonly>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-center">
                                          <div class="col-xl-6 ">
                                            <input type="submit" class="cart-btn" value="Update" style="background: #3f3f3f;">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-12 col-12">
                              <div class="">
                                <label>Shipping Address</label>
                              </div>
                            
                            <?php $caddress = getCustomerAddress($CustomerDetails['id']); 
                            $address_id = 0;  
                            $jk=1; foreach ($caddress as $key => $add_v){
                            $ckh_sel = "";
                            if($add_v['is_last']==1)
                            {
                              $ckh_sel = "checked";
                              $address_id = $add_v['id'];
                            }
                            ?>
                            <div class="caupon-wrap">
                                <div class="biling-item">
                                     <div class="coupon">
                                        <label>
                                          <div class="row">
                                              <div class="col-md-1">
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                              </div>
                                              <div class="col-md-10">
                                                 <?php echo $add_v['address']; ?>
                                                  <br>
                                                  <p><?php echo $add_v['city']; ?> - <?php echo $add_v['pincode']; ?>
                                                  , <?php echo $add_v['state_name']; ?> - <?php echo $add_v['country_name']; ?><br>
                                                  Contact : <?php echo $add_v['mobileno']; ?></p>
                                              </div>
                                              <div class="col-md-1 text-center">
                                                  <a href="javascript:void(0);" title="Edit Address" data-toggle="modal" data-target="#exampleModal<?php echo $jk; ?>">
                                                  <span class="btn btn-outline-dark btn-sm">Edit</span></a>


                                              </div>
                                          </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal<?php echo $jk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                    <form action="<?php echo base_url(); ?>customer/upaddress/" enctype="multipart/form-data" method="post">
                                      <input type="hidden" name="address_id" value="<?php echo $add_v['id']; ?>">
                                      <div class="modal-body">
                                        <div class="contact-form ">
                                          <div class="row text-left">
                                            <div class="col-lg-12 col-md-12 col-12">
                                              <label for="saddress">Address <span class="text-danger">*</span></label>
                                              <input type="text" placeholder="Enter Your Address." name="saddress" value="<?php echo $add_v['address']; ?>" required>
                                            </div>
                                          </div>
                                          <div class="row text-left">
                                            <div class="col-lg-6 col-md-6 col-6">
                                              <label for="scountry">Country <span class="text-danger">*</span></label>
                                              <select name="scountry" class="form-control" onChange="return getcountrywisestatepop(this.value,<?php echo $jk; ?>);">
                                                <?php
                                                foreach ($CountryDetails as $skey => $svalue) {
                                                if($svalue['id']==$add_v['country']){
                                                  $sel='selected';
                                                }else{
                                                  $sel='';
                                                }
                                                echo '<option value="'.$svalue['id'].'" '.$sel.'>'.ucwords($svalue['name']).'</option>';
                                                }
                                                ?>
                                              </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                              <label for="sstate">State <span class="text-danger">*</span></label>
                                              <select name="sstate" id="sstate<?php echo $jk; ?>" class="form-control">
                                                <option value="">Select State</option>
                                                <?php
                                                $StateDetailstmp = $this->db->select('*')->from('billing_state')->where('country_id',$add_v['country'])->get()->result_array();
                                                $sele='';
                                                foreach ($StateDetailstmp as $skey => $svalue) {
                                                if(isset($CustomerDetails['state']) && $CustomerDetails['state']!=''){
                                                  if($svalue['id']==$add_v['state']){
                                                    $sele="selected";
                                                  }else{
                                                    $sele='';
                                                  }
                                                }
                                                echo '<option value="'.$svalue['id'].'" '.$sele.'>'.ucwords($svalue['name']).'</option>';
                                                }
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row text-left">
                                            <div class="col-lg-6 col-md-6 col-6">
                                              <label for="scity">City <span class="text-danger">*</span></label>
                                              <input type="text" placeholder="Enter Your City Name."  name="scity" value="<?php echo $add_v['city']; ?>" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                              <label for="spincode">Pincode <span class="text-danger">*</span></label>
                                              <input type="text" placeholder="Enter Your Pincode."  name="spincode" value="<?php echo $add_v['pincode']; ?>" required>
                                            </div>
                                          </div>
                                          <div class="row text-left">
                                            <div class="col-lg-6 col-md-6 col-6">
                                              <label for="smobileno">Mobile No. <span class="text-danger">*</span></label>
                                              <input type="text" placeholder="Enter Your Mobile No." name="smobileno" value="<?php echo $add_v['mobileno']; ?>" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                              <label for="alternatemobileno">Alternate Mobile No.</label>
                                              <input type="text" placeholder="Alternate Your Mobile No."  name="alternatemobileno" value="<?php echo $add_v['alternate_mobileno']; ?>">
                                            </div>
                                          </div>
                                          </div>
                                        </div>
                                      <p class="form-submit m-5 text-center">
                                        <input value="Update" class="submit" type="submit">
                                      </p>
                                </form>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                  </div>
                                </div>
                            </div>
                            <?php $jk++; } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <!-- /.col-xl-9 -->
          </div>
        </div>
      </section>
      <?php $this->load->view('common/inner_contact');?>
      <?php $this->load->view('common/footer');?>
      <div class="backtotop"> <i class="fa fa-angle-up backtotop_btn"></i> </div>
      <?php $this->load->view('common/quick-view');?>
    </div>
    <?php $this->load->view('common/main-search');?>
     <?php $this->load->view('common/common_js');?>
</body>
</html>
<script type="text/javascript">
  
   function getcountrywisestatepop(countryid,cid){
        //var countryid = $('#countryid').val();
        if (countryid=='') { 
          Swal.fire({
            icon: 'error',
            title: 'Please Select Country.',
            showConfirmButton: false,
            timer: 2000
          })
          return false;
        }
        var data = 'countryid='+countryid;
        if(countryid!=''){
          $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>customer/getcountrywisestate/',
            data:data,
            dataType: "json",
            success:function(result){
              var msg = result.msg;
              if(msg=='success'){
                $("#sstate"+cid).html(result.data);
              }else{
                $("#sstate"+cid).html('');
              }    
              return false;
            }
          });
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Something went wrong',
            showConfirmButton: false,
            timer: 2000
          })
        }  
        
      }

</script>