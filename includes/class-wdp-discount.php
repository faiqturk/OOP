<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WDP_Discount' ) ) {
    /**
	 * Class WDP_Discount.
	 */
	class WDP_Discount {

		/**
		 *  Constructor.
		 */
		public function __construct() {
            // The code for displaying WooCommerce Product Custom Fields
            add_action( 'woocommerce_product_options_general_product_data', array($this, 'wdp_woocommerce_product_input' )); 
            // Following code Saves  WooCommerce Product Custom Fields
            add_action( 'woocommerce_process_product_meta', array($this, 'wdp_woocommerce_product_save' ));
            // add_action('woocommerce_before_add_to_cart_button', array($this,'woocommerce_discount_display'));
            add_filter( 'woocommerce_get_price_html',array($this,'wdp_woocommerce_discount_calculation'));
        }
        
        /**
		 *  Discount Input Box Function.
		 */
        public function wdp_woocommerce_product_input () 
        {
            global $woocommerce;
            echo '<div class=" product_custom_field "> <p><input type="checkbox"> Add Discount in percent .</p>';
            woocommerce_wp_text_input(
                array(
                    'id'            => 'collect_product_id',
                    'placeholder'   => 'Insert Discount In %',
                    'label'         => '',
                    'desc_tip'      => 'true'
                    )
                );
            echo '</div>';
        }

        /**
		 *  Save Discount data Function.
		 */
        public function wdp_woocommerce_product_save($post_id)
        {
            $woocommerce_collect_product_id = $_POST['collect_product_id'];
            if (!empty($woocommerce_collect_product_id)){
                update_post_meta($post_id, 'collect_product_id', esc_attr($woocommerce_collect_product_id));
            }
        }
        /**
		 *  For fetch Discount price in userside.
		 */
        public function wdp_woocommerce_discount_calculation($price)
        {
          global $post;
          $product = wc_get_product($post->ID);
            $discount = $product->get_meta('collect_product_id');
            $regular_price = $product->get_regular_price();
            
          if ($discount > 0) {
            $price = $regular_price * ((100 - $discount)/ 100) ;
          } else {
            $price = $regular_price;
          }
            return 'Rs :'. $price;
        }
    }
}
new WDP_Discount();