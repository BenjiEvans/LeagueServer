<?php   session_start(); 

?>
<html>
	<head>
		<title> Welcome! </title>
	</head>
	<body style='text-align:center;'>
		<h1> Welcome <?php echo $_SESSION["name"]; ?> </h1>

     		<h1> Here are the books at your disposal </h1>
		<?php
			$dom = simplexml_load_file("../../data/data.xml");
			
			foreach($dom->xpath("/books/book") as $book)
			{
			     	echo "<li>";
				echo $book->title." by ".$book->author;
				echo "</li>";
				
			}



		?>		
	</body>
</html>
