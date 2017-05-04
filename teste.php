<?php 
	
	
	$customers = file_get_contents('./coding-test-master/data/customers.json');
	$customers = json_decode($customers, true); 
	
	$categories = file_get_contents('./coding-test-master/data/categories.json');
	$categories = json_decode($categories, true); 
	
	// $products = file_get_contents('./coding-test-master/data/products.json');
	// $products = json_decode($products, true); 
	
	
	//echo '<pre>' . print_r($customers, true) . '</pre>';
	
	
	
?>



<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Discount Calculator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	
	<!-- Modal -->
	<div class="modal fade" id="list" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			
		</div>
	</div>
	
	
	<form id="discount_form">
		
		<header>
			<h2>Discount Calculator</h2>
		</header>
		
		<div class="div_costumers">
			<label class="desc" id="lbl_costumers" for="Field1">Customers</label>
			<select id="drp_costumer" class="field select medium" required> 
				<option disabled selected value="0"> -- select an option -- </option>
				
				<?php 
					foreach ($customers as $customer){
					?>
					<option value="<?= $customer['id'] ?>"><?= $customer['name']?></option>					
					<?php
					}	
				?>
				
			</select>
			
		</div>
		
		
		<div class="div_categories">
			<label id="lbl_categories" >Categories</label>
			<select id="drp_categories" class="field select medium"  required> 
				<option disabled selected value="0"> -- select an option -- </option>
				<?php 
					foreach ($categories as $category){
					?>
					<option value="<?= $category['id'] ?>"><?= $category['description']?></option>					
					<?php
					}	
				?>
			</select>
		</div>
		
		<div class="div_products">
			<label class="desc" id="lbl_products" >Products</label>
			<select id="drp_products" class="field select medium"  required> 
				
				
			</select>
		</div>
		
		<div class="prod_quantity">
			<label class="desc" id="lbl_quantity" for="Field1">Quantity:</label>
			<input id="qtd" type="number" class="quantity field text fn" value="1" size="8" tabindex="1" min="1" required>
		</div>
		
		
		<div id="submit">
			<button type="button" id="addProduct"  class="btn btn-info" type="btn" title="Add Product to list" >Add to list</button>
			<input id="saveForm" class="btn btn-success" name="saveForm" type="submit" value="Submit">
		</div>
		
	</form>
	<div id="product_list">
		
		
	</div>
</body>
</html>





