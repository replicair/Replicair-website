<div class="article_pagination">
	<ul style="display:table-cell;">
		<?php
			$pagination = $this->pagination;
			$activePage = "<img src=\"".$this->rootImg."img/style/list-button-active.png\" >";
			$inactivePage = "<img src=\"".$this->rootImg."img/style/list-button-inactive.png\" >";
		?>
		<li class="prev"><a href="<?php echo $pagination->pageUrl . $pagination->pagePrev ?>"><img src="<?php echo $this->rootImg ?>img/style/list-prev.png" ></a></li>
		<?php
		$counter = 1;
		while ($pagination->pageCount >= $counter) {
		?>
		<li class="page">
			<a href="<?php echo $pagination->pageUrl . $counter ?>">
				<?php if ($pagination->pageCurrent == $counter) { echo $activePage;	} else {echo $inactivePage;	} ?>
			</a>
		</li>
		<?php
			$counter += 1;
		}
		?>
		<li class="next"><a href="<?php echo $pagination->pageUrl . $pagination->pageNext ?>"><img src="<?php echo $this->rootImg ?>img/style/list-next.png" ></a></li>
	</ul>
</div>