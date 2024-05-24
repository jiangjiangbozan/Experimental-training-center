<?php
namespace app\model;

class Page {
	/**当前页的内容*/
	public $content = [];

	/**第几页（0基)*/
	public $number = 0;

	public $size = 0;
	
	public $totalCount = 0;

	/**共多少页*/
	public $totalPage = 0;

	/**
	 * @param $content 当前页 内容
	 * @param $number 第几页（0基）
	 * @param $size 每页大小
	 * @param $totalCount 总条数
	 * */
	public function __construct($content, $number, $size, $totalCount) {
		// 防止除0异常
		if (is_null($size) || (int) $size === 0) {
			$size = 1;
		}
		$this->content = $content;
		$this->number = $number;
		$this->size = $size;
		$this->totalCount = $totalCount;
		$this->totalPage = ceil($totalCount / $size);
	}
}