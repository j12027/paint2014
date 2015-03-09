<?php
	$png = base64_decode($_POST['picture']);		//•Ï‚¦‚Ä‚Í‚¢‚¯‚È‚¢
	$secrecy = "err";
	$secrecy = $_POST['secrecy'];
	
	if($png){
		include 'MySQL.php';

		$imageName = date("YmdHis") . $_FILES['userfile']['name'] . $secrecy . ".png";

		$fileName = "img/" . $imageName;


		$up = new MySQL();
		$up->insert($imageName);
		$file = fopen($fileName, 'wb');
		fwrite($file, $png);
		fclose($file);
	}
?>
