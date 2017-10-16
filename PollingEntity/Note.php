<?php 
namespace PollingEntity;
try {
	if(file_exists("/vendor/autoload.php"))
		require "/vendor/autoload.php";
	else{
		if(file_exists("../vendor/autoload.php"))
		require "../vendor/autoload.php";
	}

} catch (Exception $e) {
}

class Note {
	private $content;
	private $idNote;
	private $refNote;
	
		public function __construct(){
			$this->content=null;
			$this->idNote=null;
			$this->refNote=null;
		}	

		public function registerNote(){
			global $PDO;

			try{
				$PDO->beginTransaction();

				$req=$PDO->prepare("INSERT INTO note(content,idNote,refNote) VALUES (:content,:idNote,:refNote)");

				$req->execute(array("content"=>$this->content,"idNote"=>$this->idNote,"refNote"=>$this->refNote));

				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}

			return $complete;
		}

	public function updateNote(){
			global $PDO;

			try{
				$PDO->beginTransaction();

				$req=$PDO->prepare("UPDATE note SET content=:newContent WHERE idNote=:idNote");
				$req->execute(array("newContent"=>$this->content,"idNote"=>$this->idNote));

				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}

			return $complete;
		}

	public function deleteNote(){
			global $PDO;

			try{
				$PDO->beginTransaction();

				$req=$PDO->prepare("DELETE FROM note WHERE idNote=:idNote");
				$req->execute(array("idNote"=>$this->idNote));
				$req->closeCursor();
				$complete=true;
				$PDO->commit();
			}catch(Exception $e){$complete=false; $PDO->rollback();}

			return $complete;
		}

		public function retrieveNotes(){
			global $PDO;

			try{
				$PDO->beginTransaction();

				$req=$PDO->prepare("SELECT content FROM note WHERE refNote=:refNote");
				$req->execute(array("refNote"=>$this->refNote));
				while($datareq=$req->fetch())
				$response[]=($datareq);
				if(empty($response))
	 			$response=0;
				$req->closeCursor();
				$PDO->commit();
			}catch(Exception $e){$response=0; $PDO->rollback();}

			return $response;
		}


	public function getContent(){
		return $this->content;
	}

	public function setContent($newContent){
		$this->content=$newContent;
	}

	public function getIdNote(){
		return $this->idNote;
	}

	public function setIdNote($idNote){
		$this->idNote=$idNote;
	}
	

	public function getRefNote(){
		return $this->refNote;
	}

	public function setrefNote($refNote){
		$this->refNote=$refNote;
	}


}

