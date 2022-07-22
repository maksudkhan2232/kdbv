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
        redirect($this->data['base_url']);
        $data = array(
                'id'      => 'sku_123ABC',
                'qty'     => 1,
                'price'   => 39.95,
                'name'    => 'T-Shirt',
                'options' => array('Size' => 'L', 'Color' => 'Red')
        );
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['breadcrumb'] = 'Order us';
        $this->data['tpl_name']= "order.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl'); 
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
                    $carthtml .='<a href="javascript:void(0);"><i class="fa fa-shopping-cart"></i>View Cart</a>';
                $carthtml .='</div>';
                $carthtml .='<div class="cart-share">';
                    $carthtml .='<a href="javascript:void(0);"><i class="fa fa-share"></i>Checkout</a> ';
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
   
    function addToCartsWithAddons()
    {
        $returnarray = array();        
        $itemid   = $this->input->post('itemid'); //item_id        
        $itemquantity  = $this->input->post('itemquantity'); // quantity
        $jainitem   = $this->input->post('jainitem'); //jainitem 
        $getaddonsgroups = $this->order_model->GetItemAddonsGroups($itemid); 
        $flag = TRUE;
        $extra_costs_total = 0;
        $item_details = $this->order_model->single_item_details($itemid);
        $isvariation=0;
        $isaddon=0;
        
        // Check if our itemid mathch 
        if(!empty($item_details)){        
            // We have a match!
            $item_cost=$item_details['price'];
            $item_name=url_title($item_details['name'], 'dash', true);
            $item_description=$item_details['description'];
            $item_categoryid=$item_details['categoryid'];
            // Check if items variation multiple 
            if ($flag) {                    
                //Check Item already exist in cart
                $existed_item=FALSE;
                if ($this->cart->contents()) { 
                    foreach ($this->cart->contents() as $item) {
                        if ($item['id']==$itemid) {
                            // Already existed! Return FALSE! 
                            $existed_item=TRUE;
                            $returnarray['msg'] = 'alreadyexisted';
                            break;
                        }
                    }                        
                }
                if($existed_item==FALSE){
                    $item_extra_note='';
                    if($jainitem=='undefined'){
                        $item_extra_note='';
                    }else{
                        $item_extra_note=$jainitem;
                    }
                    // Create an array with item information
                    $data = array(
                     'id'      => $itemid,//Item_id
                     'qty'     => $itemquantity, // Item Quantity
                     'price'   => $item_cost,//item_cost from rk_items table
                     'name'    => $item_name,
                     'options' => array('item_name' => $item_details['name'],'description' => $item_description,'item_extra_note' => $item_extra_note, 'item_cost' => $item_cost, 'category_id' => $item_categoryid)
                    );
                    // ADD ONS START
                    if(!empty($getaddonsgroups)){
                        foreach ($getaddonsgroups as $getaddonsgroupskey => $getaddonsgroupsvalue) {
                            $addongroupid=$getaddonsgroupsvalue['addongroupid'];
                            $addon_ids = ($this->input->post('itemaddonid'.$addongroupid)) ? $this->input->post('itemaddonid'.$addongroupid) : "";$getaddons = $this->order_model->GetItemAddons($itemid,$addongroupid);
                            $addonarrays=array();
                            if($addon_ids!='' and !empty($addon_ids)){
                                $addondetails=1;
                                $addons_cost_per_item = 0;
                                $addon_qty='1';
                                $addon_id = $addon_ids;
                                if($addon_qty!='' and $addon_qty!='0' and $addon_id!='' and $addon_id!='0'){
                                    $isaddon=1;
                                    $addon_item_details = $this->order_model->single_addon_item_details($addon_id);
                                    if (!empty($addon_item_details)) {                                
                                        $addonitemid = $addon_item_details['addonitemid'];
                                        $addongroupid = $addon_item_details['addongroupid'];
                                        $addonitemname = $addon_item_details['addonitemname'];
                                        $addonitemprice = $addon_item_details['addonitemprice'];
                                        $addongroupname = $addon_item_details['addongroupname'];

                                        $addons_cost_per_item += ($addonitemprice) * $addon_qty;
                                        $data['options']['addons_cost_per_item'] = $addons_cost_per_item;
                                        //$addons = $addonitemid."=".$addonitemname."=".$addongroupname."=".$addonitemprice."=".$addongroupid."=".$addon_qty;
                                        //$data['options']['addons'][]=$addonitemid."=".$addonitemname."=".$addongroupname."=".$addonitemprice."=".$addongroupid."=".$addon_qty;
                                        $addonarray = array(
                                            'addonitemid' => $addonitemid,
                                            'addonitemname' =>$addonitemname,
                                            'addongroupname' => $addongroupname,
                                            'addonitemprice' =>$addonitemprice,
                                            'addongroupid' =>$addongroupid,
                                            'addon_qty' =>$addon_qty
                                        );
                                        $data['options']['addons'][]=$addonarray;
                                        //['addons'][] =addon_id=addonname=group_name=price=group_id=quantity;
                                    }
                                }
                                if($isaddon==1){
                                    $extra_costs_total += ($addons_cost_per_item);//only addons cost
                                    $data['options']['extra_costs_total'] = $extra_costs_total;//addons cost
                                    $data['options']['isaddons']=$isaddon; // is variation cost
                                }                        
                            }
                        }
                    }
                    //ADD ONS END
                    
                    //VARIATION END
                    if($item_cost=='0'){
                        $data['price']=$extra_costs_total;
                    }
                    // echo "<pre>";
                    // print_r($data);
                    //$this->cart->insert($data);
                    //$this->cart->destroy();
                    //exit;
                    if ($this->cart->insert($data)) {
                        $returnarray['msg'] = 'cartinsert';
                        $returnarray['ftotal'] = $this->cart->total();
                        $returnarray['ftotalqty'] = $this->cart->total_items();
                        $returnarray['ftotalitem'] = count($this->cart->contents());
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
    function checkout(){
        $CartTmpDate = $this->cart->contents();
        $cart_total =0;
        $cartdetails = '';
        if(!empty($CartTmpDate)){
            $cartitemarray =array();
            $ispletter = 0;
            $totalplatter = 0;
            foreach ($CartTmpDate as $cdkey => $cdvalue) {
                $categoryid = $cdvalue['options']['category_id'];
                if($categoryid!='794456'){
                    $ispletter ='1';
                    $totalplatter = ($totalplatter+$cdvalue['qty']);
                }
                $cartitemarray[]=$cdvalue['id'];
                $item_total =0;
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
                $cartdetails .='<div class="item-container-single d-flex gold-members align-items-center justify-content-between px-3 py-2 border-bottom row ml-0 mr-0 align-items-center">';
                    $cartdetails .='<div class="media align-items-center addon-grp-checkout col-7 pl-0 pr-0">';
                        //$cartdetails .='<div class="mr-2 text-success">&middot;</div>';
                        $cartdetails .='<div class="media-body addon-option-name">';
                            $cartdetails .='<div class="d-flex"><p class="m-0"><div class="mr-2 text-success">&middot;</div><div class="txt-sizing">'.$cdvalue['options']['item_name'].'</div></p></div>';
                            //$cartdetails .='<p class="m-0 small">'.$cdvalue['options']['description'].'</p>';
                            $variation_details ='';
                            if(isset($cdvalue['options']['isvariation']) && $cdvalue['options']['isvariation']!='0') {
                                $variation = $cdvalue['options']['variation'];
                                foreach ($variation as $variationkey => $variationvalue) {
                                    $vtotal=($variationvalue['variationquantity']*$variationvalue['variation_price']);
                                    $variation_details .='<span class="addon-item-checkout small d-flex pr-2">'.$variationvalue['variation_name'].'(Qty. '.$variationvalue['variationquantity'].') ₹'.$vtotal."</span>";
                                }
                                $cartdetails .='<p class="m-0 small variation-det">';
                                $cartdetails .=$variation_details;
                                $cartdetails .='</p>';
                            }
                            $addons_details ='';
                            if(isset($cdvalue['options']['isaddons']) && $cdvalue['options']['isaddons']!='0') {
                                $addons = $cdvalue['options']['addons'];
                                foreach ($addons as $addonskey => $addonsvalue) {
                                    $atotal=($addonsvalue['addon_qty']*$addonsvalue['addonitemprice']);
                                    //$addons_details .='<span class="addon-item-checkout small d-flex pr-2">'.$addonsvalue['addonitemname'].'(Qty. '.$addonsvalue['addon_qty'].') ₹ '.$atotal."</span>";
                                    $addons_details .='<span class="addon-item-checkout small d-flex pr-2">'.$addonsvalue['addonitemname'].', </span>';
                                }
                                $cartdetails .='<p class="m-0 small addon-det"> Choice : ';
                                $cartdetails .=$addons_details;
                                $cartdetails .='</p>';
                            }
                        $cartdetails .='</div>';
                    $cartdetails .='</div>';
                    $cartdetails .='<div class="d-flex justify-content-end align-items-center btns-grp-checkout col-5 pl-0 pr-0">';
                            if (isset($cdvalue['options']['isvariation'])) {
                                if ($cdvalue['options']['isvariation']!='0') {
                                    $cartdetails .='<div class="grp-it"><span class="count-number float-right">';
                                        $cartdetails .='<button type="button" class="btn-sm left btn btn-outline-secondary" onclick="get_item_addons_variation_for_customize(';
                                            $cartdetails .="'".$cdvalue['id']."',";   
                                            $cartdetails .="'".$cdvalue['rowid']."'";   
                                            $cartdetails .=')">';   
                                            $cartdetails .='Customize';
                                        $cartdetails .='</button>';
                                    $cartdetails .='</span></div>';
                                }
                            }else if(isset($cdvalue['options']['isaddons']) || isset($cdvalue['options']['isvariation'])){
                                // if ($cdvalue['options']['isaddons']!='0' ||  $cdvalue['options']['isvariation']=='0') {
                                //     $cartdetails .='<div class="grp-it"><span class="count-number float-right">';
                                //         $cartdetails .='<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="return update_qty(';
                                //         $cartdetails .="'".$cdvalue['rowid']."',";   
                                //         $cartdetails .="'decr',";   
                                //         $cartdetails .="'onlyitem'";   
                                //         $cartdetails .=')">';   
                                //             $cartdetails .='<i class="feather-minus"></i>';
                                //         $cartdetails .='</button>';
                                //         $cartdetails .='<input class="count-number-input" type="text" name="" readonly="" value="'.$cdvalue['qty'].'">';
                                //         $cartdetails .='<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="return update_qty(';
                                //         $cartdetails .="'".$cdvalue['rowid']."',";   
                                //         $cartdetails .="'incr',";   
                                //         $cartdetails .="'onlyitem'";   
                                //         $cartdetails .=')">';   
                                //             $cartdetails .='<i class="feather-plus"></i>';
                                //         $cartdetails .='</button>';
                                //     $cartdetails .='</span>';
                                //     $cartdetails .='<p class="text-gray mb-0 float-right ml-2 text-muted small price-pop">₹ '.$item_total.'</p></div>';
                                //     $cartdetails .='<div class="btn-customise count-number"><button type="button" class="btn-sm left btn btn-outline-secondary" onclick="get_item_addons_variation_for_customize(';
                                //         $cartdetails .="'".$cdvalue['id']."',";   
                                //         $cartdetails .="'".$cdvalue['rowid']."'";   
                                //         $cartdetails .=')">';   
                                //         $cartdetails .='Customize';
                                //     $cartdetails .='</button></div>';
                                // }
                                $cartdetails .='<div class="grp-it"><span class="count-number float-right">';
                                    $cartdetails .='<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="return update_qty(';
                                    $cartdetails .="'".$cdvalue['rowid']."',";   
                                    $cartdetails .="'decr',";   
                                    $cartdetails .="'onlyitem'";   
                                    $cartdetails .=')">';   
                                        $cartdetails .='<i class="feather-minus"></i>';
                                    $cartdetails .='</button>';
                                    $cartdetails .='<input class="count-number-input" type="text" name="" readonly="" value="'.$cdvalue['qty'].'">';
                                    $cartdetails .='<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="return update_qty(';
                                    $cartdetails .="'".$cdvalue['rowid']."',";   
                                    $cartdetails .="'incr',";   
                                    $cartdetails .="'onlyitem'";   
                                    $cartdetails .=')">';   
                                        $cartdetails .='<i class="feather-plus"></i>';
                                    $cartdetails .='</button>';
                                $cartdetails .='</span>';
                                $cartdetails .='<p class="text-gray mb-0 float-right ml-2 text-muted small price-pop">₹ '.$item_total.'</p></div>';
                            }else{                    
                                $cartdetails .='<div class="grp-it"><span class="count-number float-right">';
                                    $cartdetails .='<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="return update_qty(';
                                    $cartdetails .="'".$cdvalue['rowid']."',";   
                                    $cartdetails .="'decr',";   
                                    $cartdetails .="'onlyitem'";   
                                    $cartdetails .=')">';   
                                        $cartdetails .='<i class="feather-minus"></i>';
                                    $cartdetails .='</button>';
                                    $cartdetails .='<input class="count-number-input" type="text" name="" readonly="" value="'.$cdvalue['qty'].'">';
                                    $cartdetails .='<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="return update_qty(';
                                    $cartdetails .="'".$cdvalue['rowid']."',";   
                                    $cartdetails .="'incr',";   
                                    $cartdetails .="'onlyitem'";   
                                    $cartdetails .=')">';   
                                        $cartdetails .='<i class="feather-plus"></i>';
                                    $cartdetails .='</button>';
                                $cartdetails .='</span>';
                                $cartdetails .='<p class="text-gray mb-0 float-right ml-2 text-muted small price-pop">₹ '.$item_total.'</p></div>';
                            }
                            
                    $cartdetails .='</div>';
                $cartdetails .='</div>';
            }
            if($ispletter=='0'){
                $this->session->set_flashdata('message',"Please Select Any One Platter");
                redirect($this->data['base_url']);
            }
            
            $cartdetails .='<div class="bg-primary item-container-single gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom"><p class="w-100 text-gray mb-0 text-right ml-2 large text-success">₹ '.$cart_total.'</p></div>';             
            $SpecialInstructions=$this->session->userdata('SpecialInstructions');
            if(isset($SpecialInstructions)){
                $SpecialInstructions = $SpecialInstructions;
            }else{
                $SpecialInstructions = '';
            }
            $sp .='<div class="mb-0 input-group pl-3 pr-3 pt-4 pb-4">';
                $sp .='<div class="input-group-prepend">';
                    $sp .='<span class="input-group-text">';
                        $sp .='<i class="feather-message-square"></i>';
                    $sp .='</span>';
                $sp .='</div>';
                $sp .='<textarea placeholder="Add any Special Instructions" aria-label="With textarea" class="form-control" name="SpecialInstructions" id="SpecialInstructions" onblur="return SpecialInstructions();">'.$SpecialInstructions.'</textarea>';
            $sp .='</div><br>';
            $cartdetails .=$sp;
            // Addons Start
            $CategoryWiseItem=$this->order_model->GetCategoryWiseItem('794456');
            $cwi ='';
            if(!empty($CategoryWiseItem)){
                 $cwi .='<div class="">';
                     $cwi .='<div class="px-3 pt-3 title d-flex align-items-center pb-3">';
                         $cwi .='<h5 class="m-0">Addons</h5>';
                     $cwi .='</div>';
                 $cwi .='</div>';
                $cwi .='<div class="Addons-slider">';
                    foreach ($CategoryWiseItem as $CategoryWiseItemkey => $cwiv) {
                        if (!in_array($cwiv['itemid'], $cartitemarray)){
                            $cwi .='<div class="osahan-slider-item py-1 px-1">';
                                $cwi .='<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">';
                                    $cwi .='<div class="list-card-image">';
                                        $cwi .='<img src="'.$this->data['base_assets'].'uploads/itemimages/'.$cwiv['image'].'" class="img-fluid item-img w-100">';
                                    $cwi .='</div>';
                                    $cwi .='<div class="p-2 position-relative">';
                                        $cwi .='<div class="list-card-body">';
                                            $cwi .='<div class="dish-contents d-flex">';
                                                $cwi .='<h6 class="mb-1 col-12 pl-0 pr-0">';
                                                    $cwi .='<div class="text-black item-nm small">'.$cwiv['name'].'</div>';
                                                    $cwi .='<p class="size-of-addon small text-gray mb-3">'.$cwiv['description'].'</p>';
                                                $cwi .='</h6>';
                                                
                                                $cwi .='<div class="col-12 pl-0 pr-0 pb-2">';
                                                    $cwi .='<p class="text-gray mb-0 time">';
                                                        $cwi .='<span class="float-left text-black-50 w-100 pb-2"> ₹ '.$cwiv['price'].'/-</span> ';
                                                    $cwi .='</p>';                                                
                                                $cwi .='</div>';
                                                if($cwiv['itemallowvariation']!='0' || $cwiv['itemallowaddon']!='0'){
                                                    $cwi .='<button class="btn btn-primary btn-block btn-sm w-50 m-auto" onclick="return get_item_selection_addons('.$cwiv['itemid'].');">';
                                                        $cwi .='Add';
                                                    $cwi .='</button><span class="small float-right pt-1">customisable</span>';
                                                }else{
                                                    $cwi .='<button class="btn btn-primary btn-block btn-sm w-50 m-auto" onclick="return addtocartaddonse('.$cwiv['itemid'].');">';
                                                        $cwi .='Add';
                                                    $cwi .='</button>';
                                                }
                                            $cwi .='</div>';
                                        $cwi .='</div>';
                                    $cwi .='</div>';
                                $cwi .='</div>';
                            $cwi .='</div>';
                        }
                    }                
                $cwi .='</div>';
            }
            $cartdetails .=$cwi;
            // Addons Edn
        }else{
            redirect($this->data['base_url']);
        }
        $discount_div =$this->load_discount_div($cart_total);
        $this->data['discount_div'] = $discount_div;
        $final_pay_div =$this->load_final_pay_div($cart_total,$totalplatter);
        $this->data['final_pay_div'] = $final_pay_div;
        $this->data['cartdetails'] = $cartdetails;
        // Coupon Details
        $coupons_details=$this->session->userdata('coupons_details_session');
        $this->data['coupons_details'] = $coupons_details;
        
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['breadcrumb'] = 'Check Out';
        $this->data['tpl_name']= "checkout.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl'); 
    }
    
    function load_cart_div(){
        $CartTmpDate = $this->cart->contents();
        $cart_total =0;
        $cartdetails = '';

        if(!empty($CartTmpDate)){
            foreach ($CartTmpDate as $cdkey => $cdvalue) {
                $item_total =0;
                if (isset($cdvalue['options']['isvariation'])) {
                    if ($cdvalue['options']['isvariation']!='0' ||  $cdvalue['options']['isaddons']!='0') {
                        $cart_total += $cdvalue['options']['extra_costs_total'];
                        $item_total += $cdvalue['options']['extra_costs_total'];
                    }
                    if (isset($cdvalue['options']['isaddons']) && !isset($cdvalue['options']['isvariation'])) {
                        $cart_total += $cdvalue['subtotal'];
                        $cart_total += $cdvalue['options']['extra_costs_total'];
                        $item_total += $cdvalue['subtotal'];
                    }
                }else{                    
                    $cart_total += $cdvalue['subtotal'];
                    $item_total += $cdvalue['subtotal'];
                }
                $cartdetails .='<div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">';
                    $cartdetails .='<div class="media align-items-center">';
                        $cartdetails .='<div class="mr-2 text-success">&middot;</div>';
                        $cartdetails .='<div class="media-body">';
                            $cartdetails .='<p class="m-0">'.$cdvalue['name'].'</p>';
                            $cartdetails .='<p class="m-0">'.$cdvalue['options']['description'].'</p>';
                            $variation_details ='';
                            if(isset($cdvalue['options']['isvariation']) && $cdvalue['options']['isvariation']!='0') {
                                $variation = $cdvalue['options']['variation'];
                                foreach ($variation as $variationkey => $variationvalue) {
                                    $vtotal=($variationvalue['variationquantity']*$variationvalue['variation_price']);
                                    $variation_details .=$variationvalue['variation_name'].'( Qty. '.$variationvalue['variationquantity'].') ₹'.$vtotal."<br>";
                                }
                                $cartdetails .='<p class="m-0">';
                                $cartdetails .=$variation_details;
                                $cartdetails .='</p>';
                            }
                            $addons_details ='';
                            if(isset($cdvalue['options']['isaddons']) && $cdvalue['options']['isaddons']!='0') {
                                $addons = $cdvalue['options']['addons'];
                                foreach ($addons as $addonskey => $addonsvalue) {
                                    $atotal=($addonsvalue['addon_qty']*$addonsvalue['addonitemprice']);
                                    $addons_details .=$addonsvalue['addonitemname'].'( Qty. '.$addonsvalue['addon_qty'].') ₹ '.$atotal."<br>";
                                }
                                $cartdetails .='<p class="m-0">';
                                $cartdetails .=$addons_details;
                                $cartdetails .='</p>';
                            }
                        $cartdetails .='</div>';
                    $cartdetails .='</div>';
                    $cartdetails .='<div class="d-flex align-items-center">';
                            if (isset($cdvalue['options']['isvariation'])) {
                                if ($cdvalue['options']['isvariation']!='0') {
                                    $cartdetails .='<span class="count-number float-right">';
                                        $cartdetails .='<button type="button" class="btn-sm left dec btn btn-outline-secondary">';
                                            $cartdetails .='Customize';
                                        $cartdetails .='</button>';
                                    $cartdetails .='</span>';
                                }
                            }else if(isset($cdvalue['options']['isaddons']) || isset($cdvalue['options']['isvariation'])){
                                if ($cdvalue['options']['isaddons']!='0' ||  $cdvalue['options']['isvariation']=='0') {
                                    $cartdetails .='<span class="count-number float-right">';
                                        $cartdetails .='<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="return update_qty(';
                                        $cartdetails .="'".$cdvalue['rowid']."',";   
                                        $cartdetails .="'decr',";   
                                        $cartdetails .="'onlyitem'";   
                                        $cartdetails .=')">';   
                                            $cartdetails .='<i class="feather-minus"></i>';
                                        $cartdetails .='</button>';
                                        $cartdetails .='<input class="count-number-input" type="text" name="" readonly="" value="'.$cdvalue['qty'].'">';
                                        $cartdetails .='<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="return update_qty(';
                                        $cartdetails .="'".$cdvalue['rowid']."',";   
                                        $cartdetails .="'incr',";   
                                        $cartdetails .="'onlyitem'";   
                                        $cartdetails .=')">';   
                                            $cartdetails .='<i class="feather-plus"></i>';
                                        $cartdetails .='</button>';
                                    $cartdetails .='</span>';
                                    $cartdetails .='<button type="button" class="btn-sm left dec btn btn-outline-secondary">';
                                        $cartdetails .='Customize';
                                    $cartdetails .='</button>';
                                }
                            }else{                    
                                $cartdetails .='<span class="count-number float-right">';
                                    $cartdetails .='<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="return update_qty(';
                                    $cartdetails .="'".$cdvalue['rowid']."',";   
                                    $cartdetails .="'decr',";   
                                    $cartdetails .="'onlyitem'";   
                                    $cartdetails .=')">';   
                                        $cartdetails .='<i class="feather-minus"></i>';
                                    $cartdetails .='</button>';
                                    $cartdetails .='<input class="count-number-input" type="text" name="" readonly="" value="'.$cdvalue['qty'].'">';
                                    $cartdetails .='<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="return update_qty(';
                                    $cartdetails .="'".$cdvalue['rowid']."',";   
                                    $cartdetails .="'incr',";   
                                    $cartdetails .="'onlyitem'";   
                                    $cartdetails .=')">';   
                                        $cartdetails .='<i class="feather-plus"></i>';
                                    $cartdetails .='</button>';
                                $cartdetails .='</span>';
                            }
                            $cartdetails .='<p class="text-gray mb-0 float-right ml-2 text-muted small">₹ '.$item_total.'</p>';
                    $cartdetails .='</div>';
                $cartdetails .='</div>';
            }
            $cartdetails .='<div class="bg-primary item-container-single gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom"><p class="text-gray mb-0 float-right ml-2 large">₹ '.round($cart_total).'</p></div>'; 
        }
        echo $cartdetails;exit;
    }
    function get_item_addons_variation_for_customize() 
    {
        $returnarray = array();     
        if($this->input->post()){
            $page='';
            $itemid = $this->input->post('itemid');
            $rowid = $this->input->post('rowid');
            $CartData = $this->cart->contents();
            $existed_item=FALSE;
            $record=array();
            if ($itemid > 0 && !empty($CartData)) {
                foreach ($this->cart->contents() as $item) {
                    if ($item['id']==$itemid and $item['rowid']==$rowid) {
                        $existed_item=TRUE;
                        array_push($record, $item);
                        break;
                    }
                }
            }
            if($existed_item==TRUE){
                $record = $record[0];
                $item_total =0;
                if (isset($record['options']['isvariation']) || isset($record['options']['isaddons'])) {
                    $item_total += $record['options']['extra_costs_total'];
                    
                }else if(isset($record['options']['isaddons']) && !isset($record['options']['isvariation'])){
                    $item_total += $record['subtotal'];
                }else{                    
                    $item_total += $record['subtotal'];
                }
                // if (isset($record['options']['isvariation']) || isset($record['options']['isaddons'])) {
                //     if ($record['options']['isvariation']!='0' ||  $record['options']['isaddons']!='0') {
                //         $item_total += $record['options']['extra_costs_total'];
                //     }
                //     if (isset($record['options']['isaddons']) && $record['options']['isaddons']!='0' && !isset($record['options']['isvariation'])) {
                //        $item_total += $record['subtotal'];
                //     }
                // }else{                    
                //     $item_total += $record['subtotal'];
                // }
                $item_details = $this->order_model->single_item_details($record['id']);
                //get item_record
                if (!empty($item_details)) {
                    $item_price = $item_details['price'];
                    $item_name = $item_details['name'];
                    $item_description=$item_details['description'];
                    $item_categoryid=$item_details['categoryid'];
                    $itemallowvariation=$item_details['itemallowvariation'];
                    $itemallowaddon=$item_details['itemallowaddon'];
                    //get variation
                    if($itemallowvariation=='1'){
                        $variation = $this->order_model->GetItemVariation($itemid);    
                    }
                    if (!empty($variation)) {
                        $item_price = $variation[0]['variation_price'];
                    }
                    $slctd_addons=array();
                    if (isset($record['options']['addons'])) {                    
                        foreach ($record['options']['addons'] as $adn) {                        
                            $addonitemid = $adn['addonitemid'];
                            if (!empty($addonitemid)) {
                                array_push($slctd_addons, $addonitemid);
                            }
                        }
                    }

                    $slctd_variation=array();
                    if (isset($record['options']['variation'])) {                    
                        foreach ($record['options']['variation'] as $adn) {                        
                            $variationid = $adn['variationid'];
                            if (!empty($variationid)) {
                                array_push($slctd_variation, $variationid);
                            }
                        }
                    }
                    $page .= '<form id="updatetocartform" method="post" autocomplete="false">';
                    $page .= '<div class="row">';
                        $page .= '<input type="hidden" id="selected_item_id" value="'.$itemid.'">';
                        $page .= '<input type="hidden" id="selected_item_price" value="'.$item_price.'">';
                        $page .= '<input type="hidden" id="selected_menu_id" value="'.$item_categoryid.'">';
                        $page .= '<input type="hidden" id="rowid" value="'.$rowid.'">';

                        $page .= '<input type="hidden" id="itemFrom" value="items">';
                    $page .= '</div>';
                    $page .= '<div class="p-3 osahan-cart-item">';
                        $page .= '<div class="d-flex mb-3 osahan-cart-item-profile bg-white shadow rounded p-3 mt-2">';
                            $page .= '<div class="col-4 pl-0 pr-0"><img alt="Item" src="'.$this->data['base_assets'].'uploads/itemimages/'.$item_details['image'].'" class=""></div>';
                            $page .= '<div class="d-flex flex-column col-8 pr-0">';
                                $page .= '<h6 class="mb-1 font-weight-bold">'.$item_name.'</h6>';
                                $page .= '<h5 class="card-item-price">₹ <span id="hp_final_cost">'.$item_total.'</span>'.'</h5>';
                                $page .= '<input type="hidden" id="totalcost'.$itemid.'" value="'.$item_total.'">';
                                $page .= '<p class="mb-0 small text-muted"><i class="feather-map-pin"></i> '.$item_description.'</p>';
                            $page .= '</div>';
                        $page .= '</div>';
                        $page .= '<div class="bg-white rounded shadow mb-3 py-2">';
                            if (!empty($variation)) {
                                $page .= '<h5 class="modal-title pl-3" id="exampleModalLabel">Options</h5>';
                                $variationqty=0;
                                $o=0;
                                foreach ($variation as $variationkey => $variationvalue) {
                                    $o++;
                                    if(in_array($variationvalue['variation_id'],$slctd_variation)){
                                        $variationdetails = array();
                                        foreach ($record['options']['variation'] as $adkey => $advalue) {
                                            $variationqty=0;
                                            if($advalue['variationid']==$variationvalue['variation_id']){
                                               $variationqty=$advalue['variationquantity'];
                                               break;
                                            }
                                        }
                                        $page .= '<div class="item-container-single gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">';
                                            $page .= '<div class="media align-items-center">';
                                                $page .= '<input type="hidden" class="form-check-input-variation" name="itemvariationid[]"  data-val="'.$variationvalue['variation_price'].'" id="itemvariationid'.$itemid.''.$variationvalue['variation_id'].'" value="'.$variationvalue['variation_id'].'">';
                                                $page .= '<div class="mr-2 text-danger">&middot;</div>';
                                                $page .= '<div class="media-body">';
                                                   $page .= '<p class="m-0"> '.$variationvalue['variation_name'].'</p>';
                                                $page .= '</div>';
                                            $page .= '</div>';
                                            $page .= '<div class="d-flex align-items-center">';
                                                $page .= '<span class="count-number float-right">';
                                                    $page .= '<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="increase_decrease_variationqty('.$itemid.','.$variationvalue['variation_id'].',0);">';
                                                        $page .= '<i class="feather-minus"></i>';
                                                    $page .= '</button>';
                                                    $page .= '<input class="count-number-input" type="text" value="'.$variationqty.'" id="variationqty'.$itemid.''.$variationvalue['variation_id'].'" readonly>';

                                                    $page .= '<input class="count-number-input" type="hidden" name="itemvariationqty[]" value="'.$variationqty.'" id="itemvariationqty'.$itemid.''.$variationvalue['variation_id'].'">';
                                                    $page .= '<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="increase_decrease_variationqty('.$itemid.','.$variationvalue['variation_id'].',1);">';
                                                        $page .= '<i class="feather-plus"></i>';
                                                    $page .= '</button>';
                                                $page .= '</span>';
                                                $page .= '<p class="text-gray mb-0 float-right ml-2 text-muted small">₹ '.$variationvalue['variation_price'].'</p>';
                                            $page .= '</div>';
                                        $page .= '</div>'; 
                                    }else{
                                        $page .= '<div class="item-container-single gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">';
                                            $page .= '<div class="media align-items-center">';
                                                $page .= '<input type="hidden" class="form-check-input-variation" name="itemvariationid[]"  data-val="'.$variationvalue['variation_price'].'" id="itemvariationid'.$itemid.''.$variationvalue['variation_id'].'" value="'.$variationvalue['variation_id'].'">';
                                                $page .= '<div class="mr-2 text-danger">&middot;</div>';
                                                $page .= '<div class="media-body">';
                                                   $page .= '<p class="m-0"> '.$variationvalue['variation_name'].'</p>';
                                                $page .= '</div>';
                                            $page .= '</div>';
                                            $page .= '<div class="d-flex align-items-center">';
                                                $page .= '<span class="count-number float-right">';
                                                    $page .= '<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="increase_decrease_variationqty('.$itemid.','.$variationvalue['variation_id'].',0);">';
                                                        $page .= '<i class="feather-minus"></i>';
                                                    $page .= '</button>';
                                                    if ($o==1) { 
                                                        $page .= '<input class="count-number-input" type="hidden" name="itemvariationqty[]" value="1" id="itemvariationqty'.$itemid.''.$variationvalue['variation_id'].'">';
                                                        $page .= '<input class="count-number-input" type="text" value="1" id="variationqty'.$itemid.''.$variationvalue['variation_id'].'" readonly>';
                                                    }else{
                                                        $page .= '<input class="count-number-input" type="text" value="0" id="variationqty'.$itemid.''.$variationvalue['variation_id'].'" readonly>';

                                                        $page .= '<input class="count-number-input" type="hidden" name="itemvariationqty[]" value="0" id="itemvariationqty'.$itemid.''.$variationvalue['variation_id'].'">';
                                                    }
                                                    $page .= '<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="increase_decrease_variationqty('.$itemid.','.$variationvalue['variation_id'].',1);">';
                                                        $page .= '<i class="feather-plus"></i>';
                                                    $page .= '</button>';
                                                $page .= '</span>';
                                                $page .= '<p class="text-gray mb-0 float-right ml-2 text-muted small">₹ '.$variationvalue['variation_price'].'</p>';
                                            $page .= '</div>';
                                        $page .= '</div>'; 
                                    }                                  
                                }
                            } 

                            $getaddons = $this->order_model->GetItemAddons($itemid); 
                            if (!empty($getaddons)) {
                                $page .= '<h5 class="modal-title" id="exampleModalLabel">Addons</h5>';
                                foreach ($getaddons as $getaddonskey => $getaddonsvalue) {
                                    $itemaddonqty=0;
                                    if(in_array($getaddonsvalue['addonitemid'],$slctd_addons)){
                                        $addondetails = array();
                                        foreach ($record['options']['addons'] as $adkey => $advalue) {
                                            $itemaddonqty=0;
                                            if($advalue['addonitemid']==$getaddonsvalue['addonitemid']){
                                               $itemaddonqty=$advalue['addon_qty'];
                                               break;
                                            }
                                        }
                                        $page .= '<div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">';
                                            $page .= '<div class="media align-items-center">';
                                                $page .= '<input type="hidden" class="form-check-input-addon" name="itemaddonid[]"  data-val="'.$getaddonsvalue['addonitemprice'].'" id="itemaddonid'.$itemid.''.$getaddonsvalue['addonitemid'].'" value="'.$getaddonsvalue['addonitemid'].'" >';
                                                $page .= '<div class="mr-2 text-danger"> &middot;</div>';
                                                $page .= '<div class="media-body">';
                                                   $page .= '<p class="m-0"> '.$getaddonsvalue['addonitemname'].'</p>';
                                                $page .= '</div>';
                                            $page .= '</div>';
                                            $page .= '<div class="d-flex align-items-center">';
                                                $page .= '<span class="count-number float-right">';
                                                    $page .= '<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="increase_decrease_addonqty('.$itemid.','.$getaddonsvalue['addonitemid'].',0);">';
                                                        $page .= '<i class="feather-minus"></i>';
                                                    $page .= '</button>';
                                                    $page .= '<input class="count-number-input" type="hidden" name="itemaddonqty[]" value="'.$itemaddonqty.'" id="itemaddonqty'.$itemid.''.$getaddonsvalue['addonitemid'].'">';
                                                    $page .= '<input class="count-number-input" type="text" value="'.$itemaddonqty.'" id="addonqty'.$itemid.''.$getaddonsvalue['addonitemid'].'" readonly>';
                                                    $page .= '<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="increase_decrease_addonqty('.$itemid.','.$getaddonsvalue['addonitemid'].',1);">';
                                                        $page .= '<i class="feather-plus"></i>';
                                                    $page .= '</button>';
                                                $page .= '</span>';
                                                $page .= '<p class="text-gray mb-0 float-right ml-2 text-muted small">₹ '.$getaddonsvalue['addonitemprice'].'</p>';
                                            $page .= '</div>';
                                        $page .= '</div>';
                                    }else{
                                        $page .= '<div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">';
                                            $page .= '<div class="media align-items-center">';
                                                $page .= '<input type="hidden" class="form-check-input-addon" name="itemaddonid[]"  data-val="'.$getaddonsvalue['addonitemprice'].'" id="itemaddonid'.$itemid.''.$getaddonsvalue['addonitemid'].'" value="'.$getaddonsvalue['addonitemid'].'" >';
                                                $page .= '<div class="mr-2 text-danger"> &middot;</div>';
                                                $page .= '<div class="media-body">';
                                                   $page .= '<p class="m-0"> '.$getaddonsvalue['addonitemname'].'</p>';
                                                $page .= '</div>';
                                            $page .= '</div>';
                                            $page .= '<div class="d-flex align-items-center">';
                                                $page .= '<span class="count-number float-right">';
                                                    $page .= '<button type="button" class="btn-sm left dec btn btn-outline-secondary" onclick="increase_decrease_addonqty('.$itemid.','.$getaddonsvalue['addonitemid'].',0);">';
                                                        $page .= '<i class="feather-minus"></i>';
                                                    $page .= '</button>';
                                                    $page .= '<input class="count-number-input" type="hidden" name="itemaddonqty[]" value="0" id="itemaddonqty'.$itemid.''.$getaddonsvalue['addonitemid'].'">';
                                                    $page .= '<input class="count-number-input" type="text" value="0" id="addonqty'.$itemid.''.$getaddonsvalue['addonitemid'].'" readonly>';
                                                    $page .= '<button type="button" class="btn-sm right inc btn btn-outline-secondary" onclick="increase_decrease_addonqty('.$itemid.','.$getaddonsvalue['addonitemid'].',1);">';
                                                        $page .= '<i class="feather-plus"></i>';
                                                    $page .= '</button>';
                                                $page .= '</span>';
                                                $page .= '<p class="text-gray mb-0 float-right ml-2 text-muted small">₹ '.$getaddonsvalue['addonitemprice'].'</p>';
                                            $page .= '</div>';
                                        $page .= '</div>';
                                    }
                                    
                                }                                       
                            }                            
                        $page .= '</div>';
                    $page .= '</div>';
                    $page .= '<div class="modal-footer p-0 border-0">';
                        $page .= '<div class="col-12 m-0 p-0">';
                           $page .= '<button type="button" class="btn btn-primary btn-lg btn-block" onclick="updateToCart('.$itemid.')">Update Cart</button>';
                        $page .= '</div>';
                    $page .= '</div>';
                    $page .= '</form>';
                    $returnarray['msg'] = 'getinfo';
                    $returnarray['data'] = $page;
                } else {
                    $returnarray['msg'] = 'notfound';
                }
            }else{
                $returnarray['msg'] = 'notfound';
            }
        }
        echo json_encode($returnarray);exit;
    }
    function update_cart_item()
    {
        $returnarray = array();        
        $itemid   = $this->input->post('itemid'); //item_id        
        $itemquantity  = $this->input->post('itemquantity'); // quantity
        $item_variation_id = ($this->input->post('itemvariationid')) ? $this->input->post('itemvariationid'):""; // if variant select
        $item_variation_quantity = ($this->input->post('itemvariationqty')) ? $this->input->post('itemvariationqty'):""; // if variant qty
        $addon_ids = ($this->input->post('itemaddonid')) ? $this->input->post('itemaddonid') : ""; 
        $addon_quantity = ($this->input->post('itemaddonqty')) ? $this->input->post('itemaddonqty') : ""; 
        $rowid = ($this->input->post('rowid')) ? $this->input->post('rowid') : ""; 
        $flag = TRUE;
        $extra_costs_total = 0;
        $item_details = $this->order_model->single_item_details($itemid);
        $isvariation=0;
        $isaddon=0;      
        $is_updated=0;
        // Check if our itemid mathch 
        if(!empty($item_details)){        
            // We have a match!
            $item_cost=$item_details['price'];
            $item_name=$item_details['name'];
            $item_description=$item_details['description'];
            $item_categoryid=$item_details['categoryid'];
            // Check if items variation multiple 
            if ($flag) {                    
                //Check Item already exist in cart
                $existed_item=FALSE;
                if (!empty($this->cart->contents())){ 
                    foreach ($this->cart->contents() as $item) {
                        if($item['rowid']==$rowid){
                            // REMOVE OLD DATA

                            $dat = array(
                               'rowid' => $item['rowid'],
                               'qty'   => '0' //new quantity
                            );
                            $this->cart->update($dat);
                            
                            // ADD NEW DATA
                            $itemquantity =$item['qty'];
                            $item_cost = $item['price'];
                            $item_name = $item['name'];
                            //if($existed_item==TRUE){
                            // Create an array with item information
                            $data = array(
                             'id'      => $itemid,//Item_id
                             'qty'     => $itemquantity, // Item Quantity
                             'price'   => $item_cost,//item_cost from rk_items table
                             'name'    => $item_name,
                             'options' => array('item_name' => $item_details['name'],'description' => $item_description, 'item_cost' => $item_cost, 'category_id' => $item_categoryid)
                            );
                            
                            //ADD ONS START
                            if (!empty($addon_ids)) {
                                $addons_cost_per_item = 0;
                                foreach ($addon_ids as $addon_idskey => $addon_idsvalue) {
                                    $addon_qty=$addon_quantity[$addon_idskey];
                                    $addon_id = $addon_idsvalue;
                                    if($addon_qty!='' and $addon_qty!='0' and $addon_id!='' and $addon_id!='0'){
                                        $isaddon=1;
                                        $addon_item_details = $this->order_model->single_addon_item_details($addon_id);
                                        if (!empty($addon_item_details)) {                                
                                            $addonitemid = $addon_item_details['addonitemid'];
                                            $addongroupid = $addon_item_details['addongroupid'];
                                            $addonitemname = $addon_item_details['addonitemname'];
                                            $addonitemprice = $addon_item_details['addonitemprice'];
                                            $addongroupname = $addon_item_details['addongroupname'];

                                            $addons_cost_per_item += ($addonitemprice) * $addon_qty;
                                            $data['options']['addons_cost_per_item'] = $addons_cost_per_item;
                                            //$addons = $addonitemid."=".$addonitemname."=".$addongroupname."=".$addonitemprice."=".$addongroupid."=".$addon_qty;
                                            //$data['options']['addons'][]=$addonitemid."=".$addonitemname."=".$addongroupname."=".$addonitemprice."=".$addongroupid."=".$addon_qty;
                                            $addonarray = array(
                                                'addonitemid' => $addonitemid,
                                                'addonitemname' =>$addonitemname,
                                                'addongroupname' => $addongroupname,
                                                'addonitemprice' =>$addonitemprice,
                                                'addongroupid' =>$addongroupid,
                                                'addon_qty' =>$addon_qty
                                            );
                                            $data['options']['addons'][]=$addonarray;
                                            //['addons'][] =addon_id=addonname=group_name=price=group_id=quantity;
                                        }
                                    }
                                }
                                $extra_costs_total += ($addons_cost_per_item);//only addons cost
                                $data['options']['extra_costs_total'] = $extra_costs_total;//addons cost
                                $data['options']['isaddons']=$isaddon; // is variation cost
                            }
                            //ADD ONS END

                            //VARIATION START
                            if($item_variation_id!='' and !empty($item_variation_id)){
                                $variation_cost_per_item = 0;
                                $total_variation_type=0;
                                foreach ($item_variation_id as $variationidkey => $variationidvalue) {
                                    $variationid = $variationidvalue;
                                    $variationquantity = $item_variation_quantity[$variationidkey];
                                    if($variationidvalue!='' and $variationidvalue!='0' and $variationquantity!='' and $variationquantity!='0'){
                                        $isvariation=1;
                                        $variation_details = $this->order_model->single_item_variation_details($itemid,$variationid);
                                        if (!empty($variation_details)){ 
                                            $variation_name=$variation_details['variation_name'];
                                            $variation_groupname = $variation_details['variation_groupname'];
                                            $variation_price=$variation_details['variation_price'];
                                            $variation_cost_per_item += ($variation_price) * $variationquantity;
                                            $data['options']['variation_cost_per_item'] = $variation_cost_per_item;
                                            //$data['options']['variation'][] = $variationid."=".$variation_name."=".$variation_price."=".$itemid."=".$variationquantity;
                                            //$data['options']['variation'][]['variation_name']=$variation_name;
                                            $variation = array(
                                                'variationid' => $variationid,
                                                'variation_name' =>$variation_name,
                                                'variation_price' => $variation_price,
                                                'variationquantity' =>$variationquantity,
                                                'itemid' =>$itemid
                                            );
                                            $data['options']['variation'][]= $variation;
                                            //."=".$variation_price."=".$itemid."=".$variationquantity;
                                            //['variation'][] =variation_id=variation_name=variation_price=item_id=quantity;
                                            $total_variation_type++;
                                        }
                                    }   
                                }
                                $extra_costs_total +=($variation_cost_per_item); //only variation cost
                                $data['options']['isvariation']=$isvariation; // is variation cost
                                $data['options']['totalvariationtype']=$total_variation_type; // Total variation Type
                                $data['options']['extra_costs_total']=$extra_costs_total; //variation cost
                                //$item_cost =$extra_costs_total;
                            }
                            //VARIATION END
                            if($item_cost=='0'){
                                $data['price']=$extra_costs_total;
                                $data['price']=$itemquantity;
                            }
                            // echo "<pre>";
                            // print_r($data);
                            // $this->cart->insert($data);
                            //$this->cart->destroy();
                            //exit;
                            $this->cart->insert($data);
                            $returnarray['msg'] = 'cartinsert';
                            $returnarray['ftotal'] = $this->cart->total();
                            $returnarray['ftotalqty'] = $this->cart->total_items();
                            $returnarray['ftotalitem'] = count($this->cart->contents());
                            
                            //} 
                        }
                    }
                }else{
                   $returnarray['msg'] = 'notexisted';
                   //break; 
                }
            }            
        }else{
            // Nothing found! Return FALSE! 
            $returnarray['msg'] = 'error';
        }
        echo json_encode($returnarray);exit;        
    }
    function load_discount_div($cart_total){
        $cart_total = $cart_total;
        $discount_div = '';
        if($this->data['customer_info']['id']!=''){
            $coupons_details= $this->order_model->GetCouponsDetails();
            $coupons_details_session=$this->session->userdata('coupons_details_session');
            if(!empty($coupons_details_session)){
                $discount_div .='<div class="mb-3 shadow bg-white rounded p-3 py-1 mt-3 clearfix">';
                    $discount_div .='<div class="input-group-sm input-group">';
                        $discount_div .='<div class="apply-coupon-div row mx-auto">';
                            $discount_div .='<div class="col-6 pl-0 pr-0">';
                                $discount_div .='<svg width="25px" height="25px" viewBox="0 0 19 11"><path fill="#094f8d" d="M.634 0C.284 0 0 .274 0 .611v9.778c0 .338.284.611.634.611h17.733c.35 0 .633-.273.633-.611V.611C19 .274 18.716 0 18.367 0H.634zm3.8 1.222c0-.337.284-.611.633-.611.35 0 .634.274.634.611v1.223c0 .337-.284.61-.634.61-.35 0-.633-.273-.633-.61V1.222zm0 3.667c0-.337.284-.61.633-.61.35 0 .634.273.634.61v1.223c0 .337-.284.61-.634.61-.35 0-.633-.273-.633-.61V4.889zm0 3.667c0-.337.284-.61.633-.61.35 0 .634.273.634.61v1.222c0 .338-.284.612-.634.612-.35 0-.633-.274-.633-.612V8.556zm9.5-2.444c.7 0 1.266.547 1.266 1.221 0 .676-.567 1.222-1.266 1.222-.7 0-1.267-.546-1.267-1.222 0-.674.567-1.221 1.267-1.221zm-3.8-3.667c.699 0 1.266.547 1.266 1.222 0 .674-.567 1.221-1.267 1.221-.699 0-1.266-.547-1.266-1.221 0-.675.567-1.222 1.266-1.222zm.504 5.865c-.209.269-.604.323-.883.122-.279-.202-.335-.584-.126-.853l3.8-4.889c.209-.269.604-.323.883-.121.279.201.335.583.126.852l-3.8 4.889z"></path></svg>';
                                $discount_div .='<span class="ml-1">Selected offer / Applied coupon</span>';
                            $discount_div .='</div>';
                            $discount_div .='<div class="col-12 coupon-list pt-4 pl-0 pr-0">';
                                $discount_div .='<div class="applied-coupon">';
                                    $discount_div .='<div class="coupon-head">';
                                      $discount_div .='<div class="coupon-code-box">'.$coupons_details_session['discountname'].'</div>';
                                       $discount_div .='<div class="coupon-apply-btn text-danger" onclick="removecouponcode();">Remove</div>';
                                   $discount_div .='</div>';
                                   $discount_div .='<div class="coupon-foot">'.$coupons_details_session['discountdescription'].'</div>';
                                $discount_div .='</div>';
                            $discount_div .='</div>';
                        $discount_div .='</div>';
                    $discount_div .='</div>';
                $discount_div .='</div>';
            }else{
                if(!empty($coupons_details)){
                    $discount_div .='<div class="mb-3 shadow bg-white rounded p-3 py-1 mt-3 clearfix">';
                        $discount_div .='<div class="input-group-sm input-group">';
                            $discount_div .='<div class="apply-coupon-div row mx-auto"><div class="col-6 pl-0 pr-0"><svg width="25px" height="25px" viewBox="0 0 19 11"><path fill="#094f8d" d="M.634 0C.284 0 0 .274 0 .611v9.778c0 .338.284.611.634.611h17.733c.35 0 .633-.273.633-.611V.611C19 .274 18.716 0 18.367 0H.634zm3.8 1.222c0-.337.284-.611.633-.611.35 0 .634.274.634.611v1.223c0 .337-.284.61-.634.61-.35 0-.633-.273-.633-.61V1.222zm0 3.667c0-.337.284-.61.633-.61.35 0 .634.273.634.61v1.223c0 .337-.284.61-.634.61-.35 0-.633-.273-.633-.61V4.889zm0 3.667c0-.337.284-.61.633-.61.35 0 .634.273.634.61v1.222c0 .338-.284.612-.634.612-.35 0-.633-.274-.633-.612V8.556zm9.5-2.444c.7 0 1.266.547 1.266 1.221 0 .676-.567 1.222-1.266 1.222-.7 0-1.267-.546-1.267-1.222 0-.674.567-1.221 1.267-1.221zm-3.8-3.667c.699 0 1.266.547 1.266 1.222 0 .674-.567 1.221-1.267 1.221-.699 0-1.266-.547-1.266-1.221 0-.675.567-1.222 1.266-1.222zm.504 5.865c-.209.269-.604.323-.883.122-.279-.202-.335-.584-.126-.853l3.8-4.889c.209-.269.604-.323.883-.121.279.201.335.583.126.852l-3.8 4.889z"></path></svg>';
                            $discount_div .='<span class="ml-1">Select offer / Apply coupon</span></div>';
                            $discount_div .='<div class="col-6 float-right text-right pl-0 pr-0">';
                                $discount_div .='<button id="button-addon2" type="button" class="btn btn-primary" data-toggle="modal" data-target="#CouponCodesShow" onclick="viewallcoupons();"> View All Coupons </button>';
                            $discount_div .='</div>';
                            $discount_div .='</div>';
                        $discount_div .='</div>';
                    $discount_div .='</div>';
                }                        
            }  
            // $discount_div .='<div class="mb-0 input-group">';
            //     $discount_div .='<div class="input-group-prepend">';
            //         $discount_div .='<span class="input-group-text"><i class="feather-message-square"></i></span>';
            //     $discount_div .='</div>';
            //     $discount_div .=' <textarea placeholder="Any suggestions? We will pass it on..." aria-label="With textarea" class="form-control"></textarea>';
            // $discount_div .='</div>';
                    
        }else{
            $discount_div .='<div class="mb-3 shadow bg-white rounded p-3 py-1 mt-3 clearfix" style="opacity: 0.3;" data-toggle="modal" data-target="#LoginModal" onclick="paytimelogin();">';
                $discount_div .='<div class="apply-coupon-div row mx-auto"><div class="col-6"><svg width="25px" height="25px" viewBox="0 0 19 11"><path fill="#094f8d" d="M.634 0C.284 0 0 .274 0 .611v9.778c0 .338.284.611.634.611h17.733c.35 0 .633-.273.633-.611V.611C19 .274 18.716 0 18.367 0H.634zm3.8 1.222c0-.337.284-.611.633-.611.35 0 .634.274.634.611v1.223c0 .337-.284.61-.634.61-.35 0-.633-.273-.633-.61V1.222zm0 3.667c0-.337.284-.61.633-.61.35 0 .634.273.634.61v1.223c0 .337-.284.61-.634.61-.35 0-.633-.273-.633-.61V4.889zm0 3.667c0-.337.284-.61.633-.61.35 0 .634.273.634.61v1.222c0 .338-.284.612-.634.612-.35 0-.633-.274-.633-.612V8.556zm9.5-2.444c.7 0 1.266.547 1.266 1.221 0 .676-.567 1.222-1.266 1.222-.7 0-1.267-.546-1.267-1.222 0-.674.567-1.221 1.267-1.221zm-3.8-3.667c.699 0 1.266.547 1.266 1.222 0 .674-.567 1.221-1.267 1.221-.699 0-1.266-.547-1.266-1.221 0-.675.567-1.222 1.266-1.222zm.504 5.865c-.209.269-.604.323-.883.122-.279-.202-.335-.584-.126-.853l3.8-4.889c.209-.269.604-.323.883-.121.279.201.335.583.126.852l-3.8 4.889z"></path></svg>';
                    $discount_div .='<span class="ml-1">Apply Coupon</span></div>';
                    $discount_div .='<div class="col-6 pl-0 pr-0 float-right">';
                        $discount_div .='<button id="button-addon2" type="button" class="btn btn-primary float-right"> View All Coupons </button>';
                    $discount_div .='</div>';
                $discount_div .=' </div>';
            $discount_div .=' </div>';
        }  
        // $SpecialInstructions=$this->session->userdata('SpecialInstructions');
        // if(isset($SpecialInstructions)){
        //     $SpecialInstructions = $SpecialInstructions;
        // }else{
        //     $SpecialInstructions = '';
        // }
        // $discount_div .='<div class="mb-0 input-group">';
        //     $discount_div .='<div class="input-group-prepend">';
        //         $discount_div .='<span class="input-group-text">';
        //             $discount_div .='<i class="feather-message-square"></i>';
        //         $discount_div .='</span>';
        //     $discount_div .='</div>';
        //     $discount_div .='<textarea placeholder="Add any Special Instructions" aria-label="With textarea" class="form-control" name="SpecialInstructions" id="SpecialInstructions" onblur="return SpecialInstructions();">'.$SpecialInstructions.'</textarea>';
        // $discount_div .='</div><br>';
        
        return $discount_div;  
    }
    function load_final_pay_div($cart_total,$totalplatter){
        $cart_total = $cart_total;
        $final_pay_div = '';
        $finalpay =$cart_total;
        $discount=0;
        $taxes=0;
        $final_pay_div .='<div class="shadow bg-white rounded p-3 clearfix mb-5">';
            $final_pay_div .='<p class="mb-1">Sub Total <span class="float-right text-dark">₹ '.$cart_total.'</span></p>';
            if($this->data['customer_info']['id']!=''){
                $coupons_details_session=$this->session->userdata('coupons_details_session');
                // NORMAL START
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
                        }
                    }
                    $final_pay_div .='<p class="mb-1">Discount (-) <span class="float-right text-dark">₹ '.number_format($discount,2).'</span></p>';
                    $finalpay =($finalpay-$discount);
                }
                // NORMAL END
            }
            $gettaxesdetails = $this->order_model->taxes_details();
            if(!empty($gettaxesdetails)){
                foreach ($gettaxesdetails as $taxesdetailskey => $taxesdetails) {
                    if($taxesdetails['taxtype']!='' and $taxesdetails['taxtype']!='0'){
                        if($taxesdetails['taxtype']=='1'){
                            $taxes = ($finalpay*$taxesdetails['tax']/100);
                        }
                        if($taxesdetails['taxtype']=='2'){
                            $taxes = $taxesdetails['tax'];
                        }
                        $final_pay_div .='<p class="mb-1">'.$taxesdetails['taxname'].' <span class="float-right text-dark">₹ '.number_format($taxes,2).'</span></p>';
                        $finalpay =($finalpay+$taxes);
                    }
                }                
            }
            $restaurantsdetails = $this->order_model->restaurants_details();
            if(!empty($restaurantsdetails)){
                // Packaging Charge As  Internethandling Charge
                $packaging_applicable_on = $restaurantsdetails['packaging_applicable_on'];
                $packaging_charge = $restaurantsdetails['packaging_charge'];
                $packaging_charge_type = $restaurantsdetails['packaging_charge_type'];
                
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
                
                // Delivery Charge
                if($this->data['order_type']=='H'){
                    $minimumorderamount = $restaurantsdetails['minimumorderamount'];
                    if($restaurantsdetails['deliverycharge']!='' and $restaurantsdetails['deliverycharge']!='0'){
                        if($finalpay>$minimumorderamount){
                            $final_pay_div .='<p class="mb-1">Delivery Charges <span class="text-info ml-1"><i class="icofont-info-circle"></i></span>';
                            $final_pay_div .='<span class="float-right text-danger""><del>₹ 25.00</del></span></p>';
                        }else{
                            $final_pay_div .='<p class="mb-1">Delivery Charges <span class="text-info ml-1"><i class="icofont-info-circle"></i></span>';
                            $final_pay_div .='<span class="float-right text-dark">₹ '.number_format($restaurantsdetails['deliverycharge'],2).'</span></p>';
                            $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                        } 
                    }else{
                       $final_pay_div .='<p class="mb-1">Delivery Charges <span class="text-info ml-1"><i class="icofont-info-circle"></i></span>';
                       $final_pay_div .='<span class="float-right text-danger""><del>₹ 25</del></span></p>'; 
                    }
                }else{
                    $final_pay_div .='<p class="mb-1">Delivery Charges <span class="text-info ml-1"><i class="icofont-info-circle"></i></span>';
                    $final_pay_div .='<span class="float-right text-danger""><del>₹ 25</del></span></p>'; 
                }
            }
            
            $final_pay_div .='<hr>';
            $GetSquereOff = $this->getsquereoff($finalpay);
            $customerpaid = $GetSquereOff['roundoffprice'];
            $squeroff = $GetSquereOff['squereoff'];
            if($squeroff!='' and $squeroff!='0.00'){
                $final_pay_div .='<h6 class="mb-0 pb-2" style="font-size: 10px;">Round Off <span class="float-right">₹ '.number_format($squeroff,2).'</span></h6>';
            }
            $final_pay_div .='<h6 class="font-weight-bold mb-0 pb-2">Grand Total <span class="float-right">₹ '.number_format($customerpaid,2).'</span></h6>';
        $final_pay_div .='</div>';
        if($this->data['customer_info']['id']!=''){
            if($this->data['menuname']!='placeorder'){
                $final_pay_div .='<a class="btn btn-success btn-block btn-lg btns-ss-two fixed-bottom " href="'.$this->data['base_url'].'order/placeorder/">Place Order<i class="icofont-long-arrow-right"></i></a>';
            }
        }else{
            //Buttons code
             $final_pay_div .='<div class="btns-ss-two fixed-bottom">';
                $final_pay_div .='<div class="col-6 m-0 p-0">';
                   $final_pay_div .='<button type="button" class="btn btn-primary border-top btn-lg btn-block" data-toggle="modal" data-target="#LoginModal" onclick="paytimelogin();">Login</button>';
                $final_pay_div .='</div>';
                 $final_pay_div .='<div class="col-6 m-0 p-0">';
                   $final_pay_div .='<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#SignupPopup">Sign-up</button>';
                 $final_pay_div .='</div>';
             $final_pay_div .='</div>';
            // Buttons code
        }
        return $final_pay_div;
    }
    function paytimelogin(){
        $returnarray = array();     
        if($this->data['customer_info']['id']!=''){
            $returnarray['msg'] = 'alreadylogin';
        }else{
            $returnarray['msg'] = 'loginpopupopen';
        }
        echo json_encode($returnarray);exit;
    }
    function mobilenumberverify(){
        if($this->input->post()){  
            $returnarray =array();   
            $mobileno = $this->input->post('mobilenumber');
            $numlength = strlen((string)$mobileno);
            if($mobileno!='' && $numlength==10){
                $checkalreadyexist = $this->order_model->check_already_customer($mobileno);
                $returnarray['verifystatus'] ='done';
                $returnarray['msg'] = 'sendnotification';
                $newmobilenumber="Raivat".$this->get_random_number(5).$mobileno."Kitchen".$this->get_random_number(5);
                //$e=$this->encrypt->encode($newmobilenumber);
                $e=$this->encryption->encrypt($newmobilenumber);
                $returnarray['mobileno'] = $mobileno;
                $this->session->set_userdata('login_mobile_number_encryption',$e);
            }            
            echo json_encode($returnarray);exit;
        }else{
            $returnarray['msg'] = 'error';
            $returnarray['message'] = 'Something Wrong. Please try Again.';
            echo json_encode($returnarray);exit;
        }          
    }
    function sendotp(){
        $returnarray =array(); 
        if($this->input->post()){
            $mobileno = $this->input->post('mobilenumber');
            $customername = $this->input->post('customername');
            $email = $this->input->post('email');            
            $otp = $this->get_random_number(5);
            $boi = array();
            $boi['name']=$customername;
            $boi['mobileno']=$mobileno;
            $boi['email']=$email;
            $boi['password']=md5($otp);
            $boi['pin']=$otp; 
            $boi['status']='1';            
            $boi['isdelete']='0';
            $boi['created_datetime']=date('Y-m-d H:i:s');
            $boi['createdip']=$_SERVER['REMOTE_ADDR'];
            $numlength = strlen((string)$mobileno);
            if($mobileno!='' && $numlength==10){
                $checkalreadyexist = $this->order_model->check_already_customer($mobileno);
                if(count($checkalreadyexist)!='0'){
                    $returnarray['msg'] = 'verify';
                    $AaExists =array();
                    $AaExists["id"] = $checkalreadyexist['id'];
                    $AaExists["name"] = $checkalreadyexist['name'];
                    $AaExists["mobileno"] = $checkalreadyexist['mobileno'];
                    $AaExists["email"] = $checkalreadyexist['email'];
                    $AaExists['verifystatus'] ='done';
                    $AaExists['logged_in'] = TRUE;
                    $this->session->set_userdata('customer_info', $AaExists);
                }
                if(count($checkalreadyexist)=='0'){
                    $customerid = $this->order_model->AddCustomerDetails($boi);
                    $returnarray['msg'] = 'notverify';
                    $AaExists =array();
                    $AaExists["id"] = $customerid;
                    $AaExists["name"] = $customername;
                    $AaExists["mobileno"] = $mobileno;
                    $AaExists["email"] = $email;
                    $AaExists['verifystatus'] ='done';
                    $AaExists['logged_in'] = TRUE;
                    $this->session->set_userdata('customer_info', $AaExists);
                }
            }            
        }else{
            $returnarray['msg'] = 'error';
        }
        echo json_encode($returnarray);exit;          
    }
    function sendotpwithsms(){
        if($this->input->post()){  
            $returnarray =array(); 
            $enctypmobilenumber = $this->session->userdata('login_mobile_number_encryption');  
            if($enctypmobilenumber!=''){
                //$decodemobilenumber=$this->encrypt->decode($enctypmobilenumber); 
                $decodemobilenumber=$this->encryption->decrypt($enctypmobilenumber['encrypted'],$enctypmobilenumber['keys']); 
                $removemobilenumber = substr($decodemobilenumber, 10, -11);
                $mobileno = $removemobilenumber;
                //$mobileno = $this->input->post('mobilenumber');
                $customername = $this->input->post('customername');
                $email = $this->input->post('email');            
                $otp = $this->get_random_number(5);
                $boi = array();
                $boi['name']=$customername;
                $boi['mobileno']=$mobileno;
                $boi['email']=$email;
                $boi['password']=md5($otp);
                $boi['pin']=$otp; 
                $boi['status']='0';            
                $boi['isdelete']='0';
                $boi['created_datetime']=date('Y-m-d H:i:s');
                $boi['createdip']=$_SERVER['REMOTE_ADDR'];
                $numlength = strlen((string)$mobileno);
                if($mobileno!='' && $numlength==10){
                    $checkalreadyexist = $this->order_model->check_already_customer($mobileno);
                    if(count($checkalreadyexist)!='0'){
                        $returnarray['msg'] = 'otpsendnotverify';
                        $AaExists =array();
                        $AaExists["id"] = $checkalreadyexist['id'];
                        $AaExists["name"] = $checkalreadyexist['name'];
                        $AaExists["mobileno"] = $checkalreadyexist['mobileno'];
                        $AaExists["password"] = $checkalreadyexist['password'];
                        $AaExists['verifystatus'] ='done';
                        $AaExists['logged_in'] = TRUE;
                        $AaExists['cotp '] = $otp;
                        $sdata =array();
                        $sdata['id']=$checkalreadyexist['id'];
                        $sdata['pin']=$otp; 
                        $Customerid = $this->order_model->UpdateCustomerDetails($sdata);
                        //$AaExists['cotp '] = $checkalreadyexist['pin'];
                        //$otp = $checkalreadyexist['pin'];
                        //$this->session->set_userdata('customer_info', $AaExists);
                        $this->session->set_userdata('cdetails_session', $AaExists);
                        if($otp!='' && $mobileno!=''){
                            $message = urlencode($otp)." is the OTP for verification from Raivat Kitchen. Use it to complete verification.";
                            $this->sendsms_fromsmsyou($mobileno,$message,'1207161710731337734');
                        }
                    }
                    if(count($checkalreadyexist)=='0'){
                        $Customerid = $this->order_model->AddCustomerDetails($boi);
                        $returnarray['msg'] = 'otpsendnotverify';
                        $cdetails = array();
                        $cdetails['name'] = $customername;
                        $cdetails['mobileno'] = $mobileno;
                        $cdetails['id'] = $Customerid;
                        $cdetails['cotp '] = $otp;
                        $this->session->set_userdata('cdetails_session', $cdetails);
                        if($otp!='' && $mobileno!=''){
                            $message = urlencode($otp)." is the OTP for verification from Raivat Kitchen. Use it to complete verification.";
                            $this->sendsms_fromsmsyou($mobileno,$message,'1207161710731337734');
                        }
                    }
                }            
            }else{
               $returnarray['msg'] = 'error';
            }
            echo json_encode($returnarray);exit;
        }else{
            $returnarray['msg'] = 'error';
            echo json_encode($returnarray);exit;
        }          
    }
    function verifyotp(){
        $returnarray =array();
        if($this->input->post()){  
            $eotp = $this->input->post('verifyotp');
            $o_session=$this->session->userdata('cdetails_session');
            $rdetails = array();
            $customerid = $o_session['id'];            
            $customer_details= $this->order_model->GetSingleCustomerDetails($customerid);
            $verifyotp = $customer_details['pin'];
            
            if($verifyotp!=$eotp){
                $returnarray['msg']='error';
                $returnarray['message']='Please Enter Valid OTP.';
            }
            if($verifyotp==$eotp){
                $returnarray['msg']='success';
                $returnarray['message']='Successfully Verify OTP.';
                $sdata =array();
                $sdata['id']=$customerid;
                $sdata['status']='1';            
                $sdata['isdelete']='0';
                $sdata['modified_datetime']=date('Y-m-d H:i:s');
                $sdata['createdip']=$_SERVER['REMOTE_ADDR'];
                $Customerid = $this->order_model->UpdateCustomerDetails($sdata);
                $this->session->unset_userdata("cdetails_session");
                $sess_data = array();

                $sess_data['id'] =$customerid;
                $sess_data['name'] = $customer_details['name'];
                $sess_data['mobileno'] = $customer_details['mobileno'];
                $sess_data['email'] = $customer_details['email'];
                $sess_data['verifystatus'] ='done';
                $sess_data['logged_in'] = TRUE;
                $this->session->set_userdata('customer_info', $sess_data);  
            }
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        } 
        echo json_encode($returnarray);exit;        
    }
    function viewallcoupons(){
        $returnarray =array();
        $couponlist ='';
        if($this->data['customer_info']['id']!=''){
            $coupons_details= $this->order_model->GetCouponsDetails();
            if(!empty($coupons_details)){
                foreach ($coupons_details as $couponsdetailskey => $couponsdetailvalue) {
                    $couponlist .='<div class="coupon-item">';
                        $couponlist .='<div class="coupon-head">';
                           $couponlist .='<div class="coupon-code-box">'.$couponsdetailvalue['discountname'].'</div>';
                           $couponlist .='<div class="coupon-apply-btn" onclick="applycoupons('.$couponsdetailvalue['discountid'].');">Apply</div>';
                       $couponlist .='</div>';
                       $couponlist .='<div class="coupon-foot">'.$couponsdetailvalue['discountdescription'].'</div>';
                   $couponlist .='</div>';
                }  
                $returnarray['msg'] = 'couponfound'; 
                $returnarray['couponlist'] = $couponlist; 
            }else{
               $returnarray['msg'] = 'couponnotfound'; 
           }
        }else{
            $returnarray['msg'] = 'couponnotfound';
        }
        echo json_encode($returnarray);exit;
    }
    function couponscodevefiry(){
        $returnarray =array();
        if($this->data['customer_info']['id']!=''){
            $couponscode = $this->input->post('couponscode');
            $customerid = $this->data['customer_info']['id'];
            if($couponscode!=''){  
                $coupons_details=$this->order_model->GetSingleCoupon_CodeDetails($couponscode);
                if(!empty($coupons_details)){                    
                    $couponsid = $coupons_details['discountid'];
                    $discounttype = $coupons_details['discounttype'];
                    $CustomerCouponDetails=$this->order_model->GetSingleCustomerCouponDetails($couponsid,$customerid);
                    if(count($CustomerCouponDetails) > 0){
                        $returnarray['msg']='error';
                        $returnarray['message']='Alerady Enjoye this Offer.';
                    }else{
                        $returnarray['msg']='success';
                        $returnarray['message']='Coupon Successfully Applied.';
                        $returnarray['couponsid']=$couponsid;
                    }
                }else{
                    $returnarray['msg']='error';
                    $returnarray['message']='Coupons Not Valid .';
                }
            }else{
                $returnarray['msg']='error';
                $returnarray['message']='Something Wrong.';
            }
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        } 
        echo json_encode($returnarray);exit;        
    }
    function applycoupons(){
        $returnarray =array();
        if($this->data['customer_info']['id']!=''){
            $couponsid = $this->input->post('couponsid');
            $customerid = $this->data['customer_info']['id'];
            if($couponsid!=''){  
                $coupons_details=$this->order_model->GetSingleCouponDetails($couponsid);
                if(!empty($coupons_details)){                    
                    $discounttype = $coupons_details['discounttype'];
                    $CustomerCouponDetails=$this->order_model->GetSingleCustomerCouponDetails($couponsid,$customerid);
                    if(count($CustomerCouponDetails) > 0){
                        $returnarray['msg']='error';
                        $returnarray['message']='Alerady Enjoye this Offer.';
                    }else{
                        $discountarray = array(
                            'couponsid' => $couponsid,
                            'discountname' => $coupons_details['discountname'],
                            'discountdescription' => $coupons_details['discountdescription'],
                            'discount' => $coupons_details['discount'],
                            'discounttype' => $coupons_details['discounttype']
                        );
                        $this->session->set_userdata("coupons_details_session",$discountarray);
                        $returnarray['msg']='success';
                        $returnarray['message']='Coupon Successfully Applied.';
                    }
                }else{
                    $returnarray['msg']='error';
                    $returnarray['message']='Coupons Not Valid .';
                }
            }else{
                $returnarray['msg']='error';
                $returnarray['message']='Something Wrong.';
            }
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        } 
        echo json_encode($returnarray);exit;        
    }
    function removecouponcode(){
        $returnarray =array();
        if($this->data['customer_info']['id']!=''){
            $this->session->unset_userdata("coupons_details_session");
            $couponsid = $this->input->post('couponsid');
            $returnarray['msg']='success';
            $returnarray['message']='Coupon Successfully Remove.';
            $customerid = $this->data['customer_info']['id'];
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        } 
        echo json_encode($returnarray);exit;        
    }
    function Get_Single_Item(){
        $returnarray = array();     
        if($this->input->post()){
            $page='';
            $itemid = $this->input->post('itemid');
            if ($itemid > 0) {
                $item_details = $this->order_model->single_item_details($itemid);     
                //get item_record
                if (!empty($item_details)) {
                    $item_price = $item_details['price'];
                    $item_name = $item_details['name'];
                    $item_description=$item_details['description'];
                    $item_categoryid=$item_details['categoryid'];
                    $itemallowvariation=$item_details['itemallowvariation'];
                    $itemallowaddon=$item_details['itemallowaddon'];
                    $categoryname=$item_details['categoryname'];
                    $additionalproperty=$item_details['additionalproperty'];
                    
                    //get variation
                    if($itemallowvariation=='1'){
                        $variation = $this->order_model->GetItemVariation($itemid);    
                    }
                    if (!empty($variation)) {
                        $item_price = $variation[0]['variation_price'];
                    }
                    $page .= '<form id="addtocartform" method="post" autocomplete="false">';
                    $page .= '<div class="">';
                        $page .= '<input type="hidden" id="selected_item_id" value="'.$itemid.'">';
                        $page .= '<input type="hidden" id="selected_item_price" value="'.$item_price.'">';
                        $page .= '<input type="hidden" id="selected_menu_id" value="'.$item_categoryid.'">';
                        $page .= '<input type="hidden" id="itemFrom" value="items">';
                    $page .= '</div>';
                    $page .= '<div class="mx-auto w-100">';
                        $page .= '<div class="bg-primary pt-3 pb-3 shadow-sm mt-3 ml-0 mr-0 w-100">';
                            $page .= '<img src="'.$this->data['base_assets'].'uploads/itemimages/'.$item_details['image'].'" class="img-fluid w-100 p-3">';
                        $page .= '</div>';
                        $page .= '<div class="bg-primary col-12 pt-3 pb-3 shadow-sm mt-3 row ml-0 mr-0">';
                                $page .= '<div class="col-6 pl-0 pr-0">';
                                    $page .= '<span class="badge badge-success">'.$categoryname.'</span>';
                                $page .= '</div>';
                                $page .= '<div class="col-6 text-right pl-0 pr-0">';
                                    $page .= '<div class="price-tag card-item-price">₹ <span id="hp_final_cost">'.$item_price.'</span>/-</div>';
                                $page .= '</div>';
                                $page .= '<h6 class="mb-1 font-weight-bold pt-2">'.$item_name.'</h6>';
                                $page .= '<input type="hidden" id="totalcost'.$itemid.'" value="'.$item_price.'">';
                                $page .= '<div class="col-12 pt-1 pb-1 pl-0 pr-0">';
                                    $page .= '<p>'.$item_description.'</p>';
                                $page .= '</div>';
                                if ($itemid == 12988205) {
                                    $page .= '<div class="col-12 pt-1 pb-1 pl-0 pr-0">';
                                        $page .= '<p>A winter special subji made with steamed whole garlics and spicy gravy. It is generally served with Rotli or Rotlo.</p>';
                                    $page .= '</div>';
                                }
                                // <div class="pt-2 pb-2 col-12 pl-0 pr-0">Vegetarian • Indian • Pure veg</div>
                                // <div class="col-12 ml-0 mr-0 pl-0 pr-0">
                                //    <span class="badge badge-danger">OFFER</span> <small> Use Coupon OSAHAN50</small>
                                // </div>
                        $page .= '</div>';
                        $page .= '<div class="bg-white rounded shadow mb-3 py-2 col-12 mt-2 pl-0 pr-0">';
                            $getaddonsgroups = $this->order_model->GetItemAddonsGroups($itemid); 
                            if (!empty($getaddonsgroups)) {
                                // $page .= '<h5 class="modal-title" id="exampleModalLabel">Choice</h5>';
                                foreach ($getaddonsgroups as $getaddonsgroupskey => $getaddonsgroupsvalue) {
                                    $addongroupid=$getaddonsgroupsvalue['addongroupid'];
                                    $addongroupname=$getaddonsgroupsvalue['addongroupname'];
                                    $page .= '<h6 class="modal-title p-3" id="exampleModalLabel">'.$addongroupname.'</h6>';
                                    $getaddons = $this->order_model->GetItemAddons($itemid,$addongroupid);
                                    $ados_select =0;
                                    $page .= '<div class="mb-0 col-md-12 form-group mb-3">';
                                        $page .= '<div class="btn-group btn-group-toggle w-100" data-toggle="buttons">';
                                            foreach ($getaddons as $getaddonskey => $getaddonsvalue) {
                                        if($ados_select==0){
                                               $checked='checked';
                                               $active='active';
                                        }else{
                                           $checked='';
                                           $active='';
                                        }
                                        $page .= '<label class="btn btn-outline-secondary btns-select '.$active.'">';
                                            $page .= '<input type="radio" name="itemaddonid'.$addongroupid.'" data-val="'.$getaddonsvalue['addonitemprice'].'" class="form-check-input-addon" id="itemaddonid'.$itemid.''.$getaddonsvalue['addonitemid'].'" value="'.$getaddonsvalue['addonitemid'].'" '.$checked.'> '.$getaddonsvalue['addonitemname'];
                                        $page .= '</label>';  
                                            
                                        $ados_select++;
                                    }
                                        $page .= '</div>';
                                    $page .= '</div>';
                                    
                                }                                       
                            }                            
                            if($additionalproperty!='' and $additionalproperty='j'){
                                $page .='<div class="col-md-12 form-group mb-0">';
                                    $page .='<div class="custom-control custom-checkbox test">';
                                        $page .='<input type="checkbox" name="itemjain'.$itemid.'"  id="itemjain'.$itemid.'" class="custom-control-input" value="Jain">';
                                        $page .='<label title="" for="itemjain'.$itemid.'" class="custom-control-label pt-1"><strong>Jain</strong></label>';
                                    $page .='</div>';
                                $page .='</div>';
                            }
                        $page .= '</div>';
                    $page .= '</div>';
                    $page .= '<div class="modal-footer p-0 border-0">';
                        $page .= '<div class="col-12 m-0 p-0">';
                            //BUTTON DISABLE AT 3
                            if($this->data['add_to_cart_visiable']=='N'){
                                                    
                            }else{
                                $page .= '<button type="button" class="btn btn-primary add-btn w-100" onclick="addToCartsWithAddons('.$itemid.')">Add to Cart</button>';
                            }
                        $page .= '</div>';
                    $page .= '</div>';
                    $page .= '</form>';
                    $returnarray['msg'] = 'getinfo';
                    $returnarray['data'] = $page;
                } else {
                    $returnarray['msg'] = 'notfound';
                }
            }else{
                $returnarray['msg'] = 'notfound';
            }
        }
        echo json_encode($returnarray);exit; 
    }
    function selectaddress(){
        
        $returnarray = array();
        $delivery_address_id=$this->session->userdata('delivery_address_id');
        $customerid=$this->data['customer_info']['id'];
        $customeraddress = $this->manageaddresses_model->GetCustomerAllAddress($customerid);

        if($delivery_address_id!='' and $delivery_address_id!='0'){
            $returnarray['msg']='success';
            $returnarray['message']='Address Successfully added.';  
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Please Select Delivery Address.';
        }  
        if(empty($customeraddress)){
            $returnarray['msg']='enteraddress';
            $returnarray['message']='Please Enter Delivery Address.';
        }
        echo json_encode($returnarray);exit; 
    }
    function selectordertype(){
        $returnarray = array();
        $ordertype=$this->input->post('ordertype');
        $customerid=$this->data['customer_info']['id'];
        if($ordertype!='' and $customerid!=''){
            $returnarray['msg']='success';
            $returnarray['message']='Order Type Successfully added.'; 
            $this->session->set_userdata("order_type",$ordertype);
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Please Select Delivery Address.';
        }  
        echo json_encode($returnarray);exit; 
    }
    function manageaddressordertime(){
        $returnarray = array();        
        $deliveryarea   = $this->input->post('deliveryarea'); //item_id        
        $completedddress  = $this->input->post('completedddress'); // quantity
        $city = ($this->input->post('pincode')) ? $this->input->post('city'):"Junagadh"; // if variant select
        $pincode = ($this->input->post('pincode')) ? $this->input->post('pincode'):""; // if variant qty
        $addresstype = ($this->input->post('addresstype')) ? $this->input->post('addresstype') : ""; 
        $latitude = ($this->input->post('latitude')) ? $this->input->post('latitude') : "21.5189287	"; 
        $longtitude = ($this->input->post('longtitude')) ? $this->input->post('longtitude') : "70.4558306"; 
        $flag = TRUE;
        if($this->data['customer_info']['id']!=''){
            $customerid = $this->data['customer_info']['id'];
            $adata =array();
            $adata['deliveryarea'] =$deliveryarea;
            $adata['completedddress'] =$completedddress;
            $adata['city'] =$city;
            $adata['pincode'] =$pincode;
            $adata['addresstype'] =$addresstype;
            $adata['latitude'] =$latitude;
            $adata['longtitude'] =$longtitude;
            $adata['customerid ']=$customerid;
            $adata['created_datetime']=date('Y-m-d H:i:s');
            $adata['status']='1';
            $adata['isdelete']='0';
            $adata['createdip']=$_SERVER['REMOTE_ADDR'];
            $addressid = $this->manageaddresses_model->ManageAddressesAdd($adata);
            $returnarray['msg']='success';
            $returnarray['message']='Address Update Successfully.';
            $this->session->set_userdata("delivery_address_id",$addressid);
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        } 
        echo json_encode($returnarray);exit;        
    }
    function removeaddressordertime(){
        $returnarray =array();
        if($this->data['customer_info']['id']!=''){
            $this->session->unset_userdata("delivery_address_id");
            $returnarray['msg']='success';
            $returnarray['message']='Address Successfully Remove.';
        }else{
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        } 
        echo json_encode($returnarray);exit;        
    }
    function deliveraddressordertime(){
        $returnarray = array();
        $customer_address_id=$this->uri->segment(3);
        if($this->data['customer_info']['id']!=''){
            $customerid = $this->data['customer_info']['id'];
            $addressid = $customer_address_id;
            $customer_address_details=$this->manageaddresses_model->check_already_exist($customerid,$addressid);
            if(!empty($customer_address_details)){
                $this->session->set_userdata("delivery_address_id",$addressid);
                redirect($this->data['base_url'].'order/placeorder/');
            }else{
                redirect($this->data['base_url'].'order/placeorder/');
            }            
        }else{
            redirect($this->data['base_url'].'order/placeorder/');
        }        
    }
    function placeorder(){
        if($this->data['add_to_cart_visiable']=='N'){
            // Only Girveda Product Full Day open
            $GetGirvedaItem = $this->item_model->GetGirvedaItem();
            $GirvedaItemList =array();
            foreach ($GetGirvedaItem as $GIkey => $GIValue) {
                $GirvedaItemList[]=$GIValue['itemid'];
            }
            $GetOrderItem = $this->cart->contents();
            $RaivatItemCount =0;
            foreach ($GetOrderItem as $key => $OrderItem) {
                if(!in_array($OrderItem['id'], $GirvedaItemList)){
                    $RaivatItemCount++;
                }
                
            }
            if($RaivatItemCount!=0){
                $this->session->set_flashdata('message','Only Girveda Natural Product Order Any Time.');
                //redirect($this->data['base_url']);
            }
            // Only Girveda Product Full Day End
            // redirect($this->data['base_url']);
        }
        if($this->data['customer_info']['id']!=''){
            $CartTmpDate = $this->cart->contents();
            $cart_total =0;
            $cartdetails = '';
            $totalplatter = 0;
            if(!empty($CartTmpDate)){
                foreach ($CartTmpDate as $cdkey => $cdvalue) {
                    $categoryid = $cdvalue['options']['category_id'];
                    if($categoryid!='794456'){
                        $ispletter ='1';
                        $totalplatter = ($totalplatter+$cdvalue['qty']);
                    }
                    $item_total =0;
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
                    $cartdetails .='<div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">';
                        $cartdetails .='<div class="media align-items-center">';
                            $cartdetails .='<div class="mr-2 text-success">&middot;</div>';
                            $cartdetails .='<div class="media-body">';
                                $cartdetails .='<p class="m-0">'.$cdvalue['options']['item_name'].'</p>';
                                //$cartdetails .='<p class="m-0">'.$cdvalue['options']['description'].'</p>';
                                $variation_details ='';
                                if(isset($cdvalue['options']['isvariation']) && $cdvalue['options']['isvariation']!='0') {
                                    $variation = $cdvalue['options']['variation'];
                                    foreach ($variation as $variationkey => $variationvalue) {
                                        $vtotal=($variationvalue['variationquantity']*$variationvalue['variation_price']);
                                        $variation_details .=$variationvalue['variation_name'].'( Qty. '.$variationvalue['variationquantity'].') ₹'.$vtotal."<br>";
                                    }
                                    $cartdetails .='<p class="m-0">';
                                    $cartdetails .=$variation_details;
                                    $cartdetails .='</p>';
                                }
                                $addons_details ='';
                                if(isset($cdvalue['options']['isaddons']) && $cdvalue['options']['isaddons']!='0') {
                                    $addons = $cdvalue['options']['addons'];
                                    foreach ($addons as $addonskey => $addonsvalue) {
                                        $atotal=($addonsvalue['addon_qty']*$addonsvalue['addonitemprice']);
                                        //$addons_details .=$addonsvalue['addonitemname'].'( Qty. '.$addonsvalue['addon_qty'].') ₹ '.$atotal."<br>";
                                        $addons_details .=$addonsvalue['addonitemname'].',';
                                    }
                                    $cartdetails .='<p class="m-0 small"> Choice : ';
                                    $cartdetails .=$addons_details;
                                    $cartdetails .='</p>';
                                }
                            $cartdetails .='</div>';
                        $cartdetails .='</div>';
                        $cartdetails .='<div class="d-flex align-items-center">';
                                
                                $cartdetails .='<p class="text-gray mb-0 float-right ml-2 text-muted small">₹ '.$item_total.'</p>';
                        $cartdetails .='</div>';
                    $cartdetails .='</div>';
                }
                $cartdetails .='<div class="bg-white rounded p-3 pb-4">Sub Total : <p class="text-gray mb-0 float-right ml-2 large bold">₹ '.$cart_total.'</p></div>'; 
                $SpecialInstructions=$this->session->userdata('SpecialInstructions');
                if(isset($SpecialInstructions)){
                    $SpecialInstructions = $SpecialInstructions;
                }else{
                    $SpecialInstructions = '';
                }
                $sp .='<div class="mb-0 input-group pl-3 pr-3">';
                    $sp .='<div class="input-group-prepend">';
                        $sp .='<span class="input-group-text">';
                            $sp .='<i class="feather-message-square"></i>';
                        $sp .='</span>';
                    $sp .='</div>';
                    $sp .='<textarea placeholder="Add any Special Instructions" aria-label="With textarea" class="form-control" name="SpecialInstructions" id="SpecialInstructions" onblur="return SpecialInstructions();">'.$SpecialInstructions.'</textarea>';
                $sp .='</div><br>';
                $cartdetails .=$sp;
                $discount_div =$this->load_discount_div($cart_total);
                $this->data['discount_div'] = $discount_div;
                $final_pay_div =$this->load_final_pay_div($cart_total,$totalplatter);
                $delivery_address_id=$this->session->userdata('delivery_address_id');
                $this->data['final_pay_div'] = $final_pay_div;
                // Get Address Details
                $this->data['delivery_address']=$this->manageaddresses_model->GetCustomerSingleAddress($delivery_address_id);
                
                $Final_Pay_Rs =$this->Final_Pay_Rs($cart_total);
                $PayButuon =$this->PayButuon_Create($Final_Pay_Rs);
                $this->data['PayButuon'] = $PayButuon;
                
                $customerid=$this->data['customer_info']['id'];
                $customeraddress = $this->manageaddresses_model->GetCustomerAllAddress($customerid);
                $this->data['customeraddressdetails'] = $customeraddress;
                $this->data['cart_total'] = $Final_Pay_Rs;
                $this->data['cartdetails'] = $cartdetails;
                $this->data['order_type'] = $this->data['order_type'];
                $this->data['message'] = $this->session->flashdata('message');
                $this->data['breadcrumb'] = 'Place Order';
                $this->data['tpl_name']= "placeorder.tpl";
                $this->smarty->assign('data', $this->data);
                $this->smarty->view('template.tpl');
            }else{
                redirect($this->data['base_url'].'order');
            
            }
        }else{
            redirect($this->data['base_url'].'order/checkout');
            
        }
    }
    function Final_Pay_Rs($cart_total){
        $cart_total = $cart_total;
        $finalpay =$cart_total;
        $discount=0;
        $taxes=0;
        if($this->data['customer_info']['id']!=''){
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
                    }
                    // if($coupons_details['discountmaxlimit']!='' and $coupons_details['discountmaxlimit']!='0'){
                    //     $discountmaxlimit = $coupons_details['discountmaxlimit'];
                    //     if($discount>$discountmaxlimit){
                    //         $discount =$discountmaxlimit;
                    //     }
                    // }
                }
                $finalpay =($finalpay-$discount);
            }                
        }
        $gettaxesdetails = $this->order_model->taxes_details();
        if(!empty($gettaxesdetails)){
            foreach ($gettaxesdetails as $taxesdetailskey => $taxesdetails) {
                if($taxesdetails['taxtype']!='' and $taxesdetails['taxtype']!='0'){
                    if($taxesdetails['taxtype']=='1'){
                        $taxes = ($finalpay*$taxesdetails['tax']/100);
                    }
                    if($taxesdetails['taxtype']=='2'){
                        $taxes = $taxesdetails['tax'];
                    }
                    $finalpay =($finalpay+$taxes);
                }
            }                
        }
        $restaurantsdetails = $this->order_model->restaurants_details();
        
        if(!empty($restaurantsdetails)){
            // Packaging Charge As  Internethandling Charge
            $packaging_applicable_on = $restaurantsdetails['packaging_applicable_on'];
            $packaging_charge = $restaurantsdetails['packaging_charge'];
            $packaging_charge_type = $restaurantsdetails['packaging_charge_type'];
            
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
                    if($restaurantsdetails['deliverycharge']!='' and $restaurantsdetails['deliverycharge']!='0'){
                        $minimumorderamount = $restaurantsdetails['minimumorderamount'];
                        if($finalpay<$minimumorderamount){
                            $finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                        }
                        //$finalpay =($finalpay+$restaurantsdetails['deliverycharge']);
                    }
                } 
        }
        return round($finalpay);
    }
    function PayButuon_Create($cart_total) {
        $customerid=$this->data['customer_info']['id'];
        $pay_amount = $cart_total; // Total Pay Amount
        $currency = 'INR'; // currency
        $keyId = $this->data['PG_keyId'];
        $keySecret = $this->data['PG_keySecret'];
        $displayCurrency = 'INR';
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $CustomerDetails = $this->order_model->GetSingleCustomerDetails($customerid);
        if(!empty($CustomerDetails)){
            $customername=$CustomerDetails['name'];
            $customermobileno=$CustomerDetails['mobileno'];
            $customeremail=$CustomerDetails['email'];
        }else{
            $customername='';
            $customermobileno='';
            $customeremail='';
        }
        $api = new Api($keyId, $keySecret);
        $orderData = [
            'receipt'         => rand(1000, 9999),
            'amount'          => $pay_amount * 100,
            'currency'        => $currency,
            'payment_capture' => 1
        ];
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];
        //$_SESSION['razorpay_order_id'] = $razorpayOrderId;
        $this->session->set_userdata('razorpay_order_id', $razorpayOrderId);
        $displayAmount = $pay_amount = $orderData['amount'];
        if ($displayCurrency !== 'INR') {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);

            $displayAmount = $exchange['rates'][$displayCurrency] * $pay_amount / 100;
        }
        $imageurl = $this->data['base_assets'].'img/logo/logo.png';
        $data = [
            "key"               => $keyId,
            "amount"            => $pay_amount,
            "name"              => 'Raivat Kitchen',
            "description"       => '',
            "image"             => $imageurl,
            "prefill"           => [
            "name"              => $customername,
            "email"             => $customeremail,
            "contact"           => $customermobileno,
            ],
            "notes"             => [
            "address"           => '4th Floor Noble Plaza Kalva Chowk Nr. Domadiya Vadi, Junagadh, Gujarat 362001',
            "merchant_order_id" => rand(1000, 9999),
            ],
            "theme"             => [
            "color"             => "#094F8D"
            ],
            "order_id"          => $razorpayOrderId,
        ];
        if ($displayCurrency !== 'INR')
        {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
        }
        $json = json_encode($data);

        $returnhtml='';
        $returnhtml .='<button id="pay-button" class="btn btn-success btn-block btn-lg btns-ss-two" style="display:none;">Pay ₹ '.$cart_total.'<i class="icofont-long-arrow-right"></i></button>';
        $returnhtml .='<script src="https://checkout.razorpay.com/v1/checkout.js"></script>';
        $returnhtml .='<form name="razorpayform" action="'.$this->data['base_url'].'order/paymentsuccess/" method="POST">';
            $returnhtml .='<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">';
            $returnhtml .='<input type="hidden" name="razorpay_signature"  id="razorpay_signature" >';
        $returnhtml .='</form>';
        $returnhtml .='<script>';
        $returnhtml .=' var options = '.$json.';';
        $returnhtml .=' options.handler = function (response){';
            $returnhtml .='document.getElementById("razorpay_payment_id").value = response.razorpay_payment_id;';
            $returnhtml .='document.getElementById("razorpay_signature").value = response.razorpay_signature;';
            $returnhtml .='document.razorpayform.submit();';
        $returnhtml .='};';
        $returnhtml .='options.theme.image_padding = false;';
        $returnhtml .='options.modal = {';
            $returnhtml .='ondismiss: function() {';
                $returnhtml .='console.log("This code runs when the popup is closed");';
            $returnhtml .='},';
            $returnhtml .='escape: true,';
            $returnhtml .='backdropclose: false';
        $returnhtml .='};';
        $returnhtml .='var rzp = new Razorpay(options);';
        $returnhtml .=' document.getElementById("pay-button").onclick = function(e){';
            $returnhtml .='rzp.open();';
            $returnhtml .='e.preventDefault();';
        $returnhtml .='}';
        
       $returnhtml .=' </script>';
       return $returnhtml;         
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
    function get_map_live_location_track_script($delivery_boy_latitude,$delivery_boy_longitude,$delivery_boy_name,$customerlatitude,$customerlongtitude,$customername){
        $html ='';
        $html .="<script>";
            $html .="var mymap = new GMaps({";
                $html .=" el: '#GMap',";
                $html .=" lat: ".$delivery_boy_latitude.",";
                $html .=" lng: ".$delivery_boy_longitude.",";
                $html .=" zoom:13";
            $html .=" });";
            $html .=" mymap.addMarker({";
                $html .=" lat: ".$delivery_boy_latitude.",";
                $html .=" lng: ".$delivery_boy_longitude.",";
                  $html .=" title: '".$delivery_boy_name."',";
                 $html .=" icon: {";
                    $html .=" url: 'http://raivatkitchen.com/assets/img/ordermessageicon/bike.png',";
                  $html .="},";
                $html .=" click: function(e) {";
                  $html .=" alert('".$delivery_boy_name.", is here.');";
                $html .=" }";
            $html .="});";
            $html .=" mymap.addMarker({";
                   $html .=" lat: ".$customerlatitude.",";
                   $html .=" lng: ".$customerlongtitude.",";
                     $html .=" title: '".$customername."',";
                     $html .=" icon: {";
                       $html .=" url: 'http://raivatkitchen.com/assets/img/ordermessageicon/home.png',";
                     $html .=" },";
                    $html .=" click: function(e) {";
                      $html .=" alert('".$customername.", is here.');";
                    $html .=" }";
                $html .=" });";
        $html .=" </script>";
        return $html;exit;
    }
    
    
    
    
    // Feedback
    function viewfeedbackform($order_id,$order_no){
        $html='';
        $OrderDetails = $this->order_model->GetSingelOrderForFeedback($order_id,$order_no);
        $customerid = $OrderDetails['customerid'];
        $order_status=$OrderDetails['order_status'];
        $customername=$OrderDetails['customername'];
        $phone_number=$OrderDetails['customermobileno'];
        $email='';
        $deliveryby=$OrderDetails['deliveryby'];

        $GetOrderFeedbackRatingCount=$this->order_model->GetOrderFeedbackRatingCount($order_no,$order_id,$customerid);
        
        if($GetOrderFeedbackRatingCount=='0' and $order_status=='Delivered'){
            
            $star_details = $this->order_model->star_details();
            $OrderItemDetails = $this->order_model->GetOrderItemDetailsForFeedback($order_no,$order_id,$customerid);
            if ($OrderItemDetails != false) {
                $qniqueid = 1;
                $html .= '<input type="hidden" name="cname" value="'.$customername.'">';
                $html .= '<input type="hidden" name="cphonenumber" value="'.$phone_number.'">';
                $html .= '<input type="hidden" name="cemail" value="'.$email.'">';
                $html .= '<input type="hidden" name="customerid" value="'.$customerid.'">';
                $html .= '<input type="hidden" name="order_no" value="'.$order_no.'">';
                $html .= '<input type="hidden" name="order_id" value="'.$order_id.'">';
                foreach ($OrderItemDetails as $qkey => $qdetails) {
                    $html .= '<div class="card col-lg-12 mb-2">';
                        $html .= '<div class="card-body">';
                            $html .= '<h5 class="card-title text-center">'.ucwords(str_replace("-", " ", $qdetails['item_name'])).'</h5>';
                            $html .= '<input type="hidden" name="item_id[]" value="'.$qdetails['item_id'].'">';
                            $html .= '<div class="voting-count">';
                                $html .= '<div class="rating" id="input-grp">';
                                    foreach ($star_details as $skey => $sdetails) {
                                        $html .= '<input type="radio" name="ratingforitem'.$qdetails['item_id'].'" value="'.$sdetails['star'].'" id="'.$qniqueid.'">';
                                        $html .= '<label for="'.$qniqueid.'">☆</label>';
                                        $qniqueid = ($qniqueid+1); 
                                    }
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<div class="form-group">';
                                $html .= '<textarea name="reviewforitem'.$qdetails['item_id'].'" placeholder="Write your Review" class="form-control"></textarea>';
                            $html .= '</div>';
                            $html .= '<span id="ERROR"></span> ';
                        $html .= '</div>';
                    $html .= '</div>';
                }
                if($deliveryby!='' and $deliveryby!='0'){
                    $html .= '<div class="card col-lg-12 mb-2">';
                        $html .= '<div class="card-body">';
                            $html .= '<h5 class="card-title text-center">For Delivery</h5>';
                            $html .= '<input type="hidden" name="deliveryboyid" value="'.$deliveryby.'">';
                            $html .= '<div class="voting-count">';
                                $html .= '<div class="rating" id="input-grp">';
                                    foreach ($star_details as $skey => $sdetails) {
                                        $html .= '<input type="radio" name="ratingfordeliveryboy'.$deliveryby.'" value="'.$sdetails['star'].'" id="'.$qniqueid.'">';
                                        $html .= '<label for="'.$qniqueid.'">☆</label>';
                                        $qniqueid = ($qniqueid+1); 
                                    }
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<div class="form-group">';
                                $html .= '<textarea name="reviewfordeliveryboy'.$deliveryby.'" placeholder="Write your Review" class="form-control"></textarea>';
                            $html .= '</div>';
                            $html .= '<span id="ERROR"></span> ';
                        $html .= '</div>'; 
                    $html .= '</div>'; 
                }
                
            }
        } 
        return $html;
    }  
    function orderfeedback(){
        if($this->input->post()){  
            $name =$this->input->post('cname');
            $phone_number =$this->input->post('cphonenumber');
            $email =$this->input->post('cemail');
            $customerid =$this->input->post('customerid');
            $order_no =$this->input->post('order_no');
            $order_id =$this->input->post('order_id');
            $item_id=$this->input->post('item_id');
            $deliveryboyid=$this->input->post('deliveryboyid');
            
            foreach ($item_id as $ikey => $ivalue) {                
                $vdata=array();
                $ratingforitem = $this->input->post('ratingforitem'.$ivalue);
                $reviewforitem = $this->input->post('reviewforitem'.$ivalue);
                if($ivalue!='' and $ratingforitem!=''){
                    $vdata['name'] =$name;
                    $vdata['phone_number'] =$phone_number;
                    $vdata['email'] =$email;
                    $vdata['customerid'] =$customerid;
                    $vdata['order_no'] =$order_no;
                    $vdata['order_id'] =$order_id;
                    $vdata['ordered_item']=$ivalue;
                    $vdata['order_item_rating']=$ratingforitem;
                    $vdata['order_item_review']=$reviewforitem;
                    $vdata['status']='1';
                    $vdata['isdelete']='0';
                    $vdata['created_datetime']=date('Y-m-d H:i:s');
                    $vdata['createdip']=$_SERVER['REMOTE_ADDR'];
                    $voteid = $this->order_model->AddOrderRatingDetails($vdata);
                    
                    // Item Rating Update
                    $GetItemRatingDetails = $this->order_model->GetItemRatingDetails($ivalue);
                    $ItemRating = ($GetItemRatingDetails['itemtotalrating']+$ratingforitem);
                    $itemtotalreviews = ($GetItemRatingDetails['itemtotalreviews']+1);
                    $idata=array();
                    $idata['itemid'] =$ivalue;
                    $idata['itemtotalrating']=$ItemRating;
                    $idata['itemtotalreviews']=$itemtotalreviews;
                    $UpdateItemRatingDetails = $this->order_model->UpdateItems($idata);
                }       
            }
            if($deliveryboyid!=''){
                // Delivery Boy Rating Update

                $ratingfordeliveryboy=$this->input->post('ratingfordeliveryboy'.$deliveryboyid);
                $GetDeliveryBoyRatingDetails = $this->order_model->GetDeliveryBoyRatingDetails($deliveryboyid);
                $DeliveryBoyRating = ($GetDeliveryBoyRatingDetails['rating']+$ratingfordeliveryboy);
                $reviewfordeliveryboy=$this->input->post('reviewfordeliveryboy'.$deliveryboyid);
                $vdata=array();
                $vdata['name'] =$name;
                $vdata['phone_number'] =$phone_number;
                $vdata['email'] =$email;
                $vdata['customerid'] =$customerid;
                $vdata['order_no'] =$order_no;
                $vdata['order_id'] =$order_id;
                $vdata['deliveryboyid']=$deliveryboyid;
                $vdata['delivery_rating']=$ratingfordeliveryboy;
                $vdata['delivery_review']=$reviewfordeliveryboy;
                $vdata['status']='1';
                $vdata['isdelete']='0';
                $vdata['created_datetime']=date('Y-m-d H:i:s');
                $vdata['createdip']=$_SERVER['REMOTE_ADDR'];
                $AddOrderDeliveryBoyRatingId = $this->order_model->AddOrderDeliveryBoyRatingDetails($vdata);

                $ddata=array();
                $ddata['id'] =$deliveryboyid;
                $ddata['rating']=$DeliveryBoyRating;
                $UpdateDeliveryBoyRatingDetails = $this->order_model->UpdateDeliveryBoyRating($ddata);                
                
            }
            $this->session->set_flashdata('message',"Thank you for your valuable feedback.");
            redirect($this->data['base_url'].'order/vieworder/'.$order_no);
        }else{
            redirect($this->data['base_url']);
        }
    }
    function SingleProductRating(){
        $returnarray = array();     
        if($this->input->post()){
            $reviewslist='';
            $reviewsrating='';
            $itemid = $this->input->post('itemid');
            if ($itemid > 0) {
                $item_details = $this->order_model->single_item_details($itemid);     
                //get item_record
                if (!empty($item_details)) {
                    $item_name = $item_details['name'];
                    $returnarray['msg'] = 'success';
                    $returnarray['SingleProductRatingPlatterName'] = $item_name;
                    $totalrating = ($item_details['itemtotalrating']/$item_details['itemtotalreviews']);
                    //$reviewsrating .='<div class="rating-wrap d-flex align-items-center">';
                        $reviewsrating .='<div class="voting-count"><div class="rating ratings-highlight">';
                            //$reviewsrating .='<li>';
                               for ($r=1; $r<=5;$r++) { 
                                    if($r<=round($totalrating)){
                                        $reviewsrating .='<label class="fillstar">☆</label>';
                                    }else{
                                       $reviewsrating .='<label>☆</label>'; 
                                    }
                                }
                            //$reviewsrating .='</li>';
                        //$reviewsrating .='</ul>';
                        $reviewsrating .='<p class="label-rating text-muted ml-2 mb-0 small"> ('.$item_details['itemtotalrating'].' Reviews)</p>';
                    //$reviewsrating .='</div>';
                    $returnarray['reviewsrating'] = $reviewsrating;                    

                    $GetItemFeedbackRatingDetails = $this->order_model->GetItemFeedbackRatingDetails($itemid);    
                    foreach ($GetItemFeedbackRatingDetails as $ifkey => $ifrvalue) {
                        $rating = $ifrvalue['order_item_rating'];
                        if($rating!='' and $rating!='0'){
                            $reviewslist .='<div class="review-item shadow bg-white p-3 pl-4 pr-4 mb-2" >';
                              $reviewslist .='<div class="row"><div class="reviwer-name col-6">'.ucwords($ifrvalue['name']).'</div>';
                              $reviewslist .='<div class="reviwer-name d-none pt-0 col-6 text-right" style="font-size: 10px"><i class="feather-clock"></i> '.date('d/m/Y - h:i A',strtotime($ifrvalue['datetime'])).'</div></div>';
                                //$reviewslist .='<div class="rating-wrap d-flex align-items-center mt-2">';
                                 $reviewslist .='<div class="voting-count"><div class="rating ratings-highlight single-person-rating" >';
                                    //$reviewslist .='<li>';
                                        for ($i=1; $i<=5;$i++) { 
                                            if($i<=$rating){
                                                $reviewslist .='<label class="fillstar">☆</label>';
                                            }else{
                                               $reviewslist .='<label>☆</label>'; 
                                            }
                                        }
                                    //$reviewslist .='</li>';
                                 //$reviewslist .='</ul>';
                               $reviewslist .='</div></div>';
                               
                              $reviewslist .='<div class="review-text">';
                                $reviewslist .=ucwords($ifrvalue['order_item_review']);
                              $reviewslist .='</div>';
                            $reviewslist .='</div>';
                        }                        
                    }
                    $returnarray['reviewslist'] = $reviewslist;
                } else {
                    $returnarray['msg'] = 'notfound';
                }
            }else{
                $returnarray['msg'] = 'notfound';
            }
        }
        echo json_encode($returnarray);exit; 
    }
    function vieworderbk(){
        $transaction_id=$this->uri->segment(3);
        $vdata = array();
        $vdata['transaction_id'] = 'pay_'.$transaction_id;
        $SingelOrderDetails = $this->order_model->GetSingelOrderDetails($vdata);
        if(!empty($SingelOrderDetails)){
            $this->data['SingelOrderDetails'] = $SingelOrderDetails;
        }else{
          redirect($this->data['base_url']); 
        }
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['breadcrumb'] = 'Order us';
        $this->data['tpl_name']= "vieworder.tpl";
        $this->smarty->assign('data', $this->data);
        $this->smarty->view('template.tpl'); 
    }
    function SpecialInstructions(){
        $returnarray =array();
        $SpecialInstructions = $this->input->post('SpecialInstructions');
        if($SpecialInstructions!=''){  
            $this->session->set_userdata("SpecialInstructions",$SpecialInstructions);
            $returnarray['msg']='success';
            $returnarray['message']='Special Instructions Successfully Applied.';
        }else{
            $this->session->set_userdata("SpecialInstructions",$SpecialInstructions);
            $returnarray['msg']='error';
            $returnarray['message']='Something Wrong.';
        }
        echo json_encode($returnarray);exit;        
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