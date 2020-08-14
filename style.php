<style>
	/* SCROLLBAR STYLING */
	/* width */
	::-webkit-scrollbar {
		width: 5px;
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
		background: <?php echo $secondcolor ?>; 
	}

	h1, h2, h3, h4, h5, p{
		margin: 0px;
		margin-bottom: 10px;
	}

	p{
		margin-bottom: 15px;
	}

	body{
		padding: 0px;
		margin: 0px;
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
	
	
	input, textarea{
		box-sizing: border-box;
		width: 100%;
		padding: 20px;
		border-radius: 5px;
		margin-bottom: 20px;
		border: none;
	}
	
	select{
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
	
	.fileinput{
		cursor: pointer;
		border: 3px dashed <?php echo $secondcolor ?>; 
	}
	
	.fileinput:hover{
		border: 3px solid <?php echo $secondcolor ?>; 
	}
	
	.textlink{
		text-decoration: underline;
		color: <?php echo $maincolor ?>; 
	}
	.textlink:hover{
		text-decoration: none;
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
	
	table {
		border-collapse: collapse;
		width: 100%;
	}

	table, th, td {
		border: 1px solid gray;
		font-size: 14px;
	}

	th{
		text-align: center;
		font-weight: bold;
		background-color: <?php echo $maincolor ?>;
		color: black;
	}

	th, td{
		padding: 10px;
	}

	tr:hover{
		background-color: black;
		color: <?php echo $maincolor ?>;
	}
	
	.inlinecenterblock{
		display: inline-block;
		vertical-align: middle;
		padding: 20px;
	}
	
	#header{
		background-color: #212121;		
		border-bottom: 1px solid #424242;
		position: -webkit-sticky; /* Safari */
		position: sticky;
		top: 0;
		font-size: 25px;
		/*border-bottom: 1px solid <?php echo $maincolor ?>;*/
		-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
		box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
		
		z-index: 100;
	}
	
	.section{
		padding: 20px;
	}
	
	.footerlink{
		background-color: #212121;
		display: table; 
		width: 100%;
		font-size: 13px;
		padding-left: 100px;
		padding-right: 100px;
		box-sizing: border-box;
	}
	
	.flblock{
		display: table-cell;
		text-align: left;
		padding: 20px;
		vertical-align: top;
		max-width: 200px;
	}
	
	.footercopyright{
		font-size: 11px;
		color: #c6c6c6;
		background-color: #424242;
		text-align: center;
	}
	
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}
	
	li{
		width: 100%;
		display: inline-block;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		transition: color .5s;
	}
	
	li:hover{
		color: <?php echo $maincolor ?>;
		transition: color .5s;
	}
	
	.firstthreeblock{
		margin: 30px;
		background-color: black;
		border-radius: 20px;
		border: 1px solid black;
		transition: border .5s;
	}
	
	.firstthreeblock:hover{
		border: 1px solid <?php echo $maincolor ?>;
		transition: border .5s;
	}
	
	.morebutton{
		padding: 20px;
		border-radius: 10px;
		border: 1px solid white;
		transition: background-color .5s;
	}
	
	.morebutton:hover{
		background-color: <?php echo $maincolor ?>;
		transition: background-color .5s;
		color: black;
		border: 1px solid black;
	}
	
	.gridcontainer{
		display: flex;
		flex-wrap: wrap;
		flex-direction: row;
		justify-content: center;
		
	}
	.filmblock{
		width: 150px;
		height: 200px;
		padding: 5px;
		padding-top: 10px;
		padding-bottom: 10px;
		margin: 10px;
		text-align: center;
		position: relative; 
		border-radius: 20px;
		cursor: pointer;
		border: 1px solid black;
		transition: border .5s;
	}
	
	.filmblock:hover{
		border: 1px solid <?php echo $maincolor ?>;
		transition: border .5s;
	}
	
</style>