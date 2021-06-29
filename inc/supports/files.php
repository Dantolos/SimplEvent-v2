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
}