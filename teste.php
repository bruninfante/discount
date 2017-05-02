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
		  
		  <div>
			<label class="desc" id="title1" for="Field1">Client</label>
			<div>
			  <input id="Field1" name="Field1" type="text" class="field text fn" value="" size="8" tabindex="1">
			</div>
		  </div>
			
		  <div>
			<label class="desc" id="title3" for="Field3">
			  Email
			</label>
			<div>
			  <input id="Field3" name="Field3" type="email" spellcheck="false" value="" maxlength="255" tabindex="3"> 
		   </div>
		  </div>
			
		  <div>
			<label class="desc" id="title4" for="Field4">
			  Message
			</label>
		  
			<div>
			  <textarea id="Field4" name="Field4" spellcheck="true" rows="10" cols="50" tabindex="4"></textarea>
			</div>
		  </div>
			
		  <div>
			<fieldset>
			
			  <legend id="title5" class="desc">
				Select a Choice
			  </legend>
			  
			  <div>
				<input id="radioDefault_5" name="Field5" type="hidden" value="">
				<div>
					<input id="Field5_0" name="Field5" type="radio" value="First Choice" tabindex="5" checked="checked">
					<label class="choice" for="Field5_0">First Choice</label>
				</div>
				<div>
					<input id="Field5_1" name="Field5" type="radio" value="Second Choice" tabindex="6">
					<label class="choice" for="Field5_1">Second Choice</label>
				</div>
				<div>
					<input id="Field5_2" name="Field5" type="radio" value="Third Choice" tabindex="7">
					<label class="choice" for="Field5_2">Third Choice</label>
				</div>
			  </div>
			</fieldset>
		  </div>
		  
		  <div>
			<fieldset>
			  <legend id="title6" class="desc">
				Check All That Apply
			  </legend>
			  <div>
			  <div>
				<input id="Field6" name="Field6" type="checkbox" value="First Choice" tabindex="8">
				<label class="choice" for="Field6">First Choice</label>
			  </div>
			  <div>
				<input id="Field7" name="Field7" type="checkbox" value="Second Choice" tabindex="9">
				<label class="choice" for="Field7">Second Choice</label>
			  </div>
			  <div>
				<input id="Field8" name="Field8" type="checkbox" value="Third Choice" tabindex="10">
				<label class="choice" for="Field8">Third Choice</label>
			  </span>
			  </div>
			</fieldset>
		  </div>
		  
		  <div>
			<label class="desc" id="title106" for="Field106">
				Select a Choice
			</label>
			<div>
			<select id="Field106" name="Field106" class="field select medium" tabindex="11"> 
			  <option value="First Choice">First Choice</option>
			  <option value="Second Choice">Second Choice</option>
			  <option value="Third Choice">Third Choice</option>
			</select>
			</div>
		  </div>
		  
		  <div>
				<div>
				<input id="saveForm" name="saveForm" type="submit" value="Submit">
			</div>
			</div>
		  
		</form>
	</body>
</html>