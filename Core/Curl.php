<?php
// namespace Core;

/**
* curl 获取网页信息 并对指定 的信息操作
*/
class Curl
{
	
	private static $target;	//目标 地址
	private static $obj;	//目标 地址
	private $agreement;	//请求 协议
	private $domain;	//请求 域名
	private $other;		//请求 附加参数
	private $newOther;	//请求 新的  附加参数
	// private $address='../Result/';    //结果返回地址
	private $match;      //请求 匹配的参数
	public  $data;       //请求 网页结果
	public  $result=array();     //请求 匹配结果

	function __construct($url='')
	{
		// 记录请求协议
		if (!empty($this->target)) 
		{
			$this->run();
		} else {
				if (!empty($url)) {
					self::$target=$url;
					$this->run();							
					$url = explode("://", self::$target);
					$this->agreement = $url[0];
					//记录请求域名
					$url = explode("/", $url[1]);
					$this->domain = $url[0];
				} else {
					return '缺少参数';
				}
		}
	}

	public static function url($url)
	{
		return new self($url);
	}

	/**
	 * [run 加载页面]
	 * @return string 请求页面的数据
	 */
	public function run()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::$target);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		$this->data = $data;
		curl_close($ch);
		return $this;
	}

	public function getdata()
	{
		return $this->data;
	}

	// static 
    public function match($match=array())
	{
		if (is_string($match)) {
			
		};
		foreach ($match as $k => $value) {
			// $sql = "/<".$key." ".$value."=[\"|'](.*?)[\"|'] [\/]>/";
			$sql = $value;
			// var_dump($this->data);
			//$sql = "/<img (.*)>/";
			preg_match_all($sql, $this->data, $Result);
			foreach ($Result[1] as $key => $value) {
				// var_dump(strpos($value,'http://'));
				if (!strpos($value, '://')) {
					$value = $this->agreement."://".$this->domain.$value;
				};
				$this->result["$k"][]= htmlspecialchars($value);
			}
		}
		return $this;
	}

	public function get()
	{
		return ['result'=>$this->result,'domain'=>$this->domain];
	}
}

