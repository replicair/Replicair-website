<?php 

class PaginationArticle {
	
	var $pageUrl;
	var $pageCurrent;
	var $pagePrev;
	var $pageNext;
	var $pageCount;
	var $pageList;
	
	function PaginationArticle($articleCount,$currentPage,$defaultUrl, $category) {
		$this->preparePagination($articleCount,$currentPage,$defaultUrl,$category);
	}
	
	function endsWith($str, $sub)
	{
		return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
	}
	
	
	function preparePagination($articleCount,$currentPage,$defaultUrl,$category) {
		$this->pageCurrent = $currentPage;
		$this->pageCount = $articleCount;
		$this->setPagePrev($currentPage, $articleCount);
		$this->setPageNext($currentPage, $articleCount);
		if ($this->endsWith($defaultUrl, "?")) {
			$this->pageUrl=$defaultUrl."category=".$category."&page=";
		} else {
			$this->pageUrl=$defaultUrl."&category=".$category."&page=";
		}
	}
	
	function setPagePrev($currentPage, $totalPages) {
		$prev = $currentPage - 1;
		if ($prev > 0) {
			$this->pagePrev = $prev;
		}
		else {
			$this->pagePrev = $totalPages;
		}
	}
	
	function setPageNext($currentPage, $totalPages) {
		$next = $currentPage + 1;
		if ($next <= $totalPages) {
			$this->pageNext = $next;
		}
		else {
			$this->pageNext = 1;
		}
	}
	
}

?>