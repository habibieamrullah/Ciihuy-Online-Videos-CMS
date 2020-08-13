<style>
	/* SCROLLBAR STYLING */
	/* width */
	::-webkit-scrollbar {
		width: 10px;
		height: 5px;
	}
	/* Track */
	::-webkit-scrollbar-track {
		background: white; 
	}
	/* Handle */
	::-webkit-scrollbar-thumb {
		background: <?php echo $maincolor ?>; 
	}
	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
		background: <?php echo $maincolor ?>; 
	}

	h1, h2, h3, h4, h5, p{
		margin: 0px;
		margin-bottom: 10px;
	}

	p{
		font-size: 18px;
		margin-bottom: 15px;
	}

	body{
		padding: 0px;
		margin: 0px;
		padding-top: 100px;
		font-family: 'Dosis', sans-serif;
		background-color: #4a4a4a;
		color: white;
		overflow-x: hidden;
		
		background: url(images/bgimage.jpg) no-repeat fixed center; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	
	input{
		box-sizing: border-box;
		width: 100%;
		padding: 20px;
		border-radius: 5px;
		margin-bottom: 20px;
		border: none;
	}
	
	.submitbutton{
		background-color: <?php echo $maincolor ?>; 
		color: black;
		cursor: pointer;
	}
	.submitbutton:hover{
		background-color: <?php echo $secondcolor ?>; 
	}
	
	.textlink{
		text-decoration: underline;
		color: inherit;
	}
	.textlink:hover{
		text-decoration: none;
		color: <?php echo $maincolor ?>; 
	}
	
	a{
		color: inherit;
		text-decoration: none;
	}
	
	label{
		display: block;
		margin-bottom: 10px;
	}
	
	.alert{
		background-color: green; 
		color: white;
		font-weight: bold;
		padding: 10px;
		border-radius: 5px;
		margin-bottom: 10px;
	}
	
	.categoryblock{
		display: inline-block;
		background-color: <?php echo $maincolor ?>; 
		border-radius: 10px;
		color: black;
		padding: 5px;
		font-weight: bold;
		margin: 5px;
	}
</style>