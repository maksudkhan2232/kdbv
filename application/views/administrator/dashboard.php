<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('administrator/common/header-js');?>
    <style type="text/css">
    .counter {
    text-align: center;
    }
    .employees, .customer, .design, .order {
    margin-top: 10px;
    margin-bottom: 10px;
    }
    .counter-count {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 2.1em;
    background-color: #fc5c65;
    border-radius: 50%;
    position: relative;
    color: #ffffff;
    text-align: center;
    line-height: 102px;
    width: 150px;
    height: 100px;
    -webkit-border-radius: 5%;
    -moz-border-radius: 5%;
    -ms-border-radius: 5%;
    -o-border-radius: 5%;
    display: inline-block;
    }
    .employee-p, .customer-p, .order-p, .design-p {
    font-size: 18px;
    color: #000000;
    line-height: 34px;
    margin-bottom: 40px;
    }
    .silver
    {
    background-color: #d3d3d3;
    background-image: linear-gradient(315deg, #d3d3d3 0%, #7f8c8d 74%);
    }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <?php $this->load->view('administrator/common/header');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <?php $this->load->view('administrator/common/right_sidebar');?>
        <?php $this->load->view('administrator/common/sidebar');?>
        <div class="main-panel">
          <div class="">
            <div class="card">
              <div class="card-body">
                <div class="counter">
                  <div class="row">
                  <div class="col-md-12">
                <div id="errormsg"></div>
                <?php $this->load->view('administrator/common/errors');?>
              </div>
                    <div class="col-md-4 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body text-left">
                          <h4 class="card-title">Daily Price</h4>
                          <hr>
                          <?php
                          $action=base_url().'administrator/dashboard/';
                          ?>
                          <?php  echo form_open_multipart($action, array('id' => 'myForm'));?>
                          <input type="hidden" name="id" id="id" value="<?php echo $DailyRateChangerDetails['id']; ?>">
                          <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $DailyRateChangerDetails['name']; ?>" placeholder="Name">
                            <?php echo '<div class="text-danger">'.form_error('name').'</div>' ?>
                          </div>
                          <hr>
                          <button type="submit" class="btn btn-outline-success mr-2 pull-right">Update Price</button>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="row">
                        <?php $a=array("e1b12c","BDC3C7","487eb0","b2bec3");
                        $random_keys=array_rand($a,3);
                        foreach ($sub_product as $key => $v)
                        { ?>
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <div class="customer">
                            <p class="counter-count" style="background-color:#<?php echo $a[$random_keys[$key]]; ?>;"><?php 
                            $cnt=0; 
                            foreach ($v['sub_category'] as $sk => $sv){ 
                                  if($sv['product']>0)
                                  {
                                    $cnt +=$sv['product'];
                                  }
                               } 
                               echo $cnt;
                            ?></p>
                            <p class="customer-p"><?php echo $v['category']; ?></p>
                          </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--      Cutomer Inquiry -->
          <div class="content-wrapper">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Cutomer Inquiry</h4>
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="order-listing" class="table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>City</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if(!empty($OrderData)){
                              foreach ($OrderData as $key => $value) {
                          ?> 
                          <tr>
                            <td><?php echo ($key+1);?></td>
                            <td><?php echo ($value['OrderNo']);?></td>
                            <td><?php echo date('M d,Y',strtotime($value['OrderDate']));?></td>
                            <td><?php echo ucwords($value['BillingName']);?></td>
                            <td><?php echo ucwords($value['BillingCity']);?></td>
                            <td><a href="<?php echo base_url()."administrator/order/view/".$value['OrderID'];?>" target="_blank" class="btn btn-primary">View</button></td>
                          </tr>
                          <?php 
                              }
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--      Cutomer Inquiry -->
          <div class="content-wrapper">
            <div class="row">
              <?php foreach ($sub_product as $key => $v)
              { ?>
              <div class="col-lg-4 mb-5">
                <div class="block">
                  <div class="list-group border-bottom">
                    <a href="javascript:void(0);" class="list-group-item" style="background-color:#fc5c65;color:#fff"><?php echo $v['category']; ?></a>
                    <?php foreach ($v['sub_category'] as $sk => $sv){ ?>
                    <a href="#" class="list-group-item"><span class="fa fa-star"></span> <?php echo $sv['name']; ?> <span class="badge badge-warning pull-right"><?php echo $sv['product']; ?></span></a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php $this->load->view('administrator/common/footer');?>
          <!-- partial -->
        </div>
      </div>
    </div>
    <?php $this->load->view('administrator/common/footer-js');?>
    <script>
    $('.counter-count').each(function () {
    $(this).prop('Counter',0).animate({
    Counter: $(this).text()
    }, {
    duration: 5000,
    easing: 'swing',
    step: function (now) {
    $(this).text(Math.ceil(now));
    }
    });
    });
    </script>
    </bo
></html>