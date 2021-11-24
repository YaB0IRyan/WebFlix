<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- guid.php -->

<!-- this page is used to generate a random ID for anything in the database that needs a unique random ID -->
<!-- code source - https://www.php.net/manual/en/function.com-create-guid.php -->



<?php
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }
return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));