<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class order extends MY_Controller{    
    function __construct(){
        parent::__construct();
        $this->load->model('administrator/Crud_Model');
        //$this->load->model('order_model', '', TRUE);
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
        if(count($this->cart->contents()) > 0) {

        }else{
            redirect($this->data['base_url']);
        }
        $this->data['message'] = $this->session->flashdata('message');
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
        if(count($this->cart->contents()) > 0){
            
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

                $GetLastOrderNoDetails=$this->Crud_Model->GetLastOrderNo();
                if(!empty($GetLastOrderNoDetails)){
                    $LastOrderNo = ($GetLastOrderNoDetails['totalorder']+1);
                }else{
                    $LastOrderNo = 1;
                }
                $OrderNo= sprintf("%04d", $LastOrderNo);
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
                        $orderinfo['TotalProducts']=count($this->cart->contents());
                        // Address
                        $AddressDetails=$this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id'=>$customerid));
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
                        $orderinfo['status']='1';
                        $orderinfo['isdelete']='0';
                        $orderinfo['created_datetime']=date('Y-m-d H:i:s');
                        $orderinfo['modified_datetime']='0000-00-00 00:00:00';
                        $orderid=$this->Crud_Model->InsertData('orders',$orderinfo);
                        foreach ($CartTmpDate as $cdkey => $cdvalue) {
                            if($cdvalue['qty']!='' && $cdvalue['qty']!='0'){                                
                                // Order products Entry
                                $productss_data=array();
                                $productss_data['order_id']=$orderid;
                                $productss_data['order_no']=$OrderNo;
                                $productss_data['customer_id']=$customerid;
                                $productss_data['products_id']=$cdvalue['id'];
                                $productss_data['products_name']= $cdvalue['name'];
                                $productss_data['products_code']= $cdvalue['options']['product_code'];
                                $productss_data['products_price']=$cdvalue['price'];
                                $productss_data['products_qty']=$cdvalue['qty'];
                                $productss_data['products_total_cost']=($cdvalue['price']*$cdvalue['qty']);
                                $productss_data['collectiontype']=$cdvalue['options']['product_collectionid'];
                                $productss_data['categoryid']=$cdvalue['options']['product_categoryid'];
                                $productss_data['products_image']=$cdvalue['options']['product_image'];
                                $productss_data['products_extra_note']="";
                                $productss_data['product_remark']="";
                                $productss_data['status']='1';
                                $productss_data['isdelete']='0';
                                $productss_data['created_datetime']=date('Y-m-d H:i:s');
                                $productss_data['modified_datetime']='0000-00-00 00:00:00';
                                $OrderproductssId=$this->Crud_Model->InsertData('order_products',$productss_data);
                            }
                        }
                       
                        $this->cart->destroy();
                        $this->session->unset_userdata("ordernote");
                        
                        $this->session->set_flashdata('message',"Your Order Successfully Place.");
                        redirect($this->data['base_url'].'customer');            
                    }else{
                        redirect($this->data['base_url'] . 'order/');
                    }
                }
            // End Order Details Add
        }else{
            redirect($this->data['base_url'] . 'order/');
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