<?php
/**
 * Meta Box
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'PLUGIN_Meta_box' ) ) {

	/**
	 * Class PLUGIN_Meta_box.
	 */
	class PLUGIN_Meta_box {
        /**
		 *  Constructor.
		 */
		public function __construct() {
             add_action("add_meta_boxes",array( $this,"register_metabox"));
             add_action("save_post",array( $this,"save_values"),10,2);
        }


        // Register Custom Post Type project
        public function register_metabox(){
             add_meta_box( "cpt-id", "Details",array( $this, "call_metabox"), "projects","side","high");
        }
       
        public function call_metabox($post){
        ?>
           <p>
            <label> Name </label>
            <?php  $name = get_post_meta($post->ID,"post_name",true) ?>
            <input type="text" value="<?php echo $name ?>" name="textName" placeholder="Name"/>
           </p>
           <p>
            <label> Email </label>
            <?php  $email = get_post_meta($post->ID,"post_email",true) ?>
            <input type="email" value="<?php echo $email ?>" name="textEmail" placeholder="Email"/>
           </p>
       <?php
        } 

        // getting data from (custom field) metabox
        public function save_values($post_id, $post){
        
            $textName = isset($_POST['textName'])?$_POST['textName']:"";
            $textEmail = isset($_POST['textEmail'])?$_POST['textEmail']:"";
        
            update_post_meta( $post_id,"post_name",$textName);
            update_post_meta( $post_id,"post_email",$textEmail);
         }

    }
}
new PLUGIN_Meta_box();

  