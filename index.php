<?php
/**
 * Plugin Name: parcham product update
 * Description: Allow a specific user to view and edit product attribute prices.
 * Version: 1.0
 * Author: Your Name
 * License: GPLv2 or later
 * Text Domain: wc-custom-meta-editor
 */

// Register a custom page template
add_filter('theme_page_templates', 'wc_custom_meta_editor_add_page_template');
function wc_custom_meta_editor_add_page_template($templates) {
    $templates['custom-meta-page.php'] = 'Custom Meta Edit Page';
    return $templates;
}

// Load the custom page template
add_filter('template_include', 'wc_custom_meta_editor_load_page_template');
function wc_custom_meta_editor_load_page_template($template) {
    global $post;

    if ($post && isset(get_page_templates($post->ID)['custom-meta-page.php'])) {
        $template = plugin_dir_path(__FILE__) . 'custom-meta-page.php';
    }

    return $template;
}

// Handle form submission and update product attribute price
add_action('init', 'wc_custom_meta_editor_update_price');
function wc_custom_meta_editor_update_price() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price']) && isset($_POST['attribute_index']) && isset($_POST['index'])) {
        // Get the submitted values
        $price = $_POST['price'];
        $attribute_index = $_POST['attribute_index'];
        $index = $_POST['index'];

        // Debugging: Write the submitted values to a debug.log file in the plugin directory
        $debug_message = sprintf("Attribute index: %d, Index: %d, Price: %s\n", $attribute_index, $index, $price);
        file_put_contents(plugin_dir_path(__FILE__) . 'debug.log', $debug_message, FILE_APPEND);

        // Update the product attribute price using the WooCommerce API or direct database query
        // ...
    }
}
