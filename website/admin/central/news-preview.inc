<div id="middle-mid">
	<?php include($this->path . '/lib/includes/nav/nav-admin.inc'); ?>
	<?php 
		$object = $this->object;
		if ($object->state == 0) {
				$stateButtonClass="admin-ko";
				$stateLabel="Activer";
			} else {
				$stateButtonClass="admin-ok";
				$stateLabel="Désactiver";
			}
	?>
	<div id="content" class="content-normal">
		<div id="news-control" style="height: 20px;width:790px;">
			<a href="news.php?action=list&page=<?php echo $this->page ?>">
			<img  class="close"  src="<?php echo $this->root ?>img/style/close.png" alt="fermer" />
			</a>
		</div>
		<div id="news" class="news">
			<h1><?php echo $object->title ?></h1>
			<img src="<?php echo $this->fileLocation . $object->filename ?>" alt="<?php $object->filename ?>" />
			<!-- 
			<div class="news-content"> -->
			<?php echo $object->content ?>
			<!-- </div>-->
		</div>
		<div class="news-actions">
			<!-- <img src="/img/social/comment.jpg" alt="comment" />-->
			<?php include($this->path . '/lib/includes/util/social.inc') ?>
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
		</div>
	</div>
	<?php include($this->path . '/lib/includes/util/news-panel.inc'); ?>
	<script>
		(function($){
			$(window).load(function(){
				$("#news").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
			});
		})(jQuery);
	</script>
</div>