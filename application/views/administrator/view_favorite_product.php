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
                           <h4 class="card-title">Favourite Product</h4>
                        </div>
                        <hr />
                        <div class="row">
                           <div class="col-12">
                              <div class="table-responsive">
                                 <table id="order-listing" class="table">
                                    <thead>
                                       <tr>
                                          <th>Sr No.</th>
                                          <th>Product Name / Code</th>
                                          <th>Type</th>
                                          <th>Image</th>
                                          <th>Total Customer Favourite</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $i=1; 
                                        foreach($viewdata as $key=>$val){
                                      ?>
                                       <tr>
                                        <td><?php echo $i; ?></td>
                                        <td style="line-height:22px;"><?php echo $val['productcode']; ?></td>
                                        <td style="line-height:22px;"><?php echo ucwords($val['collectionshortname']).' / '.ucwords($val['categoryname']); ?></td>
                                        <td style="line-height:22px;"><img src="<?php echo base_url().'uploads/product/'.$val['image_name'];?>" alt="<?php echo $val['productcode'];?>"></td>
                                        
                                        <td style="line-height:22px;"><?php echo $val['totalcustomer']; ?></td>
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