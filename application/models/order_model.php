<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class order_model extends CI_Model 
{

	function __construct()
    {
        parent::__construct();
        //echo $this->db->last_query();exit;
    }
    function single_item_details($itemid){ 
        $this->db->select('c.name as categoryname,ch.choice_name,i.*');
        $this->db->from('rk_item as i');
        $this->db->join('rk_category as c','c.id=i.categoryid','LEFT');
        $this->db->join('rk_item_choice as ch','ch.choice_id=i.choiceid','LEFT');
        $this->db->where('i.status','1');
        $this->db->where('i.isdelete','0');
        $this->db->where('i.itemid',$itemid);
        //$this->db->group_by('o.name');
        $this->db->order_by('c.id', 'DESC');
        $query=$this->db->get();
        //echo $this->db->last_query();exit;
        return $query->row_array();
    } 
    function single_addon_item_details($addonitemid){ 
        $this->db->select('ag.addongroup_name as addongroupname,ai.*');
        $this->db->from('rk_addon_groups_item as ai');
        $this->db->join('rk_addon_groups as ag','ag.addongroupid=ai.addongroupid','LEFT');
        $this->db->where('ai.status','1');
        $this->db->where('ai.isdelete','0');
        $this->db->where('ai.addonitemid',$addonitemid);
        $query=$this->db->get();        
        return $query->row_array();
    } 
    function single_item_variation_details($itemid,$variationid){ 
        $this->db->select('v.variationname,vp.*');
        $this->db->from('rk_item_variation_price as vp');
        $this->db->join('rk_item_variation as v','v.variationid=vp.variation_id','LEFT');
        $this->db->where('vp.status','1');
        $this->db->where('vp.isdelete','0');
        $this->db->where('vp.item_id',$itemid);
        $this->db->where('vp.variation_id',$variationid);
        $query=$this->db->get();        
        return $query->row_array();
    } 
     
    
    function GetItemVariation($item_id, $item_variation_id = "")
    {
        $this->db->select('v.variationname,v.groupname,vp.*');
        $this->db->from('rk_item_variation_price as vp');
        $this->db->join('rk_item_variation as v','v.variationid=vp.variation_id','LEFT');
        $this->db->where('vp.status','1');
        $this->db->where('vp.isdelete','0');
        $this->db->where('vp.item_id',$item_id);
        if($item_variation_id!=''){
            $this->db->where('vp.item_variation_id',$item_variation_id);
        }
        $query=$this->db->get();        
        return $query->result_array();
    }
    function GetItemAddons($item_id, $addongroupid = "")
    {
        $this->db->select('agi.*,ag.addongroup_name as addongroupname');
        $this->db->from('rk_addon_groups_item as agi');
        $this->db->join('rk_addon_groups as ag','ag.addongroupid=agi.addongroupid','LEFT');
        $this->db->join('rk_item_with_addongroups as iwa','iwa.addongroupid=agi.addongroupid','LEFT');
        $this->db->where('agi.status','1');
        $this->db->where('agi.isdelete','0');
        $this->db->where('iwa.itemid',$item_id);
        if($addongroupid!=''){
            $this->db->where('agi.addongroupid',$addongroupid);
        }
        $query=$this->db->get();        
        return $query->result_array();
    }
    function restaurants_details(){ 
        $this->db->select('*');
        $this->db->from('rk_restaurants');
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $this->db->order_by('id','desc');
        $this->db->limit('1');
        $query=$this->db->get();        
        return $query->row_array();
    }
    function taxes_details(){ 
        $this->db->select('*');
        $this->db->from('rk_taxes');
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $this->db->order_by('taxid','desc');
        $this->db->limit('1');
        $query=$this->db->get();        
        return $query->result_array();
    }
    function check_already_customer($mobileno){
        $this->db->select('*');
        $this->db->from('rk_customer');
        $this->db->where('mobileno', $mobileno);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
    function AddCustomerDetails($data){
        $this->db->insert('rk_customer', $data);
        return $this->db->insert_id();
    }
    function GetSingleCustomerDetails($id){
        $this->db->select('*');
        $this->db->from('rk_customer');
        $this->db->where('id', $id);
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }  
    function UpdateCustomerDetails($data){
        $this->db->update("rk_customer", $data, array('id' => $data['id']));
        return $this->db->affected_rows();
    }
    function GetCouponsDetails()
    {
        $this->db->select('d.*');
        $this->db->from('rk_discounts as d');
        //$this->db->join('rk_addon_groups as ag','ag.addongroupid=agi.addongroupid','LEFT');
        $this->db->where('d.status','1');
        $this->db->where('d.isdelete','0');
        $this->db->where('d.showonweb','Yes');
        $query=$this->db->get();        
        return $query->result_array();
    }
    function GetSingleCouponDetails($discountid){
        $this->db->select('*');
        $this->db->from('rk_discounts');
        $this->db->where('discountid', $discountid);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
    function GetSingleCustomerCouponDetails($discountid,$customerid){
        $this->db->select('*');
        $this->db->from('rk_orders');
        $this->db->where('discountid', $discountid);
        $this->db->where('customerid',$customerid);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->result_array();
    } 
    function GetSingleCouponCodeDetails($discountname,$customerid){
        $this->db->select('*');
        $this->db->from('rk_orders');
        $this->db->where('discountname',$discountname);
        $this->db->where('customerid',$customerid);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
    function GetSingleCoupon_CodeDetails($discountname){
        $this->db->select('*');
        $this->db->from('rk_discounts');
        $this->db->where('discountname',$discountname);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
    function GetCustomerAddressDetails($discountid,$customerid){
        $this->db->select('*');
        $this->db->from('rk_order_discount');
        $this->db->where('discount_id', $discountid);
        $this->db->where('customerid', $customerid);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->result_array();
    } 
    // Add Order
    function AddOrderDetails($data){
        $this->db->insert('rk_orders', $data);
        return $this->db->insert_id();
    }
    // Update Order
    function UpdateOrderDetails($data){
        $this->db->update("rk_orders", $data, array('order_id' => $data['order_id']));
        return $this->db->affected_rows();
    }
    // Add Order Items
    function AddOrderItemsDetails($data){
        $this->db->insert('rk_order_items', $data);
        return $this->db->insert_id();
    }
    // Add Add Order Item Variant Details
    function AddOrderItemVariantDetails($data){
        $this->db->insert('rk_order_items_variation', $data);
        return $this->db->insert_id();
    }
    // Add Add Order Item Addo Details
    function AddOrderItemAddonDetails($data){
        $this->db->insert('rk_order_items_addons', $data);
        return $this->db->insert_id();
    }
    // Add Order Item Taxes Details
    function AddOrderItemTaxesDetails($data){
        $this->db->insert('rk_order_taxes', $data);
        return $this->db->insert_id();
    }
    
    // Update Order Status Details
    function UpdateOrderStatusDetails($order_id,$order_no,$customerid,$razorpay_payment_id,$razorpay_order_id,$paymentstatus){
        $data =array('status' =>'1','isdelete'=>'0','modified_datetime'=>date('Y-m-d H:i:s'));
        $odata =array('transaction_id' =>$razorpay_payment_id,'razorpay_order_id'=>$razorpay_order_id,'paymentstatus'=>$paymentstatus,'status' =>'1','isdelete'=>'0','modified_datetime'=>date('Y-m-d H:i:s'));
        // order table staus change
        $this->db->update("rk_orders", $odata, array('order_id' => $order_id,'order_no' => $order_no));
        // order item  table staus change
        $this->db->update("rk_order_items", $data, array('order_id' => $order_id,'order_no' => $order_no));
        // order addon table staus change
        $this->db->update("rk_order_items_addons", $data, array('order_id' => $order_id,'order_no' => $order_no));
        // order variation table staus change
        $this->db->update("rk_order_items_variation", $data, array('order_id' => $order_id,'order_no' => $order_no));
        // order taxes table staus change
        $this->db->update("rk_order_taxes", $data, array('order_id' => $order_id,'order_no' => $order_no));
    }
    function GetOrderDetails($order_no,$order_id,$customerid){
        $this->db->select('*');
        $this->db->from('rk_orders');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customerid',$customerid);        
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    } 
    function GetOrderItemDetails($order_no,$order_id,$customerid){
        $this->db->select('*');
        $this->db->from('rk_order_items');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customer_id',$customerid);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->result_array();
    } 
    function GetOrderItemAddonsDetails($order_no,$order_id,$customerid,$item_id){
        $this->db->select('*');
        $this->db->from('rk_order_items_addons');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customer_id',$customerid);
        $this->db->where('item_id',$item_id);        
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->result_array();
    } 
    function get_order_taxes_details($orderid,$orderno,$customerid){
        $this->db->select('*');
        $this->db->from('rk_order_taxes');
        $this->db->where('order_no',$orderno);
        $this->db->where('order_id',$orderid);
        $this->db->where('customer_id',$customerid);       
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->result_array();
    }   
    // Add Payment Table Details
    function AddOrderPaymentDetails($data){
        $this->db->insert('rk_orders_payment', $data);
        return $this->db->insert_id();
    } 
    function GetSingelOrderDetails($data){
        $this->db->select('*');
        $this->db->from('rk_orders');
        if($data['transaction_id']!=''){
            $this->db->where('transaction_id',$data['transaction_id']);
        }        
        // $this->db->where('order_id',$order_id);
        // $this->db->where('customerid',$customerid);        
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    } 
    function GetSingelOrderUsingOrderNoDetails($data){
        $this->db->select('*');
        $this->db->from('rk_orders');
        if($data['order_no']!=''){
            $this->db->where('order_no',$data['order_no']);
        }        
        // $this->db->where('order_id',$order_id);
        // $this->db->where('customerid',$customerid);        
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    } 
    function GetItemAddonsGroups($item_id, $addongroupid = "")
    {
        $this->db->select('iwa.*,ag.addongroup_name as addongroupname');
        $this->db->from('rk_item_with_addongroups as iwa');
        $this->db->join('rk_addon_groups as ag','ag.addongroupid=iwa.addongroupid','LEFT');
        $this->db->where('iwa.status','1');
        $this->db->where('iwa.isdelete','0');
        $this->db->where('iwa.itemid',$item_id);
        if($addongroupid!=''){
            $this->db->where('iwa.addongroupid',$addongroupid);
        }
        $query=$this->db->get();        
        return $query->result_array();
    } 
    function GetCategoryWiseItem($categoryid){ 
        $this->db->select('c.name as categoryname,ch.choice_name,i.*');
        $this->db->from('rk_item as i');
        $this->db->join('rk_category as c','c.id=i.categoryid','LEFT');
        $this->db->join('rk_item_choice as ch','ch.choice_id=i.choiceid','LEFT');
        $this->db->where('i.status','1');
        $this->db->where('i.isdelete','0');
        $this->db->where('i.isdelete','0');
        $this->db->where('i.categoryid',$categoryid);
        //$this->db->group_by('o.name');
        $this->db->order_by('c.id', 'DESC');
        $query=$this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    } 
    function UpdateOrderStatuDetails($data){
        $this->db->update("rk_orders", $data, array('order_no' => $data['order_no']));
        return $this->db->affected_rows();
    }
    function star_details(){ 
        $this->db->select('*');
        $this->db->from('rk_star');
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $this->db->order_by("star", "desc");
        $query=$this->db->get();
        return $query->result_array();
    }
    function AddOrderRatingDetails($data){
        $this->db->insert('rk_order_rating', $data);
        return $this->db->insert_id();
    }
    function GetItemRatingDetails($itemid){ 
        $this->db->select('itemtotalrating,itemtotalreviews');
        $this->db->from('rk_item');
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $this->db->where('itemid',$itemid);
        $query=$this->db->get();
        return $query->row_array();
    } 
    function UpdateItems($data){
        $this->db->update("rk_item", $data, array('itemid' => $data['itemid']));
        return $this->db->affected_rows();
    } 
    function GetDeliveryBoyRatingDetails($deliveryboyid){ 
        $this->db->select('rating');
        $this->db->from('rk_deliveryboy');
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $this->db->where('id',$deliveryboyid);
        $query=$this->db->get();
        return $query->row_array();
    }
    function AddOrderDeliveryBoyRatingDetails($data){
        $this->db->insert('rk_order_deliveryboy_rating', $data);
        return $this->db->insert_id();
    } 
    function UpdateDeliveryBoyRating($data){
        $this->db->update("rk_deliveryboy", $data, array('id' => $data['id']));
        return $this->db->affected_rows();
    } 
    function GetOrderFeedbackRatingDetails($order_no,$order_id,$customerid){
        $this->db->select('*');
        $this->db->from('rk_order_rating');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customerid',$customerid);       
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();  
        //echo $this->db->last_query();exit;      
        return $query->result_array();
    }
    function GetItemFeedbackRatingDetails($ordered_item){
        $this->db->select('*');
        $this->db->from('rk_order_rating');
        $this->db->where('ordered_item',$ordered_item);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();  
        //echo $this->db->last_query();exit;      
        return $query->result_array();
    }  
    function GetOrderTempDetails($order_no,$order_id,$customerid){
        $this->db->select('*');
        $this->db->from('rk_orders');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customerid',$customerid);        
        //$this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();  
        return $query->row_array();
    } 
    function GetOrderTypeDetails($order_no,$order_id,$customerid){
        $this->db->select('order_type');
        $this->db->from('rk_orders');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customerid',$customerid);        
        //$this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();  
        return $query->row_array();
    } 
    function UpdateOrderPushDetails($order_id,$push_on){
        $data =array('push_on' =>$push_on);
        // order table staus change
        $this->db->update("rk_orders", $data, array('order_id' => $order_id));
    }    
    function GetSingelOrderForViewOrder($data){
        $this->db->select('order_id,order_no,customerid,order_date,push_on,order_status,total_cost,paid_total,squeroff,discounttotal,tax_fee,delivery_fee,packing_charges,points_value,customerlongtitude,customerlatitude,customername');
        $this->db->from('rk_orders');
        if($data['order_no']!=''){
            $this->db->where('order_no',$data['order_no']);
        }                 
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
    function OrderStatusUpdate($data){
        $odata =array();
        // if($data['status']!=''){
        //     $odata['status']=$data['status'];
        // }
        if($data['order_status']!=''){
            $odata['order_status']=$data['order_status'];
        }
        $odata['modified_datetime']=date('Y-m-d H:i:s');
        $order_id=$data['order_id'];
        $order_no=$data['order_no'];
        
        // order table staus change
        $this->db->update("rk_orders", $odata, array('order_id' => $order_id,'order_no' => $order_no));

        // $ndata =array();
        // $ndata['status']=$data['status'];
        // $ndata['modified_datetime']=date('Y-m-d H:i:s');
        // // order item  table staus change
        // $this->db->update("rk_order_items", $ndata, array('order_id' => $order_id,'order_no' => $order_no));

        // // order addon table staus change
        // $this->db->update("rk_order_items_addons", $ndata, array('order_id' => $order_id,'order_no' => $order_no));

        // // order variation table staus change
        // $this->db->update("rk_order_items_variation", $ndata, array('order_id' => $order_id,'order_no' => $order_no));

        // // order taxes table staus change
        // $this->db->update("rk_order_taxes", $ndata, array('order_id' => $order_id,'order_no' => $order_no));
    }
    function GetOrderStatusFromPetpooja($order_no,$order_id){
        $this->db->select('order_status');
        $this->db->from('rk_orders');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);       
        //$this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();  
        return $query->row_array();
    }
    // Feedback
    function GetSingelOrderForFeedback($order_id,$order_no){
        $this->db->select('order_id,order_no,customerid,order_status,customername,customermobileno,deliveryby');
        $this->db->from('rk_orders');
        if($order_no!=''){
            $this->db->where('order_no',$order_no);
        }
        if($order_id!=''){
            $this->db->where('order_id',$order_id);
        }          
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
    function GetOrderFeedbackRatingCount($order_no,$order_id,$customerid){
        $this->db->select('id');
        $this->db->from('rk_order_rating');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customerid',$customerid);       
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();   
        //echo $this->db->last_query();exit;
        return $query->num_rows(); 
    }
    function GetOrderItemDetailsForFeedback($order_no,$order_id,$customerid){
        $this->db->select('item_name,item_id');
        $this->db->from('rk_order_items');
        $this->db->where('order_no',$order_no);
        $this->db->where('order_id',$order_id);
        $this->db->where('customer_id',$customerid);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->result_array();
    } 
    function GetCustomerLatLongForOrder($order_no,$order_id){
        $this->db->select('customerlongtitude,customerlatitude,customername');
        $this->db->from('rk_orders');
        if($data['order_no']!=''){
            $this->db->where('order_no',$data['order_no']);
        }                 
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
    function GetOrderSmsStatus($order_no,$orderstatusnew){
        $this->db->select('sms_status,order_id');
        $this->db->from('rk_orders');
        if($order_no!=''){
            $this->db->where('order_no',$order_no);
        } 
        if($orderstatusnew!=''){
            $this->db->where('order_status',$orderstatusnew);
        } 
        $this->db->where('sms_status','1');       
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
        //return $this->db->last_query();
    }
    
    
    
    
}
?>
