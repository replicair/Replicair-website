<div id="content_top">
	<?php
	$article = $this->list[0];
	?>
	<script>
		function showHideArticle(action) {
			if (action == 'show') {
				$('#video').css("display", "none");
				$('#surarticle').css('z-index',0);
				$('#surarticle').animate({
				    opacity: 1,
				  }, 1000, function() {
				    // Animation complete.
				  });
			}
			if (action == 'hide') {
				$('#surarticle').animate({
				    opacity: 0,
				  }, 3000, function() {
					  $('#video').css("display", "block");
					  $('#surarticle').css('z-index',-100);
				  });
				
			}
		};
	</script>
	<?php if ($article->contentHidden != NULL) { ?>
	<div id="surarticle" style="opacity: 0;z-index:-100;display:block;background-color:white;width:793px;height:500px; padding-left: 38px; padding-right: 38px;position: absolute; top:300px; left: 250px;; margin:-300px auto auto -250px; overflow: auto;background:url('img/layout/layout-central-carnet.png') no-repeat center ;">
		<div id="article_actions" style="height: 20px;width:790px;">
				<img  class="close"  src="img/style/close.png" alt="fermer" onclick="showHideArticle('hide');" />
		</div>
		<div id="article" style="height: 430px;width:790px;">
		<img style="display: block;margin: auto;" src="<?php echo $article->fileDefaultLocation . $article->filename ?>" />
		<h3 style="text-align: center;"><?php echo $article->title ?></h3>
		<?php echo $article->contentShow ?>
		<?php echo $article->contentHidden ?>		
		</div>
	</div>
	<script>
		(function($){
			$(window).load(function(){
				$("#article").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
			});
		})(jQuery);
	</script>
	<?php } ?>
	<div class="article_img">
		<img src="<?php echo $article->fileDefaultLocation . $article->filename ?>" />
		<?php include($this->path . '/lib/includes/util/pagination_article.inc') ; ?>
	</div>
	<div id="article_content_container" class="article_content" style="overflow: show">
		<h3><?php echo $article->title ?></h3>
		
			<?php echo $article->contentShow ?>
		<?php if ($article->contentHidden != NULL) { ?>
		<a class="normal" href="#nogo" onclick="showHideArticle('show');">Lire l'article complet...</a>
		<?php } ?>
	</div>
</div>