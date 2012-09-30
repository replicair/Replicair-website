<?php 

class Pagination {
	
	var $pageUrl;
	var $pageFirst;
	var $pageEnd;
	var $pageCurrent;
	var $pagePrev;
	var $pageNext;
	var $pagesPrev;
	var $pagesNext;
	var $sepPrev;
	var $sepNext;
	
	function Pagination($totalElements,$elementByPage,$currentPage,$showingPrevNextCount,$defaultUrl) {
		$this->preparePagination($totalElements,$elementByPage,$currentPage,$showingPrevNextCount,$defaultUrl);
	}
	
	function preparePagination($totalElements,$elementByPage,$currentPage,$showingPrevNextCount,$defaultUrl) {
		$pagination = array();
		$pageCount = ($totalElements - ($totalElements % $elementByPage)) / $elementByPage;
		if (($totalElements % $elementByPage) != 0) {
			$pageCount += 1;
		}
		//echo "pages:".$pageCount;
		$this->setPageFirst($currentPage);
		$this->setPageEnd($currentPage,$pageCount);
		$this->pageCurrent = $currentPage;
		$this->setPagesPrev($showingPrevNextCount, $currentPage);
		$this->setPagesNext($showingPrevNextCount, $currentPage, $pageCount);
		$this->setPagePrev($currentPage);
		$this->setPageNext($currentPage, $pageCount);
		$this->pageUrl=$defaultUrl;
	}
	
	function setPageFirst($currentPage) {
		if ($currentPage != 1) {
			$this->pageFirst = 1;
		}
		else {
			$this->pageFirst = 0;
		}
	}
	
	function setPageEnd($currentPage, $totalPages) {
		if ($currentPage != $totalPages) {
			$this->pageEnd = $totalPages;
		}
		else {
			$this->pageEnd = 0;
		}
	}
	
	function setPagePrev($currentPage) {
		$prev = $currentPage - 1;
		if ($prev > 0) {
			$this->pagePrev = $prev;
		}
		else {
			$this->pagePrev = 0;
		}
	}
	
	function setPageNext($currentPage, $totalPages) {
		$next = $currentPage + 1;
		if ($next <= $totalPages) {
			$this->pageNext = $next;
		}
		else {
			$this->pageNext = 0;
		}
	}
	
	function setPagesPrev($showingPrevNextCount, $currentPage) {
		$prev = array();
		for ($i = $showingPrevNextCount; $i > 0; $i--) {
			$current = $currentPage - $i;
			if ($current > 0) {
				array_push($prev, $current);
			}
			else {
				array_push($prev, 0);
			}
		}
		$this->pagesPrev = $prev;
	}
	
	function setPagesNext($showingPrevNextCount, $currentPage, $totalPages) {
		$next = array();
		for ($i = 1; $i <= $showingPrevNextCount; $i++) {
			$current = $currentPage + $i;
			if ($current <= $totalPages) {
				array_push($next, $current);
			}
			else {
				array_push($next, 0);
			}
		}
		$this->pagesNext = $next;
	}
}

?>