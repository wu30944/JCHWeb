<?php
namespace App\Http\Controllers\DB;

use App\Http\Controllers;
use Illuminate\Http\Request;

class DBadmin 
{
	private $DataTable;

	private $where;

	public function __construct($Table)
	{
		$this->DataTable = $Table;
	}

	public function show($view)
	{	
		return view($view);
	}

	public function query()
	{

	}

	public function getTableItem($id,$item)
	{

		return $this->DataTable[$id]->$item;
	}

	public function getTableAll()
	{
		return $this->DataTable::all();
	}

	public function getRowData($Row)
	{
		return $this->DataTable[$Row];
	}


	public function setWhere($operator)
	{	
		$rows=0;
		foreach($operator as $str)
		{
			$this->where[$rows][0]=$str[0];
			$this->where[$rows][1]=$str[1];
			$this->where[$rows][2]=$str[2];
			$rows++;
		}
	}

	public function getTableWhere()
	{
		$Conditions="";
		$rows=0;
		$count= count($this->where);
		foreach($this->where as $str)
		{	
			if( $rows==$count-1)
			{
				$Conditions=$Conditions."where('".$str[0]."','".$str[1]."','".$str[2]."')";		
			}
			else
			{
				$Conditions=$Conditions."where('".$str[0]."','".$str[1]."','".$str[2]."')->";
			}		
			$rows++;
		}
		return $Conditions;
	}

	public function getWhere()
	{	

		return $this->where[0][0];
	}

}