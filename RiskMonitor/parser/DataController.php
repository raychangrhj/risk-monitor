<?php

include "models/SummaryDataModel.php";
include "models/MonthDataModel.php";
include "models/IntermediaryDataModel.php";
include "models/TableDataModel0.php";
include "models/TableDataModel1.php";
include "models/TableDataModel2.php";
include "models/TableDataModel3.php";
include "models/TableDataModel4.php";
include "models/TableDataModel5.php";
include "models/TableDataModel6.php";
include "models/TableDataModel7.php";
include "models/TableDataModel8.php";
include "models/TableDataModel9.php";
include "models/TableDataModel10.php";
include "models/TableDataModel11.php";
include "models/TableDataModel12.php";
include "models/TableDataModel13.php";
include "models/TableDataModel14.php";
include "models/TableDataModel15.php";
include "models/TableDataModel16.php";
include "models/FooterDataModel.php";

class DataController{
	public $header;
	public $monthData=array();
	public $footerData;
	
	function DataController(){
	}
	
	function getListByAdmin($adminId){
		$summaryDataModel=new SummaryDataModel();
		$summaryRecords=$summaryDataModel->fetchAllByAdmin($adminId);
		$list=array();
		foreach($summaryRecords as $summaryRecord){
			array_push($list,$summaryRecord["fileName"]);
		}
		return $list;
	}
	
	function getListBySubAdmin($subAdminId){
		$summaryDataModel=new SummaryDataModel();
		$summaryRecords=$summaryDataModel->fetchAllBySubAdmin($subAdminId);
		$list=array();
		foreach($summaryRecords as $summaryRecord){
			array_push($list,$summaryRecord["fileName"]);
		}
		return $list;
	}
	
	function getListByCompany($companyId){
		$summaryDataModel=new SummaryDataModel();
		$summaryRecords=$summaryDataModel->fetchAllByCompany($companyId);
		$list=array();
		foreach($summaryRecords as $summaryRecord){
			array_push($list,$summaryRecord["fileName"]);
		}
		return $list;
	}
	
	function loadFromDB($pdfFileName){
		$summaryDataModel=new SummaryDataModel();
		$monthDataModel=new MonthDataModel();
		$summaryRecords=$summaryDataModel->fetch($pdfFileName);
		if(count($summaryRecords)==0)return;
		$summaryRecord=$summaryRecords[0];
		
		$pdfId=$summaryRecord["id"];
		$dataType=$summaryRecord["dataType"];
		echo "Intestatario: " . str_replace("_"," ",$summaryRecord["candidate"]) . "<br>";
		echo strcmp($dataType,"Company")==0?"Sede legale: ":"Data di nascita: ";
		echo str_replace("_"," ",$summaryRecord["property1"]) . "<br>";
		echo strcmp($dataType,"Company")==0?"CCIAA: ":"Luogo di nascita: ";
		echo str_replace("_"," ",$summaryRecord["property2"]) . "<br>";
		echo "Codice fiscale: " . str_replace("_"," ",$summaryRecord["taxCode"]) . "<br>";
		echo "Codice censito: " . str_replace("_"," ",$summaryRecord["censusCode"]) . "<br>";
		echo "Date contabili richieste: " . str_replace("_"," ",$summaryRecord["requestDate"]) . "<br>";
		
		$monthRecords=$monthDataModel->fetch($pdfId);
		for($i=0;$i<count($monthRecords);$i++){
			$monthRecord=$monthRecords[$i];
			$monthYear=$monthRecord["monthYear"];
			if(strcmp($monthYear,"Header")!=0){
				echo "<center>DATA CONTABILE: " . str_replace("_"," ",$monthYear) . "</center><br>";
			}
			$monthDataController=new MonthDataController();
			$monthDataController->loadFromDB($monthRecord["id"]);
		}

		$footerDataController=new FooterDataController();
		$footerDataController->loadFromDB($pdfId);
	}
	
	function readFromFile($file, $vat){
		$count=readLineFromFile($file);
		for($i=0;$i<$count;$i++){
			$monthDataController=new MonthDataController();
			$monthDataController->isHeader=($i==0?1:0);
			$monthDataController->readFromFile($file);
			$this->monthData[$i]=$monthDataController;
		}
		$this->footerData=new FooterDataController();
		$this->footerData->readFromFile($file);

		$header=$this->monthData[0];
		if($count==1){
			if(strcmp($header->dataType,"Invalid")==0){
				return "Invalid";
			}else{
				return "NoTable";
			}
		}else if(strcmp(trim($header->taxCode), trim($vat))!=0){
			return "VatError";
		}else{
			return "Ok";
		}
	}
	
