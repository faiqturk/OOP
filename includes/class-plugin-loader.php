<?php
/**
 * Main Loader.
 *
 * @package plugin-customization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'plugin_Loader' ) ) {

	/**
	 * Class FIRST_Loader.
	 */
	class plugin_Loader {

		/**
		 *  Constructor.
		 */
		public function __construct() {
			$this->includes();
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			// Search
			add_action('wp_ajax_data_fetch' , array( $this, 'data_fetch'));
			add_action('wp_ajax_nopriv_data_fetch', array( $this,'data_fetch'));
			// ASC and DESC
			add_action('wp_ajax_data_drop' , array( $this, 'data_drop'));
			add_action('wp_ajax_nopriv_data_drop' , array( $this, 'data_drop'));
			
		}

		/**
		 * Include Files depend on platform.
		 */
		public function includes() {
			include_once 'class-plugin-custom-post-type.php';
			include_once 'class-plugin-meta-box.php';
			include_once 'class-plugin-shortcode.php';
		}
		/**
		 * Enqueue Files.
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( 'script', plugin_dir_url( __DIR__ ) . 'assets/js/script.js', array('jquery'), wp_rand() );
    		wp_localize_script('script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));
			wp_enqueue_style('parent', plugin_dir_url( __DIR__ ) . '/assets/css/style.css');
			// print_r(plugin_dir_url(__DIR__). '/assets/css/style.css');die();
		}
		
		public function data_fetch(){

			$the_query = new WP_Query( array( 
				'posts_per_page' => 3, 
				's' => esc_attr( $_POST['keyword'] ), 
				'post_type' => 'project' ) );
			if( $the_query->have_posts() ) :?>
				
			<?php
				 while( $the_query->have_posts() ): $the_query->the_post();  ?>
					 <center> 
							<div style="background-color: lightblue; border: 1px solid black; float:left; width: 500px;margin: 5px;height: 300px;"> 
    						<h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
    						<a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
    						<p style="text-align: center;" ><?php the_content(); ?></p> 
							</div> 
					</center>
				<?php  
				endwhile; 
			endif;
			die();
			
		}
		public function data_drop() {


			$curentpage = get_query_var('paged');
			$args= array( 
				'paged' => $curentpage,
				'posts_per_page' => 4, 
				'orderby' => 'title',
				'order' => 'ASC',
				'post_type' => array('project') );
			if ($_POST['keyword'] == 'asc') {
				$args['order'] = 'ASC';
			}
			elseif ($_POST['keyword'] == 'desc') {
				$args['order'] = 'DESC';
			}
			if ($_POST['keyword'] == 'old') {
				$args['orderby'] = 'date';$args['order'] = 'ASC';
			}
			elseif ($_POST['keyword'] == 'new') {
				   $args['orderby'] = 'date';$args['order'] = 'DESC';
			}
		
		
			$the_query = new WP_Query($args);
			if( $the_query->have_posts() ) :
				ob_start();
				while( $the_query->have_posts() ): $the_query->the_post();  ?>
			   <center> 
		<div style="background-color: lightblue; border: 1px solid black; float:left; width: 500px;margin: 5px;height: 300px;"> 
			<h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
			<a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
			<p style="text-align: center;" ><?php the_content(); ?></p> 
		</div>  </center>
			<?php  
				endwhile; 
		
				
		
				$output_string = ob_get_contents();
				ob_end_clean();
				wp_die($output_string); 
				wp_reset_postdata(); 
		
				echo paginate_links(array(
					'total' => $query->max_num_pages
				));
		
			endif;
			die();
		
		
		
		}
	}
}

new plugin_Loader();