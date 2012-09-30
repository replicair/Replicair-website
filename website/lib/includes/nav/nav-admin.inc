<div id="nav-top">&nbsp;</div>
<div id="nav">
	<script type="text/javascript">
		$(document).ready(function(){
			$("#jMenu").jMenu({ ulWidth : 'auto', effects : { effectSpeedOpen : 300, effectTypeClose : 'slide' }, animatedText : false });
		});
	</script>
	<ul id="jMenu">
		<li class="admin"><a class="fNiv" href="index.php">Accueil</a></li>
		<li class="admin"><a class="fNiv">News</a>
			<ul>
				<li><a href="news.php?action=list">Gérer</a></li>
				<li><a href="news.php">Créer</a></li>
			</ul>
		</li>
		<li class="admin"><a class="fNiv">Revue</a>
			<ul>
				<li><a href="press_review.php?action=list">Gérer</a></li>
				<li><a href="press_review.php">Créer</a></li>
			</ul>
		</li>
		<li class="admin"><a class="fNiv">Slideshow</a>
			<ul>
				<li><a href="slideshow.php?action=list">Gérer</a></li>
				<li><a href="slideshow.php">Créer</a></li>
			</ul>
		</li>
		<li class="admin"><a class="fNiv">Articles</a>
			<ul>
				<li><a href="article.php?action=list&category=project">Gérer Projet</a></li>
				<li><a href="article.php?action=list&category=legend">Gérer Légende</a></li>
				<li><a href="article.php?action=list&category=replicair">Gérer Replicair</a></li>
				<li><a href="article.php">Créer</a></li>
			</ul>
		</li>
		<li class="admin"><a class="fNiv">Timeline</a>
			<ul>
				<li><a href="work.php">Gérer</a></li>
				<li><a href="work.php">Créer</a></li>
			</ul>
		</li>
	</ul>
</div>
