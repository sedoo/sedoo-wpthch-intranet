<?php
// THE MAIN ADMINISTRATION PAGE
add_action('admin_menu', 'sedoo_intranet_menu');

function sedoo_intranet_menu() {
    add_menu_page( 'sedoo-intranet-main-admin-page', 'Intranet Settings', 'administrator',
     'sedoo-intranet-admin-main-page', ''); // in sedoo-intranet-mainadmin.php
}
// END THE MAIN ADMINISTRATION PAGE
//////

?>