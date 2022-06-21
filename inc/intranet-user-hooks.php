<?php

/**
 * assign group to user from ldap group 
 */
// sedoo_intranet_change_usergroup('pvert', Object(WP_User)

function sedoo_intranet_change_usergroup( $user_login, $user ) {
    //get user_mail, explode domain
    $user_id=get_current_user_id();
    $user_info=get_userdata($user_id);
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
    global $wpdb;
    $table = $wpdb->prefix.'groups_user_group';
    $data = [ 'group_id' => $group_id ]; 
    // $format = [ %s ];  
    $where = [ 'user_id' => $user_id ];
    $format = array('%d','%s');
    $where_format = array('%d');
    $wpdb->update( $table, $data, $where, $format, $where_format );

}
add_action('wp_login', 'sedoo_intranet_change_usergroup', 10, 2);

?>