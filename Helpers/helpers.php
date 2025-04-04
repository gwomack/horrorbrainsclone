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

/**
 * Generate a checksum for some data
 */
if (! function_exists('generateChecksum')) {
    function generateChecksum(array $data): string
    {
        return hash('crc32b', json_encode($data));
    }
}

/**
 * Get the IP address of the user
 */
if (! function_exists('getIpAddress')) {
    function getIpAddress()
    {
        return request()->ip();
    }
}

/**
 * Get the user agent of the user
 */
if (! function_exists('getUserAgent')) {
    function getUserAgent()
    {
        return request()->userAgent();
    }
}

/**
 * Get the public user checksum
 */
if (! function_exists('getPublicUserChecksum')) {
    function getPublicUserChecksum()
    {
        return generateChecksum([
            'ip' => getIpAddress(),
            'user_agent' => getUserAgent(),
        ]);
    }
}

/**
 * Get the rate limiter key
 */
if (! function_exists('getRateLimiterKey')) {
    function getRateLimiterKey(string $checksum, string $key)
    {
        return "{$checksum}:{$key}";
    }
}