	function saveToDB($adminId, $subAdminId, $companyId, $pdfFileName, $vat){
		$this->removeFromDB($pdfFileName);
		$header=$this->monthData[0];
		$date=date('Y-m-d');
		$time=date('h:i:s');
		$record="{$date} {$time} {$adminId} {$subAdminId} {$companyId} {$pdfFileName} {$header->dataType} {$header->candidate} {$header->property1} {$header->property2} {$header->taxCode} {$header->censusCode} {$header->requestDate}";
		$summaryDataModel=new SummaryDataModel();
		$pdfId=$summaryDataModel->insert($record);
		for($i=0;$i<count($this->monthData);$i++){
			$this->monthData[$i]->saveToDB($pdfId);
		}
		$this->footerData->saveToDB($pdfId);
	}
	
	function removeFromDB($pdfFileName){
		$summaryDataModel=new SummaryDataModel();
		$monthDataModel=new MonthDataModel();
		$intermediaryDataModel=new IntermediaryDataModel();
		$tableDataModels=array();
		for($i=0;$i<17;$i++){
			$TableDataModel="TableDataModel" . $i;
			$tableDataModels[$i]=new $TableDataModel();
		}
		$footerDataModel=new FooterDataModel();
		$summaryRecords=$summaryDataModel->fetch($pdfFileName);
		$summaryDataModel->remove($pdfFileName);
		for($i=0;$i<count($summaryRecords);$i++){
			$summaryRecord=$summaryRecords[$i];
			$pdfId=$summaryRecord["id"];
			$monthDataModel->remove($pdfId);
			$intermediaryDataModel->remove($pdfId);
			for($j=0;$j<17;$j++){
				$tableDataModels[$j]->remove($pdfId);
			}
			$footerDataModel->remove($pdfId);
		}
	}
}

class MonthDataController{
	public $isHeader;
	public $dataType,$candidate,$property1,$property2,$taxCode,$censusCode,$requestDate;
	public $monthYear;
	public $intermediaryData=array();
	
	function MonthDataController(){
	}
	
	function loadFromDB($monthId){
		$intermediaryDataModel=new IntermediaryDataModel();
		$intermediaryRecords=$intermediaryDataModel->fetch($monthId);
		for($i=0;$i<count($intermediaryRecords);$i++){
			$intermediaryRecord=$intermediaryRecords[$i];
			$intermediary=$intermediaryRecord["intermediary"];
			echo "Intermediario: " . str_replace("_"," ",$intermediary) . "<br>";
			$intermediaryDataController=new IntermediaryDataController();
			$intermediaryDataController->loadFromDB($intermediaryRecord["id"]);
		}
	}
	
	function readFromFile($file){
		if($this->isHeader==1){
			$this->dataType=readLineFromFile($file);
			$this->candidate=readLineFromFile($file);
			$this->property1=readLineFromFile($file);
			$this->property2=readLineFromFile($file);
			$this->taxCode=readLineFromFile($file);
			$this->censusCode=readLineFromFile($file);
			$this->requestDate=readLineFromFile($file);
			$this->monthYear="Header";
		}else{
			$this->monthYear=readLineFromFile($file);
		}
		$count=readLineFromFile($file);
		for($i=0;$i<$count;$i++){
			$intermediaryDataController=new IntermediaryDataController();
			$intermediaryDataController->readFromFile($file);
			$this->intermediaryData[$i]=$intermediaryDataController;
		}
	}
	
	function saveToDB($pdfId){
		$record="{$pdfId} {$this->monthYear}";
		$monthDataModel=new MonthDataModel();
		$monthId=$monthDataModel->insert($record);
		for($i=0;$i<count($this->intermediaryData);$i++){
			$this->intermediaryData[$i]->saveToDB($pdfId,$monthId);
		}
	}
}

class IntermediaryDataController{
	public $intermediary;
	public $tableData=array();
	
	function IntermediaryDataController(){
	}
	
	function loadFromDB($intermediaryId){
		for($i=0;$i<17;$i++){
			$TableDataModel="TableDataModel" . $i;
			$tableDataController=new TableDataController();
			$tableDataController->loadFromDB(new $TableDataModel(),$intermediaryId);
		}
	}
	
