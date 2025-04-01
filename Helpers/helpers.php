<?php

/**
 * Check if the mime type is an image.
 */
if (! function_exists('isImage')) {
    function isImage($mimeType)
    {
        return str_contains($mimeType, 'image');
    }
}

/**
 * Check if the mime type is a video.
 */
if (! function_exists('isVideo')) {
    function isVideo($mimeType)
    {
        return str_contains($mimeType, 'video');
    }
}
