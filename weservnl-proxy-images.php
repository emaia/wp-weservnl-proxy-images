<?php
/**
 * Plugin Name: Weserv.nl Proxy Images
 * Description: A simple plugin to proxy WordPress images through https://images.weserv.nl
 * Version: 0.0.1
 * Author: Dina
 * License: MIT
 */

if ($_SERVER['REMOTE_ADDR'] !== "127.0.0.1") {
    add_filter('wp_get_attachment_url', function ($url) {
        if (in_array(mb_substr($url, -3), ['jpg', 'png', 'gif'])) {
            return str_replace(site_url(), 'https://images.weserv.nl/?output=webp&url='.site_url(), $url);
        }
        return $url;
    });

    add_filter('wp_calculate_image_srcset', function ($sources) {
        foreach ($sources as &$source) {
            if (in_array(mb_substr($source['url'], -3), ['jpg', 'png', 'gif'])) {
                $source['url'] = str_replace(site_url(), 'https://images.weserv.nl/?output=webp&url='.site_url(),
                    $source['url']);
            }
        }
        return $sources;
    });
}
