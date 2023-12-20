<?php
  class MyBookingPluginCPTProductSlider {

	  public function __construct()
	  {
	    	$this->register_post_type();
        add_action( 'add_meta_boxes', array( $this, 'add_metaboxes' ) );
        add_action( 'save_post', array( $this, 'add_metabox_data' ) );
	  }

    /*
     * Register Post Type
     */
	  private function register_post_type() {

        register_post_type( 'product-slider',
          array(
            'labels' => array(
              'name' => _x('Product Slider', 'slider_product', 'mybooking-wp-plugin'),
              'singular_name' => _x('Testimonial', 'slider_product', 'mybooking-wp-plugin'),
              'add_new' => _x('Add slider', 'slider_product', 'mybooking-wp-plugin'),
              'add_new_item' => _x('New slider', 'slider_product', 'mybooking-wp-plugin'),
              'edit' => _x('Edit', 'slider_product', 'mybooking-wp-plugin'),
              'edit_item' => _x('Edit slider', 'slider_product', 'mybooking-wp-plugin'),
              'new_item' => _x('New slider', 'slider_product', 'mybooking-wp-plugin'),
              'view' => _x('See', 'slider_product', 'mybooking-wp-plugin'),
              'view_item' => _x('See slider', 'slider_product', 'mybooking-wp-plugin'),
              'search_items' => _x('Search slider', 'slider_product', 'mybooking-wp-plugin'),
              'not_found' => _x('No slider found', 'slider_product', 'mybooking-wp-plugin'),
              'not_found_in_trash' => _x('No slider found on bin', 'slider_product', 'mybooking-wp-plugin'),
              'parent' => _x('Parent slider', 'slider_product', 'mybooking-wp-plugin')
            ),
            'show_ui' => true,
            'public' => true,
            'show_in_menu' => 'mybooking-plugin-configuration',
            'show_in_rest' => true, // Gutenberg activation!
            'supports' => array( 'title', 'thumbnail' ),
            'menu_icon' => 'dashicons-slides',
            'has_archive' => true
          )
        );

	  }

    /**
     * Add Metabox
     */ 
    public function add_metaboxes() {
          $screens = [ 'product-slider', 'mybooking_product_slider_cpt' ];
          foreach ( $screens as $screen ) {
              add_meta_box(
                  'mybooking-product-slider-metabox',                        // Unique ID
                  'Product Slider Data',                                     // Box title
                  array( $this, 'custom_box_html'), // Content callback, must be of type callable
                  $screen                                                    // Post type
              );
          }
    }

    /**
     * Add metabox data
     */ 
    public function add_metabox_data( $product_slider_data_id ) {

      if ( isset( $_POST['nonce_field'] ) && wp_verify_nonce( $_POST['nonce_field'], 'cpt_product_slider' ) ) {
        
        if ( isset( $_POST[ 'mybooking-product-slider-title' ] ) ) {
          $title = sanitize_text_field( $_POST['mybooking-product-slider-title'] );
          update_post_meta(
            $product_slider_data_id,
            'mybooking-product-slider-title',
            $title
            );
        }
        if ( isset( $_POST[ 'mybooking-product-slider-description' ] ) ) {
          $description = sanitize_text_field( $_POST['mybooking-product-slider-description'] );
          update_post_meta(
            $product_slider_data_id,
            'mybooking-product-slider-description',
            $description
            );
        }
        if ( isset( $_POST[ 'mybooking-product-slider-offer-price' ] ) ) {
          $offer_price = sanitize_text_field( $_POST['mybooking-product-slider-offer-price'] );
          update_post_meta(
            $product_slider_data_id,
            'mybooking-product-slider-offer-price',
            $offer_price
            );
        }
        if ( isset( $_POST[ 'mybooking-product-slider-original-price' ] ) ) {
          $price = sanitize_text_field( $_POST['mybooking-product-slider-original-price'] );
          update_post_meta(
            $product_slider_data_id,
            'mybooking-product-slider-original-price',
            $price
            );
        }
        if ( isset( $_POST[ 'mybooking-product-slider-link' ] ) ) {        
          $link = filter_var( $_POST['mybooking-product-slider-link'], FILTER_SANITIZE_URL );
          update_post_meta(
            $product_slider_data_id,
            'mybooking-product-slider-link',
            $link     
            );
        }

      }
    }

    /**
     * Custom BOX HTML
     */ 
    public function custom_box_html( $product_slider_data ) {
          $product_slider_title = get_post_meta( $product_slider_data->ID, 'mybooking-product-slider-title', true );
          $product_slider_description = get_post_meta( $product_slider_data->ID, 'mybooking-product-slider-description', true );
          $product_slider_offer_price = get_post_meta( $product_slider_data->ID, 'mybooking-product-slider-offer-price', true );
          $product_slider_original_price = get_post_meta( $product_slider_data->ID, 'mybooking-product-slider-original-price', true );
          $product_slider_link = get_post_meta( $product_slider_data->ID, 'mybooking-product-slider-link', true );
          ?>
          <div class="notice notice-warning is-dismissible">
            <p><b>Remenber to add <i>[mybooking_product_slider]</i> in the page you want the slider be shown</b></p>
          </div>
          <table style="width:100%;">
          <tbody>
            <tr valign="top">
              <td>
                <h3>Create a new product offer slider</h3>
                <p>Configure the product slider.</p>
                <ol>
                  <li>Add an image for the product in the sidebar's Featured image box. <br>
                      Image height determines how tall slider will be.</li>
                  <li>Add title or slogan and offer details in the proper fields.</li>
                  <li>Set the offer price and old price.</li>
                  <li>Add an URL if you want to link to a page, post or custom post type.<br> 
                      It must to exist previously.</li>
                  <li>Hit the Publish button to save the data.</li>
                </ol>
                <p>Empty fileds will not be shown</p>
                <p><b>If you need more control over design, <a href="/wp-admin/admin.php?page=mybooking-plugin-configuration&tab=complements_options" target="_blank">activate Content Slider</a> component.</b></p>
              </td>
              <td>
                
                <?php wp_nonce_field( 'cpt_product_slider', 'nonce_field' ); ?>

                <label for="mybooking-product-slider-title"><h3>Product Title</h3></label>
                <span class="description">Explain in few words what the product is</span>
                <br>
                <input
                  type="text"
                  size="50"
                  name="mybooking-product-slider-title"
                  value="<?php echo esc_attr( $product_slider_title ); ?>"
                  id="mybooking-product-slider-title"
                  class="components-text-control__input">
                  <br>

                <label for="mybooking-product-slider-description"><h3>Product Description</h3></label>
                <span class="description">Describe the product offer</span>
                <br>
                <textarea
                  name="mybooking-product-slider-description"
                  id="mybooking-product-slider-description"
                  rows="10" cols="50"
                  class="components-text-control__input"><?php echo esc_html( $product_slider_description ); ?></textarea>
                <br>

                <label for="mybooking-product-slider-offer-price"><h3>Offer Price</h3></label>
                <input
                  type="text"
                  size="10"
                  name="mybooking-product-slider-offer-price"
                  value="<?php echo esc_attr( $product_slider_offer_price ); ?>"
                  id="mybooking-product-slider-offer-price"
                  class="components-text-control__input">
                  <span><b>€</b></span>
                  <br>

                <label for="mybooking-product-slider-original-price"><h3>Original Price</h3></label>
                <input
                  type="text"
                  size="10"
                  name="mybooking-product-slider-original-price"
                  value="<?php echo esc_attr( $product_slider_original_price ); ?>"
                  id="mybooking-product-slider-original-price"
                  class="components-text-control__input">
                  <span><b>€</b></span>
                  <br>

                <label for="mybooking-product-slider-link"><h3>Button Link</h3></label>
                <span class="description">The full URL to your custom page or post.</span>
                <br>
                <input
                  type="text"
                  size="50"
                  name="mybooking-product-slider-link"
                  value="<?php echo esc_url( $product_slider_link ); ?>"
                  id="mybooking-product-slider-link"
                  class="components-text-control__input"><br>
              </td>
            </tr>
          </tbody>
          </table>
          <?php
      }

	}
