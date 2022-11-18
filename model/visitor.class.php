<?php
	/**
	 * 
	 */
	namespace BIT\Base
	{
		class Visitor
		{
			protected $db;

			public function email_exist($email){
				$req = $this->db->prepare('SELECT * FROM newsletters WHERE email = ?');
				$req->execute(array($email));
				return $req->rowCount();
			}

			public function newsletter_subscribe($email){
				$req = $this->db->prepare('INSERT INTO newsletters (email, date_sc) VALUES(?, NOW())');
				$req->execute(array($email));
				$req->closeCursor();
			}

			public function send_message($name, $email, $tel, $enterprise, $message){
				$req = $this->db->prepare('INSERT INTO contact (nom, entreprise, tel, email, message, date_pub) VALUES(:name, :entr, :tel, :email, :message, NOW())');
				$req->execute(array(
					'name' => $name,
					'entr' => $enterprise,
					'tel' => $tel,
					'email' => $email,
					'message' => $message
				));
				$req->closeCursor();
			}

			public function save_devis($name, $prename, $email, $tel, $ville, $url, $post, $domain, $service, $date_deb, $date_fin, $budget, $description){
				$this->db->beginTransaction();
				try{
					$req = $this->db->prepare('INSERT INTO user_devis (nom, prenom, email, tel, ville, url, activity) VALUES(:name, :prename, :email, :tel, :ville, :url, :post)');
					$req->execute(array(
						'name' => $name,
						'prename' => $prename,
						'email' => $email,
						'tel' => $tel,
						'ville' => $ville,
						'url' => $url,
						'post' => $post
					));
					$id = $this->db->lastInsertId();

					$req = $this->db->prepare('INSERT INTO devis(id_user, domaine, service, date_deb, date_fin, budget, description, date_pub) VALUES(:id, :domain, :service, :date_fin, :date_deb, :budget, :description, NOW())');
					$req->execute(array(
						'id' => $id,
						'domain' => $domain,
						'service' => $service,
						'date_deb' => $date_deb,
						'date_fin' => $date_fin,
						'budget' => $budget,
						'description' => $description
					));

					$this->db->commit();
					$req->closeCursor();
					return $id;
					
				}catch(Exception $e){
					$this->db->rollBack();
					return $e->getMessage();
				}
			}

			public function setcounter($nbre, $path){
				$nbre_visit = intval($this->daily_page_visit($path)['nbre_visit']);
				$req = $this->db->prepare('UPDATE counter_visit SET nbre_visit = ? WHERE page_dir = ? AND date_reg = CURDATE()');
				$req->execute(array($nbre_visit++, $path));
				return $req;
			} 

			public function init_visit($path) {
				$req = $this->db->prepare('INSERT INTO counter_visit(page_dir, nbre_visit, date_reg) VALUES(:dir, :nbre, CURDATE())');
				$req->execute(array('dir' => $path, 'nbre_visit' => 1));
				return $req;
			}

			public function daily_visit(){
				$req = $this->db->query('SELECT SUM(nbre_visit) d_visit FROM counter_visit WHERE date_reg = CURDATE()');
				return $req->fetch(\PDO::FETCH_ASSOC);
			}

			public function daily_page_visit($path){
				$req = $this->db->prepare('SELECT nbre_visit FROM counter_visit WHERE page_dir = ? AND date_reg = CURDATE()');
				$req->execute(array($path));
				return $req->fetch();
			}

			public function yesterday_visit(){
				$req = $this->db->query('SELECT SUM(nbre_visit) y_visit FROM counter_visit WHERE date_reg = DATE_SUB(CURDATE(), INTERVAL 1 DAY)');
				return $req->fetch(\PDO::FETCH_ASSOC);
			}

			public function weekly_visit(){
				$req = $this->db->query('SELECT SUM(nbre_visit) w_visit FROM counter_visit WHERE date_reg BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()');
				return $req->fetch(\PDO::FETCH_ASSOC);
			}

			public function page_visit($path){
				$req = $this->db->prepare('SELECT SUM(nbre_visit) p_visit FROM counter_visit WHERE page_dir = ?');
				$req->execute(array($path));
				return $req->fetch(\PDO::FETCH_ASSOC);
			}

			public function sum_visit(){
				$req = $this->db->query('SELECT SUM(nbre_visit) AS s_visit FROM counter_visit');
				return $req->fetch(\PDO::FETCH_ASSOC);
			}

			public function __tostring(){
				return 'Welcome '.__CLASS__;
			}
			
			public function __construct()
			{
				try {
					$this->db = new \PDO('mysql:host=localhost;dbname=u826705015_bit_db;charset=utf8', 'u826705015_admin', 'bit3chDbadm!n');
					$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
					$this->db->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
				} catch (PDOException $e) {
					die('Connexion error: '.$e->getMessage());
				}
			}

			public function __destruct(){
				return null;
			}
		}
	}