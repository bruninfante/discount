<?php
	
	include('./functions.class.php');
	$functions = Functions::singleton();


	if ( isset($_POST['Fn']) ) {
		$actionFn = filter_input(INPUT_POST, 'Fn', FILTER_SANITIZE_STRING);
		$idCategory = filter_input(INPUT_POST, 'IdCategory', FILTER_SANITIZE_STRING);

		// $file = 'people.txt';
		// file_put_contents($file, $idCategory);
		

		
		if ( isset($actionFn) ){
			switch ($actionFn) {
						case "getProductsFromCategory":
						//echo "entrou";
							$return = $functions->getProductsFromCategory($idCategory);
							echo $return;
							break;
						case "submitForm":
							$return = $functions->submitForm($_POST['json_list']);
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