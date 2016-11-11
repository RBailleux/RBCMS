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
	 * Retourne un objet mysqli_connect si la connexion est �tablie, false sinon.
	 * Par d�faut, utilise les param�tres de connexion du fichier config.php
	 * @param	string	$host		l'adresse du serveur de donn�es
	 * @param	string 	$login		le login � utiliser pour se connecter
	 * @param	string 	$password	le mot de passe associ� au login
	 * @return 	boolean|mysqli
	 */
	private function connect($host = NULL, $login = NULL, $password = NULL){
		$host = (is_null($host) ? $this->host : $host);
		$login = (is_null($login) ? $this->login : $login);
		$password = (is_null($password) ? $this->password : $password);
		
		$connect = new mysqli($host, $login, $password);
		if ($connect->connect_errno) {
		    echo 'Impossible d\'�tablir la connexion au serveur de donn�es';
		    return false;
		}
		return $connect;
	}

	/**
	* Ferme la connexion � la base de donn�es
	* @param mysqli_connect    $bdlink 	la connexion � fermer
	* @return boolean 					true|false si la connexion est ferm�e
	*/
	private function disconnect($dblink){
		return $dblink->close();
	}

	/**
	* Selectionne la base de donn�e � utiliser sur la connexion pour effectuer les requetes.
	* Par d�faut, utilise la base de donn�es sp�cifi�e dans le fichier config.php
	* @param mysqli_connect	  $dblink 	la connexion � utiliser
	* @param string 		  $dbname	la base de donn�es � utiliser
	* @return boolean 					true|false si la selection est r�ussie
	*/
	private function useDatabase($dblink, $dbname){
		return mysqli_select_db($dblink, $dbname);
	}

	/**
	 * Execute le fichier sql pass� en param�tre sur la connexion
	 * @param mysqli_connect $dblink	la connexion � utiliser
	 * @param string		 $filename	le fichier � executer
	 * @return boolean					true|false si l'execution est r�ussie
	 */
	private function execute($dblink, $filename){
		$extension = pathinfo($filename);
		// On v�rifie que le fichier est bien un fichier sql
		if ($extension['extension'] === 'sql'){
			$open = fopen($filename, 'r');
			$queries = fread($open, filesize($filename));
			fclose($open);
			//On se connecte � la base de donn�es
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
				echo "Erreur lors de la selection de la base de donn�es";
				return false;
			}
		}
		else{
			echo "Erreur lors de la connexion au serveur de donn�es";
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
	 * Retourne l'host de la base de donn�es utilis�e
	 * @return	string
	 */
	public function getHost(){
		return $this->host;
	}
	
	/**
	 * Retourne le login de la base de donn�es utilis�e
	 * @return	string
	 */
	public function getLogin(){
		return $this->login;
	}
	
	/**
	 * Retourne le mot de passe de la base de donn�es utilis�e
	 * @return	string
	 */
	public function getPassword(){
		return $this->password;
	}
		
	/**
	 * Retourne le nom de la base de donn�es utilis�e
	 * @return	string
	 */
	public function getDBName(){
		return $this->dbname;
	}
}
?>