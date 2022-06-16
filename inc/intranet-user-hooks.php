<?php

/**
 * assign group to user from ldap group 
 */
// sedoo_intranet_change_usergroup('pvert', Object(WP_User)

function sedoo_intranet_change_usergroup( $user_login, $user ) {
    //get user_mail, explode domain
    $user_info=get_userdata(get_current_user_id());
    $user_mail = explode('@', $user_info->user_email);
    // switch case 
        
    switch ($user_mail[1]) {
        case 'irap.omp.eu':
            $group_id=2;
            
            break;
        case 'obs-mip.fr':
            $group_id=3;
            
            break;
        case 'cesbio.cnes.fr':
            $group_id=4;
            
            break;
        case 'get.omp.eu':
            $group_id=5;
            
            break;
        case 'aero.obs-mip.fr':
            $group_id=6;
            
            break;
        case 'legos.obs-mip.fr':
            $group_id=7;
            
            break;
    }

    // update group id in  prefix_groups_user_group for user_id
    // global $wpdb;
    $data = [ 'group_id' => $group_id ]; 
    // $format = [ %s ];  
    $where = [ 'user_id' => $user_id ];
    wpdb::update( $wpdb->prefix . 'groups_user_group', $data, $where );
/**
 * [Thu Jun 16 18:46:13.405425 2022] [php7:error] [pid 847] [client 193.52.225.45:35442] PHP Fatal error:  Uncaught Error: Using $this when not in object context in /var/www/html/wplabo/wp-includes/wp-db.php:2439\nStack trace:\n#0 /var/www/html/wplabo/wp-content-labo/themes/sedoo-wpthch-intranet/inc/intranet-user-hooks.php(45): wpdb::update('groups_user_gro...', Array, Array)\n#1 /var/www/html/wplabo/wp-includes/class-wp-hook.php(307): sedoo_intranet_change_usergroup('pvert', Object(WP_User))\n#2 /var/www/html/wplabo/wp-includes/class-wp-hook.php(331): WP_Hook->apply_filters(NULL, Array)\n#3 /var/www/html/wplabo/wp-includes/plugin.php(476): WP_Hook->do_action(Array)\n#4 /var/www/html/wplabo/wp-includes/user.php(110): do_action('wp_login', 'pvert', Object(WP_User))\n#5 /var/www/html/wplabo/wp-login.php(1221): wp_signon(Array, true)\n#6 {main}\n  thrown in /var/www/html/wplabo/wp-includes/wp-db.php on line 2439, referer: https://labo.obs-mip.fr/intranet/wp-login.php?itsec-hb-token=backoff&loggedout=true&wp_lang=fr_FR

 */

}
add_action('wp_login', 'sedoo_intranet_change_usergroup', 10, 2);

?>