<?php

/**
 * Application exterieure Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'login-form-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'login-form';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<?php
if(!is_user_logged_in()) {
    sedoo_wpthch_intranet_login_form($id, $className);
}
?>



