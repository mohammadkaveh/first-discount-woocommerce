//copy this code  to your  function.php   or any plugin in wordpress


// filter get price in woocommerce in simple & variation product
add_filter('woocommerce_product_get_price', 'return_custom_price', 10, 2);
add_filter('woocommerce_product_get_sale_price','return_custom_price', 10, 2);
add_filter('woocommerce_product_variation_get_price', 'return_custom_price', 10, 2);
add_filter('woocommerce_product_variation_get_sale_price','return_custom_price', 10, 2);




function return_custom_price($price, $product) {
    global $post, $blog_id;
    $product_id = $product->get_id();
  if (is_user_logged_in()){
	
// Checks the customer has already bought
	$orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => 'shop_order',
        'post_status' => array('wc-completed','wc-processing'),
   	 ) );
	 
  }
  
  
    if (  ( is_user_logged_in() && count($orders) == 0) || !is_user_logged_in() ) {
      
// if you want static discount use this code
       $price =  intval($price) - 10000;
//or this
     //$price =  intval($price) / 2;

// if you want variable discount  use product id and price in code
    //  if($product_id == 7392 ||  $product_id == 7393) {
      //     $price =  intval($price) - 10000;
    //   }


      
    }
    
    
    return $price;

}
