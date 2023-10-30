<?php

/**
 * create custom print_r
 *
 * @param [type] $variable
 * @return void
 */
function pre( $variable ){
    echo '<pre>';
    print_r( $variable );
    echo '</pre>';
}
 

/**
 * get website home url
 *
 * @param string $target_path
 * @return $base_url
 */
function get_home_url( $target_path = '' ){

    // Define the protocol (http or https)
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

    // Get the server's hostname
    $host = $_SERVER['HTTP_HOST'];

    // Determine if a non-standard port is used and append it to the hostname
    $port = $_SERVER['SERVER_PORT'];
    if (($protocol === 'http' && $port != 80) || ($protocol === 'https' && $port != 443)) {
        $host .= ":" . $port;
    }


    $path = dirname($_SERVER['SCRIPT_NAME']);

    // site url
    $base_url = $protocol . '://' . $host . $path . $target_path;

    return $base_url;
}

/**
 * exwcute the home url
 *
 * @param string $path
 * @return void
 */
function home_url( $path = '' ){
    echo get_home_url( $path );
}


/**
 * get current page url
 *
 * @param [type] $url_path
 * @return void
 */
function current_page( $url_path ){
    $url = $_SERVER['REQUEST_URI'];
    if( $url_path == substr( $_SERVER['REQUEST_URI'],path_character_count() ) ){
        $active = 'active';
    }else{
        $active = '';
    }
    echo $active;
}


/**
 * get the root directory character count
 *
 * @param [type] $count
 * @return $count
 */
function path_character_count( $count = '' ){
    // get root directory
    $root_dir = $_SERVER['DOCUMENT_ROOT'];

    // Get the current script's path
    $current_script_path = $_SERVER['SCRIPT_FILENAME'];
    
    // Determine the root folder by removing the document root from the script path
    $root_folder     = str_replace($root_dir, '', dirname($current_script_path));
    $count_character = strlen( $root_folder );
    $characters      = $count_character + 1;
    $count           = intval( $characters );

    return $count;
    
}