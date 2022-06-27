
<?php 

function sedoo_intranet_patterns() {

    register_block_pattern(
        'tutelle-block/intranet-tutelle-block',
        array(
            'title'       => __( 'column tutelle block', 'tutelle-block' ),
            'description' => _x( 'Trois colonnes pour proposer des liens vers les trois tutelles, CNRS, IRD, UT3.', 'Block pattern description', 'tutelle-block' ),
            'content'     => "<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-column has-white-background-color has-background\"><!-- wp:heading -->\n<h2>CNRS</h2>\n<!-- /wp:heading -->\n\n<!-- wp:separator {\"style\":{\"color\":{\"background\":\"#04365d\"}},\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide\" style=\"background-color:#04365d;color:#04365d\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 1</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 2</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-column has-white-background-color has-background\"><!-- wp:heading -->\n<h2>UT3</h2>\n<!-- /wp:heading -->\n\n<!-- wp:separator {\"backgroundColor\":\"orange\",\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-orange-color has-alpha-channel-opacity has-orange-background-color has-background is-style-wide\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 1</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 2</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-column has-white-background-color has-background\"><!-- wp:heading -->\n<h2>IRD</h2>\n<!-- /wp:heading -->\n\n<!-- wp:separator {\"backgroundColor\":\"red\",\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-red-color has-alpha-channel-opacity has-red-background-color has-background is-style-wide\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 1</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Lien numéro 2</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n",
        )
    );
}

add_action( 'init', 'sedoo_intranet_patterns' );

?>