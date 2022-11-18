<?php
	function send_mail($subject, $message, $file = null){
		$header = "From: contact@bit3ch.com\n";
		$header .= "Cc: ch3rifmbah@gmail.com\n";
		$header .= "X-priority: 1\n";
		$header .= "MIME-Version: 1.0\n";

		if(!is_null($file)){
			$delim = md5(uniqid(rand()));
			$header .= "Content-type: multipart/mixed; boundary=\"$delim\"\n";
			$header .= '\n';
			$msg = "--$delim\n";
			$msg .= "Content-type: text/html\n";
			$msg .= "Content-transfer-encoding:8bit\n";
			$msg .= "\n";
			$msg .= $message."\n";
			$msg .= "\n";
			$msg .= "--$delim\n";
			$file_ext = strtolower(substr($file, strrpos($file, '.') + 1));
			$attache = chunk_split(base64_encode(file_get_contents($file)));
			if($file_ext === 'pdf')
				$msg .= "Content-type: application/octet-stream; name=\"$file\"\n";
			else
				$msg .= "Content-type: image/$file_ext; name=\"$file\"\n";

			$msg .= "Content-transfer-encoding: base64\n";
			$msg .= "Content-disposition: attachment; filename=\"$file\"\n";
			$msg .= "\n";
			$msg .= "$attache\n";
			$msg .= "\n";
			$msg .= "--$delim--";

		}else{
			$header .= "Content-type: text/html; charset=\"utf-8\"";
			$msg = $message;
		}
		$receiver_addr = 'bit3chnology@gmail.com,nosby2007@gmail.com';

		mail($receiver_addr, $subject, $msg, $header);
	}

	function data_format($data){
		$content = '';
		foreach($data as $key => $value){
			if(is_array($value)){
				foreach($value as $key => $val){
					$content .= '<tr><td><strong>'.$key.'</strong></td><td>'.$val.'</td></tr>';
				}
				$title = 'Demande de devis';
				$desc = 'Tableau récapitulatif des informations relatives au devis';
			}else{
				$content .= '<tr><td><strong>'.$key.'</strong></td><td>'.$value.'</td></tr>';
				$title = 'Contact';
				$desc = 'Cette personne vous a contacté';
			}
		}
		return '
			<html>
				<head><title>'.$title.'</title></head>
				<body>
					<div role="heading">
						<a href="https://www.bit3ch.com" target="_blank" title="Aller sur le site">
							<img src="https://www.bit3ch.com/assets/images/logo-bit.png" style="width: 90px; height: 60px;" alt="logo">
						</a>
					</div>
					<table>
						<caption>'.$desc.'</caption>
						<th>
							<td>Designation</td>
							<td>Attributs</td>
						</th>'.$content.'
					</table>
				</body>
			</html>
		';
	}