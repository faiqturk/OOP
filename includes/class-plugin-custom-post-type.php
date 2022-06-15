<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    /**
	 * Class Custom_Post.
	 */
	class Custom_Post {

		/**
		 *  Constructor.
		 */
		public function __construct() {

            add_action( 'init', array( $this, 'cpf_custom_post_type'));
            add_filter( 'archive_template',  array( $this, 'plugin_archive_template') ) ;

        }
        /**
		 *  Custom Post Type Function.
		 */
        public function cpf_custom_post_type(){

            $labels = array(
                'name'                  => __( 'projects'),
                'singular_name'         => __( 'project'),
                'menu_name'             => __( 'projects'),
                'name_admin_bar'        => __( 'project'),
                'add_new'               => __( 'Add New'),
                'add_new_item'          => __( 'Add New project'),
                'new_item'              => __( 'New project'),
                'edit_item'             => __( 'Edit project'),
                'view_item'             => __( 'View project'),
                'all_items'             => __( 'All projects'),
                'search_items'          => __( 'Search projects'),
                'parent_item_colon'     => __( 'Parent projects:'),
                'not_found'             => __( 'No projects found.'),
                'not_found_in_trash'    => __( 'No projects found in Trash.'),
                'featured_image'        => __( 'Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'movie' ),
                'set_featured_image'    => __( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'movie' ),
                'remove_featured_image' => __( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'movie' ),
                'use_featured_image'    => __( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'movie' ),
                'archives'              => __( 'movie archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'movie' ),
                'insert_into_item'      => __( 'Insert into movie', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'movie' ),
                'uploaded_to_this_item' => __( 'Uploaded to this project', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'movie' ),
                'filter_items_list'     => __( 'Filter projects list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'movie' ),
                'items_list_navigation' => __( 'projects list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'movie' ),
                'items_list'            => __( 'projects list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'movie' ),
            );     
            $args = array(
                'labels'             => $labels,
                'description'        => 'project custom post type.',
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'project' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => 20,
                'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ,'post-formats'),
                'taxonomies'         => array( 'category', 'post_tag' ),
                'show_in_rest'       => true
            );
            register_post_type( 'projects', $args );
        }

        
        public function plugin_archive_template( $archive ) {
            // print_r("archive");
            // die();
           
                $archive = FIRST_ABSPATH . '/template/archive-project.php';
            
                return $archive;
                // var_dump($archive);
        }
    }
new Custom_Post();