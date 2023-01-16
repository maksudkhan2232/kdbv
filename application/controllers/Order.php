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
            $collectionname=$ProductSingleDetails['collectionname'];
            $collectionshortname=$ProductSingleDetails['collectionshortname'];
            $categoryname=$ProductSingleDetails['categoryname'];
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
                                'options' => array('product_code' => $product_code,'product_collectionid' => $product_collectionid,'product_categoryid' => $product_categoryid,'product_image' => $product_image,'collectionname' => $collectionname,'collectionshortname' => $collectionshortname,'categoryname' => $categoryname)
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
                     'options' => array('product_code' => $product_code,'product_collectionid' => $product_collectionid,'product_categoryid' => $product_categoryid,'product_image' => $product_image,'collectionname' => $collectionname,'collectionshortname' => $collectionshortname,'categoryname' => $categoryname)
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
                    $carthtml .='<a href="javascript:void(0);" onclick="return removetocart(';
                    $carthtml .="'".$cartvalue['rowid']."'";
                    $carthtml .=');"><i class="fa fa-times"></i></a>'; 
                $carthtml .='</div>';
            }
            $carthtml .='<div class="cart-bottom">';                
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
                    $carthtml .='<p align="center"><img src="'.base_url().'assest/frontend/media/images/cart.png" /></p>';
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
    $customer_data = $this->Crud_Model->getDatafromtablewheresingle('billing_customer',array('id'=>$this->data['customer_info']['id'])); 
