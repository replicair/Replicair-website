<div id="middle-mid">
	<?php include('../lib/includes/nav/nav-admin.inc'); ?>
	<div id="content" class="content-normal">
		<ul class="pressreview-list">
		<?php
		foreach($this->list as $object) {
			if ($object->state == 0) {
				$stateButtonClass="admin-ko";
				$stateLabel="Activer";
			} else {
				$stateButtonClass="admin-ok";
				$stateLabel="Désactiver";
			}
		?>
				<li>
					<span class="pressreview-title">
						<?php echo $object->source ?>
						<?php
						if ($object->url != NULL and $object->url != "") { 
							echo "<a href='".$object->url."' target='blank'>".$object->label."</a>";
						}
						else {
							echo $object->label;
						}
						if ($object->file != null and $object->file != "") {
							if ($object->fileType == "pdf") {
								echo " - <a href='".$this->rootImg."lib/script/download.php?type=pressreview&filename=".$object->file."'><img src='".$this->root."img/icons/pdf.gif' alt='".$object->file."' /></a>";
							}
							else {
								echo " - <a href='".$this->rootImg."lib/script/download.php?type=pressreview&filename=".$object->file."'>".$object->file."</a>";
							}
						}
						?>
					</span>
					<span class="pressreview-complement">
						<?php echo $object->dateFormatted ?>
						-
						<?php echo $object->author ?>
					</span>
					<span class="admin <?php echo $stateButtonClass ?>">
			    			<a href="press_review.php?action=changeState&page=<?php echo $this->pagination->pageCurrent ?>&id=<?php echo $object->id ?>&currentState=<?php echo $object->state ?>">
			    				<?php echo $stateLabel ?>
			    			</a>
			    	</span>
			    	<span class="admin">
			    			<a href="press_review.php?action=update&page=<?php echo $this->pagination->pageCurrent ?>&id=<?php echo $object->id ?>">Modifier</a>
			    	</span>
			    	<span class="admin admin-ko">
			    		<a href="press_review.php?action=delete&page=<?php echo $this->pagination->pageCurrent ?>&id=<?php echo $object->id ?>">Supprimer</a>
			    	</span>
				</li>
		<?php } ?>
		</ul>
		<div class="pagination">
			<?php include('../lib/includes/util/pagination.inc'); ?>
		</div>
	</div>
</div>