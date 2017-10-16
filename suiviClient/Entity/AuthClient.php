<?php
namespace suiviClient\Entity; 
try {
	if(file_exists("/vendor/autoload.php"))
		require "/vendor/autoload.php";
	else{
		if(file_exists("../vendor/autoload.php"))
		require "../vendor/autoload.php";
	}

} catch (Exception $e) {
}


use Zend\Crypt\Password\Bcrypt;

class AuthClient{

	var	$forbiddenPage="index.php?p=forbidden";

		//identifier un user
		function loginClient($data)
		{
			global $PDO;
			
			$req=$PDO->prepare('SELECT mdp FROM client WHERE login=:login');
			$req->execute(array("login"=>$data['login-client-content']));
			$result=$req->fetch();
			if(!empty($result))
			{	
							$req->closeCursor();
							$securePass=$result->mdp;
							$Bcrypt=new Bcrypt();
							if($Bcrypt->verify($data['password-client-content'],$securePass))
							{
									$req=$PDO->prepare('SELECT client.id,role.slug, role.level FROM client LEFT JOIN role ON client.role_id=role.id WHERE login=:login');
									$req->execute(array("login" =>$data['login-client-content']
										)); 
									$datareq=$req->fetchAll();
									
									if(count($datareq)>0){
										$_SESSION['AuthClient']=$datareq[0];
										return true;
									}
									else
									return false;

							}
							else
							return false;
			}
			else
				return false;

		}


		function loginAdmin($data){
			global $PDO;
			
			$req=$PDO->prepare('SELECT password FROM administrators WHERE login=:login');
			$req->execute(array("login"=>$data['login-admin-content']));
			$result=$req->fetch();
			$req->closeCursor();
			if(!empty($result))
			{	

					$securePass=$result->password;
					$Bcrypt=new Bcrypt();
					if($Bcrypt->verify($data['password-admin-content'],$securePass))
					{

							$req=$PDO->prepare('SELECT administrators.id,administrators.idService,administrators.poste,administrators.nom,administrators.prenom,role.slug, role.level FROM administrators LEFT JOIN role ON administrators.role_id=role.id WHERE login=:login AND password=:password');
							$req->execute(array("login" =>$data['login-admin-content'],
								"password" => $securePass
								)); 
							$datareq=$req->fetchAll();
							
							if(count($datareq)>0){
								$_SESSION['AuthClient']=$datareq[0];
								return true;
							}
							else
							return false;

					}
					else
					return false;
			}
			else
				return false;

		}

		function allow($rang){
				global $PDO;
				$req=$PDO->prepare('SELECT slug,level FROM role');
				$req->execute(); 
				$datareq=$req->fetchAll();
				$role=array();
				foreach ($datareq as $v) {
					$role[$v->slug]=$v->level;
				}

				if(!$this->user('slug')){
					$this->forbidden();
				}else{

						if(!($role[$rang]===$this->user('level'))){
							$this->forbidden();
						}
						else
							return true;

				}
		}

		//Récupère une info user
		function user($field){
				if(isset($_SESSION['AuthClient']->$field))
					return $_SESSION['AuthClient']->$field;
				else
					return false;
		}


		//Redirige un user
		function forbidden(){	
				header("Location:".$this->forbiddenPage);
		}
}

