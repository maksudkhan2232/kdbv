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
                                 <table id="order_listing" class="table">
                                    <thead>
                                       <tr>
                                          <th>Sr No.</th>
                                          <th>Order No.</th>
                                          <th>Date Time</th>
                                          <th>Total Product</th>
                                          <th>Customer Name</th>
                                          <th>City</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      
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
            $(document).ready(function() {
              var dataTable = $('#order_listing').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":{
                url :"<?php echo base_url(); ?>administrator/order/view_order_ajax_data", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling          
                }
                }
              } );
            } );
      </script>
   </body>
</html>