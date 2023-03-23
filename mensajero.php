<?php
/*
Plugin Name: Woo plugin
Description: demo/sample plugin
Version: 1.0
Author: Zarrar aka Zony
Author URI:  https://linkedin.com/in/muhammadzarrar
Author URI2: https://www.fiverr.com/zony101
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'plugins_loaded', function(){
    $instance = new WooDemo;
    $instance->init();
});

class WooDemo{
    public $plugin_unique_id = 'woo_demo';
    private static $instance = null;

    private function __construct() {
    }
 
    public static function getInstance() {
       if (self::$instance == null) {
          self::$instance = new Sample();
       }
       return self::$instance;
    }

    public function init(){
        $this->demo_define_constants();
        if ( class_exists( 'WC_Payment_Gateway' ) ) :
            $this->demo_includes();
            add_filter( 'plugin_action_links_' . demo_BASENAME,array($this,'demo_plugin_setting'));
            add_action( 'woocommerce_cart_calculate_fees', array($this,'add_cargo_fee') );
           // removed
        else : 
            add_action( 'admin_notices', array( $this, 'woocommerce_missing_notice_for_demo' ) );
        endif;
    }

    private function demo_define_constants()
        {
            $this->demo_define( 'demo_plugin_url', plugin_dir_url( __FILE__ ) );
            $this->demo_define( 'demo_ABSPATH', dirname( __FILE__ ) );
            $this->demo_define( 'demo_BASENAME', plugin_basename( __FILE__ ) );
        }

    private function demo_define( $name, $value )
        {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }
    private function demo_includes()
        {
            if ( ! class_exists( 'demo_Gateway' ) ) :
                include_once demo_ABSPATH . '/includes/gateway_class.php';
                new DemoGateway();
            endif;
        }

    public function demo_plugin_setting($links)
        {
            if( current_user_can( 'manage_woocommerce' ) ) {
                $plugin_links = array(
                '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section='.$this->plugin_unique_id).'">' . __( 'Settings', $this->plugin_unique_id ) . '</a>',
                );
                return array_merge( $plugin_links, $links );
            }
            return $links;
        }

    public function woocommerce_missing_notice_for_demo()
        {
            echo '<div class="error woocommerce-message wc-connect"><p>' . sprintf( __( 'Sorry, <strong>demo plugin</strong> requires WooCommerce to be installed and activated first' ) ) . '</p></div>';
        }

    public function add_cargo_fee() {
        //code removed    
    }

    public function checkout_on_payment_methods_change(){
        //code removed  
    }

    public function demo_save_custom_fields_external( $order_id )
    {
        //code removed  
    }
}
