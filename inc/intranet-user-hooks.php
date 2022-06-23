<?php

/**
 * assign group to user from ldap group 
 */
// sedoo_intranet_change_usergroup('pvert', Object(WP_User)

function sedoo_intranet_change_usergroup( $user_login, WP_User $user ) {

    // ldap connect
    $ldaphost ="ldap://195.83.20.90";
    $ldapport = 389;

    $ds = ldap_connect($ldaphost, $ldapport)
    or die("Could not connect to $ldaphost");
    
    $dn = "ou=people,dc=omp";
    // $filter="(|(uid=".$uid."*)(givenName=".$person."*))";
    $filter = "(&(uid={$user_login}))";
    $justthese = array("gidNumber");

    $sr=ldap_search($ds, $dn, $filter, $justthese);

    $info = ldap_get_entries($ds, $sr);

    $gidnumber=$info[0]['gidnumber'][0];
    
    switch ($gidnumber) {
    case '1200':    //IRAP
        $group_id=2;
        break;

    case '900':     //UAR
        $group_id=3;
        break;

    case '600':     //CESBIO
        $group_id=4;
        break;
    
    case '700':     //GET
        $group_id=5;   
        break;
    
    case '1000':    //LAERO
        $group_id=6; 
        break;
    
    case '1100':    //LEGOS
        $group_id=7; 
        break;

    case '800':    //LEFE
        $group_id=9; 
        break;
    }
    // update group id in  prefix_groups_user_group for user_id
    global $wpdb;
    $table = $wpdb->prefix.'groups_user_group';
    $data = [ 'group_id' => $group_id ]; 
    // $format = [ %s ];  
    $where = [ 'user_id' => $user->ID ];
    $format = array('%d','%s');
    $where_format = array('%d');
    $wpdb->update( $table, $data, $where, $format, $where_format );

    //ADD USER ID  TO CURRENT BLOG ID AS AN EDITOR
    // $user_id = 1; 
    $blog_id = get_current_blog_id();
    $role = 'subscriber';
    // only if user is not in current blog
    if ( !is_user_member_of_blog( $user->ID, $blog_id ) ) {
        add_user_to_blog( $blog_id, $user->ID, $role );
    }
}
add_action('wp_login', 'sedoo_intranet_change_usergroup', 10, 2);

?>