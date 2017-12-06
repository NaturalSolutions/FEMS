<?php
/* Check string for Null or Empty */
if ( ! function_exists( 'museumwp_checkstring' ) ) :
	function museumwp_checkstring( $strValue ) {
		if ( !isset( $strValue ) || trim( $strValue ) === '' ) :
			return false;
		else :
			return true;
		endif;
	}
endif;

/* Check string for Null or Empty & Print It */
if ( ! function_exists( 'museumwp_content' ) ) :
	function museumwp_content( $before_val, $after_val, $val ) {

		if( $val != "" ) {
			return $before_val.$val.$after_val;
		}
		else {
			return "";
		}
	}
endif;

/* Custom Excerpt Limit */
if ( ! function_exists( 'museumwp_custom_excerpts' ) ) :
	function museumwp_custom_excerpts( $limit ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if ( count($excerpt) >= $limit ) :
		
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt);//'...';
		
		else :
		
			$excerpt = implode(" ",$excerpt);
		
		endif; 

		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}
endif;

/* --------------------------------------------- */

/* Redux Options */
if( !function_exists('museumwp_options') ) :

	function museumwp_options( $option, $arr = null ) {

		global $museumwp_option;

		if( $arr ) {

			if( isset( $museumwp_option[$option][$arr] ) ) {
				return $museumwp_option[$option][$arr];
			}
		}
		else {
			if( isset( $museumwp_option[$option] ) ) {
				return $museumwp_option[$option];
			}
		}
	}

endif;
?>