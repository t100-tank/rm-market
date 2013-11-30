<?php
function url_for_ext($uri, $absolute = false) {
    if (!function_exists('url_for')) {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    }
    return str_replace('%2F', '/', url_for($uri, $absolute));
}
