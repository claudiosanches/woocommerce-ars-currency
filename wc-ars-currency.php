<?php
/**
 * Plugin Name: WooCommerce ARS Currency
 * Plugin URI: http://claudiosmweb.com/
 * Description: Adds ARS (Argentine peso) currency in WooCommerce
 * Author: claudiosanches
 * Author URI: http://www.claudiosmweb.com/
 * Version: 2.0
 * License: GPLv2 or later
 */

if ( ! class_exists( 'WC_ARS_Currency' ) ) {

    /**
     * Add ARS Currency in WooCommerce.
     */
    class WC_ARS_Currency {

        /**
         * Class construct.
         */
        public function __construct() {

            // Actions
            add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 0 );

            // Filters.
            add_filter( 'woocommerce_currencies', array( $this, 'add_currency' ) );
            add_filter( 'woocommerce_currency_symbol', array( $this, 'currency_symbol' ), 1, 2 );
        }

        /**
         * Load Plugin textdomain.
         *
         * @return void.
         */
        public function load_textdomain() {
            load_plugin_textdomain( 'wcars', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        /**
         * Add ARS Currency in WooCommerce.
         *
         * @param  array $currencies Current currencies.
         *
         * @return array             Currencies with ARS.
         */
        public function add_currency( $currencies ) {
            $currencies['ARS'] = __( 'Argentine peso', 'wcars' );
            asort( $currencies );

            return $currencies;
        }

        /**
         * Add ARS Symbol
         *
         * @param  string $currency_symbol Currency symbol.
         * @param  array  $currency        Current currencies.
         *
         * @return string                  ARS currency symbol.
         */
        public function currency_symbol( $currency_symbol, $currency ) {
            switch( $currency ) {
                case 'ARS':
                    $currency_symbol = '&#36;';
                    break;
            }

            return $currency_symbol;
        }

    } // close WC_ARS_Currency class.

    $WC_ARS_Currency = new WC_ARS_Currency();
}
