<?php
	
/**
* 
*/
class Anatomy
{
	public $target;		//所要解剖 的 数组
	public $Result;		//结果集
	public $dir;		//创建目录
	public $result = array();	

	function __construct($target)
	{
		$this->target = $target;
		$this->start();
	}

	public static function run($target)
	{
		return new self($target);
	}

	public function start()
	{
		if (is_array($this->target)) {
			$this->anatomy($this->target);
		};
		return $this;
	}


	public function anatomy($target)
	{
		$sql = '';
		foreach ($this->target as $key => $value) {
			// $this->foreach1($value,$sql);
			$this->test($value,"",$key);
		}
		return $this;
	}


	public function test($value, $sql, $k)
	{
		 if (is_array($value)) {
				$sql .= $k."/";
				foreach ($value as $key => $vus) {
					$this->test($vus, $sql, $key);	
				}
			}else{
				$sql .= $value;
				$this->result[] = $sql; 
			}

			return $this;
	}

	public function get()
	{
		return $this->result;
	}

}