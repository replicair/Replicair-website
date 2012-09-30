<?php 
$p = $this->pagination;
if ($p->pageFirst != 0) {
	echo"<a class='pagination-prev' href='".$p->pageUrl.$p->pageFirst."'>&lt;&lt;</a>";
}
else {
	echo"<a class='pagination-prev pagination-hidden'>&lt;&lt;</a>";
}
if ($p->pagePrev != 0) {
	echo"<a class='pagination-prev' href='".$p->pageUrl.$p->pagePrev."'>&lt;</a>";
}
else {
	echo"<a class='pagination-prev pagination-hidden'>&lt;</a>";
}
foreach($p->pagesPrev as $prev) {
	if ($prev != 0) {
		echo"<a class='pagination-num' href='".$p->pageUrl.$prev."'>".$prev."</a>";
	}
	else {
		echo"<a class='pagination-num pagination-hidden'>".$prev."</a>";
	}
}
if ($p->pagePrev != 0 || $p->pageNext != 0) {
	echo"<a class='pagination-current' href='".$p->pageUrl.$p->pageCurrent."'>".$p->pageCurrent."</a>";
}
foreach($p->pagesNext as $next) {
	if ($next != 0) {
		echo"<a class='pagination-num' href='".$p->pageUrl.$next."'>".$next."</a>";
	}
	else {
		echo"<a class='pagination-num pagination-hidden'>".$next."</a>";
	}
}	
if ($p->pageNext != 0) {
	echo"<a class='pagination-next' href='".$p->pageUrl.$p->pageNext."'>&gt;</a>";
}
else {
	echo"<a class='pagination-next pagination-hidden'>&gt;</a>";
}
if ($p->pageEnd != 0) {
	echo"<a class='pagination-next' href='".$p->pageUrl.$p->pageEnd."'>&gt;&gt;</a>";
}
else {
	echo"<a class='pagination-next pagination-hidden'>&gt;&gt;</a>";
}
?>