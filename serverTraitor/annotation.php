<?php 
session_start();
require ('../vendor/autoload.php');
require_once('../bdConnect/accc-connect.php');
use PollingEntity\Note;


$Note = new Note();
//$Annotation= file_get_contents('php://input');

switch ($_POST['actionNote']) {
	case 1:
			$Annotation=$_POST['Annotation'];
			$DetailedAnnotation=json_decode($_POST['Annotation']);
			$Note->setContent($Annotation);
			$Note->setIdNote($DetailedAnnotation->id);
			$Note->setrefNote($DetailedAnnotation->refNoteContent);
			$Note->registerNote();
	break;
	
	case 2 :
			$Annotation=$_POST['Annotation'];
			$DetailedAnnotation=json_decode($_POST['Annotation']);
			$Note->setContent($Annotation);
			$Note->setIdNote($DetailedAnnotation->id);
			$Note->updateNote();
	break;
	
	case 3:
			$Annotation=$_POST['Annotation'];
			$DetailedAnnotation=json_decode($_POST['Annotation']);
			$Note->setIdNote($DetailedAnnotation->id);
			$Note->deleteNote();
	break;

	case 4:
			$Note->setrefNote($_POST['refNote']);
			$AllNotes=$Note->retrieveNotes();
			echo json_encode($AllNotes);
	break;
}



 ?>