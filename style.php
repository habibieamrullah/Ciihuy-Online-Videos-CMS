<style>
	/* SCROLLBAR STYLING */
	/* width */
	::-webkit-scrollbar {
		width: 6px;
		height: 3px;
	}
	/* Track */
	::-webkit-scrollbar-track {
		background: black; 
	}
	/* Handle */
	::-webkit-scrollbar-thumb {
		background: <?php echo $maincolor ?>; 
		border-radius: 20px;
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
	
	div{
		outline: none;
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
		font-size: 19px;
		margin-top: 30px;
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
		color: white;
		padding: 5px;
		font-weight: bold;
		margin: 5px;
		transition: background-color .5s;
	}
	
	.categoryblock:hover{
		background-color: white;
		color: <?php echo $maincolor ?>; 
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
		background-color: rgba(33, 33, 33, .75);		
		
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
		backdrop-filter: blur(10px);
	}
	
	.searchbutton{
		cursor: pointer;
	}
	
	.searchbutton:hover{
		color: <?php echo $maincolor ?>;
	}
	
	.moreoncat:hover{
		color: white;
	}
	
	.catseparator{
		border-bottom: 1px solid #424242; padding-bottom: 14px;
	}
	
	.catseparator:hover{
		border-bottom: 1px solid <?php echo $maincolor ?>;
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
		vertical-align: top;
		max-width: 200px;
	}
	
	.footercopyright{
		font-size: 11px;
		color: #c6c6c6;
		border-top: 1px solid black;
		text-align: center;
		background-color: black;
		padding: 50px;
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
	
	#firstthree{
		width: 100%;
		box-sizing: border-box;
	}
	
	.firstthreeblock{
		background-color: black;
		width: 100%;
		box-sizing: border-box;
	}
	
	.firstthreeblocktextholder{
		display: table; width: 100%; height: 100%; background-color: rgba(0,0,0,.5); padding: 40px; box-sizing: border-box;
		backdrop-filter: blur(3px);
	}
	
	.firstthreeblocktextholder:hover{
		backdrop-filter: blur(10px);
	}
	
	.morebutton{
		padding: 20px;
		border-radius: 10px;
		border: 1px solid white;
		transition: background-color .5s;
		font-weight: bold;
	}
	
	.morebutton:hover{
		background-color: <?php echo $maincolor ?>;
		transition: background-color .5s;
		color: black;
		border: 1px solid black;
	}
	
	.gridcontainer{
		overflow: auto;
		white-space: nowrap;
		margin-bottom: 50px;
	}
	
	.gridcontainerunscrollable{
		display: flex;
		flex-wrap: wrap;
		flex-direction: row;
		justify-content: center;
		
	}
	
	/* SCROLLBAR STYLING */
	/* width */
	.gridcontainer::-webkit-scrollbar {
		width: 10px;
		height: 10px;
	}
	/* Track */
	.gridcontainer::-webkit-scrollbar-track {
		background: black; 
	}
	/* Handle */
	.gridcontainer::-webkit-scrollbar-thumb {
		border-radius: 20px;
		background: <?php echo $maincolor ?>; 
	}
	/* Handle on hover */
	.gridcontainer::-webkit-scrollbar-thumb:hover {
		background: <?php echo $secondcolor ?>; 
	}

	
	.filmblock{
		display: inline-block;
		width: 200px;
		height: 256px;
		padding: 5px;
		padding-top: 10px;
		padding-bottom: 10px;
		margin: 10px;
		text-align: center;
		position: relative; 
		border-radius: 20px;
		cursor: pointer;
		border: 2px solid black;
		transition: border .5s;
	}
	
	.filmblock:hover{
		border: 2px solid <?php echo $maincolor ?>;
		transition: border .5s;
	}
	
	
	
	.hiddeninmobile{
		display: table-cell;
	}
	
	.posttableblock{
		display: table; width: 100%;
	}
	
	.postcontent{
		display: table-cell;
		padding-right: 14px;
	}
	
	.randomvids{
		display: table-cell;
		width: 350px;
		vertical-align: top;
	}
	
	#webvideo{
		width: 100%;
		height: 512px;
		background-color: black;
		outline: none;
		
		-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
		box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
		
	}
	
	.randomvidblock{
		display: table;
		width: 350px;
		padding: 14px;
		transition: background-color .5s;
		border-radius: 20px;
		box-sizing: border-box;
		
	}
	
	.randomvidblock:hover{
		background-color: black;
		transition: background-color .5s;
		
	}
	
	.lilimage{
		display: table-cell;
		width: 128px;
		border-radius: 14px;
	}
	
	.lildescr{
		display: table-cell;
	}
	
	.shorttext{
		display: block;
		width: 200px;
		padding-left: 14px;
		box-sizing: border-box;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
	}
	
	#searchui{
		display: none;
		position: fixed; 
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0,0,0,.5);
		backdrop-filter: blur(15px);
		-webkit-backdrop-filter: blur(15px);
	}
	
	.sinputcontainer{
		position: absolute;
		top: 50%;
		left: 50%;
		margin-top: -50px;
		margin-left: -150px;
		width: 300px;
		height: 100px;
		text-align: center;
	}
	
	#searchinput{
		border-radius: 25px;
		outline: none;
		border: 3px solid <?php echo $maincolor ?>;
	}
	
	.smallinmobile{
		display: table-cell;
		vertical-align: middle;
	}
	
	.w75{
		width: 75%;
		padding-right: 20px;
	}
	
	.w25{
		width: 25%;
	}
	
	.fbblur{
		position: absolute; bottom: 0; left: 0; right: 0; text-align: center; padding: 10px; border-bottom-left-radius: 19px; border-bottom-right-radius: 19px;
		background-color: rgba(0,0,0,.75);
		backdrop-filter: blur(15px);
		-webkit-backdrop-filter: blur(15px);
	}
	
	.fbblur:hover{
		background-color: rgba(0,0,0,.9);
	}
	
	/* mobile view */
	@media (max-width: 800px){
		.footerlink{
			display: block;
			padding: 20px;
			width: 100%;
		}
		
		.firstthreeblocktextholder{
			position: relative;
		}
		
		.smallinmobile{
			display: block;
			width: 100%;
			text-align: center;
			position: absolute;
			bottom: 0;
			left: 0;
			margin-bottom: 25px;
		}
		
		.farbottom{
			padding-bottom: 25px;
		}
		
		.morebutton{
			width: 100px;
			padding: 10px;
			background-color: <?php echo $maincolor ?>;
			border: 1px solid black;
			color: black;
			margin: 0 auto;
		}
		
		.flblock{
			display: block;
			box-sizing: border-box;
			width: 100%;
			max-width: 720px;
			text-align: center;
		}
		
		.hiddeninmobile{
			display: none;
		}
		
		.firstthreeblock{
			height: auto;
		}
		
		.posttableblock{
			display: block;
		}
		
		.postcontent{
			display: block;
			padding-right: 0px;
		}
		
		.randomvids{
			display: table;
			width: 100%;
			margin-top: 50px;
		}
		
		.randomvidblock{
			display: table;
			width: 100%;
			padding: 14px;
			transition: background-color .5s;
		}
		
		.randomvidblock:hover{
			background-color: black;
			transition: background-color .5s;
		}
		
		.lilimage{
			display: table-cell;
			height: 92px;
			width: 128px;
		}
		
		.lildescr{
			display: table-cell;
		}
		
		#webvideo{
			height: 256px;
		}
		
		.w75{
			padding-right: 0px;
		}
		
		.paddingonmobile{
			padding: 14px;
		}
		
		.strecthonmobile{
			margin-top: -20px;
			margin-left: -20px;
			margin-right: -20px;
		}
	}
	
</style>