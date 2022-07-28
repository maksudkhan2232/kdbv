<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class order extends MY_Controller{    
    function __construct(){
        parent::__construct();
        $this->load->model('administrator/Crud_Model');
        $this->load->model('order_model', '', TRUE);
        //error_reporting(E_ALL & ~E_NOTICE);
        //redirect($this->data['base_url'] . 'bussiness/');
        //$this->session->unset_userdata("cdetails_session");
    }    
    //load home  
    function index(){
        
        if(!empty($this->session->userdata('ordernote'))){
                $this->data['ordernote']=$this->session->userdata('ordernote');
        }else{
            $this->data['ordernote']='';
        }
        $this->data['title'] = "Cart";
        $this->load->view('order_cart',$this->data);
    }
    function addtocartproduct()
    {
        $returnarray = array();        
        $productid   = $this->input->post('productid'); //productid        
        $product_quantity  = $this->input->post('productquantity'); // quantity
        
        $flag = TRUE;
        $extra_costs_total = 0;
        $datapass=array('status'=>1,'id'=>$productid);
        $ProductSingleDetails=$this->Crud_Model->GetProductSingleDetails($datapass);
        
        // Check if our itemid mathch 
        if(!empty($ProductSingleDetails)){        
            // We have a match!
            $product_id=$ProductSingleDetails['id'];
            $product_cost=$ProductSingleDetails['price'];
            $product_name=$ProductSingleDetails['name'];
            $product_code=$ProductSingleDetails['productcode'];
            $product_collectionid=$ProductSingleDetails['collectiontype'];
            $product_categoryid=$ProductSingleDetails['categoryid'];
            $product_image=$ProductSingleDetails['image_name'];
            

            // Check if items variation multiple 
            if ($flag) {                    
                //Check Item already exist in cart
                $existed_item=FALSE;
                if ($this->cart->contents()) { 
                    foreach ($this->cart->contents() as $productcart) {
                        if ($productcart['id']==$product_id) {
                            // Already existed! Return FALSE! 
                            $existed_item=TRUE;
                            $dat = array(
                                'rowid'=>$productcart['rowid'],
                                'id'=>$productcart['id'],
                                'qty'     => $product_quantity,
                                'price'   => $product_cost,
                                'name'    => $product_name,
                                'options' => array('product_code' => $product_code,'product_collectionid' => $product_collectionid,'product_categoryid' => $product_categoryid,'product_image' => $product_image)
                            );  
                            $this->cart->update($dat);
                            $returnarray['msg'] = 'cartupdate';
                            $returnarray['ftotal'] = $this->cart->total();
                            $returnarray['ftotalqty'] = $this->cart->total_items();
                            $returnarray['ftotalproduct'] = count($this->cart->contents());
                            break;
                        }
                    }                        
                }
                if($existed_item==FALSE){
                    // Create an array with item information
                    $data = array(
                     'id'      => $product_id,//Item_id
                     'qty'     => $product_quantity, // Item Quantity
                     'price'   => $product_cost,//item_cost from rk_items table
                     'name'    => $product_name,
                     'options' => array('product_code' => $product_code,'product_collectionid' => $product_collectionid,'product_categoryid' => $product_categoryid,'product_image' => $product_image)
                    );
                   

                    
                    
                    // echo "<pre>";
                    // print_r($data);
                    // //$this->cart->insert($data);
                    // //$this->cart->destroy();
                    // exit;
                    if ($this->cart->insert($data)) {
                        $returnarray['msg'] = 'cartinsert';
                        $returnarray['ftotal'] = $this->cart->total();
                        $returnarray['ftotalqty'] = $this->cart->total_items();
                        $returnarray['ftotalproduct'] = count($this->cart->contents());
                    } else {
                        $returnarray['msg'] = 'error';
                    }
                }
            }            
        }else{
            // Nothing found! Return FALSE! 
            $returnarray['msg'] = 'error';
        }
        echo json_encode($returnarray);exit;        
    }
    function removetocartproduct(){
        
        $rowid = $this->input->post('rowid');
        $returnarray = array();        
        if($rowid!=''){            
            if (!empty($this->cart->contents())) {
                $this->cart->remove($rowid);   
                $returnarray['msg'] = 'cartremove';
                $returnarray['ftotal'] = $this->cart->total();
                $returnarray['ftotalqty'] = $this->cart->total_items();
                $returnarray['ftotalproduct'] = count($this->cart->contents());          
            }else{
                $returnarray['msg'] = 'error';
            }          
        }else{
            $returnarray['msg'] = 'error';
        } 
        echo json_encode($returnarray);exit;      
    }
    function updatetocartproduct(){
        
        $rowid = $this->input->post('rowid');
        $quantity = $this->input->post('quantity');
        $returnarray = array();        
        if($rowid!='' && $quantity!=''){            
            if (!empty($this->cart->contents())) {
                $dat = array(
                    'rowid'=>$rowid,
                    'qty'     => $quantity,
                );  
                $this->cart->update($dat);
                $cartdetails=$this->cart->contents();
                if($cartdetails[$rowid]['price']!='' && $cartvalue[$rowid]['price']!='0'){
                  $returnarray['price'] = '₹ '.$cartdetails[$rowid]['price'].' X '.$cartdetails[$rowid]['qty'];
                  $returnarray['pricetotal'] = '₹ '.($cartdetails[$rowid]['price']*$cartdetails[$rowid]['qty']);
                }else{
                   $returnarray['price'] = ' - ';
                   $returnarray['pricetotal'] = ' - ';
                }
                $returnarray['msg'] = 'cartupdate';
                $returnarray['ftotal'] = $this->cart->total();
                $returnarray['ftotalqty'] = $this->cart->total_items();
                $returnarray['ftotalproduct'] = count($this->cart->contents());
            }else{
                $returnarray['msg'] = 'error';
            }          
        }else{
            $returnarray['msg'] = 'error';
        } 
        echo json_encode($returnarray);exit;      
    }
    function viewheadercart(){
        
        $returnarray = array(); 
        $carthtml='';
        if ($this->cart->contents()) { 
            foreach ($this->cart->contents() as $cartkey => $cartvalue) {
                $carthtml .='<div class="single-cart">';
                    $carthtml .='<div class="cart-img">';
                        $carthtml .='<img alt="'.$cartvalue['options']['product_code'].'" src="'.base_url().'uploads/product/thumbnails/'.$cartvalue['options']['product_image'].'" height="100" width="100">'; 
                    $carthtml .='</div>';
                    $carthtml .='<div class="cart-title">';
                        $carthtml .='<p>';
                            $carthtml .='<a href="javascript:void(0);">';
                                $carthtml .=$cartvalue['options']['product_code'];
                            $carthtml .='</a>';
                        $carthtml .='</p>';
                    $carthtml .='</div>';
                    $carthtml .='<div class="cart-price">';
                        $carthtml .='<p>';
                            $carthtml .=$cartvalue['qty'];  
                            if($cartvalue['price']!='' && $cartvalue['price']!='0'){
                                $carthtml .='X' .$cartvalue['price'];
                            }
                        $carthtml .='</p>';
                    $carthtml .='</div>';
                    $carthtml .='<a href="javascript:void(0);" onclick="return removetocart("'.$cartvalue['rowid'].'");"><i class="fa fa-times"></i></a>'; 
                $carthtml .='</div>';
            }
            $carthtml .='<div class="cart-bottom">';
                 // <div class="cart-sub-total">
                 //      <p>Sub-Total <span>$700</span></p>
                 //    </div>
                 //    <div class="cart-sub-total">
                 //      <p>Eco Tax (-2.00)<span>$7.00</span></p>
                 //    </div>
                 //    <div class="cart-sub-total">
                 //      <p>VAT (20%) <span>$40.00</span></p>
                 //    </div>
                 //    <div class="cart-sub-total">
                 //      <p>Total <span>$244.00</span></p>
                 //    </div>
                $carthtml .='<div class="cart-checkout">';
                    $carthtml .='<a href="'.base_url().'/order"><i class="fa fa-shopping-cart"></i>View Cart</a>';
                $carthtml .='</div>';
                $carthtml .='<div class="cart-share">';
                    $carthtml .='<a href="'.base_url().'/order/checkout"><i class="fa fa-share"></i>Checkout</a> ';
                $carthtml .='</div>';
            $carthtml .='</div>';
        }else{
            $carthtml .='<div class="single-cart">';
                $carthtml .='<div class="cart-title">';
                    $carthtml .='<p>Cart Empty</p>';
                $carthtml .='</div>';
            $carthtml .='</div>';
        }
        echo json_encode($carthtml);exit;      
    }
    function viewsubtotalcart(){
        
        $returnarray = array(); 
        $carthtml='';
        if ($this->cart->contents()) {
            $carttotal= $this->cart->total();
            if($carttotal!='' and $carttotal!='0'){
                $carthtml .='<li><span>Sub-Total:</span>₹ '.number_format($carttotal).'</li>';    
                $carthtml .='<li><span>TOTAL:</span>₹ '.number_format($carttotal).'</li>';
            }
            
            //$carthtml .='<li><span>Tax (-4.00):</span>$11.00</li>';
            //$carthtml .='<li><span>Shipping Cost:</span>$00.00</li>';
            
        }
        echo json_encode($carthtml);exit;      
    }
    function orderspecialnote(){
        $returnarray =array();
        $ordernote = $this->input->post('ordernote');
        if($ordernote!=''){  
            $this->session->set_userdata("ordernote",$ordernote);
            $returnarray['msg']='success';
            $returnarray['message']='Special Order Note Successfully Applied.';
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        }
        echo json_encode($returnarray);exit;        
    }
    function checkout(){
        if(!empty($this->session->userdata('ordernote'))){
                $this->data['ordernote']=$this->session->userdata('ordernote');
        }else{
            $this->data['ordernote']='';
        }
        if($this->data['customer_info']['id']==''){
            redirect($this->data['base_url'] . 'customer');
        }
        if(count($this->cart->contents() > 0)) {

        }else{
            redirect($this->data['base_url'] . 'order');
        }
        $this->data['CustomerDetails']=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id '=>$this->data['customer_info']['id']));
        $this->data['StateDetails']=$this->Crud_Model->getDatafromtablewhere('billing_state',array('status'=>1),'ASC');
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['title'] = "Cart";
        $this->load->view('order_checkout',$this->data);
    }
    function placeorder(){
        $returnarray = array();        
        $sdata  = $this->input->post('sdata'); // Shiping Data
        
        if ($this->cart->contents()) {
            if($this->data['customer_info']['id']==''){
                redirect($this->data['base_url'] . 'customer');
            }
            if(!empty($this->session->userdata('ordernote'))){
                $ordernote=$this->session->userdata('ordernote');
            }else{
                $ordernote='';
            }
            // Start Order Details Add
                $ordernote=$this->session->userdata('ordernote');
                $customerid=$this->data['customer_info']['id'];
                $CartTmpDate = $this->cart->contents();
                $OrderNo = $this->get_random_string(5);
                if($this->data['customer_info']['id']!='' && !empty($CartTmpDate)){
                    $CartTmpDate = $this->cart->contents();
                    $cart_total =0;
                    $cartdetails = '';
                    if(!empty($CartTmpDate)){
                        // Order Details Update Order Table in Etry
                        $orderinfo =array();
                        $orderinfo['CustomerID']=$customerid;
                        $orderinfo['OrderNo']=$OrderNo;                        
                        $orderinfo['OrderDate']=date('Y-m-d');
                        $orderinfo['OrderTime']=date('H:i:s');                        
                        $orderinfo['OrderStatus']='Received';
                        $orderinfo['SubValue']=$this->cart->total();
                        $orderinfo['ShippingCharges']=0;
                        $orderinfo['Tax']=0;
                        $orderinfo['TotalValue']=$this->cart->total();
                        
                        // Address
                        $AddressDetails=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('status'=>1));
                        if(!empty($AddressDetails)){
                            $orderinfo['BillingName']=$AddressDetails['name'];
                            $orderinfo['BillingEmail']=$AddressDetails['email'];
                            $orderinfo['BillingPhone']=$AddressDetails['mobileno'];
                            $orderinfo['BillingAddress']=$AddressDetails['address'];
                            $orderinfo['BillingCity']=$AddressDetails['city'];
                            $orderinfo['BillingState']=$AddressDetails['state'];
                            $orderinfo['BillingZipCode']=$AddressDetails['pincode'];
                            
                        } 
                        $orderinfo['BillingNote']=$ordernote;   
                        $orderinfo['GSTNo']='';      
                        $orderinfo['isDifferentShipping']='';       
                        $orderinfo['ShippingName']=$sdata['name'];
                        $orderinfo['ShippingEmail']=$sdata['email'];
                        $orderinfo['ShippingAddress']=$sdata['address'];
                        $orderinfo['ShippingCity']=$sdata['city'];
                        $orderinfo['ShippingState']=$sdata['state'];
                        $orderinfo['ShippingCountry']=$sdata['country'];                        
                        $orderinfo['ShippingZipCode']=$sdata['state'];
                        $orderinfo['ShippingMobileNo']=$sdata['mobileno'];
                        $orderinfo['Remark']='';
                        $orderinfo['status']='0';
                        $orderinfo['isdelete']='0';
                        $orderinfo['created_datetime']=date('Y-m-d H:i:s');
                        $orderinfo['modified_datetime']='0000-00-00 00:00:00';
                        $orderid=$this->Crud_Model->InsertData('orders',$orderinfo);
                        foreach ($CartTmpDate as $cdkey => $cdvalue) {
                            if($cdvalue['qty']!='' && $cdvalue['qty']!='0'){
                                $products_id = 
                                $products_price = $cdvalue['price'];
                                $products_name = $cdvalue['name'];
                                $category_id = $cdvalue['options']['category_id'];
                                $products_description = $cdvalue['options']['description'];
                                $products_qty = $cdvalue['qty'];
                                $products_extra_note = $cdvalue['options']['products_extra_note'];
                                $products_total =0;
                                $isveriation =0;
                                $isaddons =0;
                                if (isset($cdvalue['options']['isvariation'])){
                                    $isveriation =1;
                                }
                                if(isset($cdvalue['options']['isaddons'])){
                                    $isaddons =1;
                                }
                                if (isset($cdvalue['options']['isvariation'])) {
                                    $cart_total += $cdvalue['options']['extra_costs_total'];
                                    $products_total += $cdvalue['options']['extra_costs_total'];
                                }else if(isset($cdvalue['options']['isaddons']) && !isset($cdvalue['options']['isvariation'])){
                                    $cart_total += $cdvalue['subtotal'];
                                    $cart_total += $cdvalue['options']['extra_costs_total'];
                                    $products_total += $cdvalue['subtotal'];
                                }else{                    

                                    $cart_total += $cdvalue['subtotal'];
                                    $products_total += $cdvalue['subtotal'];
                                }
                                

                                // Order products Entry
                                $productss_data=array();
                                $productss_data['order_id']=$orderid;
                                $productss_data['order_no']=$OrderNo;
                                $productss_data['customer_id']=$customerid;
                                $productss_data['products_id']=$cdvalue['id'];
                                $productss_data['products_name']= $cdvalue['name'];
                                $productss_data['products_price']=$cdvalue['name'];
                                $productss_data['products_qty']=$products_qty;
                                $productss_data['products_total_cost']=$products_total;
                                $productss_data['products_extra_note']=$products_extra_note;
                                $productss_data['categoryid']=$category_id;
                                $productss_data['isveriation']=$isveriation;
                                $productss_data['isaddons']=$isaddons;
                                $productss_data['status']='0';
                                $productss_data['isdelete']='0';
                                $productss_data['created_datetime']=date('Y-m-d H:i:s');
                                $productss_data['modified_datetime']='0000-00-00 00:00:00';
                                $OrderproductssId=$this->order_model->AddOrderItemsDetails($items_data);

                                

                               
                            }
                        }
                        $finalpay = $cart_total;
                        
                        $orderinfo =array();

                      
                        
                        
                        // Start Delivery Charge
                            $deliverycharge=0;
                            $restaurantsdetails = $this->order_model->restaurants_details();
                            // Packaging Charge As  Internethandling Charge
                            $packaging_applicable_on = $restaurantsdetails['packaging_applicable_on'];
                            $packaging_charge = $restaurantsdetails['packaging_charge'];
                            $packaging_charge_type = $restaurantsdetails['packaging_charge_type'];
                            $internethandlecharge=0;
                            if($packaging_charge!='' and $packaging_charge!='0'){
                                    if($packaging_charge_type=='PERCENTAGE'){
                                        $internethandlecharge = ($finalpay*$packaging_charge/100);
                                    }
                                    if($packaging_charge_type=='FIXED'){
                                        $internethandlecharge = $packaging_charge;
                                    }
                                    $final_pay_div .='<p class="mb-1">Internet Handle Charge<span class="float-right text-dark">₹ '.number_format($internethandlecharge,2).'</span></p>';
                                    $finalpay =($finalpay+$internethandlecharge);                         
                                }
                            
                            if($this->data['order_type']=='H'){
                                if(!empty($restaurantsdetails)){
                                    if($restaurantsdetails['deliverycharge']!='' and $restaurantsdetails['deliverycharge']!='0'){
                                        $minimumorderamount = $restaurantsdetails['minimumorderamount'];
                                        if($finalpay<$minimumorderamount){
                                            $deliverycharge=$restaurantsdetails['deliverycharge'];
                                            $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                                        }
                                        // $deliverycharge=$restaurantsdetails['deliverycharge'];
                                        // $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                                    }
                                }
                            }
                        // End Delivery Charge
                        
                        $GetSquereOff = $this->getsquereoff($finalpay);
                        $customerpaid = $GetSquereOff['roundoffprice'];
                        $squeroff = $GetSquereOff['squereoff'];
                        
                        
                        $orderinfo['order_id']=$orderid;
                        $orderinfo['total_cost']=$cart_total;
                        $orderinfo['no_of_items']=count($CartTmpDate);        
                        $orderinfo['delivery_fee']=$deliverycharge;
                        $orderinfo['tax_fee']=$taxes;
                        $orderinfo['packing_charges']=$internethandlecharge;
                        // $orderinfo['paid_total']=$finalpay;
                        $orderinfo['paid_total']=$customerpaid;
                        $orderinfo['squeroff']=$squeroff;
                        $orderinfo['paid_date']=date('Y-m-d H:i:s');
                        $orderinfo['order_type']=$this->data['order_type'];
                        $orderinfo['payment_types']='ONLINE';
                        $orderinfo['order_status']='Received';
                       
                        
                        // Customer 
                        $CustomerDetails = $this->order_model->GetSingleCustomerDetails($customerid);
                        if(!empty($CustomerDetails)){
                            $orderinfo['customername']=$CustomerDetails['name'];
                            $orderinfo['customermobileno']=$CustomerDetails['mobileno'];
                            if($CustomerDetails['email']=='' || $CustomerDetails['email']=='undefined'){
                                $orderinfo['customeremail']='';
                            }else{
                                $orderinfo['customeremail']=$CustomerDetails['email']; 
                            }
                            
                        }
                        $SpecialInstructions=$this->session->userdata('SpecialInstructions');
                        if(isset($SpecialInstructions)){
                            $SpecialInstructions = $SpecialInstructions;
                        }else{
                            $SpecialInstructions = '';
                        }
                        $orderinfo['ordernote']=$SpecialInstructions;
                        $UpdateOrderId=$this->order_model->UpdateOrderDetails($orderinfo);

                        // All cart Remove & Session Remove
                        // $this->cart->destroy();
                        // $this->session->unset_userdata("coupons_details_session");
                        // $this->session->unset_userdata("delivery_address_id");


                        $OrderDetailsSession = array('orderid'=>$orderid, 'order_no'=>$order_no);
                        $this->session->set_userdata('OrderDetailsSession', $OrderDetailsSession);
                        $returnarray['msg']='success';
                        
                    }else{
                        $returnarray['msg']='error';
                    }
                }
        
               
                
                $order_no = sprintf("%04d", $lastorder);   
            // End Order Details Add

            // Order Product Details Add
        }else{
            redirect($this->data['base_url'] . 'order/');
        }
    }

    function pay(){
        $returnarray = array();      
        $delivery_address_id=$this->session->userdata('delivery_address_id');
        $customerid=$this->data['customer_info']['id'];
        $CartTmpDate = $this->cart->contents();
        $GetRandNumberString = $this->get_random_string(5);
        //$order_no =  'ORD'.random_string('alnum',5).rand(100,10000);
        $order_no =  'ORD'.date('his').$GetRandNumberString.rand(100,10000);   
        $items_data     = array();
        $addons_data    = array();
        $finalpay=0;
        $offer_products_data = array();
        if($this->data['customer_info']['id']!='' && !empty($CartTmpDate)){
            $CartTmpDate = $this->cart->contents();
            $cart_total =0;
            $cartdetails = '';
            if(!empty($CartTmpDate)){
                // Order Details Update Order Table in Etry
                $orderinfo =array();
                $orderinfo['order_no']=$order_no;
                $orderinfo['customerid']=$customerid;
                $orderinfo['order_date']=date('Y-m-d');
                $orderinfo['order_time']=date('H:i:s');;
                // Address
                $DeliveryAddressDetails=$this->manageaddresses_model->GetCustomerSingleAddress($delivery_address_id);
                if(!empty($DeliveryAddressDetails)){
                    $orderinfo['addressid']=$delivery_address_id;
                    $orderinfo['addressarea']=$DeliveryAddressDetails['deliveryarea'];
                    $orderinfo['addresscomplete']=$DeliveryAddressDetails['completedddress'];
                    $orderinfo['city']=$DeliveryAddressDetails['city'];
                    $orderinfo['pincode']=$DeliveryAddressDetails['pincode'];
                    $orderinfo['customerlatitude']=$DeliveryAddressDetails['latitude'];
                    $orderinfo['customerlongtitude']=$DeliveryAddressDetails['longtitude'];
                }           
                $orderinfo['status']='0';
                $orderinfo['isdelete']='0';
                $orderinfo['created_datetime']=date('Y-m-d H:i:s');
                $orderinfo['modified_datetime']='0000-00-00 00:00:00';
                $orderid=$this->order_model->AddOrderDetails($orderinfo);
                foreach ($CartTmpDate as $cdkey => $cdvalue) {
                    if($cdvalue['qty']!='' && $cdvalue['qty']!='0'){
                        $item_id = $cdvalue['id'];
                        $item_price = $cdvalue['price'];
                        $item_name = $cdvalue['name'];
                        $category_id = $cdvalue['options']['category_id'];
                        $item_description = $cdvalue['options']['description'];
                        $item_qty = $cdvalue['qty'];
                        $item_extra_note = $cdvalue['options']['item_extra_note'];
                        $item_total =0;
                        $isveriation =0;
                        $isaddons =0;
                        if (isset($cdvalue['options']['isvariation'])){
                            $isveriation =1;
                        }
                        if(isset($cdvalue['options']['isaddons'])){
                            $isaddons =1;
                        }
                        if (isset($cdvalue['options']['isvariation'])) {
                            $cart_total += $cdvalue['options']['extra_costs_total'];
                            $item_total += $cdvalue['options']['extra_costs_total'];
                        }else if(isset($cdvalue['options']['isaddons']) && !isset($cdvalue['options']['isvariation'])){
                            $cart_total += $cdvalue['subtotal'];
                            $cart_total += $cdvalue['options']['extra_costs_total'];
                            $item_total += $cdvalue['subtotal'];
                        }else{                    

                            $cart_total += $cdvalue['subtotal'];
                            $item_total += $cdvalue['subtotal'];
                        }
                        // Jo Order Item Variant Entry
                        if($isveriation!='' and $isveriation!=0){
                            if(isset($cdvalue['options']['isvariation']) && $cdvalue['options']['isvariation']!='0') {
                                $variation = $cdvalue['options']['variation'];
                                foreach ($variation as $variationkey => $variationvalue) {
                                    $variationid = $variationvalue['variationid'];
                                    $variation_name = $variationvalue['variation_name'];
                                    $variation_price = $variationvalue['variation_price'];
                                    $variationquantity = $variationvalue['variationquantity'];
                                    $vtotal=($variationvalue['variationquantity']*$variationvalue['variation_price']);
                                    
                                    $variation_data=array();
                                    $variation_data['order_id']=$orderid;
                                    $variation_data['order_no']=$order_no;
                                    $variation_data['customer_id']=$customerid;
                                    $variation_data['item_id']=$item_id;
                                    $variation_data['variation_id']=$variationid;
                                    $variation_data['variation_name']=$variation_name;
                                    $variation_data['variation_price']=$variation_price;
                                    $variation_data['variation_qty']=$variationquantity;
                                    $variation_data['variation_total_cost']=$vtotal;
                                    $variation_data['status']='0';
                                    $variation_data['isdelete']='0';
                                    $variation_data['created_datetime']=date('Y-m-d H:i:s');
                                    $variation_data['modified_datetime']='0000-00-00 00:00:00';
                                    $OrderItemsVariantId=$this->order_model->AddOrderItemVariantDetails($variation_data);

                                    $item_price = $variation_price;
                                    $item_qty = $variationquantity;
                                }
                            } 
                        }

                        // Order Item Entry
                        $items_data=array();
                        $items_data['order_id']=$orderid;
                        $items_data['order_no']=$order_no;
                        $items_data['customer_id']=$customerid;
                        $items_data['item_id']=$item_id;
                        $items_data['item_name']=$item_name;
                        $items_data['item_price']=$item_price;
                        $items_data['item_qty']=$item_qty;
                        $items_data['item_total_cost']=$item_total;
                        $items_data['item_extra_note']=$item_extra_note;
                        $items_data['categoryid']=$category_id;
                        $items_data['isveriation']=$isveriation;
                        $items_data['isaddons']=$isaddons;
                        $items_data['status']='0';
                        $items_data['isdelete']='0';
                        $items_data['created_datetime']=date('Y-m-d H:i:s');
                        $items_data['modified_datetime']='0000-00-00 00:00:00';
                        $OrderItemsId=$this->order_model->AddOrderItemsDetails($items_data);

                        // Jo Order Item Variant Entry
                        if($isveriation!='' and $isveriation!=0){
                            if(isset($cdvalue['options']['isvariation']) && $cdvalue['options']['isvariation']!='0') {
                                $variation = $cdvalue['options']['variation'];
                                foreach ($variation as $variationkey => $variationvalue) {
                                    $variationid = $variationvalue['variationid'];
                                    $variation_name = $variationvalue['variation_name'];
                                    $variation_price = $variationvalue['variation_price'];
                                    $variationquantity = $variationvalue['variationquantity'];
                                    $vtotal=($variationvalue['variationquantity']*$variationvalue['variation_price']);
                                    
                                    $variation_data=array();
                                    $variation_data['order_id']=$orderid;
                                    $variation_data['order_no']=$order_no;
                                    $variation_data['customer_id']=$customerid;
                                    $variation_data['item_id']=$item_id;
                                    $variation_data['variation_id']=$variationid;
                                    $variation_data['variation_name']=$variation_name;
                                    $variation_data['variation_price']=$variation_price;
                                    $variation_data['variation_qty']=$variationquantity;
                                    $variation_data['variation_total_cost']=$vtotal;
                                    $variation_data['status']='0';
                                    $variation_data['isdelete']='0';
                                    $variation_data['created_datetime']=date('Y-m-d H:i:s');
                                    $variation_data['modified_datetime']='0000-00-00 00:00:00';
                                    $OrderItemsVariantId=$this->order_model->AddOrderItemVariantDetails($variation_data);
                                }
                            } 
                        }

                        // Jo Order Item Addon Entry
                        if($isaddons!='' and $isaddons!=0){
                            if(isset($cdvalue['options']['isaddons']) && $cdvalue['options']['isaddons']!='0') {
                                $addons = $cdvalue['options']['addons'];
                                foreach ($addons as $addonskey => $addonsvalue) {
                                    $addonitemid = $addonsvalue['addonitemid'];
                                    $addonitemname = $addonsvalue['addonitemname'];
                                    $addonitemprice = $addonsvalue['addonitemprice'];
                                    $addon_qty = $addonsvalue['addon_qty'];
                                    $addongroupname = $addonsvalue['addongroupname'];
                                    $addongroupid = $addonsvalue['addongroupid'];

                                    $addontotal=($addonitemprice*$addon_qty);
                                    
                                    $addon_data=array();
                                    $addon_data['order_id']=$orderid;
                                    $addon_data['order_no']=$order_no;
                                    $addon_data['customer_id']=$customerid;
                                    $addon_data['item_id']=$item_id;
                                    $addon_data['addons_id']=$addonitemid;
                                    $addon_data['addons_name']=$addonitemname;
                                    $addon_data['addons_price']=$addonitemprice;
                                    $addon_data['addons_qty']=$addon_qty;
                                    $addon_data['addons_total_cost']=$addontotal;
                                    $addon_data['addons_groups_id']=$addongroupid;
                                    $addon_data['addons_groups_name']=$addongroupname;
                                    $addon_data['status']='0';
                                    $addon_data['isdelete']='0';
                                    $addon_data['created_datetime']=date('Y-m-d H:i:s');
                                    $addon_data['modified_datetime']='0000-00-00 00:00:00';
                                    $OrderItemsAddonId=$this->order_model->AddOrderItemAddonDetails($addon_data);
                                }
                            } 
                        }
                    }
                }
                $finalpay = $cart_total;
                
                $orderinfo =array();

                // Discount                
                $coupons_details_session=$this->session->userdata('coupons_details_session');
                if(!empty($coupons_details_session)){
                    $coupons_details=$this->order_model->GetSingleCouponDetails($coupons_details_session['couponsid']);
                    if(!empty($coupons_details)){                        
                        if($coupons_details['discounttype']!='' and $coupons_details['discounttype']!='0'){
                            if($coupons_details['discounttype']=='1'){
                                $discount = ($finalpay*$coupons_details['discount']/100);
                            }
                            if($coupons_details['discounttype']=='2'){
                                $discount = $coupons_details['discount'];
                            }
                            // if($coupons_details['discountmaxlimit']!='' and $coupons_details['discountmaxlimit']!='0'){
                            //     $discountmaxlimit = $coupons_details['discountmaxlimit'];
                            //     if($discount>$discountmaxlimit){
                            //         $discount =$discountmaxlimit;
                            //     }
                            // }
                            $orderinfo['isdiscount']='1';
                            $orderinfo['discountid']=$coupons_details['discountid'];
                            $orderinfo['discountname']=$coupons_details['discountname'];
                            $orderinfo['discounttype']=$coupons_details['discounttype'];
                            $orderinfo['discountvalue']=$coupons_details['discount'];
                            $orderinfo['discounttotal']=$discount;
                            $finalpay =($finalpay-$discount);
                        }
                    }
                } 

                // Tax
                $gettaxesdetails = $this->order_model->taxes_details();
                if(!empty($gettaxesdetails)){
                    foreach ($gettaxesdetails as $taxesdetailskey => $taxesdetails) {
                        if($taxesdetails['taxtype']!='' and $taxesdetails['taxtype']!='0'){
                            if($taxesdetails['taxtype']=='1'){
                                $taxes = ($finalpay*$taxesdetails['tax']/100);
                                $taxtype ='P';
                            }
                            if($taxesdetails['taxtype']=='2'){
                                $taxes = $taxesdetails['tax'];
                                $taxtype ='F';
                            }
                            // Final Pay
                            $finalpay =($finalpay+$taxes);

                            $orderinfo['istax']='1';
                            $taxes_data=array();
                            $taxes_data['order_id']=$orderid;
                            $taxes_data['order_no']=$order_no;
                            $taxes_data['customer_id']=$customerid;
                            $taxes_data['taxes_id']=$taxesdetails['taxid'];
                            $taxes_data['taxes_name']=$taxesdetails['taxname'];
                            $taxes_data['taxes_type']=$taxtype;                            
                            $taxes_data['taxes_value']=$taxesdetails['tax'];
                            $taxes_data['taxes_total']=$taxes;
                            $taxes_data['status']='0';
                            $taxes_data['isdelete']='0';
                            $taxes_data['created_datetime']=date('Y-m-d H:i:s');
                            $taxes_data['modified_datetime']='0000-00-00 00:00:00';
                            $OrderItemsTaxesId=$this->order_model->AddOrderItemTaxesDetails($taxes_data);

                        }
                    }
                }
                
                
                // Start Delivery Charge
                    $deliverycharge=0;
                    $restaurantsdetails = $this->order_model->restaurants_details();
                    // Packaging Charge As  Internethandling Charge
                    $packaging_applicable_on = $restaurantsdetails['packaging_applicable_on'];
                    $packaging_charge = $restaurantsdetails['packaging_charge'];
                    $packaging_charge_type = $restaurantsdetails['packaging_charge_type'];
                    $internethandlecharge=0;
                    if($packaging_charge!='' and $packaging_charge!='0'){
                            if($packaging_charge_type=='PERCENTAGE'){
                                $internethandlecharge = ($finalpay*$packaging_charge/100);
                            }
                            if($packaging_charge_type=='FIXED'){
                                $internethandlecharge = $packaging_charge;
                            }
                            $final_pay_div .='<p class="mb-1">Internet Handle Charge<span class="float-right text-dark">₹ '.number_format($internethandlecharge,2).'</span></p>';
                            $finalpay =($finalpay+$internethandlecharge);                         
                        }
                    
                    if($this->data['order_type']=='H'){
                        if(!empty($restaurantsdetails)){
                            if($restaurantsdetails['deliverycharge']!='' and $restaurantsdetails['deliverycharge']!='0'){
                                $minimumorderamount = $restaurantsdetails['minimumorderamount'];
                                if($finalpay<$minimumorderamount){
                                    $deliverycharge=$restaurantsdetails['deliverycharge'];
                                    $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                                }
                                // $deliverycharge=$restaurantsdetails['deliverycharge'];
                                // $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                            }
                        }
                    }
                // End Delivery Charge
                
                $GetSquereOff = $this->getsquereoff($finalpay);
                $customerpaid = $GetSquereOff['roundoffprice'];
                $squeroff = $GetSquereOff['squereoff'];
                
                
                $orderinfo['order_id']=$orderid;
                $orderinfo['total_cost']=$cart_total;
                $orderinfo['no_of_items']=count($CartTmpDate);        
                $orderinfo['delivery_fee']=$deliverycharge;
                $orderinfo['tax_fee']=$taxes;
                $orderinfo['packing_charges']=$internethandlecharge;
                // $orderinfo['paid_total']=$finalpay;
                $orderinfo['paid_total']=$customerpaid;
                $orderinfo['squeroff']=$squeroff;
                $orderinfo['paid_date']=date('Y-m-d H:i:s');
                $orderinfo['order_type']=$this->data['order_type'];
                $orderinfo['payment_types']='ONLINE';
                $orderinfo['order_status']='Received';
               
                
                // Customer 
                $CustomerDetails = $this->order_model->GetSingleCustomerDetails($customerid);
                if(!empty($CustomerDetails)){
                    $orderinfo['customername']=$CustomerDetails['name'];
                    $orderinfo['customermobileno']=$CustomerDetails['mobileno'];
                    if($CustomerDetails['email']=='' || $CustomerDetails['email']=='undefined'){
                        $orderinfo['customeremail']='';
                    }else{
                        $orderinfo['customeremail']=$CustomerDetails['email']; 
                    }
                    
                }
                $SpecialInstructions=$this->session->userdata('SpecialInstructions');
                if(isset($SpecialInstructions)){
                    $SpecialInstructions = $SpecialInstructions;
                }else{
                    $SpecialInstructions = '';
                }
                $orderinfo['ordernote']=$SpecialInstructions;
                $UpdateOrderId=$this->order_model->UpdateOrderDetails($orderinfo);

                // All cart Remove & Session Remove
                // $this->cart->destroy();
                // $this->session->unset_userdata("coupons_details_session");
                // $this->session->unset_userdata("delivery_address_id");


                $OrderDetailsSession = array('orderid'=>$orderid, 'order_no'=>$order_no);
                $this->session->set_userdata('OrderDetailsSession', $OrderDetailsSession);
                $returnarray['msg']='success';
                
            }else{
                $returnarray['msg']='error';
            }
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        }
        echo json_encode($returnarray);exit;
    }
    function paymentsuccess(){

        // All cart Remove & Session Remove
        $keyId = $this->data['PG_keyId'];
        $keySecret = $this->data['PG_keySecret'];
        $displayCurrency = 'INR';
        $razorpay_payment_id = $_POST['razorpay_payment_id'];
        $razorpay_signature = $_POST['razorpay_signature'];
        $razorpay_order_id=$this->session->userdata('razorpay_order_id');
        $OrderDetailsSession=$this->session->userdata('OrderDetailsSession');
        $orderid = $OrderDetailsSession['orderid'];
        $orderno = $OrderDetailsSession['order_no'];
        $customerid=$this->data['customer_info']['id'];
        $paymentstatus='captured';
        $success = true;  
        $message='';      
        if ($success==true)
        {
            
            // Our Database in data status change
            // order table staus change transaction_id,paid_date,payment_types
            // order item  table staus change
            // order addon table staus change
            // order variation table staus change
            $UpdateOrderStatus=$this->order_model->UpdateOrderStatusDetails($orderid,$orderno,$customerid,$razorpay_payment_id,$razorpay_order_id,$paymentstatus);
            $OrderTypeDetails = $this->order_model->GetOrderTypeDetails($orderno,$orderid,$customerid);
            $order_push_on=$this->data['order_push_on'];
            
            // Petpooja in push data
            if($order_push_on=='Both'){
                // pickup on petpooja
                if($OrderTypeDetails['order_type']=='P'){
                    $petpooja = $this->petpooja_in_data_push($orderid,$orderno,$customerid);
                    $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'petpooja');
                    $message=$petpooja;
                }
                
                // delivery on fudex
                if($OrderTypeDetails['order_type']=='H'){
                    $fudx = $this->fudx_in_data_push($orderid,$orderno,$customerid);
                    $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'fudx');
                    $message=$petpooja;
                }
            }
            
            //push order only petpooja
            if($order_push_on=='petpooja'){
                $petpooja = $this->petpooja_in_data_push($orderid,$orderno,$customerid);
                $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'petpooja');
                $message=$petpooja;
            }


            //push order only fudex
            if($order_push_on=='fudx'){
                $fudx = $this->fudx_in_data_push($orderid,$orderno,$customerid);
                $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'fudx');
                $message=$petpooja;
            }            

            $this->cart->destroy();
            $this->session->unset_userdata("coupons_details_session");
            $this->session->unset_userdata("delivery_address_id");
            $this->session->unset_userdata("SpecialInstructions");
            $this->session->unset_userdata("order_type");
            $this->session->unset_userdata("OrderDetailsSession");
            $this->session->unset_userdata("razorpay_order_id");

            $orderview_url=$this->data['base_url'].'order/vieworder/'.$orderno;
            $this->session->set_flashdata('message',$message);
            redirect($orderview_url);            
        }
    }
    function paycashondelivery(){
        $returnarray = array();      
        $delivery_address_id=$this->session->userdata('delivery_address_id');
        
        $customerid=$this->data['customer_info']['id'];
        $CartTmpDate = $this->cart->contents();
        $GetRandNumberString = $this->get_random_string(5);
        //$order_no =  'ORD'.random_string('alnum',5).rand(100,10000);  
        $order_no =  'ORD'.date('his').$GetRandNumberString.rand(100,10000);
        $items_data     = array();
        $addons_data    = array();
        $finalpay=0;
        $offer_products_data = array();
        
        if($this->data['customer_info']['id']!='' && !empty($CartTmpDate)){
            $CartTmpDate = $this->cart->contents();
            $cart_total =0;
            $cartdetails = '';            
            if(!empty($CartTmpDate)){                
                // Order Details Update Order Table in Etry
                $orderinfo =array();
                $orderinfo['order_no']=$order_no;
                $orderinfo['customerid']=$customerid;
                $orderinfo['order_date']=date('Y-m-d');
                $orderinfo['order_time']=date('H:i:s');;
                // Address
                $DeliveryAddressDetails=$this->manageaddresses_model->GetCustomerSingleAddress($delivery_address_id);
                if(!empty($DeliveryAddressDetails)){
                    $orderinfo['addressid']=$delivery_address_id;
                    $orderinfo['addressarea']=$DeliveryAddressDetails['deliveryarea'];
                    $orderinfo['addresscomplete']=$DeliveryAddressDetails['completedddress'];
                    $orderinfo['city']=$DeliveryAddressDetails['city'];
                    $orderinfo['pincode']=$DeliveryAddressDetails['pincode'];
                    $orderinfo['customerlatitude']=$DeliveryAddressDetails['latitude'];
                    $orderinfo['customerlongtitude']=$DeliveryAddressDetails['longtitude'];
                }           
                $orderinfo['status']='1';
                $orderinfo['isdelete']='0';
                $orderinfo['created_datetime']=date('Y-m-d H:i:s');
                $orderinfo['modified_datetime']='0000-00-00 00:00:00';
                $orderid=$this->order_model->AddOrderDetails($orderinfo);
                foreach ($CartTmpDate as $cdkey => $cdvalue) {
                    if($cdvalue['qty']!='' && $cdvalue['qty']!='0'){
                        $item_id = $cdvalue['id'];
                        $item_price = $cdvalue['price'];
                        $item_name = $cdvalue['name'];
                        $category_id = $cdvalue['options']['category_id'];
                        $item_description = $cdvalue['options']['description'];
                        $item_qty = $cdvalue['qty'];
                        $item_extra_note = $cdvalue['options']['item_extra_note'];
                        $item_total =0;
                        $isveriation =0;
                        $isaddons =0;
                        if (isset($cdvalue['options']['isvariation'])){
                            $isveriation =1;
                        }
                        if(isset($cdvalue['options']['isaddons'])){
                            $isaddons =1;
                        }
                        if (isset($cdvalue['options']['isvariation'])) {
                            $cart_total += $cdvalue['options']['extra_costs_total'];
                            $item_total += $cdvalue['options']['extra_costs_total'];
                        }else if(isset($cdvalue['options']['isaddons']) && !isset($cdvalue['options']['isvariation'])){
                            $cart_total += $cdvalue['subtotal'];
                            $cart_total += $cdvalue['options']['extra_costs_total'];
                            $item_total += $cdvalue['subtotal'];
                        }else{                    

                            $cart_total += $cdvalue['subtotal'];
                            $item_total += $cdvalue['subtotal'];
                        }
                        // Jo Order Item Variant Entry
                        if($isveriation!='' and $isveriation!=0){
                            if(isset($cdvalue['options']['isvariation']) && $cdvalue['options']['isvariation']!='0') {
                                $variation = $cdvalue['options']['variation'];
                                foreach ($variation as $variationkey => $variationvalue) {
                                    $variationid = $variationvalue['variationid'];
                                    $variation_name = $variationvalue['variation_name'];
                                    $variation_price = $variationvalue['variation_price'];
                                    $variationquantity = $variationvalue['variationquantity'];
                                    $vtotal=($variationvalue['variationquantity']*$variationvalue['variation_price']);
                                    
                                    $variation_data=array();
                                    $variation_data['order_id']=$orderid;
                                    $variation_data['order_no']=$order_no;
                                    $variation_data['customer_id']=$customerid;
                                    $variation_data['item_id']=$item_id;
                                    $variation_data['variation_id']=$variationid;
                                    $variation_data['variation_name']=$variation_name;
                                    $variation_data['variation_price']=$variation_price;
                                    $variation_data['variation_qty']=$variationquantity;
                                    $variation_data['variation_total_cost']=$vtotal;
                                    $variation_data['status']='1';
                                    $variation_data['isdelete']='0';
                                    $variation_data['created_datetime']=date('Y-m-d H:i:s');
                                    $variation_data['modified_datetime']='0000-00-00 00:00:00';
                                    $OrderItemsVariantId=$this->order_model->AddOrderItemVariantDetails($variation_data);

                                    $item_price = $variation_price;
                                    $item_qty = $variationquantity;
                                }
                            } 
                        }

                        // Order Item Entry
                        $items_data=array();
                        $items_data['order_id']=$orderid;
                        $items_data['order_no']=$order_no;
                        $items_data['customer_id']=$customerid;
                        $items_data['item_id']=$item_id;
                        $items_data['item_name']=$item_name;
                        $items_data['item_price']=$item_price;
                        $items_data['item_qty']=$item_qty;
                        $items_data['item_total_cost']=$item_total;
                        $items_data['item_extra_note']=$item_extra_note;
                        $items_data['categoryid']=$category_id;
                        $items_data['isveriation']=$isveriation;
                        $items_data['isaddons']=$isaddons;
                        $items_data['status']='1';
                        $items_data['isdelete']='0';
                        $items_data['created_datetime']=date('Y-m-d H:i:s');
                        $items_data['modified_datetime']='0000-00-00 00:00:00';
                        $OrderItemsId=$this->order_model->AddOrderItemsDetails($items_data);

                        // Jo Order Item Variant Entry
                        if($isveriation!='' and $isveriation!=0){
                            if(isset($cdvalue['options']['isvariation']) && $cdvalue['options']['isvariation']!='0') {
                                $variation = $cdvalue['options']['variation'];
                                foreach ($variation as $variationkey => $variationvalue) {
                                    $variationid = $variationvalue['variationid'];
                                    $variation_name = $variationvalue['variation_name'];
                                    $variation_price = $variationvalue['variation_price'];
                                    $variationquantity = $variationvalue['variationquantity'];
                                    $vtotal=($variationvalue['variationquantity']*$variationvalue['variation_price']);
                                    
                                    $variation_data=array();
                                    $variation_data['order_id']=$orderid;
                                    $variation_data['order_no']=$order_no;
                                    $variation_data['customer_id']=$customerid;
                                    $variation_data['item_id']=$item_id;
                                    $variation_data['variation_id']=$variationid;
                                    $variation_data['variation_name']=$variation_name;
                                    $variation_data['variation_price']=$variation_price;
                                    $variation_data['variation_qty']=$variationquantity;
                                    $variation_data['variation_total_cost']=$vtotal;
                                    $variation_data['status']='1';
                                    $variation_data['isdelete']='0';
                                    $variation_data['created_datetime']=date('Y-m-d H:i:s');
                                    $variation_data['modified_datetime']='0000-00-00 00:00:00';
                                    $OrderItemsVariantId=$this->order_model->AddOrderItemVariantDetails($variation_data);
                                }
                            } 
                        }

                        // Jo Order Item Addon Entry
                        if($isaddons!='' and $isaddons!=0){
                            if(isset($cdvalue['options']['isaddons']) && $cdvalue['options']['isaddons']!='0') {
                                $addons = $cdvalue['options']['addons'];
                                foreach ($addons as $addonskey => $addonsvalue) {
                                    $addonitemid = $addonsvalue['addonitemid'];
                                    $addonitemname = $addonsvalue['addonitemname'];
                                    $addonitemprice = $addonsvalue['addonitemprice'];
                                    $addon_qty = $addonsvalue['addon_qty'];
                                    $addongroupname = $addonsvalue['addongroupname'];
                                    $addongroupid = $addonsvalue['addongroupid'];

                                    $addontotal=($addonitemprice*$addon_qty);
                                    
                                    $addon_data=array();
                                    $addon_data['order_id']=$orderid;
                                    $addon_data['order_no']=$order_no;
                                    $addon_data['customer_id']=$customerid;
                                    $addon_data['item_id']=$item_id;
                                    $addon_data['addons_id']=$addonitemid;
                                    $addon_data['addons_name']=$addonitemname;
                                    $addon_data['addons_price']=$addonitemprice;
                                    $addon_data['addons_qty']=$addon_qty;
                                    $addon_data['addons_total_cost']=$addontotal;
                                    $addon_data['addons_groups_id']=$addongroupid;
                                    $addon_data['addons_groups_name']=$addongroupname;
                                    $addon_data['status']='1';
                                    $addon_data['isdelete']='0';
                                    $addon_data['created_datetime']=date('Y-m-d H:i:s');
                                    $addon_data['modified_datetime']='0000-00-00 00:00:00';
                                    $OrderItemsAddonId=$this->order_model->AddOrderItemAddonDetails($addon_data);
                                }
                            } 
                        }
                    }
                }
                $finalpay = $cart_total;
                   
                $orderinfo =array();

                
                // Discount                
                $coupons_details_session=$this->session->userdata('coupons_details_session');
                if(!empty($coupons_details_session)){
                    $coupons_details=$this->order_model->GetSingleCouponDetails($coupons_details_session['couponsid']);
                    if(!empty($coupons_details)){                        
                        if($coupons_details['discounttype']!='' and $coupons_details['discounttype']!='0'){
                            if($coupons_details['discounttype']=='1'){
                                $discount = ($finalpay*$coupons_details['discount']/100);
                            }
                            if($coupons_details['discounttype']=='2'){
                                $discount = $coupons_details['discount'];
                            }
                            // if($coupons_details['discountmaxlimit']!='' and $coupons_details['discountmaxlimit']!='0'){
                            //     $discountmaxlimit = $coupons_details['discountmaxlimit'];
                            //     if($discount>$discountmaxlimit){
                            //         $discount =$discountmaxlimit;
                            //     }
                            // }
                            $orderinfo['isdiscount']='1';
                            $orderinfo['discountid']=$coupons_details['discountid'];
                            $orderinfo['discountname']=$coupons_details['discountname'];
                            $orderinfo['discounttype']=$coupons_details['discounttype'];
                            $orderinfo['discountvalue']=$coupons_details['discount'];
                            $orderinfo['discounttotal']=$discount;
                            $finalpay =($finalpay-$discount);
                        }
                    }
                } 
                
                // Tax
                $gettaxesdetails = $this->order_model->taxes_details();
                if(!empty($gettaxesdetails)){
                    foreach ($gettaxesdetails as $taxesdetailskey => $taxesdetails) {
                        if($taxesdetails['taxtype']!='' and $taxesdetails['taxtype']!='0'){
                            if($taxesdetails['taxtype']=='1'){
                                $taxes = ($finalpay*$taxesdetails['tax']/100);
                                $taxtype ='P';
                            }
                            if($taxesdetails['taxtype']=='2'){
                                $taxes = $taxesdetails['tax'];
                                $taxtype ='F';
                            }
                            // Final Pay
                            $finalpay =($finalpay+$taxes);

                            $orderinfo['istax']='1';
                            $taxes_data=array();
                            $taxes_data['order_id']=$orderid;
                            $taxes_data['order_no']=$order_no;
                            $taxes_data['customer_id']=$customerid;
                            $taxes_data['taxes_id']=$taxesdetails['taxid'];
                            $taxes_data['taxes_name']=$taxesdetails['taxname'];
                            $taxes_data['taxes_type']=$taxtype;                            
                            $taxes_data['taxes_value']=$taxesdetails['tax'];
                            $taxes_data['taxes_total']=$taxes;
                            $taxes_data['status']='1';
                            $taxes_data['isdelete']='0';
                            $taxes_data['created_datetime']=date('Y-m-d H:i:s');
                            $taxes_data['modified_datetime']='0000-00-00 00:00:00';
                            $OrderItemsTaxesId=$this->order_model->AddOrderItemTaxesDetails($taxes_data);

                        }
                    }
                }
                
                
                // Start Delivery Charge
                    $deliverycharge=0;
                    $restaurantsdetails = $this->order_model->restaurants_details();
                    // Packaging Charge As  Internethandling Charge
                    $packaging_applicable_on = $restaurantsdetails['packaging_applicable_on'];
                    $packaging_charge = $restaurantsdetails['packaging_charge'];
                    $packaging_charge_type = $restaurantsdetails['packaging_charge_type'];
                    $internethandlecharge=0;
                    if($packaging_charge!='' and $packaging_charge!='0'){
                        if($packaging_charge_type=='PERCENTAGE'){
                            $internethandlecharge = ($finalpay*$packaging_charge/100);
                        }
                        if($packaging_charge_type=='FIXED'){
                            $internethandlecharge = $packaging_charge;
                        }
                        $final_pay_div .='<p class="mb-1">Internet Handle Charge<span class="float-right text-dark">₹ '.number_format($internethandlecharge,2).'</span></p>';
                        $finalpay =($finalpay+$internethandlecharge);                         
                    }
                    if($this->data['order_type']=='H'){
                        if(!empty($restaurantsdetails)){
                            if($restaurantsdetails['deliverycharge']!='' and $restaurantsdetails['deliverycharge']!='0'){
                                $minimumorderamount = $restaurantsdetails['minimumorderamount'];
                                if($finalpay<$minimumorderamount){
                                    $deliverycharge=$restaurantsdetails['deliverycharge'];
                                    $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                                }
                                // $deliverycharge=$restaurantsdetails['deliverycharge'];
                                // $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                            }
                        }
                    }
                // End Delivery Charge
                
                // Squer Off Method 

                $GetSquereOff = $this->getsquereoff($finalpay);
                $customerpaid = $GetSquereOff['roundoffprice'];
                $squeroff = $GetSquereOff['squereoff'];
                
                $orderinfo['order_id']=$orderid;
                $orderinfo['total_cost']=$cart_total;
                $orderinfo['no_of_items']=count($CartTmpDate);        
                $orderinfo['delivery_fee']=$deliverycharge;
                $orderinfo['tax_fee']=$taxes;
                $orderinfo['packing_charges']=$internethandlecharge;
                //$orderinfo['paid_total']=$finalpay;
                $orderinfo['paid_total']=$customerpaid;
                $orderinfo['squeroff']=$squeroff;
                $orderinfo['paid_date']=date('Y-m-d H:i:s');
                $orderinfo['order_type']=$this->data['order_type'];
                $orderinfo['payment_types']='COD';
                $orderinfo['order_status']='Received';
                
                
                // Customer 
                $CustomerDetails = $this->order_model->GetSingleCustomerDetails($customerid);
                if(!empty($CustomerDetails)){
                    $orderinfo['customername']=$CustomerDetails['name'];
                    $orderinfo['customermobileno']=$CustomerDetails['mobileno'];
                    $orderinfo['customeremail']=$CustomerDetails['email'];
                    if($CustomerDetails['email']=='' || $CustomerDetails['email']=='undefined'){
                        $orderinfo['customeremail']='';
                    }else{
                        $orderinfo['customeremail']=$CustomerDetails['email'];
                    }
                }
                $SpecialInstructions=$this->session->userdata('SpecialInstructions');
                if(isset($SpecialInstructions)){
                    $SpecialInstructions = $SpecialInstructions;
                }else{
                    $SpecialInstructions = '';
                }
                $orderinfo['ordernote']=$SpecialInstructions;
                //$orderinfo['ordernote']='';
                $UpdateOrderId=$this->order_model->UpdateOrderDetails($orderinfo);

                $orderno=$order_no;
                $order_push_on=$this->data['order_push_on'];
            
                // Petpooja in push data
                if($order_push_on=='Both'){
                    // pickup on petpooja
                    if($this->data['order_type']=='P'){
                        $petpooja = $this->petpooja_in_data_push($orderid,$orderno,$customerid);
                        $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'petpooja');
                        $message=$petpooja;
                    }
                    
                    // delivery on fudex
                    if($this->data['order_type']=='H'){
                        $fudx = $this->fudx_in_data_push($orderid,$orderno,$customerid);
                        $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'fudx');
                        $message=$petpooja;
                    }
                }
            
                //push order only petpooja
                if($order_push_on=='petpooja'){
                    $petpooja = $this->petpooja_in_data_push($orderid,$orderno,$customerid);
                    $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'petpooja');
                    $message=$petpooja;
                }


                //push order only fudex
                if($order_push_on=='fudx'){
                    $fudx = $this->fudx_in_data_push($orderid,$orderno,$customerid);
                    $UpdateOrderPushDetails=$this->order_model->UpdateOrderPushDetails($orderid,'fudx');
                    $message=$petpooja;
                }            

                $this->cart->destroy();
                $this->session->unset_userdata("coupons_details_session");
                $this->session->unset_userdata("delivery_address_id");
                $this->session->unset_userdata("SpecialInstructions");
                $this->session->unset_userdata("order_type");
                $this->session->unset_userdata("OrderDetailsSession");
            
                $orderview_url=$this->data['base_url'].'order/vieworder/'.$orderno;
                $this->session->set_flashdata('message',$message);
                redirect($orderview_url); 
            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }
    function petpooja_in_data_push($orderid,$orderno,$customerid){
        
        // Petpooja Datapass Resturant Details
            $restaurantsdetails = $this->order_model->restaurants_details();
            $res_name = $restaurantsdetails['restaurantname'];
            $res_address = $restaurantsdetails['address'];
            $res_contact_information = $restaurantsdetails['contact'];
            $res_restID = $this->data['restID'];

        // Order Details
            $orderdetails = $this->order_model->GetOrderDetails($orderno,$orderid,$customerid);

        // Customer Details
            $email=$orderdetails['customeremail'];
            $name=$orderdetails['customername'];
            $address=$orderdetails['addressarea'].','.$orderdetails['addresscomplete'].','.$orderdetails['city'].','.$orderdetails['pincode'];
            $address =$this->RemoveSpecialChar($address);
            $city = $orderdetails['city'];
            $phone=$orderdetails['customermobileno'];

        // Order Details
            $orderID=$orderdetails['order_no'];
            $preorder_date=$orderdetails['order_date'];
            $preorder_time=$orderdetails['order_time'];
            $delivery_charges=$orderdetails['delivery_fee'];
            $packing_charges=$orderdetails['packing_charges'];
            $order_type=$orderdetails['order_type'];
            $advanced_order=$orderdetails['advanced_order'];
            $payment_type=$orderdetails['payment_types'];
            $table_no=$orderdetails['table_no'];
            $no_of_persons=0;
            $discount_total=$orderdetails['discounttotal'];
            $tax_total=$orderdetails['tax_fee'];
            $discountid=$orderdetails['discountid'];
            $discountname=$orderdetails['discountname'];        
            $discount=$orderdetails['discounttotal'];
            $discountvalue=$orderdetails['discountvalue'];
            $discount_type=$orderdetails['discounttype'];
            if($discount_type=='1'){
                $discount_type = 'P';
            }
            if($discount_type=='2'){
                $discount_type = 'F';
            }
            $total=$orderdetails['paid_total'];
            $description=preg_replace('/\s+/', ' ', $orderdetails['ordernote']);
            $created_on=$orderdetails['created_datetime'];
            $callback_url='https://raivatkitchen.com/getstatusorder/orderstatusfrompetpooja';
            $orderitemdetails = $this->order_model->GetOrderItemDetails($orderno,$orderid,$customerid); 
            $advancedorder=0;
            $jsonnewdata = '{
                "app_key": "'.$this->data['app_key'].'",
                "app_secret": "'.$this->data['app_secret'].'",
                "access_token": "'.$this->data['access_token'].'",
                "udid": "",
                "device_type": "Web",
                "orderinfo": {
                    "OrderInfo": {
                      "Restaurant": {
                        "details": {
                          "res_name": "'.$res_name.'",
                          "address": "'.$res_address.'",
                          "contact_information": "'.$res_contact_information.'",
                          "restID": "'.$res_restID.'"
                        }
                      },
                      "Customer": {
                        "details": {
                          "email": "'.$email.'",
                          "name": "'.$name.'",
                          "address": "'.$address.'",
                          "phone": "'.$phone.'",
                          "locality": "'.$city.'"
                        }
                      },
                      "Order": {
                        "details": {
                          "orderID": "'.$orderID.'",
                          "preorder_date": "'.$preorder_date.'",
                          "preorder_time": "'.$preorder_time.'",
                          "minimum_order_amount": "'.$total.'",
                          "delivery_charges": "'.$delivery_charges.'",
                          "order_type": "'.$order_type.'",
                          "packing_charges": "'.$packing_charges.'",
                          "advance_order": "'.$advanced_order.'",
                          "payment_type": "'.$payment_type.'",
                          "discount": "'.$discountvalue.'",
                          "discount_total": "'.$discount_total.'",                  
                          "discount_type": "'.$discount_type.'",
                          "description": "'.$description.'",
                          "tax_total": "'.$tax_total.'",
                          "total": "'.$total.'",
                          "created_on": "'.$created_on.'",
                          "callback_url": "'.$callback_url.'",
                          "enable_delivery" : "1"
                        }
                      },
                      "OrderItem": {
                        "details": [';
                            $itemarray='';
                            if(!empty($orderitemdetails)){
                                $totalitems = count($orderitemdetails);
                                $itemcount=0;
                                foreach ($orderitemdetails as $orderitemdetailskey => $orderitemdetailsvalue) {
                                    $itemcount++;
                                    $isveriation = $orderitemdetailsvalue['isveriation'];
                                    $itemid =$orderitemdetailsvalue['item_id'];
                                    $itemname =$orderitemdetailsvalue['item_name'];
                                    $itemprice =$orderitemdetailsvalue['item_price'];
                                    $itemquantity =$orderitemdetailsvalue['item_qty'];
                                    $itemdescription =$orderitemdetailsvalue['item_extra_note'];
                                    if($itemid=='12074088'){
                                        $advancedorder='1';
                                    }
                                    
                                    
                                    if ($itemid!='') {
                                        $jsonnewdata .='{
                                            "id": "'.$itemid.'",
                                            "name": "'.$itemname.'",
                                            "price": '.$itemprice.',
                                            "quantity": "'.$itemquantity.'",
                                            "description": "'.$itemdescription.'",
                                            "variation_id": "",
                                            "variation_name": "",
                                            "AddonItem": {
                                              "details": [';
                                                $isaddons = $orderitemdetailsvalue['isaddons'];
                                                if($isaddons=='1'){
                                                    $orderitemaddonsdetails = $this->order_model->GetOrderItemAddonsDetails($orderno,$orderid,$customerid,$itemid);
                                                    $totalitemaddons = count($orderitemaddonsdetails);
                                                    $itemaddonscount=0;
                                                    if(!empty($orderitemaddonsdetails)){
                                                        foreach ($orderitemaddonsdetails as $orderitemaddonsdetailskey => $orderitemaddonsdetailsvalue) {
                                                            $itemaddonscount++;
                                                            $addons_id = $orderitemaddonsdetailsvalue['addons_id'];
                                                            $addons_name = $orderitemaddonsdetailsvalue['addons_name'];
                                                            $addons_price = $orderitemaddonsdetailsvalue['addons_price'];
                                                            $addons_qty = $orderitemaddonsdetailsvalue['addons_qty'];
                                                            $addons_groups_id = $orderitemaddonsdetailsvalue['addons_groups_id'];
                                                            $addons_groups_name = $orderitemaddonsdetailsvalue['addons_groups_name'];
                                                            $jsonnewdata .='{
                                                              "id": "'.$addons_id.'",
                                                              "name": "'.$addons_name.'",
                                                              "price": "'.$addons_price.'",
                                                              "quantity": "'.$addons_qty.'",
                                                              "group_id": "'.$addons_groups_id.'",
                                                              "group_name": "'.$addons_groups_name.'"
                                                            }';
                                                            if($totalitemaddons!=$itemaddonscount && $totalitemaddons!=''){
                                                               $jsonnewdata .=',';
                                                            }
                                                        }  
                                                    }
                                                }
                                                $jsonnewdata .=']
                                            }
                                        }';
                                        if($totalitems!=$itemcount && $totalitems!=''){
                                            $jsonnewdata .=',';
                                        }
                                    }
                                }
                            }
                            
                        $jsonnewdata .=']
                      },
                      "Tax": {
                        "details": [';
                            $gettaxesdetails = $this->order_model->get_order_taxes_details($orderid,$orderno,$customerid);
                            $totalitemtaxes=count($gettaxesdetails);
                            $itemtaxescount='0';
                            if(!empty($gettaxesdetails)){
                                foreach ($gettaxesdetails as $taxesdetailskey => $taxesdetails) {
                                    $itemtaxescount++;
                                    if($taxesdetails['taxes_type']!='' and $taxesdetails['taxes_type']!='0'){
                                        $taxesid = $taxesdetails['taxes_id'];
                                        $taxestitle = $taxesdetails['taxes_name'];
                                        $taxesprice = $taxesdetails['taxes_value'];
                                        $taxes_total = $taxesdetails['taxes_total'];
                                        if($taxesdetails['taxes_type']=='P'){
                                            $totaltax = ($total*$taxesdetails['taxes_value']/100);
                                            $taxestype = 'P';
                                        }
                                        if($taxesdetails['taxes_type']=='F'){
                                            $totaltax = $taxesdetails['taxes_value'];
                                            $taxestype = 'F';
                                        }
                                        $jsonnewdata .='{
                                            "id": '.$taxesid.',
                                            "title": "'.$taxestitle.'",
                                            "price": "'.$taxesprice.'",
                                            "type": "'.$taxestype.'"
                                        }';
                                        if($totalitemtaxes!=$itemtaxescount && $totalitemtaxes!=''){
                                            $jsonnewdata .=',';
                                        }
                                    }
                                }                
                            }
                        $jsonnewdata .=']
                      },
                      "Discount": {
                        "details": [';
                            if($discountid!='' and $discountid!='0'){
                                $jsonnewdata .='{ 
                                    "id": "'.$discountid.'",
                                    "title": "'.$discountname.'",
                                    "type": "'.$discount_type.'",
                                    "price": "'.$discountvalue.'",
                                    "total": "'.$discount_total.'"                    
                                }';
                            }else{
                                $jsonnewdata .='null';
                            }
                        $jsonnewdata .=']
                      }
                    }
                }
            }';
            $petpooja_Save_Order = $this->data['petpooja_Save_Order'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $petpooja_Save_Order,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $jsonnewdata,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
              ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                $return_message = $err;
            } else {
                $success=$response_decode['success']; //1='success' 0=Failure
                $message=$response_decode['message'];
                $response_decode = json_decode($response, TRUE);
                $message=$response_decode['message'];
                $return_message = $message;
            }
        return $return_message;
    }
    function fudx_in_data_push($orderid,$orderno,$customerid){
        
        // Order Details
        $orderdetails = $this->order_model->GetOrderDetails($orderno,$orderid,$customerid);

        // Customer Details
        $email=$orderdetails['customeremail'];
        if($email=='' || $email=='undefined'){
            $email="abc@gmail.com";
        }else{
            $email=$email;
        }
        $name=$orderdetails['customername'];
        $address=$orderdetails['addressarea'].','.$orderdetails['addresscomplete'].','.$orderdetails['city'].','.$orderdetails['pincode'];
        $address =$this->RemoveSpecialChar($address);
        $city = $orderdetails['city'];
        $phone=$orderdetails['customermobileno'];
        $latitude=$orderdetails['customerlatitude'];
        if($latitude==''){
            $latitude='21.5189287';
        }
        $longtitude=$orderdetails['customerlongtitude'];
        if($longtitude==''){
            $longtitude='70.4558306';
        }

        // Order Details
            
            // Status 1 - Order Placed - Customer, 2 - Preparing Order - Restuarant , 8 - Accept By Delivery Boy    Notification to Delivery Boy to Okay the order. 3 - Delivery Guy Assigned Delivery Partner Select Delivery PIN by Restuarant   Delivery Pilot & Restuarant 4 - Order Picked Up Delivery Pilot 5 - Delivered Delivery Pilot & Customer 6 - Cancelled
            
            $orderID=$orderdetails['order_no'];
            $preorder_date=$orderdetails['order_date'];
            $preorder_time=$orderdetails['order_time'];
            $delivery_charges=$orderdetails['delivery_fee'];
            $packing_charges=$orderdetails['packing_charges'];
            $discount_total=$orderdetails['discounttotal'];
            $discountname=$orderdetails['discountname'];
            $total=$orderdetails['paid_total'];
            $description=$orderdetails['ordernote'];
            $payment_types=$orderdetails['payment_types'];
            $orderitemdetails = $this->order_model->GetOrderItemDetails($orderno,$orderid,$customerid); 
            $fudx_Token = $this->data['fudx_Token'];
            $fudx_UserId = $this->data['fudx_UserId'];
            $jsonnewdata = '{
                "token": "'.$fudx_Token.'",
                "order_no": "'.$orderID.'",
                "user_id": "'.$fudx_UserId.'",
                "fullname": "'.$name.'",
                "mobileno": "'.$phone.'",
                "emailid": "'.$email.'",
                "address": "'.trim($address).'",
                "add_lat": "'.trim($latitude).'",
                "add_log": "'.trim($longtitude).'",
                "status": "1",
                "discount_title": "'.$discountname.'",
                "total_discount": "'.$discount_total.'",
                "order_comment": "'.trim($description).'",
                "total_order_amount": "'.$total.'",
                "packaging_charges": "'.$packing_charges.'",
                "order_type": "'.$payment_types.'",
                "order_item": [';
                    $itemarray='';
                    if(!empty($orderitemdetails)){
                        $totalitems = count($orderitemdetails);
                        $itemcount=0;
                        foreach ($orderitemdetails as $orderitemdetailskey => $orderitemdetailsvalue) {
                            $itemcount++;
                            $isveriation = $orderitemdetailsvalue['isveriation'];
                            $itemid =$orderitemdetailsvalue['item_id'];
                            $itemname =$orderitemdetailsvalue['item_name'];
                            $itemprice =$orderitemdetailsvalue['item_price'];
                            $itemquantity =$orderitemdetailsvalue['item_qty'];
                            $itemdescription =$orderitemdetailsvalue['item_extra_note'];
                            $categoryid = $orderitemdetailsvalue['categoryid'];
                            if ($itemid!='') {
                                $jsonnewdata .='{
                                    "category": "'.$categoryid.'",
                                    "pname_en": "'.$itemname.'",
                                    "qty": "'.$itemquantity.'",
                                    "price": "'.$itemprice.'",                                        
                                    "description": "'.$itemdescription.'",
                                    "AddonItem": [';
                                        $isaddons = $orderitemdetailsvalue['isaddons'];
                                        if($isaddons=='1'){
                                            $orderitemaddonsdetails = $this->order_model->GetOrderItemAddonsDetails($orderno,$orderid,$customerid,$itemid);
                                            $totalitemaddons = count($orderitemaddonsdetails);
                                            $itemaddonscount=0;
                                            if(!empty($orderitemaddonsdetails)){
                                                foreach ($orderitemaddonsdetails as $orderitemaddonsdetailskey => $orderitemaddonsdetailsvalue) {
                                                    $itemaddonscount++;
                                                    $addons_name = $orderitemaddonsdetailsvalue['addons_name'];
                                                    $addons_price = $orderitemaddonsdetailsvalue['addons_price'];
                                                    $addons_qty = $orderitemaddonsdetailsvalue['addons_qty'];
                                                    $addons_groups_name = $orderitemaddonsdetailsvalue['addons_groups_name'];
                                                    $jsonnewdata .='{
                                                      "name": "'.$addons_name.'",
                                                      "price": "'.$addons_price.'",
                                                      "quantity": "'.$addons_qty.'",
                                                      "description": "'.$addons_groups_name.'"
                                                    }';
                                                    if($totalitemaddons!=$itemaddonscount && $totalitemaddons!=''){
                                                       $jsonnewdata .=',';
                                                    }
                                                }  
                                            }
                                        }
                                    $jsonnewdata .=']                                        
                                }';
                                if($totalitems!=$itemcount && $totalitems!=''){
                                    $jsonnewdata .=',';
                                }
                            }
                        }
                    }
                    $jsonnewdata .=']
            }';
            //print_r($jsonnewdata);exit;
            $fudx_Save_Order = $this->data['fudx_Save_Order'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $fudx_Save_Order,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 500,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $jsonnewdata,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
              ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                $return_message = $err;
            } else {
                $success=$response_decode['success']; //1='success' 0=Failure
                $message=$response_decode['message'];
                $response_decode = json_decode($response, TRUE);
                $message=$response_decode['message'];
                $return_message = $message;
            }
        return $return_message;
    }
    function vieworder(){
        $order_no=$this->uri->segment(3);
        
        $odata = array();
        $odata['order_no'] = $order_no;
        $OrderDetails = $this->order_model->GetSingelOrderForViewOrder($odata);
        $order_id=$OrderDetails['order_id'];
        $customerid=$OrderDetails['customerid'];
        if(!empty($OrderDetails)){
            $this->data['OrderDetails'] = $OrderDetails;
        }else{
            redirect($this->data['base_url']); 
        }
        $orderstatus = $OrderDetails['order_status'];
        $OrderStatusDetails=array();
        if($orderstatus=='Received'){
            $OrderStatusDetails['orderstatusicon'] ='Received.png';
            $OrderStatusDetails['orderstatustag'] ='Done';
            $OrderStatusDetails['orderstatusmessage'] ='Your order is received!';
            $OrderStatusDetails['orderstatusdescription'] ='Waiting to accept order from restaurant!';
            $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298" class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
        }
        if($orderstatus=='Accepted'){
            $OrderStatusDetails['orderstatusicon'] ='Accepted.png';
            $OrderStatusDetails['orderstatustag'] ='Done';
            $OrderStatusDetails['orderstatusmessage'] ='Your order is Accepted!';
            $OrderStatusDetails['orderstatusdescription'] ='Waiting for Preparing!';
            $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298" class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
        }
        if($orderstatus=='Preparing'){
            $OrderStatusDetails['orderstatusicon'] ='Preparing.png';
            $OrderStatusDetails['orderstatustag'] ='Done';
            $OrderStatusDetails['orderstatusmessage'] ='Your order is Preparing!';
            $OrderStatusDetails['orderstatusdescription'] ='Waiting for Food Ready.';
            $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
        }
        if($orderstatus=='FoodReady'){
            $OrderStatusDetails['orderstatusicon'] ='FoodReady.png';
            $OrderStatusDetails['orderstatustag'] ='Done';
            $OrderStatusDetails['orderstatusmessage'] ='Your Food is Ready!';
            $OrderStatusDetails['orderstatusdescription'] ='Waiting for Dispatched!';
            $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
        }
        if($orderstatus=='Dispatch'){
            $OrderStatusDetails['orderstatusicon'] ='Dispatch.png';
            $OrderStatusDetails['orderstatustag'] ='Done';
            $OrderStatusDetails['orderstatusmessage'] ='Your order is Dispatched from Kitchen!';
            $OrderStatusDetails['orderstatusdescription'] ='Waiting for Delivered.';
            $OrderStatusDetails['orderstatusbtn'] = '';

            $ordermessage = 'Your order has Dispatched..';
            $ordermessageicon = 'Dispatch.png';
        }
        if($orderstatus=='Delivered'){
            $OrderStatusDetails['orderstatusicon'] ='Delivered.png';
            $OrderStatusDetails['orderstatustag'] ='Done';
            $OrderStatusDetails['orderstatusmessage'] ='Your order has been Delivered.';
            $OrderStatusDetails['orderstatusdescription'] ='Enjoy the Food. Dont forget rate us.';
            $OrderStatusDetails['orderstatusbtn'] = '';
        }
        if($orderstatus=='Cancelled'){
            $OrderStatusDetails['orderstatusicon'] ='Cancelled.png';
            $OrderStatusDetails['orderstatustag'] ='Done';
            $OrderStatusDetails['orderstatusmessage'] ='Your order is Cancelled.';
            $OrderStatusDetails['orderstatusdescription'] ='Cancelled order from restaurant!';
            $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
        } 
        // Only Girveda Product Next Day Message Start
            $GirvedaNextDayDeliveryMessage='';
            if($orderstatus!='Delivered' || $orderstatus!='Cancelled'){
                $GetGirvedaItem = $this->item_model->GetGirvedaItem();
                $GirvedaItemList =array();
                foreach ($GetGirvedaItem as $GIkey => $GIValue) {
                    $GirvedaItemList[]=$GIValue['itemid'];
                }
                $GetOrderItem =$this->order_model->GetOrderItemDetails($order_no,$order_id,$customerid);
                $RaivatItemCount =0;
                foreach ($GetOrderItem as $key => $OrderItem) {
                    if(!in_array($OrderItem['item_id'], $GirvedaItemList)){
                        $RaivatItemCount++;
                    }
                    
                }
                if($RaivatItemCount==0){
                    $DeliveryDate=date('d-m-Y', strtotime($OrderDetails['order_date'] . ' +1 day'));
                    $GirvedaNextDayDeliveryMessage = "Hey Nature Lover, Thank you for shopping with us! Your order has been accepted and will be delivered to you on ".$DeliveryDate;
                }
            }
        // Only Girveda Product Next Day Message End
        //if order delivery show feedback form   
        $feedbackform='';
        if($orderstatus=='Delivered'){
           $feedbackform = $this->viewfeedbackform($order_id,$order_no);
           //echo $feedbackform;
        }
        $this->data['feedbackform'] = $feedbackform;  
        $this->data['OrderStatusDetails'] = $OrderStatusDetails;
        $this->data['GirvedaNextDayDeliveryMessage'] = $GirvedaNextDayDeliveryMessage;  
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['breadcrumb'] = 'Order us';
        $this->data['tpl_name']= "vieworder.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl'); 
    }
    function get_order_status_from_fudx(){
        $order_no = $this->input->post('order_no');
        $order_id = $this->input->post('order_id');
        $fudx_Token = $this->data['fudx_Token'];
        $fudx_Check_Order_Status = $this->data['fudx_Check_Order_Status'];
        $jsonnewdata = '{
            "token": "'.$fudx_Token.'",
            "order_no": "'.$order_no.'"
        }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $fudx_Check_Order_Status,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $jsonnewdata,
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $OrderStatusDetails = array();
        if ($err) {
            $OrderStatusDetails['message']=$err;
        }else{
            $response_decode = json_decode($response, TRUE);
            $OrderStatusDetails['message']=$response_decode['status'];
            $orderstatus=$response_decode['data']['orderstatus_id'];
            $orderstatusnew ='Received';
            
            if($orderstatus=='1'){
                $OrderStatusDetails['orderstatusicon'] ='Received.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is received!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting to accept order from restaurant!';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298" class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
                $OrderStatusDetails['orderstatus'] ='Received';
                $status = '1';
                $orderstatusnew='Received';
            }

            if($orderstatus=='2'){
                $OrderStatusDetails['orderstatusicon'] ='Preparing.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is Preparing!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting for Food Ready.';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298" class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
                $OrderStatusDetails['orderstatus'] ='Preparing';
                $status = '1';
                $orderstatusnew='Preparing';
            }
            if($orderstatus=='3'){
                $OrderStatusDetails['orderstatusicon'] ='FoodReady.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your Food is Ready!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting for Dispatched!';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
                $OrderStatusDetails['orderstatus'] ='FoodReady';
                $orderstatusnew='FoodReady';
                $status = '1';
            }
            if($orderstatus=='8'){
                $OrderStatusDetails['orderstatusicon'] ='Dispatch.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is Dispatched from Kitchen!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting for Delivered.';
                
                $delivery_boy_name=$response_decode['delivery_pilot']['name'];
                $delivery_boy_phone=$response_decode['delivery_pilot']['phone'];
                $delivery_boy_latitude=$response_decode['delivery_pilot']['latitude'];
                $delivery_boy_longitude=$response_decode['delivery_pilot']['longitude'];

                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:'.$delivery_boy_phone.'"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call '.$delivery_boy_name.'</a>';
                
                $order_details=$this->order_model->GetCustomerLatLongForOrder($order_no,$order_id);
                if($order_details['customerlatitude']!=''){
                    $customerlatitude = $order_details['customerlatitude'];
                }else{
                    $customerlatitude = '21.5189287';
                }
                
                if($order_details['customerlongtitude']!=''){
                    $customerlongtitude = $order_details['customerlongtitude'];
                }else{
                    $customerlongtitude = '70.4558306';
                }
                $customername =$order_details['customername']; 
                $OrderStatusDetails['orderstatusmap']=$this->get_map_live_location_track_script($delivery_boy_latitude, $delivery_boy_longitude,$delivery_boy_name,$customerlatitude,$customerlongtitude,$customername);
                $OrderStatusDetails['orderstatus'] ='Dispatch';
                $orderstatusnew='Dispatch';
                $status = '1';
                
            }
            if($orderstatus=='5'){
                $OrderStatusDetails['orderstatusicon'] ='Delivered.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order has been Delivered.';
                $OrderStatusDetails['orderstatusdescription'] ='Enjoy the Food. Dont forget rate us.';

                $delivery_boy_name=$response_decode['delivery_pilot']['name'];
                $delivery_boy_phone=$response_decode['delivery_pilot']['phone'];
                $delivery_boy_latitude=$response_decode['delivery_pilot']['latitude'];
                $delivery_boy_longitude=$response_decode['delivery_pilot']['longitude'];
                $OrderStatusDetails['orderstatus'] ='Delivered';
                $OrderStatusDetails['orderstatusbtn'] = '';

                $orderstatusnew='Delivered';
                $status = '1';
            }
            if($orderstatus=='6'){
                $OrderStatusDetails['orderstatusicon'] ='Cancelled.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is Cancelled.';
                $OrderStatusDetails['orderstatusdescription'] ='Cancelled order from restaurant!';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
                $OrderStatusDetails['orderstatus'] ='Cancelled';
                $orderstatusnew='Cancelled';
                $status = '1';
            }
            // Status 
            // 1 - Order Placed - Customer, 
            // 2 - Preparing Order - Restuarant , 
            // 8 - Accept By Delivery Boy Notification to Delivery Boy to Okay the order. 
            // 3 - Delivery Guy Assigned Delivery Partner Select Delivery PIN by Restuarant Delivery Pilot & Restuarant 
            // 4 - Order Picked Up Delivery Pilot 
            // 5 - Delivered Delivery Pilot & Customer 
            // 6 - Cancelled

            $data_array=array();
            $data_array['order_status']=$orderstatusnew;
            $data_array['order_no']=$order_no;
            $data_array['order_id']=$order_id;
            $UPdateOrderStatusId = $this->order_model->OrderStatusUpdate($data_array);

        }
        echo json_encode($OrderStatusDetails);exit;
        
    }
    function get_order_status_from_petpooja(){
        $order_no = $this->input->post('order_no');
        $order_id = $this->input->post('order_id');
        $order_details=$this->order_model->GetOrderStatusFromPetpooja($order_no,$order_id);
        if(!empty($order_details)){
            $OrderStatusDetails=array();
            $OrderStatusDetails['message']='success';
            $orderstatus=$order_details['order_status'];
            if($orderstatus=='Received'){
                $OrderStatusDetails['orderstatusicon'] ='Received.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is received!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting to accept order from restaurant!';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298" class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
            }
            if($orderstatus=='Accepted'){
                $OrderStatusDetails['orderstatusicon'] ='Accepted.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is Accepted!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting for Preparing!';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298" class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
            }
            if($orderstatus=='Preparing'){
                $OrderStatusDetails['orderstatusicon'] ='Preparing.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is Preparing!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting for Food Ready.';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
            }
            if($orderstatus=='FoodReady'){
                $OrderStatusDetails['orderstatusicon'] ='FoodReady.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your Food is Ready!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting for Dispatched!';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
            }
            if($orderstatus=='Dispatch'){
                $OrderStatusDetails['orderstatusicon'] ='Dispatch.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is Dispatched from Kitchen!';
                $OrderStatusDetails['orderstatusdescription'] ='Waiting for Delivered.';
                $OrderStatusDetails['orderstatusbtn'] = '';

                $ordermessage = 'Your order has Dispatched..';
                $ordermessageicon = 'Dispatch.png';
            }
            if($orderstatus=='Delivered'){
                $OrderStatusDetails['orderstatusicon'] ='Delivered.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order has been Delivered.';
                $OrderStatusDetails['orderstatusdescription'] ='Enjoy the Food. Dont forget rate us.';
                $OrderStatusDetails['orderstatusbtn'] = '';
            }
            if($orderstatus=='Cancelled'){
                $OrderStatusDetails['orderstatusicon'] ='Cancelled.png';
                $OrderStatusDetails['orderstatustag'] ='Done';
                $OrderStatusDetails['orderstatusmessage'] ='Your order is Cancelled.';
                $OrderStatusDetails['orderstatusdescription'] ='Cancelled order from restaurant!';
                $OrderStatusDetails['orderstatusbtn'] = '<a href="tel:9069098298"class="mb-2 small btn btn-primary btn-sm d-none w-auto"> Call Kitchen</a>';
            }   
            echo json_encode($OrderStatusDetails);exit;
        }else{
            redirect($this->data['base_url']); 
        }
    }
    
    
    
    function RemoveSpecialChar($str) { 
        // Using str_replace() function  
        // to replace the word  
        $res = str_replace( array( '\'', '"', "'", ';', '<', '>' ), ' ', $str); 
        // Returning the result  
        return $res; 
    } 
    function stdToArray($obj){
      $reaged = (array)$obj;
      foreach($reaged as $key => &$field){
        if(is_object($field))$field = $this->stdToArray($field);
      }
      return $reaged;
    }
    function cvf_convert_object_to_array($data) {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {
            return array_map(__FUNCTION__, $data);
        }
        else {
            return $data;
        }
    }
}
?>