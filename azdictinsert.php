<?php
	$con = mysql_connect("localhost","root","masterkey");
	if (!$con)
  	{
		die('Could not connect: ' . mysql_error());
	}
	$db_selected = mysql_select_db("dictionaryStudyTool", $con);

	$paraended=true;
	$f = fopen ("azdictionary.txt", "r");
	$line1=true;
	
	while (! feof ($f)) 
	{
		$line= fgets ($f);

		if (trim($line)=="")
		{
			$line1=true;
			$englishWord=trim($englishWord);
			$definition=trim($definition);
			$sql="INSERT INTO entries (word, wordtype, definition) VALUES ('".mysql_real_escape_string($englishWord)."', '$mid', '".mysql_real_escape_string($definition)."')";
			if (!mysql_query($sql,$con)) 
			{
				die('Error: ' . mysql_error($con));
			}

		}
		else 
		if ($line1==true)
		{
			$lineArray=explode(" ",$line, 3);
			$lineArray=split('[()]', $line, 3); 
			$englishWord=$lineArray[0];
			$mid=$lineArray[1];
			$definition=$lineArray[2]; 	 	
			$line1=false;
		}
		else 
		{
			$definition.=$line;
		}
	
      		if ($line===FALSE) print ("End of File\n");
	}
  	fclose ($f);
	mysql_close($con);
	
?>
