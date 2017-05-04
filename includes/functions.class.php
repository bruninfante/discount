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
	
	function submitForm($json_list){


		//return $json_list;

		$customers = file_get_contents('../coding-test-master/data/customers.json');
		$customers = json_decode($customers, true); 

		$products = file_get_contents('../coding-test-master/data/products.json');
		$products = json_decode($products, true); 


		

		$json_list = json_decode($json_list, true);
		
		file_put_contents("../coding-test-master/example-orders/order".$json_list['id'].".json" , json_encode($json_list, JSON_PRETTY_PRINT)); 
		//print_r( $json_list );

		foreach($customers as $customer){
			if( $customer['id'] == $json_list['customer-id'] ){
				$revenue = $customer['revenue'];				
			}
		
		}
		print_r( $json_list['items'] );
		foreach($json_list['items'] as $item){
			print_r( $item );
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