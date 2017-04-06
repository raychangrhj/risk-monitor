<?php

class IntermediaryDataModel{
	
	private $connect;
	private $tableName="pdf_intermediary";
	private $fields=array("id", "pdf_id", "month_id", "intermediary");
	
	public function IntermediaryDataModel(){
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
	
	public function fetch($monthId){
		$sql="SELECT * FROM {$this->tableName} WHERE month_id='{$monthId}'";
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
	
	public function remove($pdfId){
		$sql="DELETE FROM {$this->tableName} WHERE pdf_id='{$pdfId}'";
		mysqli_query($this->connect, $sql);
	}
}

?>
