<script type="text/javascript">
	if (swfobject.hasFlashPlayerVersion("9.0.124.0"))
	{
	    var flashvars = {
	      LINK_URL: "http://www.fondation-patrimoine.org/fr/haute-normandie-11/fiscalite-531/calculez-votre-avantage-fiscal-541",
	      LINK_TARGET: "_self",
	      VALIDATE_STR: "CALCULEZ",
	      TITLE_STR: "POUR VOS DONS CALCULEZ VOTRE AVANTAGE FISCAL",
	      LINK_STR: "en savoir plus",
	      GIVE_STR: "Vous donnez :",
	      GAIN_STR: "Vous bénéficiez d'une réduction d'impôt de :",
	      SUBJECT_STR: "Vous êtes soumis à :",
	      TAX_STR: "l'impôt sur le revenu",
	      WEALTH_STR: "l'ISF",
	      COMPANY_STR: "l'impôt sur les sociétés"
	    };
	    var params = { allowScriptAccess: "Always", showMenu: false, wmode:"transparent" };
	    var attributes = {};
	    swfobject.embedSWF("calcul.swf", "calcul", "179", "276", "9.0.124.0", "http://www.fondation-patrimoine.org/inc/swf/expressInstall.swf", flashvars, params, attributes);
	} else {
	
	    var str = '<br /><br /><br /><br />' +
	                '<p><em>Vous devez installer une version plus récente de Flash Player pour visualiser ce contenu.</em>' +
	                '<br />' +
	                '<a href="http://www.adobe.com/go/getflashplayer"><strong>Cliquez ici pour télécharger la dernière version de Flash Player...</strong></a></p>' +
	                '<br />' +
	                '<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.fondation-patrimoine.org/inc/im/get_flash_player.gif" alt="Get Adobe Flash player" border="0" /></a>';
	    document.getElementById("calcul").innerHTML = str;
	}
</script>