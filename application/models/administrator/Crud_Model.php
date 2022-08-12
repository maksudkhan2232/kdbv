<?php 
class crud_model extends CI_Model{
	//echo $this->db->last_query();    
	public function getById($id,$fieldName,$table){
			$this->db->select("*");
			$this->db->from($table);
			$this->db->where($fieldName,$id);
			$query=$this->db->get();
			return $query->row_array();
	}
	public function Updatedata($id,$fieldName,$table,$data){
		$this->db->where($fieldName, $id);
		return $this->db->update($table, $data);
	}
	public function getDatafromtable($table){
		$this->db->order_by('id','desc');
  		$query = $this->db->get($table);
    	return $query->result_array();
	}
	public function getCount($table,$where){
		$this->db->where($where);
  		$query = $this->db->get($table);
    	return $query->num_rows();
	}
	public function InsertData($table,$data){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	public function getDatafromtablewhere($table,$where,$order_by='ASC'){
		
		$this->db->where($where);
		$this->db->order_by('id',$order_by);
  		$query = $this->db->get($table);
		return $query->result_array();
    	
	}
    public function getDatafromtablelike($table,$where,$order_by='ASC'){
        
        $this->db->like($where);
        $this->db->order_by('id',$order_by);
        $query = $this->db->get($table);
        return $query->result_array();
        
    }
	public function DeletData($id,$fieldName,$table){
		$this->db->where($fieldName,$id);
		return $this->db->delete($table);		
	}
	public function getDatafromtablewheresingle($table,$where){
		$this->db->where($where);
  		$query = $this->db->get($table);
    	return $query->row_array();
	}
	public function getDatafromtablewherecount($table,$where,$order_by='ASC'){
		
		$this->db->where($where);
		$this->db->order_by('id',$order_by);
  		$query = $this->db->get($table);
    	return $query->num_rows();
	}
	public function get_count($table) {
        return $this->db->count_all($table);
    }
    public function get_count_where($table,$where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        return count($query->result_array());
    }

    public function get_limit_data($limit, $start,$table) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);
        return $query->result_array();
    }
    public function get_limit_data_where($limit, $start,$table,$where) {
    	$this->db->where($where);
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);
        return $query->result_array();
    }
	public function is_email_available($email)  
    {  
		   $this->db->where('email', $email);  
		   $query = $this->db->get("subscription");  
		   if($query->num_rows() > 0)  
		   {  
				return true;  
		   }  
		   else  
		   {                  
				$data = array( 
					'email'	=>  strtolower($email)
				);
				$this->db->insert('subscription', $data);
				return false;  
		   }  
	}
	function get_info($id, $table = "", $field = "id", $whereCon = "", $all_field = '*', $join = false, $GroupBy = false, $OrderBy = false, $having = false, $db_config = 'db') {
        if (!empty($id) && !empty($table)) {
            $this->$db_config->select($all_field);
            if ($join) {
                if (isset($join['table'])) {
                    $this->$db_config->join($join['table'], $join['on'], $join['type']);
                } else {
                    foreach ($join as $j) {
                        $this->$db_config->join($j['table'], $j['on'], $j['type']);
                    }
                }
            }
            if ($OrderBy) {
                if (isset($OrderBy['field']))
                    $this->$db_config->order_by($OrderBy['field'], $OrderBy['order']);
                else
                    foreach ($OrderBy as $Order)
                        $this->$db_config->order_by($Order['field'], $Order['order']);
            }
            if (!empty($whereCon)) {
                $this->$db_config->where($whereCon);
            }
            if ($having)
                $this->$db_config->having($having);
            if ($GroupBy)
                $this->$db_config->group_by($GroupBy);
            if ($id && $field) {
                $this->$db_config->where($field, $id);
            }
            $query = $this->$db_config->get($table);
            // echo $this->$db_config->last_query(); die;
            if ($query->num_rows() > 0) {
                return $query->row();
            }
        }
        return NULL;
    }

    function GetAllInfo($id = '', $table = "", $field = "id", $whereCon = "", $all_field = '*', $count = false, $join = false, $GroupBy = false, $OrderBy = false, $limit = false, $offset = false, $having = false, $QueryGet = false) {
        // echo "id: ".$id." table: ".$table." field: ".$field;
        if (!empty($table)) {
            $this->db->select($all_field);
            if (!empty($whereCon))
                $this->db->where($whereCon);
            if ($join && count($join) > 0) {
                if (isset($join['table']))
                    $this->db->join($join['table'], $join['on'], $join['type']);
                else
                    foreach ($join as $j)
                        $this->db->join($j['table'], $j['on'], $j['type']);
            }
            if ($OrderBy) {
                if (isset($OrderBy['field']))
                    $this->db->order_by($OrderBy['field'], $OrderBy['order']);
                else
                    foreach ($OrderBy as $Order)
                        $this->db->order_by($Order['field'], $Order['order']);
            }
            if ($limit)
                $this->db->limit($limit);
            if ($offset)
                $this->db->offset($offset);
            if ($having)
                $this->db->having($having);
            if ($id != "")
                $this->db->where($field, $id);
            if ($GroupBy)
                $this->db->group_by($GroupBy);
            $query = $this->db->get($table);
            if ($count)
                if ($QueryGet)
                    return array($this->db->last_query(), $query->num_rows());
                else
                    return $query->num_rows();
            if ($query->num_rows() > 0) {
                if ($QueryGet) {
                    return array($this->db->last_query(), $query->result());
                } else {
                    return $query->result();
                }
            }
        }
        if ($QueryGet) {
            return array($this->db->last_query(), array());
        } else {
            return array();
        }
    }  
    function GetProductDetails($data=''){ 
        $this->db->select('p.*,c.name as collectionname,c.shortname as collectionshortname,sc.name as categoryname,pi.image_name');
        $this->db->from('product as p');
        $this->db->join('category as c','c.id=p.collectiontype','LEFT');
        $this->db->join('sub_category as sc','sc.id=p.categoryid','LEFT');
        $this->db->join('product_image as pi','pi.product_id=p.id','LEFT');
        if(isset($data['collectiontype']) and $data['collectiontype']!=''){
            $this->db->where('p.collectiontype',$data['collectiontype']);    
        }
        if(isset($data['categoryid']) and $data['categoryid']!=''){
            $this->db->where('p.categoryid',$data['categoryid']);    
        }
        if(isset($data['productcode']) and $data['productcode']!=''){
            $this->db->where('p.productcode',$data['productcode']);    
        }
        if(isset($data['name']) and $data['name']!=''){
            $this->db->like('p.name',$data['name']);    
        }
        if(isset($data['description']) and $data['description']!=''){
            $this->db->like('p.description',$data['description']);    
        }
        if(isset($data['gender']) and $data['gender']!=''){
            $this->db->like('p.gender',$data['gender']);    
        }
        if(isset($data['pricemin']) and $data['pricemin']!='' and $data['pricemax']!=''){
            if($data['pricemin']!='' and $data['pricemax']!=''  and $data['pricemax']!='0'){
                $this->db->where('price >=', $data['pricemin']);
                $this->db->where('price <=', $data['pricemax']);
            }
            if($data['pricemax']!=''  and $data['pricemax']=='0'){
                $this->db->where('price >=', $data['pricemin']);
            }
        }
        if(isset($data['highlight']) and $data['highlight']!=''){
            $this->db->like('p.highlight',$data['highlight']);    
        }
        if(isset($data['CustomWhere']) and $data['CustomWhere']!=''){
            $this->db->where($data['CustomWhere']);    
        }
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('p.status',$data['status']);    
        }else{
            $this->db->where('p.status','1');    
        }
        $this->db->where('p.isdelete','0');
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('p.id','DESC');
        }
        $this->db->group_by('p.id');        
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();    exit;
        return $query->result_array();
    } 
    function GetProductSingleDetails($data=''){ 
        $this->db->select('p.*,c.name as collectionname,c.shortname as collectionshortname,sc.name as categoryname,pi.image_name');
        $this->db->from('product as p');
        $this->db->join('category as c','c.id=p.collectiontype','LEFT');
        $this->db->join('sub_category as sc','sc.id=p.categoryid','LEFT');
        $this->db->join('product_image as pi','pi.product_id=p.id','LEFT');
        if(isset($data['id']) and $data['id']!=''){
            $this->db->where('p.id',$data['id']);    
        }
        if(isset($data['slug']) and $data['slug']!=''){
            $this->db->where('p.slug',$data['slug']);    
        }
        if(isset($data['collectiontype']) and $data['collectiontype']!=''){
            $this->db->where('p.collectiontype',$data['collectiontype']);    
        }
        if(isset($data['categoryid']) and $data['categoryid']!=''){
            $this->db->where('p.categoryid',$data['categoryid']);    
        }
        if(isset($data['productcode']) and $data['productcode']!=''){
            $this->db->where('p.productcode',$data['productcode']);    
        }
        if(isset($data['gender']) and $data['gender']!=''){
            $this->db->like('p.gender',$data['gender']);    
        }
        if(isset($data['highlight']) and $data['highlight']!=''){
            $this->db->like('p.highlight',$data['highlight']);    
        }
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('p.status',$data['status']);    
        }else{
            $this->db->where('p.status','1');    
        }
        $this->db->where('p.isdelete','0');
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('p.id','DESC');
        }
        $this->db->group_by('p.id');        
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();    
        return $query->row_array();
    } 	
    function GetCustomerDetails($data=''){ 
        //count(o.OrderID) as totalorder,count(fp.id) as totalfavorite
        $this->db->select('c.*');
        $this->db->from('billing_customer as c');
        $this->db->join('orders as o','o.CustomerID=c.id','LEFT');
        $this->db->join('customer_favorite_products as fp','fp.customer_id=c.id','LEFT');
        
        if(isset($data['id']) and $data['id']!=''){
            $this->db->where('c.id',$data['id']);    
        }
        if(isset($data['email']) and $data['email']!=''){
            $this->db->where('c.email',$data['email']);    
        }
        if(isset($data['state']) and $data['state']!=''){
            $this->db->where('c.state',$data['state']);    
        }
        if(isset($data['city']) and $data['city']!=''){
            $this->db->like('c.city',$data['city']);    
        }
        if(isset($data['name']) and $data['name']!=''){
            $this->db->like('c.name',$data['name']);    
        }
        if(isset($data['created_datetime']) and $data['created_datetime']!=''){
            $this->db->like('c.created_datetime',$data['created_datetime']);    
        }
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('c.status',$data['status']);    
        }else{
            $this->db->where('c.status','1');    
        }
        $this->db->where('c.isdelete','0');
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('c.id','DESC');
        }
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $this->db->group_by('c.id');        
        $query=$this->db->get();
        //echo $this->db->last_query();    exit;
        return $query->result_array();
    }
    function CheckAlreadyCustomer($email){
        $this->db->select('*');
        $this->db->from('billing_customer');
        $this->db->where('email', $email);
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->row_array();
    }
      
	function CheckAuth($email,$password){
        //check if password is working or not 
        $this->db->select('id');
        $this->db->from('billing_customer');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', '1');
        $query = $this->db->get();
        $ApExists = $query->row_array();

        if(count($ApExists) > 0 ){
            //check if user is active or not 
            $this->db->select('*');
            $this->db->from('billing_customer');
            $this->db->where('email', $email);
            $this->db->where('password', $password);
            $this->db->where('status', '1');
            $this->db->where('isdelete', '0');
            $query = $this->db->get();
            $AaExists = $query->row_array();
            if(count($AaExists) > 0){
                $AaExists["id"] = $AaExists['id'];
                $AaExists["name"] = $AaExists['name'];
                $AaExists["mobileno"] = $AaExists['mobileno'];
                $AaExists["password"] = $AaExists['password'];
                $AaExists['verifystatus'] ='done';
                $AaExists['logged_in'] = TRUE;
                return $AaExists;
            }else{
                $AaExists["msg"]="Sorry, Your Account has been deactive , contact to administrator";
                $AaExists['logged_in'] = FALSE;
                return $AaExists;
            }

        }else{
            //tell user that your password is wrong here.
            $AaExists["msg"]="Sorry, your password is wrong.";
            $AaExists['logged_in'] = FALSE;
            return $AaExists;
        }
    }
    function GetLastOrderNo(){ 
        $this->db->select('count(OrderID) as totalorder');
        $this->db->from('orders');
        $this->db->order_by('OrderID ','DESC');
        $this->db->limit(1);
        $query=$this->db->get();
        return $query->row_array();
    } 
    function GetOrderDetails($data=''){
        $this->db->select('*');
        $this->db->from('orders');
        if(isset($data['CustomerID']) and $data['CustomerID']!=''){
            $this->db->where('CustomerID',$data['CustomerID']);    
        }
        if(isset($data['OrderNo']) and $data['OrderNo']!=''){
            $this->db->where('OrderNo',$data['OrderNo']);    
        }
        if(isset($data['OrderDate']) and $data['OrderDate']!=''){
            $this->db->where('OrderDate',$data['OrderDate']);    
        }
        $this->db->where('status','1');
        $this->db->where('isdelete','0');
        $query = $this->db->get();        
        return $query->result_array();
    } 
    function GetFavoriteProductDetails($data=''){ 
        $this->db->select('f.*,p.name as pname,p.slug as pslug,p.productcode,pi.image_name');
        $this->db->from('customer_favorite_products as f');
        $this->db->join('product as p','f.products_id=p.id','LEFT');
        $this->db->join('product_image as pi','pi.product_id=f.products_id','LEFT');
        if(isset($data['customer_id']) and $data['customer_id']!=''){
            $this->db->where('f.customer_id',$data['customer_id']);    
        }
        if(isset($data['products_id']) and $data['products_id']!=''){
            $this->db->where('f.products_id',$data['products_id']);    
        }
        
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('f.status',$data['status']);    
        }else{
            $this->db->where('f.status','1');    
        }
        $this->db->where('f.isdelete','0');
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('f.id','DESC');
        }
        $this->db->group_by('f.products_id');        
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $query=$this->db->get();
        return $query->result_array();
    }
    function FavoriteProductDetails($data=''){ 
        $this->db->select('f.*,p.name as pname,p.slug as pslug,p.productcode,pi.image_name,count(f.customer_id) as totalcustomer');
        $this->db->from('customer_favorite_products as f');
        $this->db->join('product as p','f.products_id=p.id','LEFT');
        $this->db->join('product_image as pi','pi.product_id=f.products_id','LEFT');
        if(isset($data['customer_id']) and $data['customer_id']!=''){
            $this->db->where('f.customer_id',$data['customer_id']);    
        }
        if(isset($data['products_id']) and $data['products_id']!=''){
            $this->db->where('f.products_id',$data['products_id']);    
        }
        
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('f.status',$data['status']);    
        }else{
            $this->db->where('f.status','1');    
        }
        $this->db->where('f.isdelete','0');
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('f.id','DESC');
        }
        $this->db->group_by('f.products_id');        
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $query=$this->db->get();
        return $query->result_array();
    } 
    function GetProductCollectionDetails($data=''){ 
        $this->db->select('p.*,c.name as collectionname,c.shortname as collectionshortname,sc.name as categoryname,sc.slug as categoryslug,count(p.id) as totalrecord');
        $this->db->from('product as p');
        $this->db->join('category as c','c.id=p.collectiontype','LEFT');
        $this->db->join('sub_category as sc','sc.id=p.categoryid','LEFT');
        if(isset($data['collectiontype']) and $data['collectiontype']!=''){
            $this->db->where('p.collectiontype',$data['collectiontype']);    
        }
        if(isset($data['categoryid']) and $data['categoryid']!=''){
            $this->db->where('p.categoryid',$data['categoryid']);    
        }
        if(isset($data['productcode']) and $data['productcode']!=''){
            $this->db->where('p.productcode',$data['productcode']);    
        }
        if(isset($data['gender']) and $data['gender']!=''){
            $this->db->like('p.gender',$data['gender']);    
        }
        if(isset($data['pricemin']) and $data['pricemin']!='' and $data['pricemax']!=''){
            if($data['pricemin']!='' and $data['pricemax']!=''  and $data['pricemax']!='0'){
                $this->db->where('price >=', $data['pricemin']);
                $this->db->where('price <=', $data['pricemax']);
            }
            if($data['pricemax']!=''  and $data['pricemax']=='0'){
                $this->db->where('price >=', $data['pricemin']);
            }
        }
        if(isset($data['highlight']) and $data['highlight']!=''){
            $this->db->like('p.highlight',$data['highlight']);    
        }
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('p.status',$data['status']);    
        }else{
            $this->db->where('p.status','1');    
        }
        $this->db->where('p.isdelete','0');
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('p.id','DESC');
        }
        if(isset($data['GroupBy']) and $data['GroupBy']!=''){
            $this->db->group_by($data['GroupBy']);
        }else{
             $this->db->group_by('p.id','DESC');
        }
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $query=$this->db->get();
        return $query->result_array();
    } 
    function GetProductMinMaxPriceDetails(){ 
        $this->db->select('Min(price) as MinPrice,Max(price) as MaxPrice');
        $this->db->from('product');
        $this->db->limit(1);
        $query=$this->db->get();
        return $query->row_array();
    } 
    function GetProductForSearch($search){
 
        $response = array();
      
        $this->db->select('*');
        $this->db->from('product');
        if(isset($search)){
          // Select record
            $this->db->like('name', $search, 'both');
            //$this->db->where("name like '%".$data['search']."%' ");
            //$this->db->where("description like '%".$data['search']."%' ");
        }
        $records=$this->db->get()->result();
        //echo $this->db->last_query();exit;
        foreach($records as $row ){
            $response[] = array("id"=>$row->id,"name"=>$row->name);
        }
        return $response;
    }
    function GetSearchProductDetails($data=''){ 
        $this->db->select('p.*,c.name as collectionname,c.shortname as collectionshortname,sc.name as categoryname,pi.image_name');
        $this->db->from('product as p');
        $this->db->join('category as c','c.id=p.collectiontype','LEFT');
        $this->db->join('sub_category as sc','sc.id=p.categoryid','LEFT');
        $this->db->join('product_image as pi','pi.product_id=p.id','LEFT');
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('p.status',$data['status']);    
        }else{
            $this->db->where('p.status','1');    
        }
        $this->db->where('p.isdelete','0');
        if(isset($data['collectiontype']) and $data['collectiontype']!=''){
            $this->db->where('p.collectiontype',$data['collectiontype']);    
        }
        if(isset($data['categoryid']) and $data['categoryid']!=''){
            $this->db->where('p.categoryid',$data['categoryid']);    
        }
        
        if(isset($data['pricemin']) and $data['pricemin']!='' and $data['pricemax']!=''){
            if($data['pricemin']!='' and $data['pricemax']!=''  and $data['pricemax']!='0'){
                $this->db->where('price >=', $data['pricemin']);
                $this->db->where('price <=', $data['pricemax']);
            }
            if($data['pricemax']!=''  and $data['pricemax']=='0'){
                $this->db->where('price >=', $data['pricemin']);
            }
        }
        $this->db->group_start();
        if(isset($data['name']) and $data['name']!=''){
            $this->db->like('p.name',$data['name']);    
        }
        if(isset($data['productcode']) and $data['productcode']!=''){
            $this->db->or_like('p.productcode',$data['productcode']);    
        }
        
        if(isset($data['description']) and $data['description']!=''){
            $this->db->or_like('p.description',$data['description']);    
        }
        if(isset($data['gender']) and $data['gender']!=''){
            $this->db->or_like('p.gender',$data['gender']);    
        }
        if(isset($data['highlight']) and $data['highlight']!=''){
            $this->db->or_like('p.highlight',$data['highlight']);    
        }
        $this->db->group_end();        
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('p.id','DESC');
        }
        $this->db->group_by('p.id');        
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();    exit;
        return $query->result_array();
    } 
    function GetSearchProductOnPageDetails($data=''){ 
        $this->db->select('p.*,c.name as collectionname,c.shortname as collectionshortname,sc.name as categoryname,pi.image_name');
        $this->db->from('product as p');
        $this->db->join('category as c','c.id=p.collectiontype','LEFT');
        $this->db->join('sub_category as sc','sc.id=p.categoryid','LEFT');
        $this->db->join('product_image as pi','pi.product_id=p.id','LEFT');
        if(isset($data['status']) and $data['status']!=''){
            $this->db->where('p.status',$data['status']);    
        }else{
            $this->db->where('p.status','1');    
        }
        $this->db->where('p.isdelete','0');
        if(isset($data['collectiontype']) and $data['collectiontype']!=''){
            $this->db->where('p.collectiontype',$data['collectiontype']);    
        }
        if(isset($data['categoryid']) and $data['categoryid']!=''){
            $this->db->where('p.categoryid',$data['categoryid']);    
        }
        
        if(isset($data['pricemin']) and $data['pricemin']!='' and $data['pricemax']!=''){
            if($data['pricemin']!='' and $data['pricemax']!=''  and $data['pricemax']!='0'){
                $this->db->where('price >=', $data['pricemin']);
                $this->db->where('price <=', $data['pricemax']);
            }
            if($data['pricemax']!=''  and $data['pricemax']=='0'){
                $this->db->where('price >=', $data['pricemin']);
            }
        }
        $this->db->group_start();
        
        if(isset($data['collection']) and $data['collection']!=''){
            $excollection = explode(',',$data['collection']);
            if(!empty($excollection)){
                foreach ($excollection as $key => $value) {
                    if($value!=''){
                        $this->db->like('p.collectiontype',$value);    
                    }
                }
            }            
        }

        if(isset($data['name']) and $data['name']!=''){
            $this->db->like('p.name',$data['name']);    
        }
        if(isset($data['productcode']) and $data['productcode']!=''){
            $this->db->or_like('p.productcode',$data['productcode']);    
        }
        
        if(isset($data['description']) and $data['description']!=''){
            $this->db->or_like('p.description',$data['description']);    
        }
        if(isset($data['genders']) and $data['genders']!=''){
            $exgenders = explode(',',$data['genders']);
            if(!empty($exgenders)){
                foreach ($exgenders as $key => $value) {
                    if($value!=''){
                        $this->db->or_like('p.gender',$value);    
                    }
                }
            } 
        }
        if(isset($data['gender']) and $data['gender']!=''){

            $this->db->or_like('p.gender',$data['gender']);    
        }
        if(isset($data['highlight']) and $data['highlight']!=''){
            $this->db->or_like('p.highlight',$data['highlight']);    
        }
        $this->db->group_end();        
        if(isset($data['OrderBy']) and $data['OrderBy']!=''){
            $this->db->order_by($data['OrderBy'], $data['order']);
        }else{
             $this->db->order_by('p.id','DESC');
        }
        $this->db->group_by('p.id');        
        if(isset($data['Limit']) and $data['Limit']!=''){
            $this->db->limit($data['Limit']);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();    exit;
        return $query->result_array();
    } 
}
?>