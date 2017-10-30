<?php

/**
* 
*/
class File 
{
	
	public $fileaddress = '';	//文件的地址
	public $information = '';	//写入文件的内容
	public $result='';			//结果写入是否成功 
	private $file ;

	function __construct($address, $information)
	{
		$this->fileaddress = $address;
		$this->information = $information;
		$this->filecreate();
	}

	public static function run($address, $information)
	{
		return new self($address, $information);
	}

	public  function filecreate()
	{
		$file = fopen($this->fileaddress, "a");
		$this->result = fwrite($file, $this->information);
		$this->file = $file;
		return $this;
	}

	public function get()
	{
		if ($this->file) {
			fclose($this->file);
			$this->file = '';
		}
		return $this->result;
	}

	function __destruct()
	{
		if ($this->file) {
			fclose($this->file);
			$this->file = '';
		}
	}

}