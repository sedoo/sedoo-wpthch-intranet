<?php

/**
 * assign group to user from ldap group 
 */
// sedoo_intranet_change_usergroup('pvert', Object(WP_User)

function sedoo_intranet_change_usergroup( $user_login, $user ) {
    //get user_mail, explode domain

// function sedoo_intranet_change_usergroup( $user, $username, $password ) {

    $ldaphost ="ldap://195.83.20.90";
    $ldapport = 389;

    $ds = ldap_connect($ldaphost, $ldapport)
    or die("Could not connect to $ldaphost");

    // $person="pvert";
    $user_id=get_current_user_id();
    $user_info=get_userdata($user_id);
    $uid=$user_info->user_login;
    $dn = "ou=people,dc=omp";
    // $filter="(|(uid=".$uid."*)(givenName=".$person."*))";
    $filter = "(&(uid={$uid}))";
    $justthese = array("gidNumber");

    $sr=ldap_search($ds, $dn, $filter, $justthese);

    $info = ldap_get_entries($ds, $sr);

    $gidnumber=$info[0]['gidnumber'][0];
    
    switch ($gidnumber) {
    // case 'irap.omp.eu':
    case '1200':
        $group_id=2;
        
        break;
    case '900':
        $group_id=3;
        
        break;
    // case 'cesbio.cnes.fr':
    case '600':
        $group_id=4;
        
        break;
    // case 'get.omp.eu':
    case '700':
        $group_id=5;
        
        break;
    // case 'aero.obs-mip.fr':
    case '1000':  
        $group_id=6;
        
        break;
    // case 'legos.obs-mip.fr':
    case '1100':
        $group_id=7;
        
        break;
    }
    // echo "ENTRY WP GROUP: ".$group_id;
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
// add_filter( 'authenticate', 'sedoo_intranet_change_usergroup', 30, 3 );

?>