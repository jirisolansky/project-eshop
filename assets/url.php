<?php

/**
 * 
 * Přesměrovává na zadanou Url adresu
 * 
 * @param string $path - část adresy, na kterou se má přesměrovat
 * 
 * @return void
 * 
 */

function redirectUrl($path) {
    if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] != "off") {
        $url_protocol = "https";
    } else {
        $url_protocol = "http";
    }

    header("location: $url_protocol://" . $_SERVER["HTTP_HOST"] . $path);

}