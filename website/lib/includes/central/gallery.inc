<div id="general" class="compact" style="text-align:center;">
	<div id="galleria" class="carrousel">
	    <!-- <img src="content/photos/photo1.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">
	    <img src="content/photos/photo2.jpg">
	    <img src="content/photos/photo3.jpg">-->
	</div>
	<script>
	//<![CDATA[
	(function(jQuery) {
	// chargement du thème alaska;
	Galleria.loadTheme("galleria/themes/alaska/galleria.alaska.js");
	Galleria.configure({
	    thumbCrop: false,
	    lightbox: true,
	    height: 450,
	    width: 790
	});
	/*
		pleins de façons de faire mais la moins "gourmande" je trouve est via JSON (avec un ajax et tout).
		de cette façon il charge que les miniatures (si le serveur peut en générer) 
		et pas les images pleine taille (charge seulement sur demande)
		http://galleria.io/docs/getting_started/quick_start/ 
	*/
	var datas = [
			{
			/* lien sur l'image */
			"link" : "http://google.fr",
			/* image en plein écran */
			"big" : "img/orly.png",
			/* image normale dans le caroussel */
			"image" : "img/rainbow.png",
			/* image dans la liste des thumbs */
			"thumb": "img/squirel_min.png",
			/* titre qui apparaitra dans info (que j'ai pas masqué via les options) */
			"title": 'image',
			"description": "blabla blabla"
			},
			{
			"image" : "img/rainbow.png",
			"thumb": "img/rainbow_min.png",
			"title": 'image'
			},
			{
			"image" : "img/orly.png",
			"thumb": "img/orly_min.png",
			"title": 'image'
			},
			{
			"image" : "img/yarly.png",
			"thumb": "img/yarly_min.png",
			"title": 'image'
			},
			{
			"image" : "img/ohnoes.png",
			"thumb": "img/ohnoes_min.png",
			"title": 'image'
			},
			{
			"image" : "img/rainbow.png",
			"thumb": "img/rainbow_min.png",
			"title": 'image'
			},
			{
			"image" : "img/nowai.png",
			"thumb": "img/nowai_min.png",
			"title": 'image'
			},
			{
			"image" : "img/war.png",
			"thumb": "img/war_min.png",
			"title": 'image'
			},
			{
			"image" : "img/godzilla.png",
			"thumb": "img/godzilla_min.png",
			"title": 'image'
			},
			{
				"image" : "img/orly.png",
				"thumb": "img/orly_min.png",
				"title": 'image'
				},
				{
				"image" : "img/yarly.png",
				"thumb": "img/yarly_min.png",
				"title": 'image'
				},
				{
				"image" : "img/ohnoes.png",
				"thumb": "img/ohnoes_min.png",
				"title": 'image'
				},
				{
					"image" : "img/orly.png",
					"thumb": "img/orly_min.png",
					"title": 'image'
					},
					{
					"image" : "img/yarly.png",
					"thumb": "img/yarly_min.png",
					"title": 'image'
					},
					{
					"image" : "img/ohnoes.png",
					"thumb": "img/ohnoes_min.png",
					"title": 'image'
					}
		];
	jQuery(document).ready(function() {			
		jQuery(".carrousel").galleria({ "dataSource" : datas });
	});
	
	})(jQuery);
	//]]>

     </script>
</div>
<div style="clear: both"></div>
