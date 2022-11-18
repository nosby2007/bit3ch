<?php
	require_once('../model/visitor.class.php');
	require_once('../model/service.class.php');
	require_once('../functions/functions.php');
	use BIT\Base;
	use BIT\Service;
	session_start();
	$visitor = new Base\Visitor;
	$service = new Service\Service;
	$action = isset($_GET['do']) ? utf8_decode($_GET['do']) : utf8_decode($_POST['do']);
		
	switch ($action) {
		case 'load-page':
			$tab = [];
			$item = $_COOKIE['user']['item'] ?? intval($_GET['item']);
			$result = $_SESSION['devis'] ?? [];  
			if(!isset($_COOKIE['user']['verify_visit'])){
				$result[] = array(
					'verify_visit' => 0,
					'newsletter_status' => 1,
					'cookie_status' => 1,
					'item' => $item
				);
				if(isset($_COOKIE['user']['email'])){
					if($visitor->email_exist($_COOKIE['user']['email']))
						$result[0]['newsletter_status'] = 0;
				}

				if(isset($_COOKIE['user']['cookie_opt']))
					$result[0]['cookie_status'] = 0;
				
				setcookie('user[verify_visit]', 1);
			}else
				array_unshift($result, $_COOKIE['user']);

			$resp = ['status' => 200, 'response' => $result];
			break;

		case 'update-page':
			if(isset($_GET['item'])){
				$status = 1;
				$message = "done";
				$tab = [];
				$cpt = 0;
				$item = intval($_GET['item']);
				setcookie('user[item]', $_GET['item']);
				if(isset($_POST['nom'])){
					foreach ($_POST as $key => $value) {
						$_POST[$key] = html_entity_decode($value);
					}

					$_SESSION['devis'][0] = $_POST;
					$item++;
					setcookie('user[item]', $item);
				}elseif(isset($_POST['domain'])){
					foreach ($_POST as $key => $value) {
						if($key == 'budget')
							$_POST[$key] = number_format($value, 0, ',', '.');
						else
							$_POST[$key] = html_entity_decode($value);
					}

					$_SESSION['devis'][] = $_POST; 
					list($t0, $t1) = $_SESSION['devis'];
					$id = $visitor->save_devis($t0['nom'], $t0['prenom'], $t0['email'], $t0['tel'], $t0['ville'], $t0['url'], $t0['activity'], $t1['domain'], $t1['service'], $t1['date_debut'], $t1['date_fin'], $t1['budget'], $t1['details']);

					$subject = "Demande de devis";
					$tbody = '';
					foreach($t0 as $key => $value){
						$tbody .= '<tr><td><strong>'.$key.'</strong></td><td>'.$value.'</td></tr>';
					}

					$file = isset($_SESSION['file']) ? '../tmp/tac_'.$_SESSION['file']['key'].'.'.$_SESSION['file']['ext'] : null;
					send_mail($subject, data_format($_SESSION['devis']), $file);
					unset($_SESSION['devis']);
					$item = 0;
					setcookie('user[item]', $item);
					$message = 'Your estimate has been sent successfully';
				}

				if(isset($_SESSION['file'], $id)){
					if(!file_exists('../plan/'))
						mkdir('../plan/', 0755);
					$dir = opendir('../tmp/');
					while($name = readdir($dir)){
						if(strpos($name, $_SESSION['file']['key']) !== FALSE){
							rename('../tmp/'.$name, '../plan/bit_'.$id.'.'.$_SESSION['file']['ext']);
						}
					}
					closedir($dir);
				}
				
				$data =  $_SESSION['devis'] ?? null;
				$resp = ['status' => $status, 'item' => $item, 'response' => $data, 'message' => $message];
			}
			break;

		case 'upload-file':
					
			if(isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK){
				if(!file_exists('../tmp/'))
					mkdir('../tmp/', 0755);

				if(isset($_SESSION['file']))
					unlink('../tmp/tac_'.$_SESSION['file']['key'].'.'.$_SESSION['file']['ext']);
				else
					$_SESSION['file']['key'] = md5(uniqid(mt_rand()));

				$_SESSION['file']['ext'] = strtolower(pathinfo($_FILES['file']['name'])['extension']);
				$file_add = '../tmp/tac_'.$_SESSION['file']['key'].'.'.$_SESSION['file']['ext'];
				move_uploaded_file($_FILES['file']['tmp_name'], $file_add);
				$status = 200;
				$message = 'file uploaded';
			}else{
				$status = 404;
				$message = 'file not found';
			}
			$resp = ['status' => $status, 'message' => $message];
			break;

		case 'cookie-preference':
			setcookie('user[cookie_opt]', htmlentities($_GET['option']), time() + 365*24*3600); 
			$resp = ['status' => 200, 'message' => 'ok'];
			break;

		case 'newsletter':
			$email = utf8_decode(htmlentities($_POST['email']));
			if(!$visitor->email_exist($email)){
				$visitor->newsletter_subscribe($email);
				setcookie('user[email]', $email, time()+90*24*3600);
			}
				
			$resp = ['status' => 1, 'message' => 'email has been added to newsletter'];;
			break;

		case 'contact':
			foreach($_POST as $key => $value){
				$_POST[$key] = htmlentities($value);
				if(!in_array($key, ['test', 'details', 'nl']))
					setcookie("user[$key]", $_POST[$key], time() + 30*24*3600);
			}
			
			$visitor->send_message($_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['entreprise'], $_POST['details']);
			if(isset($_POST['nl']) && !$visitor->email_exist($_POST['email']))
				$visitor->newsletter_subscribe($_POST['email']);
			send_mail('Nouveau message', data_format($_POST));
			$resp = ['status' => 200, 'message' => 'Your message has been sent successfully'];
			break;

		case 'get-service':
			$domain = html_entity_decode($_GET['domain']);
			$status = 0;
			$msg = 'domain not found';
			if($service->domain_exist($domain)){
				$status = 200;
				$msg = 'Success';
				$response = $service->get_service($domain);
			}

			$resp = ['status' => $status, 'return' => $response, 'message' => $msg];
			break;

		case 'download-img':
			$dir = dir('../images/');
			while($nom = $dir->read()){
				if(strpos($nom, 'img-realise-'.$_GET['item']) === 0)
					$tab[] = $nom;
			}
			$dir->close();
			$resp = ['status' => 1, 'response' => sizeof($tab), 'message' => 'done'];
			break;	
		
	}
	echo json_encode($resp);
