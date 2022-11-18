<?php
	/**
	 * 
	 */
	namespace BIT\Service
	{
		class Service
		{
			protected $db;

			public function domain_exist($domain){
				$req = $this->db->prepare('SELECT * FROM service WHERE domain = ?');
				$req->execute(array($domain));
				return $req->rowCount();
			}

			public function get_service($domain){
				$req = $this->db->prepare('SELECT designation, tag FROM service WHERE domain = ?');
				$req->execute(array($domain));
				return $req->fetchAll(\PDO::FETCH_ASSOC);
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