
<?php 
// Load values and assign defaults.
$typeDeBlock = get_field('intranet_super_tile_block_type_choice');
$titreBlock = get_field('intranet_super_tile_block_title');
$superTileIcone = get_field('intranet_super_tile_block_icone');
$link = get_field('intranet_super_tile_block_link');
$contact = get_field('intranet_super_tile_block_user');
$contactMail = get_field('mail', $contact );
$phoneNumber = get_field('intranet_super_tile_block_user_phone');
$tag = get_field('intranet_super_tile_block_tag');
$typeFile = get_field('intranet_super_tile_block_type_form');
?>
    <div class="flip-card-inner">

        <div class="flip-card-front">
                <span class="material-icons">face</span>    

                <h3>
                
                <?php echo get_user_meta( $contact->ID,'first_name', true); ?>

                <?php echo get_user_meta( $contact->ID,'last_name', true); ?>

                </h3>
                
                <span class="tag">#<?php echo $tag; ?></span>
        </div>

        <div class="flip-card-back">

            <span class="material-icons">mail</span> </br>
               
            <a href="mailto:<?php echo $contact->user_email; ?>"><?php echo $contact->user_email; ?></a>

            <?php if( get_field('intranet_super_tile_block_user_phone') ): ?>
                
                <span class="material-icons">call</span> </br>
               
                <a href="tel:<?php echo $phoneNumber; ?>"><?php echo $phoneNumber; ?></a>
           
            <?php endif; ?>

        </div>

    </div>


