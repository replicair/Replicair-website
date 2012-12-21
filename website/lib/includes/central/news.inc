<?php $object = $this->object ?>
<div id="news-control" style="height: 20px;width:790px;">
			<a href="news-list.php?page=<?php echo $this->page ?>">
				<img  class="close"  src="img/style/close.png" alt="fermer"" />
			</a>
		</div>
<div id="news" class="news" style="overflow: auto;">
	<h1><?php echo $object->title ?></h1>
	<img src="<?php echo $this->fileLocation . $object->filename ?>" alt="<?php $object->filename ?>" />
	<!-- <div class="news-content"> -->
	<?php echo $object->content ?>
	<!-- </div> -->
</div>
<div class="news-actions">
	<!-- <img src="/img/social/comment.jpg" alt="comment" />-->
	<?php //include($this->path . '/lib/includes/util/social.inc') ?>
</div>
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