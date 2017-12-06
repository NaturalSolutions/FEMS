<?php
/**
// Exit if accessed directly
// Don't duplicate me!
if( !class_exists( 'ReduxFramework_Extension_ow_repeater' ) ) {
    /**
        // Protected vars
        /**
        public function __construct( $parent ) {
            add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/'.$this->field_name, array( &$this, 'overload_field_path' ) ); // Adds the local field
    } // class