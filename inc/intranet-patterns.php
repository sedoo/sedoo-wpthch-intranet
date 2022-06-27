
<?php 

function sedoo_intranet_patterns() {
    register_block_pattern_category(
        'sedoo',
        array( 'label' => 'Pattern Sedoo' )
    );

    register_block_pattern(
        'tutelle-block/intranet-tutelle-block',
        array(
            'title'       => __( '3 Colonnes tutelles', 'tutelle-block' ),
            'description' => _x( 'Trois colonnes pour proposer des liens vers les trois tutelles, CNRS, IRD, UT3.', 'Block pattern description', 'tutelle-block' ),
            'content'     => "<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-column has-white-background-color has-background\"><!-- wp:heading -->\n<h3>CNRS</h3>\n<!-- /wp:heading -->\n\n<!-- wp:separator {\"style\":{\"color\":{\"background\":\"#04365d\"}},\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide\" style=\"background-color:#04365d;color:#04365d\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 1</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 2</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-column has-white-background-color has-background\"><!-- wp:heading -->\n<h3>UT3</h3>\n<!-- /wp:heading -->\n\n<!-- wp:separator {\"style\":{\"color\":{\"background\":\"#FBCA00\"}},\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide\" style=\"background-color:#FBCA00;color:#FBCA00\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 1</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 2</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-column has-white-background-color has-background\"><!-- wp:heading -->\n<h3>IRD</h3>\n<!-- /wp:heading -->\n\n<!-- wp:separator {\"style\":{\"color\":{\"background\":\"#E20613\"}},\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide\" style=\"background-color:#E20613;color:#E20613\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 1</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 2</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n",
            'blockTypes' => array( 'core/columns' ),
            'categories'    => array('sedoo', 'columns'),
        )
    );
}

add_action( 'init', 'sedoo_intranet_patterns' );

?>