<?php
class Functions{
	private static $instance;
	
		CONST	ORDER_FOLDER = "../coding-test-master/example-orders/";
		CONST	CUSTOMERS_FILE = '../coding-test-master/data/customers.json';
		CONST	PRODUCTS_FILE = '../coding-test-master/data/products.json';
		
	public function __construct() {
       
    }
	
	function getProductsFromCategory($idCategory){
	
		$products = file_get_contents(self::PRODUCTS_FILE);
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
		$message = "";
		$count = 0;
		$total = 0;


		$customers = file_get_contents(self::CUSTOMERS_FILE);
		$customers = json_decode($customers, true); 

		$products = file_get_contents(self::PRODUCTS_FILE);
		$products = json_decode($products, true); 


		$json_list = json_decode($json_list, true);
		
		
		file_put_contents(self::ORDER_FOLDER."order".$json_list['id'].".json" , json_encode($json_list, JSON_PRETTY_PRINT)); 
		
		
		if(    ( !isset($json_list['id']) )  ||   ( !isset($json_list['customer-id']) )  ||  ( !isset($json_list['items']) )   || ( !isset($json_list['total']) )  ){
					return "Error!!! Json don't have the necessary fields";
		}

		foreach($customers as $customer){
			if( $customer['id'] == $json_list['customer-id'] ){
				$revenue = $customer['revenue'];				
			}
		
		}
		
		$json_list_new = array();
		
		foreach($json_list['items'] as $item){
				if(    ( !isset($item['product-id']) )  ||   ( !isset($item['quantity']) )  || ( !isset($item['unit-price']) )  ){
					return "Error!!! Json don't have the necessary fields";
				}
			foreach($products as $product){
				if( $item['product-id'] ==  $product['id'] ){
					$item['unit-price']  = $product['price'];
					if( ($product['category']  == 2) &&  ($item['quantity']  >= 5 ) ){
						$item['quantity']  = $item['quantity'] +1;
						$message .=  "<p>You got an extra item on your product ".$item['product-id'] . " quantity: ". $item['quantity'] ."</p>";							
					}else{
						if($product['category']  == 1){
							$count++;
								if(isset($cheapest)){
									if($cheapest > $product['price']) {
										$cheapest = $product['price'];
										$cheapest_product = $product['id'];
										$message_20 =  "<p>You got a discount of 20% on your ".$item['product-id'] . " quantity: ". $item['quantity'] ."</p>";
									}
								}else{
									$cheapest = $product['price'];
									$cheapest_product = $product['id'];
									$message_20 =  "<p>You got a discount of 20% on your ".$item['product-id'] . " quantity: ". $item['quantity'] ."</p>";
								}
						}
					}
				}
			}
			$json_list_new[] = $item;
		}
		$json_list['items']  = $json_list_new;
		
		$json_list_new = array();
		foreach($json_list['items'] as $item){
		
			if($count > 1){
				if( $item['product-id'] ==  $cheapest_product){
					$item['unit-price']  = $item['unit-price'] * 0.8;
					$message .= $message_20;
				}
			}
			$item['total'] = $item['unit-price'] * $item['quantity'];
			$total = $total +  $item['total'] ;
			$json_list_new[] = $item;
			
		}
		
		//file_put_contents($order_folder."teste.json" , json_encode($json_list_new) ,  FILE_APPEND);
		$json_list['items']  = $json_list_new;
		$json_list['total'] = $total;
		
		if($revenue >= 1000 ){
		
			$oldtotal = $json_list['total']; 
			$json_list['total'] = $json_list['total'] * 0.9;
			$message .=  "<p>You got a bonus discount of 10% on your order.   Old PRICE: ".$oldtotal. "€  ----> NEW PRICE: ".$json_list['total']. "€.</p>";
		}
		
		$message .=  "<p>Your total is: ".$json_list['total']. ".€</p>";
		$result['json'] = $json_list;
		$result['message'] = $message;
		
		file_put_contents(self::ORDER_FOLDER."final_order".$json_list['id'].".json" , json_encode($json_list, JSON_PRETTY_PRINT)); 
		
		echo json_encode($result);
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
            $functions = __CLASS__;
            self::$instance = new $functions;
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