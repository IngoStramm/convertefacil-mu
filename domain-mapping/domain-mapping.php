<?php
// Fix do plugin Domain Mapping que estava retirando o HTTPS do admin-ajax.php
add_filter( 'dm_force_ssl_on_mapped_domain', 'cf_force_ssl_on_mapped_domain' );

function cf_force_ssl_on_mapped_domain( $force_ssl_on_mapped_domain ) {
	if( is_ssl() )
		$force_ssl_on_mapped_domain = true;
	return $force_ssl_on_mapped_domain;
}