<script>
	
	var order  = new Array();

	
	$( document ).ready(function() {
		console.log( "ready!" );
		
		var costumer;
		var category;
		var product;
		var quantity;
		var price;
	});
	
	/*Get Products Based on Categories*/	
	$("#drp_categories").change(function(e) {
		category = $("#drp_categories").val();
		getProductsFromCategory(category);
		
	});
	
	
	$("#addProduct").click(function(e) {	
		list = "<h4>Product List:</h4>";
		costumer = $("#drp_costumer").val();
		product   = $("#drp_products").val();
		price       = $('#drp_products :selected').attr('data-unit-price'); 
		category = $("#drp_categories").val();
		quantity  = $("#qtd").val();
		var item = 0;
		
		if( (quantity > 0) && (product != null) && ( costumer != null ) && ( category != null ) ){
				var found = false;
				$.each( order, function( index, value ){
					if(value['product-id'] == product){
						value['quantity'] = Number(value['quantity']) + Number(quantity);
						value['total'] = Number(value['unit-price']) * Number(value['quantity']);
						found = true;			 	
					}	
					
					item ++;	
					list += "<div id='list_item_"+item+"' class='product_item'>"+
									"<div class='product_id'>Product-id : "+value['product-id']+"</div>"+
									"<div class='product_quantity'>X "+value['quantity']+"</div>"+
									"<button class='removeItem btn btn-danger'  data-item='"+item+"' data-product='"+value['product-id']+"'>Remove</button>"+
								"</div>";
				});
				
				if(found == false){
					addToArray(product , quantity, price);
					item ++;
					list += "<div id='list_item_"+item+"' class='product_item'>"+
									"<div class='product_id'>Product-id : "+product+"</div>"+
									"<div class='product_quantity'>X "+quantity+"</div>"+
									"<button class='removeItem btn btn-danger'  data-item='"+item+"' data-product='"+product+"'>Remove</button>"+
								"</div>";
				}
				
				
				$("#product_list").html(list);
				$("#drp_costumer").prop("disabled", true);
				$("#drp_categories").val(0);
				$("#drp_products").val(0);
				$("#drp_categories").val(0);
				$("#qtd").val(1);
				
				
				
				if( quantity > 0){$("#lbl_quantity").removeClass("warning-missing"); }     
				if(product != null){$("#lbl_products").removeClass("warning-missing"); }    
				if( costumer != null) {$("#lbl_categories").removeClass("warning-missing"); }    
				if( costumer != null) {$("#lbl_costumers").removeClass("warning-missing"); }    
			
		}else{
			
				if (quantity <= 0){ 
					$("#lbl_quantity").addClass("warning-missing"); 
					}else{
					$("#lbl_quantity").removeClass("warning-missing"); 
				}     
				
				if (product == null){
					$("#lbl_products").addClass("warning-missing"); 
					}else{
					$("#lbl_products").removeClass("warning-missing"); 
				}     
				
				if (category == null) {
					$("#lbl_categories").addClass("warning-missing"); 
					}else{
					$("#lbl_categories").removeClass("warning-missing"); 
				}    
				
				if (costumer == null) {
					$("#lbl_costumers").addClass("warning-missing"); 
					}else{
					$("#lbl_costumers").removeClass("warning-missing"); 
				}   
		}
	});
	
	
	
	function addToArray(product, quantity, price) {
		keyValuePair = {};
		
		keyValuePair['product-id' ]= product;
		keyValuePair['quantity' ]= quantity;
		keyValuePair['unit-price' ]= price;
		keyValuePair['total' ] = (parseFloat(price))* (Number(quantity));
		
		order.push(keyValuePair);
		
	}
	
	$(document).on("click", ".removeItem",function() {
		var found = false;
		var thisproduct = $(this).data('product');
		
		$('#list_item_' + $(this).data('item') ).remove(); 
		$.each( order, function( index, value ){
			if(found === false){
				var arr_product = value['product-id'];
				//console.log(value['product-id']);
				if( (arr_product == thisproduct)  ){
					order.splice( $.inArray( index) ,1);
					found = true;
				}
			}
			
		});
	});
	
	
	function getProductsFromCategory(category)
	{
		
		var data = {
			Fn: "getProductsFromCategory",
			IdCategory: category
		};
		$.ajax({
			type: "POST",
			url: 'includes/middleware.php',
			data: data,
			success: function (output) {
				var options ="<option disabled selected value='0'> -- select an option -- </option>";
				var products = $.parseJSON(output);
				$.each( products, function( index, value ){
					options +="<option value='"+value['id']+"' data-unit-price='"+value['price']+"'>"+value['description']+"</option>";
					
					// console.log(value['price']) ;
				});
				//console.log(options);
				$("#drp_products").html(options);
			},
			error: function (output) {
				console.log(output);
				//error
			}
		});
	}
	
		$("#discount_form").submit(function(e) {
			e.preventDefault();
			$("#addProduct").click();
			var total = 0;
			var id;
			
			if(order != null){
				costumer = $("#drp_costumer").val();
				
				
				$.each( order, function( index, value ){
					total += Number(value['total']);
				});
			
				
			
				var data = {	Fn: "getOrderId" };
				$.ajax({
					type: 'POST',
					url: 'includes/middleware.php',
					data: data,
					dataType: 'JSON',
					success: function(response) {
					console.log(response);
						//id = response;
						var json_order = new Array();
						json_order["id"] = 1;
						json_order["customer-id"] = costumer;
						json_order["items"] = order;
						json_order["total"] = total;
						
						
						var json_order=  JSON.stringify(json_order );
							
						var data = {
							Fn: "submitForm",
							json_list: json_order
						};

						$.ajax({
							type: 'POST',
							url: 'includes/middleware.php',
							data: data,
							dataType: 'JSON',
							success: function(response) {
								
								console.log(response);
							},
							error: function(response) { 
								console.log(response);
							}
						});
							
					},
					error: function(response) { 
								console.log(response);
								
					}
				});
						
	

			}
		});
	
	
	
	
	
	
	</script>	