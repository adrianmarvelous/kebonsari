<?php
    if (!function_exists('sanitizeString')) {
        function sanitizeString($input) {
            return preg_replace('/<script\b[^>]*>(.*?)<\/script>|(\b(prompt)\b)/is', '', $input);
        }
    }
?>