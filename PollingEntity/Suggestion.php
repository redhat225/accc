<?php 
Namespace PollingEntity;
try {
	if(file_exists("/vendor/autoload.php"))
		require "/vendor/autoload.php";
	else{
		if(file_exists("../vendor/autoload.php"))
		require "../vendor/autoload.php";
	}

} catch (Exception $e) {
}
use PollingEntity\Courrier;

class Suggestion{

	private $idSuggest;
	private $idCourrierSuggest;
	private $suggestion;
	private $dateEnvoi;
	private $stateSuggest;
	public  $Courrier;

	public function __construct()
	{
			$this->idSuggest=null;
			$this->idClientSuggest=null;
			$this->idExpSuggest=null;
			$this->suggestion=null;
			$this->dateEnvoi=null;
			$this->Courrier = new Courrier();
	}

	public function registerSuggest(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("INSERT INTO suggestion(suggestion,idCourrier) VALUES(:suggest,:idCourrier)");
				$req->execute(array("suggest"=>$this->suggestion,"idCourrier"=>$this->idCourrierSuggest));
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
		
			return $complete;	
	}

	public function tagSeenSuggest(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE suggestion SET suggestion.state=1 WHERE suggestion.idSuggest=:idSuggest");
				$req->execute(array("idSuggest"=>$this->idSuggest));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function UnSeenSuggest(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare("UPDATE suggestion SET suggestion.state=0 WHERE suggestion.idSuggest=:idSuggest");
				$req->execute(array("idSuggest"=>$this->idSuggest));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}
			return $complete;	
	}

	public function getCumulUnreadSuggest(){
			global $PDO;	
			try{
				$PDO->beginTransaction();
				$req=$PDO->prepare(	"SELECT count(suggestion.idSuggest) as totalSuggest FROM suggestion WHERE suggestion.state=0");
				$req->execute();
				$datareq=$req->fetch();
				$results=$datareq->totalSuggest;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$results=0; $PDO->rollback();}
		
			return $results;
	}

	/*GETTERS SETTERS*/
	public function getIdSuggest(){
		return $this->idSuggest;
	}

	public function setIdSuggest($idSuggest){
		$this->idSuggest=$idSuggest;
	}

	public function getStateSuggest(){
		return $this->stateSuggest;
	}

	public function setStateSuggest($stateSuggest){
		$this->stateSuggest=$stateSuggest;
	}

	public function getIdCourrierSuggest(){
		return $this->idCourrierSuggest;
	}

	public function setIdCourrierSuggest($idCourrierSuggest){
		$this->idCourrierSuggest=$idCourrierSuggest;
	}
	public function getSuggestion(){
		return $this->suggestion;
	}

	public function setSuggestion($suggestion){
		$this->suggestion=$suggestion;
	}


	public function getDateEnvoi(){
		return $this->dateEnvoi;
	}

	public function setDateEnvoi($dateEnvoi){
		$this->dateEnvoi=$dateEnvoi;
	}



}