//  echo "<pre>"; print_r($customer_data) ; 
//  echo $customer_data['country'];
//  exit;
        $this->data['CountryDetails']=$this->Crud_Model->getDatafromtablewhere('billing_country',array('status'=>1),'ASC');
        $this->data['StateDetails']=$this->Crud_Model->GetStateDetails(array('country_id'=>$customer_data['country']));
    //  echo $this->db->last_query() ; exit;
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
//        $this->data['StateDetails']=$this->Crud_Model->getDatafromtablewhere('billing_state',array('status'=>1),'ASC');
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
                        $address_id = $this->input->post('address_id');
                        $orderinfo =array();
                        $orderinfo['address_id']=$address_id;

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
                        $BillingEmail=$AddressDetails['email'];
                        $BillingName=$AddressDetails['name'];
                        if(!empty($AddressDetails)){
                            $orderinfo['BillingName']=$AddressDetails['name'];
                            $orderinfo['BillingEmail']=$AddressDetails['email'];
                            $orderinfo['BillingPhone']=$AddressDetails['mobileno'];
                            $orderinfo['BillingAddress']=$AddressDetails['address'];
                            $orderinfo['BillingCity']=$AddressDetails['city'];
                            $orderinfo['BillingState']=$AddressDetails['state'];
                            $orderinfo['BillingZipCode']=$AddressDetails['pincode'];
                        } 
                        $bill_addr = $this->db->select('*')->from('billing_address')->where('id',$address_id)->get()->row_array();
                        //echo "<pre>"; print_r($bill_addr); exit;
                        $orderinfo['BillingNote']=$ordernote;   
                        $orderinfo['GSTNo']='';      
                        $orderinfo['isDifferentShipping']='';       
                        $orderinfo['ShippingName']=$AddressDetails['name'];
                        $orderinfo['ShippingEmail']=$AddressDetails['email'];
                        $orderinfo['ShippingAddress']=$bill_addr['address'];
                        $orderinfo['ShippingCity']=$bill_addr['city'];
                        $orderinfo['ShippingState']=$bill_addr['state'];
                        $orderinfo['ShippingCountry']=$bill_addr['country'];                        
                        $orderinfo['ShippingZipCode']=$bill_addr['pincode'];
                        $orderinfo['ShippingMobileNo']=$bill_addr['mobileno'];
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
                        // Email Send
                        $subject = "KD Bhindi Jewellers | Your order #ORD".$OrderNo;
                        $message ='';
                        $message .= '<table cellspacing="0" cellpadding="0" border="0" style="background:#f2f2f2;width:100%;border-top:10px solid #f2f2f2">
                               <tbody>
                                  <tr>
                                     <td valign="top" align="center">
                                        <u></u>
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fff;max-width:600px">
                                           <tbody>
                                              <tr>
                                                 <td style="padding-top:18px;padding-bottom:18px;padding-left:15px" valign="top" align="center">
                                                    <img src="'.base_url().'assest/frontend/media/images/logo.svg" width="200" height="auto"> 
                                                    <div style="color:#666666">Zanzarda Road, opp. Saibaba Temple, Junagadh, Gujarat 362001 India<br />Phone: +91 9825085001</div>
                                                 </td>
                                              </tr>
                                           </tbody>
                                        </table>
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:600px;border:1px solid #e2e2e2;background:#fff;border-bottom:1px solid #ef4e46">
                                           <tbody>
                                              <tr>
                                                 <td style="padding-top:0;padding-right:14px;padding-bottom:14px;padding-left:14px">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                       <tbody>
                                                          <tr>
                                                             <td valign="top" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:left;padding-top:40px;padding-bottom:24px">
                                                                Order Number: ORD'.$OrderNo.'
                                                             </td>
                                                             <td valign="top" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:right;padding-top:30px;padding-bottom:24px">
                                                                '.date('d M Y').'
                                                             </td>
                                                          </tr>
                                                          <tr>
                                                             <td valign="top" colspan="2" style="font:normal 16px arial;line-height:19px;color:#51505d;text-align:left;word-wrap:nornal">
                                                                <table cellpadding="10" cellspacing="0" align="center" width="100%" style="font-family:Calibri;"  frame="box" rules="groups">
                                                                   <tr>
                                                                      <td colspan="2" style="font-size:20px;font-weight:bold;color:#990000;background-color:#ffe9be">
                                                                         Hello '.$BillingName.',
                                                                         <p style="font-size:14px;line-height:18px;font-weight:normal;color:#000000;">We’re happy to let you know that we’ve received your order.
                                                                         If you have any questions, contact us here or call us on +91 9825085001
                                                                         </p>
                                                                      </td>
                                                                   </tr>
                                                                   <tr>
                                                                      <td colspan="2">
                                                                         <table border="0" cellpadding="10" cellspacing="0" align="center" width="100%" style="font-size:18px;"  frame="void" rules="none">
                                                                            <tr>
                                                                               <td><b>Sr No. </b></td>
                                                                               <td><b>Product Code </b></td>
                                                                               <td><b>Collection </b></td>
                                                                               <td><b>Category </b></td>
                                                                               <td><b>Qty </b></td>
                                                                               <td><b>Price </b></td>
                                                                               <td><b>Total </b></td>
                                                                            </tr>';
                                                                            $total=0;
                                                                            $Ftotal =0;
                                                                            foreach ($CartTmpDate as $cdkey => $cdvalue) {
                                                                                $total = ($cdvalue['price']*$cdvalue['qty']);
                                                                                $Ftotal = ($Ftotal+$total);
                                                                                    if($cdvalue['price']!='0'){ 
                                                                                        $price = $cdvalue['price'];
                                                                                        $totals = ($cdvalue['price']*$cdvalue['qty']);
                                                                                    }else{ 
                                                                                        $price = '-';
                                                                                        $totals = '-';
                                                                                    }
                                                                                    $message .= '<tr>
                                                                                           <td>'.($cdkey+1).'</td>
                                                                                           <td>'.$cdvalue['options']['product_code'].'</td>
                                                                                           <td>'.$cdvalue['options']['collectionshortname'].'</td>
                                                                                           <td>'.$cdvalue['options']['categoryname'].'</td>
                                                                                           <td>'.$cdvalue['qty'].'</td>
                                                                                           <td>'.$price.'</td>
                                                                                           <td>'.($totals).'</td>
                                                                                        </tr>';
                                                                            }
                                                                            $message .= '<tr>
                                                                               <td colspan="5" align="center"><b>Total</b></td>
                                                                               <td  colspan="2" align="right"><b>₹ '.$Ftotal.'</b></td>
                                                                            </tr>
                                                                         </table>
                                                                      </td>
                                                                   </tr>
                                                                </table>
                                                             </td>
                                                          </tr>
                                                       </tbody>
                                                    </table>
                                                 </td>
                                              </tr>
                                              <tr>
                                                 <td valign="top" style="padding-top:10px;padding-right:14px;padding-bottom:36px;padding-left:14px;text-align:center;">
                                                    <table cellspacing="0" cellpadding="0" width="50%" border="0" style="margin-top:20px;" align="center">
                                                       <tbody>
                                                          <tr>
                                                             <td style="font:normal 15px arial;color:#fff;line-height:18px;background:#00bcd5;border-radius:3px;border:1px solid #00bcd5;text-align:center;padding:12px;">
                                                                <a href="'.base_url().'customer/" title="Connect"  style="outline:none;text-decoration:none;color:#fff" target="_blank">View Order</a> 
                                                             </td>
                                                          </tr>
                                                       </tbody>
                                                    </table>
                                                 </td>
                                              </tr>
                                           </tbody>
                                        </table>
                                     </td>
                                  </tr>
                               </tbody>
                        </table>';
                        $email=$BillingEmail;
                        send_mail($email,$message,$subject,"");
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

    function store(){
        $returnarray = array();        
        echo $this->data['customer_info']['id'];
        $sdata  = $this->input->post('sdata'); // Shiping Data
        if ( $this->input->post('sdata')) {
           echo "<pre>"; print_r($sdata);

            $ins_data['customer_id'] = $this->data['customer_info']['id'];
            $ins_data['is_last'] = 1;
            $ins_data['address'] = $sdata['address'];
            $ins_data['country'] = $sdata['country'];
            $ins_data['state'] = $sdata['state'];
            $ins_data['city'] = $sdata['city'];
            $ins_data['pincode'] = $sdata['pincod'];
            $ins_data['mobileno'] = $sdata['mobileno'];
            $ins_data['alternate_mobileno'] = $sdata['alternatemobileno'];

            $up = $this->db->where('customer_id',$this->data['customer_info']['id'])->update('billing_address',array('is_last'=>0));

            $this->db->insert('billing_address',$ins_data);
           redirect($this->data['base_url'] . 'order/checkout');



        }else{
            redirect($this->data['base_url'] . 'order/checkout');
        }
    }

    function upaddress()
    {
        $address_id=$this->input->post('address_id');
        $updata['address']=$this->input->post('saddress');
        $updata['country']=$this->input->post('scountry');
        $updata['state']=$this->input->post('sstate');
        $updata['city']=$this->input->post('scity');
        $updata['pincode']=$this->input->post('spincode');
        $updata['mobileno']=$this->input->post('smobileno');
        $updata['alternate_mobileno']=$this->input->post('alternatemobileno');
        $updata['modified_datetime']=date("Y-m-d H:i:s");
        $this->db->where('id',$address_id)->update('billing_address',$updata);
        redirect($this->data['base_url'] . 'order/checkout');
        
    }
}
?>