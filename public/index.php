<?php

    /*****************************************************************************
     * index.php
     *
     * portfolio
     * Nicholas Howlett
     *
     * Controller for multi-page website that allows user to send a message to a 
     * specified email address. 
     *
     * Includes error logging & emailing, and user-submitted data validation & 
     * repopulation of valid user data.
     */

    // messages displayed to user
    $success = "Your message has been sent!";
    $error_500 = "Sorry, we made an error. Someone has been notified. Please try again later. Sad face :(";

    /*****************************************************************************
     * Custom error handling. Logs & Emails me specific details of error, when any
     * level of message triggered. Responds to client with user-friendly message 
     * (inc. status code).
     */
    function errorHandling($errno, $errstr, $file, $line)
    {
        // error details
        $time = strftime("%F %r", time());
        $message = "[" . $time . "] " . $errstr . " in " . $file  . " on line " . $line . ". \n";

        // email and log error
        //mail(MY_EMAIL, "Portfolio Error", $message); // OR error_log($message, 1, MY_EMAIL);
        error_log($message, 3, __DIR__ . "/../logs/error_log");

        // set response status code
        http_response_code(500);

        // display abstracted server error message to user
        exit($GLOBALS["error_500"]);
    }

    // set errors to be handled by custom error handling function
    set_error_handler("errorHandling");

    /*****************************************************************************
     * Gets file (within includes directory) passed in as parameter. Triggers 
     * error message if cannot find file.
     */
    function getFileOrError($filename)
    {
        $path = __DIR__ . "/../includes/" . $filename . ".php";
        if (file_exists($path))
        {
            require($path);
        }
        else
        {
            trigger_error("Could not find " . $path, E_USER_ERROR);
        }
    }

    // configuration file
    getFileOrError("config");

    // helper functions file
    getFileOrError("functions");

    // checking for repopulation of form user input
    $validatedName = false;
    $validatedEmail = false;
    $validatedMessage = false;

    // render header content
    render("header");
    
    // if form submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        // for all error messages
        $errors = [];
        
        // for each form data field
        foreach ($_POST as $key => $value)
        {
            // create string from form input ID
            $validatedVar = "validated" . ucwords($key);
            
            // validate form input data (returns true if successful else error 
            // message).
            $validated = validate($value, $key);

            // store boolean value in variable that's name is the string 
            // initialised to $validatedVar. Append error message to list (if
            // returned by validate function).
            if ($validated !== true)
            {
                $$validatedVar = false;
                $errors[] = $validated;
            }
            else
            {
                $$validatedVar = true;
            }   
        }
               
        // render all error messages (if any)   
        if (count($errors) != 0)
        {
            render("error", ["id" => "error_user"]);
        }
        // otherwise, if user-submitted data valid
        else
        {
            // attempt to send me email with user data
            $sent = emailMe($_POST["name"], $_POST["email"], $_POST["message"]);

            // if email sent succesfully then render confirmation message.
            if ($sent == true)
            {
                render("confirmation");
            }
            /*// otherwise, if email not sent then render error message.
            else
            {
                $errors[] = $error_503;
                render("error", ["id" => "error_email"]);
            }*/
        }
    }
    
    // render main content
    render("main");
    
    // render footer content
    render("footer");

?>
