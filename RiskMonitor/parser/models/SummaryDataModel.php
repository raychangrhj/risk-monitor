<?php

class SummaryDataModel{
	
	private $connect;
	private $tableName="pdf_summary";
	private $fields=array("id", "date", "time", "admin_id", "sub_admin_id", "company_id", "fileName", "dataType", "candidate", "property1", "property2", "taxCode", "censusCode", "requestDate");
	
	public function SummaryDataModel(){
		$this->connect=mysqli_connect("localhost", "root", "", "risk_monitor");
	}
	
	public function closeConnect(){
		mysqli_close($this->connect);
	}
	
	public function insert($record){
		$items=explode(" ", $record);
		$values="";
		$fieldString="";
		for($i=0;$i<count($items);$i++){
			$values=$values . ($i==0?"":", ") . "'" . addslashes($items[$i]) . "'";
			$fieldString=$fieldString . ($i==0?"":", ") . "{$this->fields[$i+1]}";
		}
		$sql="INSERT INTO " . $this->tableName . " ({$fieldString}) VALUES (" . $values . ")";
		if(mysqli_query($this->connect, $sql)){
			return mysqli_insert_id($this->connect);
		}else{
			return -1;
		}
	}
	
	public function fetchAllByAdmin($adminId){
		if($adminId==0)
		{
			$sql="SELECT fileName FROM {$this->tableName}";
		}
		else
		{
			$sql="SELECT fileName FROM {$this->tableName} WHERE admin_id='{$adminId}'";
		}
		return mysqli_query($this->connect, $sql);
	}
	
	public function fetchAllBySubAdmin($subAdminId){
		if($subAdminId==0)
		{
			$sql="SELECT fileName FROM {$this->tableName}";
		}
		else
		{
			$sql="SELECT fileName FROM {$this->tableName} WHERE sub_admin_id='{$subAdminId}'";
		}
		return mysqli_query($this->connect, $sql);
	}
	
	public function fetchAllByCompany($companyId){
		if($companyId==0)
		{
			$sql="SELECT fileName FROM {$this->tableName}";
		}
		else
		{
			$sql="SELECT fileName FROM {$this->tableName} WHERE company_id='{$companyId}'";
		}
		return mysqli_query($this->connect, $sql);
	}
	
	public function fetch($fileName){
		$sql="SELECT * FROM {$this->tableName} WHERE fileName='{$fileName}'";
		$result=array();
		$queryResult=mysqli_query($this->connect, $sql);
		if(mysqli_num_rows($queryResult)>0){
			while($record=mysqli_fetch_assoc($queryResult)){
				$ary=array();
				foreach($record as $key=>$value){
					$ary[$key]=stripslashes($value);
				}
				array_push($result,$ary);
			}
		}
		return $result;
	}
	
	public function remove($fileName){
		$sql="DELETE FROM {$this->tableName} WHERE fileName='{$fileName}'";
		mysqli_query($this->connect, $sql);
	}
}

?>
