<?php 

class se2_Files {


     public function getRemoteFilesize($file_url, $formatSize = true)
	{
	    $head = array_change_key_case(get_headers($file_url, 1));
	    $clen = isset($head['content-length']) ? $head['content-length'] : 0;

	    if (!$clen) {
	        return -1;
	    }

	    if (!$formatSize) {
	        return $clen;
	    }

	    $size = $clen;
	    switch ($clen) {
	        case $clen < 1024:
	            $size = $clen .' B'; break;
	        case $clen < 1048576:
	            $size = round($clen / 1024 ) .' KB'; break;
	        case $clen < 1073741824:
	            $size = round($clen / 1048576, 2) . ' MB'; break;
	        case $clen < 1099511627776:
	            $size = round($clen / 1073741824, 2) . ' GB'; break;
	    }

	    return $size;
		// return formatted size
	}

	public function se2_get_attachment_id_by_url( $url ) {

		$parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );
	 
		// Get the host of the current site and the host of the $url, ignoring www
		$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
		$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );
	 
		// Return nothing if there aren't any $url parts or if the current host and $url host do not match
		if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
		    return;
		}
	 	 
		// Example: /uploads/2013/05/test-image.jpg
		global $wpdb;
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );
	 
		// Returns null if no attachment is found
		return $attachment[0];
	 }

}