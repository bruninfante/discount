<?php
	
	include_once('./functions.class.php');
	$functions = Functions::singleton();


	if ( isset($_POST['Fn']) ) {
		$actionFn = filter_input(INPUT_POST, 'Fn', FILTER_SANITIZE_STRING);
		
		
		if ( isset($actionFn) ){
			switch ($actionFn) {
						case "getProductsFromCategory":
							$idCategory = filter_input(INPUT_POST, 'IdCategory', FILTER_SANITIZE_STRING);
							$return = $functions->getProductsFromCategory($idCategory);
							echo $return;
							break;
							
						case "getOrderId":
							$return = $functions->getOrderId();
							echo $return;
							break;	
							
						case "submitForm":
							$json_list = filter_input(INPUT_POST, 'json_list');
							//$idCostumer = filter_input(INPUT_POST, 'IdCustomer', FILTER_SANITIZE_STRING);
							$return = $functions->submitForm($json_list);
							echo $return;
							break;	
			}
		}else{
			echo "Error Function was not declared";
		}
		
	}else{
		echo "Error Function was not declared";
	}		
	
?>