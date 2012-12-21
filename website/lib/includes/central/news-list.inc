<?php foreach($this->list as $object) { ?>
<div class="news-list">
	<a href="news.php?page=<?php echo $this->pagination->pageCurrent ?>&id=<?php echo $object->id ?>">
	<div class="news-list-image">
		<img src="<?php echo $this->fileLocation . $object->filenameList ?>" alt="<?php $object->filenameList ?>" />
	</div>
	</a>
	<div class="news-list-content">
		<h3><a href="news.php?page=<?php echo $this->pagination->pageCurrent ?>&id=<?php echo $object->id ?>"><?php echo $object->date ?> - <?php echo $object->title ?></a></h3>
		<?php echo $object->abstract ?>
	</div>
	
	<div class="news-list-footer">
		<span>
			<a href="news.php?page=<?php echo $this->pagination->pageCurrent ?>&id=<?php echo $object->id ?>">> Lire la suite</a>
		</span>
		<?php //include($this->path . '/lib/includes/util/social.inc') ?>
		
	</div>
</div>

<?php } ?>
<div class="pagination">
	<?php include($this->path . '/lib/includes/util/pagination.inc'); ?>
</div>