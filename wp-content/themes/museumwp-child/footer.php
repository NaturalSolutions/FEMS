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
?>
		<!--======= FooterCustom =========-->
		<footer>
		<img src="http://localhost/FEMS/wp-content/uploads/2017/12/Plan-de-travail-1.png">
			<div class="col-md-12 footerCustom">
				<div class="col-md-4 center">
					<h3>Suivez nous</h3></br>
					<p>
						<a href="#"><img src="http://localhost/FEMS/wp-content/uploads/2017/11/logo-fb-rond-59x59.png"></a>
						<a href="#"><img src="http://localhost/FEMS/wp-content/uploads/2017/11/logo-twitter-59x59.png"></a>
						<a href="https://www.scoop.it/u/fems1"><img src="http://localhost/FEMS/wp-content/uploads/2017/11/scoopit-icon-59x59.png"></a>
					</p>
					<a class="boutonFooter" href="http://localhost/FEMS/adherer-sabonner/" role="button">Adhérer</a>
				</div>
				<div class="col-md-4 center">
					<h3>Rubriques</h3>
					<ul>
						<li>
							<a href="#">La Fédération</a>
						</li>
						<li>
							<a href="#">Les adhérents</a>
						</li>
						<li>
							<a href="#">Nos actions</a>
						</li>
						<li>
							<a href="#">Les annonces</a>
						</li>
						<li>
							<a href="#">Made in Musée</a>
						</li>
						<li>
							<a href="#">Echanges adhérents</a>
						</li>
						<li>
							<a href="#">Ressources</a>
						</li>
					</ul>
				</div>
				<div class="col-md-4">
					<h3>Contact</h3>
					<b>Fédération des écomusées et des</br> musées de société</b></br>
					1, esplanade du j4 - CS 10351</br>13213 MARSEILLE cedex 02</br>
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