<?php 
//conexion PDO::MSQL
include('/lib/adodb5/adodb.inc.php');
class Conexion {
 		private $server; 
		private $user;         
		private $password;					
		private $database;
		private $sql_instruction;
		protected $adodb;
		public $rs; 
		
		function __construct()
		{
		   $this->adodb = ADONewConnection('mysql'); 
		   $this->setup('localhost','root','12345','usuario');
		}
		
		public function getADOdb()
		{
		 return $this->adodb;
		}
		
		function debug_on($value)
		{
		 $this->adodb->debug = $value;
		}
		
 		function setup($server, $user, $pass, $db)
		{
		    $this->adodb->connect($server, $user, $pass, $db);
		  
		} 

		function consulta($sql_instruction ){
			$valores = array();
			$i = 0;
			$this->rs = $this->adodb->Execute($sql_instruction);
			if ($this->rs === false) die("failed"); 
			while(!$this->rs->EOF){
				foreach($this->rs->fields as $row => $valor){
					if (is_string($row)){
						$valores[$i][$row]=$valor;
					}
				}
				$this->rs->MoveNext();
				$i++;
			}
			return($valores);					
		}
		function sql($sql_instruction)
		{		
		   $this->rs = $this->adodb->Execute($sql_instruction);
		   return($this->rs);		
		}
		
		function get_data($sql, $field='')
		{		 
	     $rs = $this->dosql($sql);
	     // print_r($rs);
	     if ($field == '')
	       { 
		    reset($rs->fields);
		    $res = current($rs->fields);
		   }
     	 else
	      $res = $rs->fields[$field];
	     // die("res - $res");		 
	     return($res); 
		}
		
		function Insert($table, $record, $where=false)
		{
		 $this->adodb->AutoExecute($table, $record, 'INSERT', $where);
		}

		function Update($table, $record, $where=false)
		{
		 $this->adodb->AutoExecute($table, $record,'UPDATE', $where);
		}	
		
		function InsUpd($table, $record, $key, $autoquote=false)
		{
		  $this->adodb->Replace($table, $record, $key, $autoquote);
		}
		
		function ErrorNo()
		{
		 return($this->adodb->ErrorNo());
		}
		
		function ErrorMsg()
		{
		 return($this->adodb->ErrorMsg());
		}
		
		function record_style($style)
		{

		 if ($style=='fields') $this->adodb->SetFetchMode(ADODB_FETCH_ASSOC);
		 if ($style=='numbers') $this->adodb->SetFetchMode(ADODB_FETCH_NUM);
		 if ($style=='both') $this->adodb->SetFetchMode(ADODB_FETCH_BOTH);
	     if ($style=='default') $this->adodb->SetFetchMode(ADODB_FETCH_DEFAULT);
		}

		function getrow(){
			return $this->rs->GetRowAssoc();
		}
		function next(){
			return $this->rs->MoveNext();
		}
}
?>