<?php 
	

	
	
?>



<!DOCTYPE html>
<head>
	<link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
	<meta charset="UTF-8">
	<title>Discount Calculator</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="js/jquery.min.js"></script>
</head>
	<body>
		<form action="#">

		  <header>
			<h2>Discount Calculator</h2>
		  </header>
		  
		  <div class="div_costumer">
				<label class="desc" id="title1" for="Field1">Client</label>
				<select id="category" class="field select medium" required> 
					<option value="First Choice">Filipe</option>
					<option value="Second Choice">Luis</option>
					<option value="Third Choice">André</option>
				</select>

		  </div>
			
		
		  <div class="div_category">
				<label class="desc" id="title1" for="Field1">Client</label>
				<select id="category" class="field select medium" required> 
					<option value="First Choice">First Choice</option>
					<option value="Second Choice">Second Choice</option>
					<option value="Third Choice">Third Choice</option>
				</select>
			</div>

 	
			<div class="div_product">
				<label class="desc" id="title1" for="Field1">Client</label>
				<select id="product" class="field select medium"  required> 
					<option value="First Choice">First Choice</option>
					<option value="Second Choice">Second Choice</option>
					<option value="Third Choice">Third Choice</option>
				</select>
			</div>

			<div class="prod_quantity">
			<label class="desc" id="title1" for="Field1">Quantity:</label>
			  <input type="number" class="quantity field text fn" value="" size="8" tabindex="1" min="1" required>
		  </div>

				<div id="submit">
				<input id="saveForm" name="saveForm" type="submit" value="Submit">
			</div>

		  
		</form>
	</body>
</html>