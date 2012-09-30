<div id="middle-mid">
	<?php include('../lib/includes/nav/nav-admin.inc'); ?>
	<div id="content" class="content-extended">
		<?php if ($this->action == 'create') { ?>
		<h3 class="admin">Créer un Article</h3>
		<?php } else { ?>
		<h3 class="admin">Modifier un Article</h3>
		<?php }?>
		<form action="article.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="object_id" value="<?php echo $this->object->id; ?>" />
 			<p class="form">
 				<label class="simple" for="form-title" title="Titre de cet article. Si à vide, aucun titre ne sera affiché">Titre</label>				
 				<input class="simple" type="text" id="form-title" name="object_title" value="<?php echo htmlspecialchars($this->object->title); ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-category" title="Choisissez une catégorie pour définir à quelle partie sera rattaché cet article">Categorie</label>
 				<select id="form-category" name="object_category">
 					<?php
 					foreach ($this->object->categories as $value => $label) {
 						$selected = '';
 						if($this->object->category == $value) {
 							$selected = 'selected="selected"';
 						}
 						?>
 						<option value="<?php echo $value ?>" <?php echo $selected ?>><?php echo $label ?></option>
 						<?php
 					}
 					?>
				</select>		
 			</p>
 			<p class="form">
 				<label class="simple" for="form-position" title="Un entier (1, 2, 3...) qui définira la position de l'article dans la pagination">Position</label>				
 				<input class="simple" type="text" id="form-position" name="object_position" value="<?php echo $this->object->position; ?>"/>
 			</p>
 			<p class="form">
 				<label class="textarea" for="form-contentShow" title="Contenu visible à droite de l'image, il ne doit pas être trop grand.">Contenu visible</label>
 				<textarea class="ckeditor" type="text" id="form-contentShow" name="object_contentShow"><?php echo $this->object->contentShow; ?></textarea>
 			</p>
 			<p class="form">
 				<label class="textarea" for="form-contentHidden" title="Contenu supplémentaire non affiché lors de l'accès à la catégorie de l'article. Il sera affiché après le contenu visible si l'on choisi de visualiser l'article complet.">Contenu masqué</label>
 				<textarea class="ckeditor" type="text" id="form-contentHidden" name="object_contentHidden"><?php echo $this->object->contentHidden; ?></textarea>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-image" title="Image de l'article, idéalement 441x238 (ancienne taille des images d'articles)">Image</label>
 				<input class="file" type="file" id="form-image" name="file" />
 			</p>
 			<p class="form">
 				<input class="submit" type="submit" name="<?php echo $this->action; ?>" />
 			</p>
		</form> 
	</div>
</div>