	function readFromFile($file){
		$this->intermediary=readLineFromFile($file);
		$count=readLineFromFile($file);
		for($i=0;$i<$count;$i++){
			$tableDataController=new TableDataController();
			$tableDataController->readFromFile($file);
			$this->tableData[$i]=$tableDataController;
		}
	}
	
	function saveToDB($pdfId,$monthId){
		$record="{$pdfId} {$monthId} {$this->intermediary}";
		$intermediaryDataModel=new IntermediaryDataModel();
		$intermediaryId=$intermediaryDataModel->insert($record);
		for($i=0;$i<count($this->tableData);$i++){
			$this->tableData[$i]->saveToDB($pdfId,$intermediaryId);
		}
	}
}

class TableDataController{
	public $tableType,$fieldCount;
	public $fields=array();
	public $records=array();
	
	function TableDataController(){
	}
	
	function loadFromDB($tableDataModel,$intermediaryId){
		$tableRecords=$tableDataModel->fetch($intermediaryId);
		if(count($tableRecords)==0)return;
		$tableFields=$tableDataModel->fields;
		$tableString="<table border='1' style='border-collapse:collapse;'><tr>";
		for($i=3;$i<count($tableFields);$i++){
			$tableField=$tableFields[$i];
			if(strcmp($tableField,"EMPTY")==0)$tableField=" ";
			$tableString.="<th><center>" . $tableField . "</center></th>";
		}
		$tableString.="</tr>";
		for($i=0;$i<count($tableRecords);$i++){
			$tableRecord=$tableRecords[$i];
			$tableString.="<tr>";
			for($j=3;$j<count($tableFields);$j++){
				$tableField=$tableFields[$j];
				$tableString.="<td><center>" . $tableRecord[$tableField] . "</center></td>";
			}
			$tableString.="</tr>";
		}
		$tableString.="</table><p>";
		echo str_replace("_"," ",$tableString);
	}
	
	function readFromFile($file){
		$line=readLineFromFile($file);
		$items=explode(" ", $line);
		$this->tableType=$items[0];
		$this->fieldCount=$items[1];
		$line=readLineFromFile($file);
		$fields=explode(" ", $line);
		$count=readLineFromFile($file);
		for($i=0;$i<$count;$i++){
			$this->records[$i]=readLineFromFile($file);
		}
	}
	
	function saveToDB($pdfId, $intermediaryId){
		$TableDataModel="TableDataModel" . $this->tableType;
		$tableDataModel=new $TableDataModel();
		for($i=0;$i<count($this->records);$i++){
			$record="{$pdfId} {$intermediaryId} {$this->records[$i]}";
			$tableDataModel->insert($record);
		}
	}
}

class FooterDataController{
	public $fieldCount;
	public $fields=array();
	public $records=array();
	
	function FooterDataController(){
	}
	
	function loadFromDB($pdfId){
		$footerDataModel=new FooterDataModel();
		$tableRecords=$footerDataModel->fetch($pdfId);
		if(count($tableRecords)==0)return;
		$tableFields=$footerDataModel->fields;
		$tableString="<table border='1' style='border-collapse:collapse;'><tr>";
		for($i=2;$i<count($tableFields);$i++){
			$tableString.="<th><center>" . $tableFields[$i] . "</center></th>";
		}
		$tableString.="</tr>";
		for($i=0;$i<count($tableRecords);$i++){
			$tableRecord=$tableRecords[$i];
			$tableString.="<tr>";
			for($j=2;$j<count($tableFields);$j++){
				$tableField=$tableFields[$j];
				$tableString.="<td><center>" . $tableRecord[$tableField] . "</center></td>";
			}
			$tableString.="</tr>";
		}
		$tableString.="</table><p>";
		echo "<br>VARIABILI DI CLASSIFICAZIONE";
		echo str_replace("_"," ",$tableString);
	}
	
	function readFromFile($file){
		$this->fieldCount=readLineFromFile($file);
		$line=readLineFromFile($file);
		$fields=explode(" ", $line);
		$count=readLineFromFile($file);
		for($i=0;$i<$count;$i++){
			$this->records[$i]=readLineFromFile($file);
		}
	}
	
	function saveToDB($pdfId){
		$footerDataModel=new FooterDataModel();
		for($i=0;$i<count($this->records);$i++){
			$record="{$pdfId} {$this->records[$i]}";
			$footerDataModel->insert($record);
		}
	}
}

?>
