<!DOCTYPE html>
<html lang="en">
   <head>
      <?php $this->load->view('administrator/common/header-js');?>
   </head>
   <body>
      <div class="container-scroller">
         <!-- partial:partials/_navbar.html -->
         <?php $this->load->view('administrator/common/header');?>
         <!-- partial -->
         <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <?php $this->load->view('administrator/common/right_sidebar');?>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php $this->load->view('administrator/common/sidebar');?>
            <!-- partial -->
            <div class="main-panel">
               <div class="content-wrapper">
                  <div class="card">
                     <div class="card-body">
                        <div id="errormsg"></div>
                        <?php $this->load->view('administrator/common/errors');?> 
                        <div class="d-flex justify-content-between align-items-center">
                           <h4 class="card-title">View Order</h4>
                        </div>
                        <hr />
                        <div class="row">
                           <div class="col-12">
                              <div class="table-responsive">
                                 <table id="order-listing" class="table">
                                    <thead>
                                       <tr>
                                          <th>Sr No.</th>
                                          <th>Order No.</th>
                                          <th>Date Time</th>
                                          <th>Total Product</th>
                                          <th>Total Amount</th>
                                          <th>Customer Details</th>
                                          <th>Shipping Details</th>
                                          <th>Remark</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $i=1; 
                                        foreach($viewdata as $key=>$val){
                                      ?>
                                      <tr>
                                        <td><?php echo $i; ?></td>
                                        <td style="line-height:22px;"><?php echo "#ORD".$val['OrderNo']; ?></td>
                                        <td style="line-height:22px;"><?php echo date('d M Y',strtotime($val['OrderDate'])).' '.date('h:i A',strtotime($val['OrderTime'])); ?></td>
                                        <td style="line-height:22px;"><?php echo $val['TotalProducts']; ?></td>
                                        <td style="line-height:22px;"><?php echo "₹. ".$val['TotalValue']; ?></td>
                                        <td style="line-height:22px;">
                                          <?php 
                                            if($val['BillingName']!=''){
                                              echo ucwords($val['BillingName']);
                                            }
                                            if($val['BillingEmail']!=''){
                                              echo "<br>".$val['BillingEmail'];
                                            }
                                            if($val['BillingPhone']!=''){
                                              echo "<br>".$val['BillingPhone'];
                                            }
                                          ?>
                                          
                                        </td>
                                        <td style="line-height:22px;">
                                          <?php 
                                            if($val['ShippingName']!=''){
                                              echo ucwords($val['ShippingName']);
                                            }
                                            if($val['ShippingEmail']!=''){
                                              echo "<br>".$val['ShippingEmail'];
                                            }
                                            if($val['ShippingMobileNo']!=''){
                                              echo "<br>".$val['ShippingMobileNo'];
                                            }
                                            if($val['ShippingAddress']!=''){
                                              echo "<br>".$val['ShippingAddress'];
                                              echo "<br>".$val['ShippingCity'];
                                              echo "<br>".$val['ShippingZipCode'];
                                            }
                                          ?>                                          
                                        </td>
                                        <td style="line-height:22px;">
                                          <?php 
                                            if($val['Remark']!=''){
                                              echo nl2br($val['Remark']);
                                            }
                                          ?>                                          
                                        </td>
                                        <td>
                                            <?php 
                                                if($val['OrderStatus']!=''){
                                                  echo $val['OrderStatus'];
                                                }
                                            ?> 
                                            <?php 
                                                if($val['status'] == '1'){ 
                                            ?>
                                           <!--   <button type="button" class="btn btn-sm btn-toggle changestatus active" data-table="orders" data-field="status" data-id-name="OrderID" data-id="<?php echo $val['OrderID'];?>" data-toggle="button" aria-pressed="1" autocomplete="off">
                                                <div class="handle"></div>
                                             </button>
                                             <?php } else { ?>
                                             <button type="button" class="btn btn-sm btn-toggle changestatus" data-table="orders" data-field="status" data-id-name="OrderID" data-id="<?php echo $val['OrderID'];?>" data-toggle="button" aria-pressed="0" autocomplete="off">
                                                <div class="handle"></div>
                                             </button>
                                             <?php } ?> -->
                                        </td>
                                        <td>
                                         <!--  <a href="<?php echo base_url(); ?>administrator/customer/editview/<?php echo $val['id']; ?>" class="btn btn-outline-primary mb-2">Edit</a>&nbsp;&nbsp;<a href="javascript:void(0);" onClick="check_confirm_delete('<?php echo $val['id']; ?>');" class="btn btn-outline-danger">Delete</a> -->
                                        </td>
                                      </tr>
                                      <?php
                                        $i++;
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
               <!-- content-wrapper ends -->
               <!-- partial:partials/_footer.html -->
               <?php $this->load->view('administrator/common/footer');?>
               <!-- partial -->
            </div>
            <!-- main-panel ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <?php $this->load->view('administrator/common/footer-js');?> 
      <script type="text/javascript">
         function check_confirm_delete(row_id)
         {
         
           swal({
                 title: "Delete",
                 text: 'Are You Sure To Delete this Advertisement ???',
                 icon: "error",
                 buttons: true,
                 dangerMode: true,
               })
               .then((willDelete) => {
                 if (willDelete) {
                    
                     window.location.href = "<?php echo base_url() ?>"+"administrator/customer/delete/"+row_id;
                 } else {
                   //swal("Your imaginary file is safe!");
                 }
               })
         }
      </script>
   </body>
</html>