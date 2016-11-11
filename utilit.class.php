<?php

class rbDatabase{
	
	private $host;
	private $login;
	private $password;
	private $dbname;

	public function __construct(){
		include dirname(__FILE__).'/config.php';
		$this->host = $rb_DBHost;
		$this->login = $rb_DBLogin;
		$this->password = $rb_DBPassword;
		$this->dbname = $rb_DBName;
	}

	/**
	 * Retourne un objet mysqli_connect si la connexion est établie, false sinon.
	 * Par défaut, utilise les paramètres de connexion du fichier config.php
	 * @param	string	$host		l'adresse du serveur de données
	 * @param	string 	$login		le login à utiliser pour se connecter
	 * @param	string 	$password	le mot de passe associé au login
	 * @return 	boolean|mysqli
	 */
	private function connect($host = NULL, $login = NULL, $password = NULL){
		$host = (is_null($host) ? $this->host : $host);
		$login = (is_null($login) ? $this->login : $login);
		$password = (is_null($password) ? $this->password : $password);
		
		$connect = new mysqli($host, $login, $password);
		if ($connect->connect_errno) {
		    echo 'Impossible d\'établir la connexion au serveur de données';
		    return false;
		}
		return $connect;
	}

	/**
	* Ferme la connexion à la base de données
	* @param mysqli_connect    $bdlink 	la connexion à fermer
	* @return boolean 					true|false si la connexion est fermée
	*/
	private function disconnect($dblink){
		return $dblink->close();
	}

	/**
	* Selectionne la base de donnée à utiliser sur la connexion pour effectuer les requetes.
	* Par défaut, utilise la base de données spécifiée dans le fichier config.php
	* @param mysqli_connect	  $dblink 	la connexion à utiliser
	* @param string 		  $dbname	la base de données à utiliser
	* @return boolean 					true|false si la selection est réussie
	*/
	private function useDatabase($dblink, $dbname){
		return mysqli_select_db($dblink, $dbname);
	}

	/**
	 * Execute le fichier sql passé en paramètre sur la connexion
	 * @param mysqli_connect $dblink	la connexion à utiliser
	 * @param string		 $filename	le fichier à executer
	 * @return boolean					true|false si l'execution est réussie
	 */
	private function execute($dblink, $filename){
		$extension = pathinfo($filename);
		// On vérifie que le fichier est bien un fichier sql
		if ($extension['extension'] === 'sql'){
			$open = fopen($filename, 'r');
			$queries = fread($open, filesize($filename));
			fclose($open);
			//On se connecte à la base de données
			if ($dblink = $this->connect()){
				//On execute les requetes
				if (mysqli_multi_query($dblink, $queries)) {
					do{
						if ($result = mysqli_store_result($dblink)){
							mysqli_free_result($result);
						}
						if (mysqli_more_results($dblink)){}
					}while (mysqli_next_result($dblink));
				}
				$this->disconnect($dblink);
				return true;
			}//if connect
			else{
				return false;
			}
		}//if sql
		else{
			return false;
		}
	}
	
	public function installMainDatabase(){
		$dblink = $this->connect();
		if ($dblink){
			if(is_bool($this->useDatabase($dblink, $this->getDBName()))){
				return $this->execute($dblink, 'install.sql');
			}
			else{
				echo "Erreur lors de la selection de la base de données";
				return false;
			}
		}
		else{
			echo "Erreur lors de la connexion au serveur de données";
			return false;
		}
		
	}
	
	public function setHost($host){
		$this->host = $host;
	}
	
	public function setLogin($login){
		$this->login = $login;
	}
	
	public function setPassword($password){
		$this->password = $password;
	}
	
	public function setDatabase($dbname){
		$this->dbname = $dbname;
	}
	
	/**
	 * Retourne l'host de la base de données utilisée
	 * @return	string
	 */
	public function getHost(){
		return $this->host;
	}
	
	/**
	 * Retourne le login de la base de données utilisée
	 * @return	string
	 */
	public function getLogin(){
		return $this->login;
	}
	
	/**
	 * Retourne le mot de passe de la base de données utilisée
	 * @return	string
	 */
	public function getPassword(){
		return $this->password;
	}
		
	/**
	 * Retourne le nom de la base de données utilisée
	 * @return	string
	 */
	public function getDBName(){
		return $this->dbname;
	}
}
?>