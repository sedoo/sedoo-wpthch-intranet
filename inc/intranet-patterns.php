
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
            'content'     => "<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:paragraph {\"fontSize\":\"medium\"} -->\n<p class=\"has-medium-font-size\">CNRS</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:separator {\"style\":{\"color\":{\"background\":\"#04365d\"}},\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide\" style=\"background-color:#04365d;color:#04365d\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Apparet statim, quae sint officia, quae actiones</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><a href=\"https://intranet.cnrs.fr/Pages/default.aspx\" target=\"_blank\" rel=\"noreferrer noopener\">Lien vers intranet CNRS</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><a href=\"https://intranet.cnrs.fr/Pages/default.aspx\" target=\"_blank\" rel=\"noreferrer noopener\">Lien vers intranet CNRS</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"align\":\"center\",\"style\":{\"border\":{\"radius\":\"30px\"}},\"className\":\"is-style-fill\"} -->\n<div class=\"wp-block-button aligncenter is-style-fill\"><a class=\"wp-block-button__link\" href=\"https://intranet.cnrs.fr/Pages/default.aspx\" style=\"border-radius:30px\" target=\"_blank\" rel=\"noreferrer noopener\">Page d'infos</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:paragraph {\"fontSize\":\"medium\"} -->\n<p class=\"has-medium-font-size\">UT3</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:separator {\"style\":{\"color\":{\"background\":\"#fbca00\"}},\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide\" style=\"background-color:#fbca00;color:#fbca00\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Apparet statim, quae sint officia, quae actiones</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><a href=\"https://intranet.univ-tlse3.fr\">Lien vers intranet UT3</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><a href=\"https://intranet.univ-tlse3.fr\">Lien vers intranet UT3</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"align\":\"center\",\"style\":{\"border\":{\"radius\":\"30px\"}}} -->\n<div class=\"wp-block-button aligncenter\"><a class=\"wp-block-button__link\" href=\"https://intranet.univ-tlse3.fr\" style=\"border-radius:30px\">Page d'infos</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:paragraph {\"fontSize\":\"medium\"} -->\n<p class=\"has-medium-font-size\">IRD</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:separator {\"style\":{\"color\":{\"background\":\"#e20613\"}},\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide\" style=\"background-color:#e20613;color:#e20613\"/>\n<!-- /wp:separator -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Apparet statim, quae sint officia, quae actiones</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><a href=\"https://www.ird.fr/intranet/login\" target=\"_blank\" rel=\"noreferrer noopener\">Lien vers intranet IRD</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><a href=\"https://www.ird.fr/intranet/login\" target=\"_blank\" rel=\"noreferrer noopener\">Lien vers intranet IRD</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"align\":\"center\",\"style\":{\"border\":{\"radius\":\"30px\"}}} -->\n<div class=\"wp-block-button aligncenter\"><a class=\"wp-block-button__link\" href=\"https://intranet.ird.fr/\" style=\"border-radius:30px\" target=\"_blank\" rel=\"noreferrer noopener\">Page d'infos</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
            'blockTypes' => array( 'core/columns' ),
            'categories'    => array('sedoo', 'columns'),
        )
    );
}

add_action( 'init', 'sedoo_intranet_patterns' );

?>