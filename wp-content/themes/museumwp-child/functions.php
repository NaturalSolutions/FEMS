<?php
/**
 * Child theme functions
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 *
 * @since	1.0.0
 * @package Museumwp
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'museumwp_child_enqueue_styles' ) ) {

	// Add enqueue function to the desired action.
	add_action( 'wp_enqueue_scripts', 'museumwp_child_enqueue_styles', 11 );

	/**
	 * Enqueue Styles.
	 *
	 * Enqueue parent style and child styles where parent are the dependency
	 * for child styles so that parent styles always get enqueued first.
	 *
	 * @since 1.0.0
	 */
	function museumwp_child_enqueue_styles() {

		// Parent style variable.
		$parent_style = 'museumwp-stylesheet';

		// Enqueue Parent theme's stylesheet.
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

		// Enqueue Child theme's stylesheet.
		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
}

//------------------------------------------------------------------------------------------------------------------------------

if (!function_exists('chart_scripts_init')) {
	function chart_scripts_init(){
		wp_register_script('chart', get_template_directory_uri() . '/../museumwp-child/node_modules/chart.js/dist/Chart.min.js', array('jquery'),'1.1', true);
		wp_enqueue_script('chart');
	}
}
add_action('wp_enqueue_scripts', 'chart_scripts_init');


if(!function_exists('my_wpcf7_save')){
	function my_wpcf7_save($cfdata) {
		/*  source:   http://chamankumar.co.uk/blog/uncategorized/contact-form-7-add-uploaded-file-to-media-attach-to-custom-post  */

		$formtitle = $cfdata->title;

		global $wpdb;
		$form = WPCF7_Submission::get_instance();
		if ( $form ) {
			$formData = $form->get_posted_data();
			$uploaded_files = $form->uploaded_files(); 
		}

		$formId = $formData['_wpcf7'];

		// form observations
		if($formId == 396 ) {
					// create a new post
			$newpost = array(
			'post_type' => 'observations',
			'post_title' => $formData['especeObs'],
			'post_status' => 'publish');


			$newpostid = wp_insert_post($newpost);

			// add meta data for the new post

			if($formData['stadeDevHerb'] =="1" ) {
				add_post_meta($newpostid, 'stade_developpement', 'début de floraison');
			} 
			if($formData['stadeDevHerb'] =="2" ) {
				add_post_meta($newpostid, 'stade_developpement', 'pleine floraison');
			} 
			if($formData['stadeDevArb'] =="1" ) {
				add_post_meta($newpostid, 'stade_developpement', 'début de floraison');
			} 
			if($formData['stadeDevArb'] =="2" ) {
				add_post_meta($newpostid, 'stade_developpement', 'pleine floraison');
			} 
			if($formData['stadeDevArb'] =="3" ) {
				add_post_meta($newpostid, 'stade_developpement', 'début feuillaison');
			}
			if($formData['stadeDevArb'] =="4" ) {
				add_post_meta($newpostid, 'stade_developpement', 'milieu feuillaison');
			}
			if($formData['stadeDevArb'] =="5" ) {
				add_post_meta($newpostid, 'stade_developpement', 'pleine fructification');
			}
			if($formData['stadeDevArb'] =="6" ) {
				add_post_meta($newpostid, 'stade_developpement', 'début sénescence');
			}
			if($formData['stadeDevArb'] =="7" ) {
				add_post_meta($newpostid, 'stade_developpement', 'milieu de sénescence');
			}        




			add_post_meta($newpostid, 'taxon', $formData['especeObs']);
			add_post_meta($newpostid, 'station', $formData['stations']);
			
			
			add_post_meta($newpostid, 'date', $formData['dateObs']);
			add_post_meta($newpostid, 'heure', $formData['heureObs']);
			add_post_meta($newpostid, 'habitat', $formData['habitatObs']);
			/*add_post_meta($newpostid, 'temperature', $formData['temperature_obs']);
			add_post_meta($newpostid, 'ensoleillement', $formData['ensoleillementObs']);*/
			add_post_meta($newpostid, 'commentaire', $formData['commentaire']);

			// ajouter le nom scientifique

			$name = $formData['especeObs'];
			$query = array(
				'posts_per_page' => '-1',
				'post_type'=> 'taxon'
				);

			$st = new WP_Query($query);
			$scientificName = "";

			while($st->have_posts()) : $st->the_post();
					$nom = get_the_title();
					if($nom == $name) {
						$scientificName = get_post_meta( get_the_ID(), 'nom_scientifique', true);
					}
			endwhile;
			add_post_meta($newpostid, 'nom_scientifique', $scientificName);    




			/** generate alet if necessary  **/
			/* relgles pour l'alerte:

				-  une alerte par an pour les plantes herbacées et la faune ( premiere date saisie pour l'année en cours pour l'espèce en question)
				-  une alerte par stade phénologique à observer pour les arbres et les arbustes 

				checkGenerateAlert(date, taxa_type,espece, stade )
			*/
				checkGenerateAlert($formData['dateObs'], $formData['taxa_type'],$formData['especeObs'],$formData['stadeDevArb'] );

			// gestion de photo
			$userId = $formData['userId'];
			$image_name = $formData['photoObs'];
			$image_location = $uploaded_files["photoObs"];
			if(isset($image_location)){
				$image_content = file_get_contents($image_location);
			} else {
				$image_content=false;
			}

			if ($image_content==false){
				$check = 'content fail';
			} else {
				$check = 'content success';
			}
			$wud = wp_upload_dir();
			$upload = wp_upload_bits( $image_name, null, $image_content);
			$chemin_final = $upload['url']; 
			$filename= $upload['file']; 
			if ($filename>'') {
			require_once(ABSPATH . 'wp-admin/includes/admin.php');
			$wp_filetype = wp_check_filetype(basename($filename), null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $filename, $newpostid);
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			update_post_meta($newpostid, "_thumbnail_id", $attach_id);
			add_post_meta($newpostid, 'photo', $chemin_final); 
			}


		} else {
			//  form station
			$newpost = array(
			'post_type' => 'station',
			'post_title' => $formData['nom'],
			'post_status' => 'publish');


			$newpostid = wp_insert_post($newpost);

			// add meta data for the new post
			add_post_meta($newpostid, 'commune', $formData['commune']);
			add_post_meta($newpostid, 'latitude', $formData['latitude']);
			add_post_meta($newpostid, 'longitude', $formData['longitude']);
		}
	}
}