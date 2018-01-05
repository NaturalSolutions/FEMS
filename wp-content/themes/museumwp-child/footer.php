<?php 
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Museumwp
 * @since Museumwp 1.0
 */
	if( has_nav_menu('footer') ) {
		$footer_menu_css = "";
	}
	else {
		$footer_menu_css = " menu-disabled";
	}

	$siteUrlFb = esc_url(home_url("/"))."/wp-content/uploads/2017/11/logo-fb-rond-59x59.png";
	$siteUrlTw = esc_url(home_url("/"))."/wp-content/uploads/2017/12/twitter-59x59.png";
	$siteUrlSI = esc_url(home_url("/"))."/wp-content/uploads/2017/11/scoopit-icon-59x59.png";
	$siteUrlTri = esc_url(home_url("/"))."/wp-content/uploads/2017/12/triangleViolet.png";
	$siteUrlAdh = esc_url(home_url("/"))."adherer-sabonner/";
	$siteUrlFede = esc_url(home_url("/"))."quest-ce-quun-ecomusee/"; 
?>
		<!--======= FooterCustom =========-->
		<footer>
		<img src="<?php echo($siteUrlTri);?>">
			<div class="col-md-12 footerCustom">
				<div id="suivezNous" class="col-md-4">
					<h3>Suivez nous</h3></br>
					<p>
						<a href="#"><img src="<?php echo($siteUrlFb);?>"></a>
						<a href="#"><img src="<?php echo($siteUrlTw);?>"></a>
						<a href="https://www.scoop.it/u/fems1"><img src="<?php echo($siteUrlSI);?>"></a>
					</p>
					<a class="boutonFooter" href="<?php echo($siteUrlAdh);?>" role="button">Adhérer</a>
				</div>
				<div id="rubriques" class="col-md-4">
					<h3>Rubriques</h3>
					<ul>
						<li>
							<a href="<?php echo(esc_url(home_url("/"))."quest-ce-quun-ecomusee/"); ?>">La Fédération</a>
						</li>
						<li>
							<a href="<?php echo(esc_url(home_url("/"))."qui-sont-ils/"); ?>">Les adhérents</a>
						</li>
						<li>
							<a href="<?php echo(esc_url(home_url("/"))."rencontres-professionnelles/"); ?>">Nos actions</a>
						</li>
						<li>
							<a href="<?php echo(esc_url(home_url("/"))."offres-demplois/"); ?>">Les annonces</a>
						</li>
						<li>
							<a target="blanck" href="http://www.madeinmusees.com/">Made in Musée</a>
						</li>
						<li>
							<a href="<?php echo(esc_url(home_url("/"))."echanges-adherents/"); ?>">Espace adhérents</a>
						</li>
						<li>
							<a href="<?php echo(esc_url(home_url("/"))."ressources/"); ?>">Ressources</a>
						</li>
					</ul>
				</div>
				<div id="contactFooter" class="col-md-4">
					<h3>Contact</h3>
					<b>Fédération des écomusées et des</br> musées de société</b></br>
					1, esplanade du J4 - CS 10351</br>13213 MARSEILLE cedex 02</br>
					<b>04 84 35 14 87</b></br>
					contact@fems.asso.fr</br>
					</br>
					Horaires d'accueil téléphonique :</br>
					Du lundi au jeudi de 10h à 17h et le</br>
					vendredi de 10h à 13h
				</div>
			</div>
		</footer>

	</div>
	<?php wp_footer(); ?>
</body>
</html>