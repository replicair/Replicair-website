<div id="middle-mid">
	<?php include($this->path.'/lib/includes/nav/nav-admin.inc'); ?>
	<div id="content" class="content-normal">
		<?php foreach($this->list as $object) {
			if ($object->state == 0) {
				$stateButtonClass="admin-ko";
				$stateLabel="Activer";
			} else {
				$stateButtonClass="admin-ok";
				$stateLabel="Désactiver";
			}
		?>
		<div class="news-list">
			<div class="news-list-image">
				<img src="<?php echo $this->fileLocation . $object->filename ?>" alt="<?php $object->filename ?>" />
			</div>
			<div class="news-list-content">
				<h3><?php echo $object->date ?> - <?php echo $object->title ?></h3>
				<?php echo $object->abstract ?>
			</div>
			<div class="news-list-footer">
			    <span>
					<a href="news.php?action=view&admin=true&page=<?php echo $this->pagination->pageCurrent ?>&id=<?php echo $object->id ?>">> Lire la suite</a>
				</span>
			    <span class="admin">
			    	<a href="news.php?action=update&id=<?php echo $object->id ?>">Modifier</a>
			    </span>
			    <span class="admin <?php echo $stateButtonClass ?>">
			    	<a href="news.php?action=changeState&id=<?php echo $object->id ?>&currentState=<?php echo $object->state ?>">
			    		<?php echo $stateLabel ?>
			    	</a>
			    </span>
			    <span class="admin admin-ko">
			    	<a href="news.php?action=delete&id=<?php echo $object->id ?>">Supprimer</a>
			    </span>
				<?php include($this->path . '/lib/includes/util/social.inc') ?>
			</div>
		</div>
		<?php } ?>
		<div class="pagination">
			<?php include($this->path . '/lib/includes/util/pagination.inc'); ?>
		</div>
	</div>
</div>