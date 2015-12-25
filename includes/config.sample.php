<?php

    /*****************************************************************************
     * config.sample.php
     *
     * portfolio
     * Nicholas Howlett
     *
     * Configures page.
     */

    // for development display errors, warnings, and notices. Set to false
    // in production environment (errors hidden).
    ini_set("display_errors", false);

    // which messages are reported
    error_reporting(E_ALL);

    // error logging (for default error handling)
    ini_set("log_errors", true);                          // errors logged or not
    ini_set("error_log", __DIR__ . "/../logs/error_log"); // error log file location (local)

    // email & server details
    define("MY_EMAIL", "");
    define("MAIL_SERVER", "");
    define("USERNAME", "");
    define("PASSWORD", "");

?>