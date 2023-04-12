<?php
/**
 * Template Name: Custom Meta Edit Page
 */

 require_once __DIR__ . '/wc-api-php/src/WooCommerce/Client.php';

// Check if the user is logged in
if (!is_user_logged_in()) {
    auth_redirect();
}

// Check if the current user's ID matches the hardcoded ID
$allowed_user_id = 123; // Replace with the actual allowed user ID
$current_user_id = get_current_user_id();
if ($current_user_id !== $allowed_user_id) {
    wp_die("You do not have permission to access this page.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price']) && isset($_POST['attribute_index']) && isset($_POST['index'])) {
    // Update the product attribute price using the WooCommerce API or direct database query
}

get_header();

$product_id = 8636;
$product_data = $woocommerce->get("products/{$product_id}");
// Set up the WooCommerce API client
$woocommerce = new WooCommerce\Client(array(
    'url' => 'https://donyayeparcham.com', // Replace with your website URL
    'consumer_key' => 'ck_cc3e85fbcd3b7e493b5ad50b123147a7eca9859f', // Replace with your WooCommerce API consumer key
    'consumer_secret' => 'cs_728bc3a48037630c69b2e570929aa6acf732b0ed', // Replace with your WooCommerce API consumer secret
    'wp_api' => true,
    'version' => 'wc/v3',
));

try {
    // Fetch product data
    $product_data = $woocommerce->get("products/{$product_id}");
} catch (Exception $e) {
    wp_die("Error fetching product data: " . $e->getMessage());
}
$attributes = $product_data->attributes;
// Extract the data from the product data
$multiple_radiobuttons_options_value = [
    // ...
];

$multiple_radiobuttons_options_price = [
    // ...
];
foreach ($attributes as $attribute) {
    if ($attribute->name == 'multiple_radiobuttons_options_value') {
        $multiple_radiobuttons_options_value = json_decode($attribute->options[0], true);
    }

    if ($attribute->name == 'multiple_radiobuttons_options_price') {
        $multiple_radiobuttons_options_price = json_decode($attribute->options[0], true);
    }
}
// Generate the forms
?>
<div class="container">
    <?php foreach ($multiple_radiobuttons_options_value as $attribute_index => $attribute_values) : ?>
        <?php foreach ($attribute_values as $index => $attribute_name) : ?>
            <h2>Edit Price for: <?php echo $attribute_name; ?></h2>
            <form method="post">
                <input type="hidden" name="attribute_index" value="<?php echo $attribute_index; ?>">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" value="<?php echo $multiple_radiobuttons_options_price[$attribute_index][$index]; ?>">
                <button type="submit">Update Price</button>
            </form>
            <hr>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<?php get_footer(); ?>
