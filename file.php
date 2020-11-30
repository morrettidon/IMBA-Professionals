<?php
/**
 * This file adds the custom IMBA Professional Listing post type archive template to the IMBA Pro Theme.
 *
 * @author StudioPress
 * @package IMBA Pro
 * @subpackage Customizations
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~THIS IS THE ONE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */
 

//* this is what works for the archive "profession"
add_action( 'genesis_before_loop', 'websen_do_query' );
/** Changes the Query before the Loop */
function websen_do_query() {
 
    if( is_archive( array( 'profession' , 'someother' ) ) ){
        global $query_string;
 
        query_posts( wp_parse_args( $query_string, array( 'meta_key' => 'last_name', 'orderby' => 'last_name', 'order' => 'ASC' ) ) );
    }

}
//* above, change to 'orderby' => 'rand' if you want random loade of entries


//* Force full width content layout
//* add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Add portfolio body class to the head
add_filter( 'body_class', 'imba_add_imbaprofessional_body_class' );
function imba_add_imbaprofessional_body_class( $classes ) {
   $classes[] = 'imba-pro-imbaprofessional';
   return $classes;
}

//* Add the featured image after post title
add_action( 'genesis_entry_header', 'imba_imbaprofessional_grid' );
function imba_imbaprofessional_grid() {

    if ( $image = genesis_get_image( 'format=url&size=imbaprofessional' ) ) {
        printf( '<div class="imbaprofessional-featured-image"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );

    }

}

//* Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


add_action( 'genesis_entry_content', 'genesis_page_imbaprofessional_content' );
add_action( 'genesis_post_content', 'genesis_page_imbaprofessional_content' );

// Outputs clearing div after every 3 posts assuming you want three per line
add_action( 'genesis_after_entry', 'portfolio_after_post_3' );
function portfolio_after_post_3() {
    
	global $wp_query;
    
    // Assumes 3 posts per row
	$end_row = ( $wp_query->current_post + 1 ) / 3;
        
	if ( ctype_digit( (string) $end_row ) ) {
		echo '<div class="clearit"></div>';	
	}
}

/**
 * This function outputs sitemap-esque columns displaying all pages,
 * categories, authors, monthly archives, and recent posts.
 *
 * @since 1.6
 */


function genesis_page_imbaprofessional_content() { ?>
 <!-- Choose what Advanced Custom Fields you want displayed in the Archive listings. -->
 <div class="openner">
 <!-- //* image test by steve  !!!requires image return value set to "array" -->
<div class="profileHeadshot">
<?php 
if( get_field('your_photo') ): ?>

	<img src="<?php the_field('your_photo'); ?>" />

<?php endif;	?>
</div>
<div class="nameLine"> <a href="<?php the_permalink(); ?>">
<?php if( get_field('first_name') ): ?>
	<div class="firstName"><?php the_field('first_name'); ?></div>
<?php endif; ?>
 <?php if( get_field('middle_name_initial') ): ?>
	<div class="middleInitial"><?php the_field('middle_name_initial'); ?></div>
<?php endif; ?>
 <?php if( get_field('last_name') ): ?>
	<div class="lastName"><?php the_field('last_name'); ?></div>
<?php endif; ?>
 <?php if( get_field('credential_suffix') ): ?>
	<div class="credentialSuffix">&mdash;<?php the_field('credential_suffix'); ?></div>
<?php endif; ?>
<?php if( get_field('profession') ): ?>	
	<div class="yourProfession"><?php the_field('profession'); ?></div>
	
<?php endif; ?><div class="clearit"></div></a></div><div class="clearit"></div>
	 <div class="archiveAboutProfessional">
<?php if( get_field('descriptive_excerpt') ): ?>
	<div class="descriptiveExcerpt"><?php the_field('descriptive_excerpt'); ?></div>
<?php endif; ?>
<?php if( get_field('street_address') ): ?>
	<div class="streetAddress1"><?php the_field('street_address'); ?></div>
<?php endif; ?>

<?php if( get_field('street_address_2') ): ?>
	<div class="streetAddress2"><?php the_field('street_address_2'); ?></div>
<?php endif; ?>
<div class="cityLine">
<?php if( get_field('city') ): ?>
	<div class="city"><?php the_field('city'); ?></div>
<?php endif; ?>

<?php if( get_field('state') ): ?>
	<div class="state"><?php the_field('state'); ?></div>
<?php endif; ?>
<?php if( get_field('zip_code') ): ?>
	<div class="zipCode"><?php the_field('zip_code'); ?></div>
<?php endif; ?>
<?php if( get_field('aux_location_street_address') ): ?>
	<div class="streetAddress1"><?php the_field('aux_location_street_address'); ?></div>
<?php endif; ?>

<?php if( get_field('aux_location_street_address_2') ): ?>
	<div class="streetAddress2"><?php the_field('aux_location_street_address_2'); ?></div>
<?php endif; ?>
<div class="cityLine">
<?php if( get_field('aux_city') ): ?>
	<div class="city"><?php the_field('aux_city'); ?></div>
<?php endif; ?>

<?php if( get_field('aux_state') ): ?>
	<div class="state"><?php the_field('aux_state'); ?></div>
<?php endif; ?>

<?php if( get_field('aux_zip_code') ): ?>
	<div class="zipCode"><?php the_field('aux_zip_code'); ?></div>
<?php endif; ?>
</div>
<div class="clearit"></div></div>
<div class="archiveMoreLink"><a href="<?php the_permalink(); ?>"> Profile & Contact Information... </a></div>


 <!-- Page's content ends here. -->
<?php
}


genesis();
