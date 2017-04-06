<?php

include "DataController.php";

class Parser{
	
	function Parser(){
	}
	
	function getListByAdmin($adminId){
		$dataController=new DataController();
		return $dataController->getListByAdmin($adminId);
	}
	
	function getListBySubAdmin($subAdminId){
		$dataController=new DataController();
		return $dataController->getListBySubAdmin($subAdminId);
	}
	
	function getListByCompany($companyId){
		$dataController=new DataController();
		return $dataController->getListByCompany($companyId);
	}
	
	function save($adminId, $subAdminId, $companyId, $fileName, $vat){
		$pdfFileName=str_replace(" ", "_", "uploads/" . $fileName);
		exec("parser " . $pdfFileName);
		$file = fopen("parse.txt", "r");
		$dataController=new DataController();
		$result=$dataController->readFromFile($file, $vat);
		if(strcmp($result,"Ok")==0){
			$dataController->saveToDB($adminId, $subAdminId, $companyId, $fileName, $vat);
		}
		fclose($file);
		return $result;
	}
	
	function load($pdfFileName){
		$dataController=new DataController();
		$dataController->loadFromDB($pdfFileName);
	}
	
	function remove($pdfFileName){
		$dataController=new DataController();
		$dataController->removeFromDB($pdfFileName);
	}
	
	function removeAll(){
		$fileNames=$this->getList(0);
		$dataController=new DataController();
		foreach($fileNames as $fileName){
			$dataController->removeFromDB($fileName);
		}
	}
}
	
function readLineFromFile($file){
	return trim(fgets($file));
}

?>
