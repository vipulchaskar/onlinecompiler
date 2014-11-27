<?php

$code = $_POST['code'];

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	//Uncomment this to see the submitted code.
	//echo "Here is your code:<br><b>";
	//echo htmlspecialchars($code);

	$md5hash = md5($code);	//md5 hash of a submitted code is its unique identifier

	$filename = $_SERVER['DOCUMENT_ROOT'] . "/compiler/code/" . $md5hash . ".c";		
	$opfilename = $_SERVER['DOCUMENT_ROOT'] . "/compiler/code/" . $md5hash . ".o";

	//echo $filename . "<br>";			Display the generated source code and executable path
	//echo $opfilename . "<br>";

	$dir = $_SERVER['DOCUMENT_ROOT'] . '/compiler/code';
	if ( !file_exists($dir) )
	{											//Make the directory where all codes and output files will be kept, if not present
  		mkdir ($dir, 0777);
 	}

	$myfile = fopen($filename,"w") or die("Unable to open file!");
	fwrite($myfile,$code);						//Store the user submitted code into a file
	fclose($myfile);

	//echo "<br>File created.";
	chmod($filename,0777);

	$command = "gcc " . $filename . " -o " . $opfilename . " 2>&1";	//GCC command to compile the code
	$output = shell_exec($command);							//Execute the call to GCC
	
	if( !empty($output) )									//If error is found during compilation
	{
		$output = htmlspecialchars($output);
		echo "<h4>Looks like there is some error. <a href='index.html'>Go back</a> and fix it.</h4><hr>";
		echo "<pre>$output</pre>";
	}
	else
	{
		echo "Compilation finished. Redirecting you to result page...";
		header('Location: result.php?md5=' . $md5hash);			//Redirect the user to result page
	}
}

?>