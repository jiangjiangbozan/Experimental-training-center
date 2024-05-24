<?php
namespace app\model;

/**
 * 分页中的页码
 * */
class PageNumber {
    private $number;
    
    private $isLast;
    
    private $isFirst;

    private $numberString;

    /**
     * 获取页码数组
     * @param $totalpage 总页数
     * */
    public static function getPageNumbers($totalPage) {
        if ($totalPage <= 1) {
            return [];
        }

        $page = 0;
        if (isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        }

        $pageNumber = $page + 1;

        // 最多显示几个页码
        $maxPageCount = 9;

        if ($totalPage < $maxPageCount) {
            // 总页数比较小
            $maxPageCount =  $totalPage;
        }
        $begin = 1;
        $end = $maxPageCount;
        $floor = floor((($end + $begin) / 2));
        $middle = (int)$floor;

        if ($pageNumber <= $middle) {
            // 如果是前面的几个页码，则什么也不做
        } else if ($pageNumber <= $totalPage - $middle) {
            // 如果是中间的几个数，则显示前后几页
            $begin = $pageNumber - $middle + 1;
            $end = $pageNumber - $middle + $maxPageCount;
        } else {
            // 如果是后面的几个页码，则显示最后面的
            $end = $totalPage;
            $begin = $end - $maxPageCount + 1;
        }
        $begin = $begin < 1 ? 1: $begin;

        $pageNumbers = [];
        $firstPage = new PageNumber(0, '首页');
        $firstPage->isFirst();
        array_push($pageNumbers, $firstPage);
        for ($i = $begin - 1; $i < $end; $i++) {
            $pageNumber = new PageNumber((int)$i);
            array_push($pageNumbers, $pageNumber);
        }
        $lastPage = new PageNumber($totalPage - 1, '尾页');
        $lastPage->isLast();
        array_push($pageNumbers, $lastPage);
        return $pageNumbers;
    }

    public function __construct($number, $numberString = null) {
        $this->number = $number;
        if (isset($numberString)) {
            $this->numberString = $numberString;
        }
        $this->isLast = false;
        $this->isFirst = false;
    }



    public function getClass() {
        if ($this->isActive()) {
            if ($this->isFirst || $this->isLast) {
                return ' disabled';
            } else {
                return ' active';
            }
        } else {
            return '';
        }
    
    }

    private function isActive() {
        $page = 0;
        if (isset($_GET['page'])) {
            $page = (int) $_GET['page'];
        }
        return $page === $this->number ? true : false;
    }

    public function getHref() {
        $result = '';   
        foreach($_GET as $key => $value) {
            if ($key !== 'page') {
                $result .= '&' . $key . '=' . urlencode($value);
            }
        }
        return '?page=' . $this->number . $result;
    }

    public function getNumberString() {
        if (isset($this->numberString)) {
            return $this->numberString;
        } else {
          return $this->number + 1;  
        }
    }

    public function isFirst() {
        $this->isFirst = true;
    }

    public function isLast() {
        $this->isLast = true;
    }
}