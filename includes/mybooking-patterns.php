<?php
/**
*		BLOCK PATTERNS
*  	--------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking WordPress Theme
*   @since Mybooking Rent Engine 1.0.3
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function mybooking_register_block_patterns() {


    if ( function_exists('register_block_pattern_category') ) {

        /**
         * Register block categories
         */
        register_block_pattern_category('mybooking', [
            'label' => _x('Mybooking', 'Block pattern category', 'mybooking-wp-plugin')
        ]);

    }

    if ( function_exists('register_block_pattern') ) {

        /**
         * Register Classic Selector
         */
        register_block_pattern('mybooking-block-patterns/selector-classic', [
            'title' => _x('Classic Selector', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Classic dates selector form', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['selector', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_selector]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Wizard Selector
         */
        register_block_pattern('mybooking-block-patterns/selector-wizard', [
            'title' => _x('Wizard Selector', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Wizard dates selector form', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['wizard', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_selector_wizard]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Transfer Selector
         */
        register_block_pattern('mybooking-block-patterns/selector-transfer', [
            'title' => _x('Transfer Selector', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Transfer dates selector form', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['transfer', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_wizard_selector]<!-- /wp:shortcode -->',
        ]);

        /**
         * Register Choose Product
         */
        register_block_pattern('mybooking-block-patterns/choose', [
            'title' => _x('Choose Product', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('List of your product groups or categories from Mybooking backend', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['choose', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_product_listing]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Choose Transfer
         */
        register_block_pattern('mybooking-block-patterns/choose-transfer', [
            'title' => _x('Choose Transfer', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('List of your transfers from Mybooking backend', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['choose', 'transfer', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_transfer_choose_vehicle]<!-- /wp:shortcode -->',
        ]);


        /**
         * Register Complete Reservation
         */
        register_block_pattern('mybooking-block-patterns/complete', [
            'title' => _x('Complete Reservation', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Complete reservation page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['complete', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_complete]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Complete Activities
         */
        register_block_pattern('mybooking-block-patterns/complete-activities', [
            'title' => _x('Complete Activities', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Complete reservation activities page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['complete-activities', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_shopping_cart]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Complete Transfers
         */
        register_block_pattern('mybooking-block-patterns/complete-transfers', [
            'title' => _x('Complete Transfers', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Complete reservation transfers page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['complete-transfers', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_transfer_checkout]<!-- /wp:shortcode -->',
        ]);


        /**
         * Register Reservation Summary
         */
        register_block_pattern('mybooking-block-patterns/summary', [
            'title' => _x('Reservation Summary', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Reservation summary page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['summary', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_summary]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Activities Summary
         */
        register_block_pattern('mybooking-block-patterns/summary-activities', [
            'title' => _x('Activities Summary', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Activities summary page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['activities', 'summary', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_summary]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Transfers Summary
         */
        register_block_pattern('mybooking-block-patterns/summary-transfer', [
            'title' => _x('Transfers Summary', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Transfers summary page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['transfer', 'summary', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_transfer_summary]<!-- /wp:shortcode -->',
        ]);

        /**
         * Register Reservation
         */
        register_block_pattern('mybooking-block-patterns/reservation', [
            'title' => _x('Reservation', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Reservation page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['reservation', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_reservation]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Activities Reservation
         */
        register_block_pattern('mybooking-block-patterns/reservation-activities', [
            'title' => _x('Activities Reservation', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Activities reservation page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['activities', 'reservation', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_order]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Transfers Reservation
         */
        register_block_pattern('mybooking-block-patterns/reservation-transfers', [
            'title' => _x('Transfers Reservation', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Transfers reservation page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['transfers', 'reservation', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_transfer_reservation]<!-- /wp:shortcode -->',
        ]);

        /**
         * Register Vehicle Catalog
         */
        register_block_pattern('mybooking-block-patterns/catalog', [
            'title' => _x('Vehicle Catalog', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Insert a list of vehicles with links to details pages', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['catalog', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_rent_engine_products]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Activities Catalog
         */
        register_block_pattern('mybooking-block-patterns/catalog-activities', [
            'title' => _x('Activities Catalog', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Insert a list of activities with links to details pages', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['activities', 'catalog', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_activities]<!-- /wp:shortcode -->',
        ]);

        /**
         * Register Calendar Camper/Charter
         */
        register_block_pattern('mybooking-block-patterns/calendar-camper', [
            'title' => _x('Calendar Camper', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Insert a calendar for a camper or charter detail page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['calendar', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_renting_engine_product code=]<!-- /wp:shortcode -->',
        ]);
        /**
         * Register Calendar Activities
         */
        register_block_pattern('mybooking-block-patterns/calendar-activities', [
            'title' => _x('Calendar Activities', 'Block pattern title', 'mybooking-wp-plugin'),
            'description' => _x('Insert a calendar for an activity detail page', 'Block pattern description', 'mybooking-wp-plugin'),
            'categories' => ['mybooking'],
            'keywords' => ['calendar', 'mybooking'],

            'content' => '<!-- wp:shortcode -->[mybooking_activities_engine_activity activity_id=]<!-- /wp:shortcode -->',
        ]);


    }

}
add_action('init', 'mybooking_register_block_patterns');
?>
