<html>

<head>
	<title>Result page</title>
	<style>
		#output {
			background-color: lightgray;
			font-size: 15px;
		};
	</style>
</head>

<body>

<?php

$cid = $_GET["md5"];

$filename = $_SERVER['DOCUMENT_ROOT'] . "/compiler/code/" . $cid . ".c";			//Generate the paths for source code and executable
$opfilename = $_SERVER['DOCUMENT_ROOT'] . "/compiler/code/" . $cid . ".o";

echo "displaying output for code : " . $cid . "<br><br>";

$output = shell_exec($opfilename);										//Execute and display the output
echo "<div id='output'><pre>$output</pre></div>";

?>

<hr>

<h3>Here's the original code : </h3>
<form method="POST" action="process.php">
	
	<textarea rows=25 cols=100 name="code">
<?php 																	//Open the source code file and display its contents

			$myfile = fopen($filename,"r") or die("Unable to open file!");

			$code = fread($myfile,filesize($filename));
			echo $code;

			fclose($myfile);
		?>
	</textarea>

	<br>

	<input type="submit" value="Compile again">
</form>

</body>
</html>