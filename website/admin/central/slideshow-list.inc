<div id="middle-mid">
	<?php include('../lib/includes/nav/nav-admin.inc'); ?>
	<div id="content" class="content-extended">
		<?php foreach($this->list as $object) {
			if ($object->state == 0) {
				$stateButtonClass="admin-ko";
				$stateLabel="Activer";
			} else {
				$stateButtonClass="admin-ok";
				$stateLabel="Désactiver";
			}
		?>
			<div class="slides_container">
                <div class="slides_content">
                	<div class="slide_desc">
                		<h3><?php echo $object->title ?></h3>
                		<h4><?php echo $object->subtitle ?></h4>
                		<p><?php echo $object->content ?></p>
                	</div>
                	<img src="<?php echo $this->fileLocation.$object->filename ?>" alt="slideshow-image" />
                </div>
            </div>
			<div class="slideshow-admin-footer">
			    <span class="admin">
			    	<a href="slideshow.php?action=update&id=<?php echo $object->id ?>">Modifier</a>
			    </span>
			    <span class="admin <?php echo $stateButtonClass ?>">
			    	<a href="slideshow.php?action=changeState&id=<?php echo $object->id ?>&currentState=<?php echo $object->state ?>">
			    		<?php echo $stateLabel ?>
			    	</a>
			    </span>
			    <span class="admin admin-ko">
			    	<a href="slideshow.php?action=delete&id=<?php echo $object->id ?>">Supprimer</a>
			    </span>
			</div>
		<?php } ?>
		<div class="pagination">
			<?php include('../lib/includes/util/pagination.inc'); ?>
		</div>
	</div>
</div>