<?php
class Functions{
	private static $instance;
	
	public function __construct() {
       
    }
	
	function getProductsFromCategory($idCategory){
	
		$products = file_get_contents('../coding-test-master/data/products.json');
		$products = json_decode($products, true); 
		$return = array();
		$i = 0;
		
		foreach($products as $product){

			if($product['category'] == $idCategory){
				$return[$i]['id'] = $product['id'];
				$return[$i]['description'] = $product['description'];
				$return[$i]['price'] = $product['price'];
				$i++;	
			}
			
		}
		return json_encode($return);
	}
	
	function submitForm($idCustomer ,$json_list){
	
		$products = file_get_contents('../coding-test-master/data/customers.json');
		$products = json_decode($customers, true); 
		
		$products = file_get_contents('../coding-test-master/data/products.json');
		$products = json_decode($products, true); 
		
		
		
		
		foreach($customers as $customer){

			if($customer['id'] == $idCustomer){
				$revenue = $customer['revenue'];	
			}
		}
		
		
		
		
		foreach($json_list as $item){
			
		}


	}
	
	
	function getOrderId(){
		$file = '../config/id.txt';
		$id = file_get_contents($file);
		$new_id = $id +1;
		file_put_contents($file , $new_id);
		return json_encode($id);
	}
	
// The singleton method
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $playlists = __CLASS__;
            self::$instance = new $playlists;
        }

       return self::$instance;
    }
  
    // Prevent users to clone the instance
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
	
	
	
}
?>