<div id="content_subpart">
	<?php 
	$article = $this->list[0];
	if ($article->state == 0) {
		$stateButtonClass="admin-ko";
		$stateLabel="Activer";
	} else {
		$stateButtonClass="admin-ok";
		$stateLabel="Désactiver";
	}
	?>
	<div class="separator">&nbsp;</div>
	<div class="article_actions">
		<span class="admin">
			<a href="article.php?action=update&id=<?php echo $article->id ?>&category=<?php echo $article->category ?>">Modifier</a>
		</span>
		<span class="admin <?php echo $stateButtonClass ?>">
		  	<a href="article.php?action=changeState&id=<?php echo $article->id ?>&category=<?php echo $article->category ?>&currentState=<?php echo $article->state ?>">
				<?php echo $stateLabel ?>
		   	</a>
		</span>
		<span class="admin admin-ko">
		   	<a href="article.php?action=delete&id=<?php echo $article->id ?>&category=<?php echo $article->category ?>">Supprimer</a>
		</span>		
	</div>
</div> 