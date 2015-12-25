<?php

    /*****************************************************************************
     * functions.php
     *
     * portfolio
     * Nicholas Howlett
     *
     * Main helper functions.
     */

    /*****************************************************************************
     * Emails me with user submitted data. Returns true if email sent
     * successfully, otherwise returns false if unsuccessful and triggers 
     * warning message.
     */
    function emailMe($name, $email, $message)
    {
        // get local PHPMailer library
        getFileOrError("/phpmailer/class.phpmailer");
        getFileOrError("/phpmailer/class.smtp");

        /** 
         * SMTP needs accurate times, and the PHP time zone MUST be set. This 
         * should be done in your php.ini, but this is how to do it if you 
         * don't have access to that.
         */
        date_default_timezone_set('Etc/UTC');
    
        // instantiate object of class PHPMailer (throw exceptions if any 
        // problems encountered).
        $mail = new PHPMailer(true);

        // set SMTP settings for TPG
        $mail->IsSMTP();
        $mail->Host = MAIL_SERVER;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        // SMTP Authentication
        $mail->SMTPAuth =- true;
        $mail->Username = USERNAME;
        $mail->Password = PASSWORD;
      
        // set email details
        $mail->SetFrom("$email", $name);
        $mail->AddAddress(MY_EMAIL);
        $mail->Subject = "Contacted via Portfolio";
        $mail->Body = "$message";
    
        // attempt to send email (throw exception if any problems encountered)
        // then indicate email sent successfully if no exception thrown.
        try
        {
            $mail->Send();
            $sent = true;
        }
        // if exception thrown trigger warning with details then indicate
        // email not sent.
        catch (phpmailerException $e)
        {
            trigger_error("Could not send Email via PHPMailer: " . $e->getMessage(), E_USER_WARNING);
            $sent = false;
        }
        
        // return whether email sent or not
        return $sent;
    }

    /*****************************************************************************
     * Renders template (view) if file exists, otherwise triggers warning message.
     */
    function render($template, $values = [])
    {
        // refer to variables that were already declared (as variables outside 
        // function cannot be accessed from within).
        // confirmation/error template use
        global $success;
        global $errors;

        // main template use
        //global $validatedName;
        global $validatedEmail;
        global $validatedMessage;
         
        // template path
        $path = __DIR__ . "/../views/" . $template . ".php";
        
        // get template content if it exists
        if (file_exists($path))
        {
            // extract keys as variables
            extract($values);

            // template content
            require($path);
        }
        // otherwise trigger warning message
        else
        {
            trigger_error("Could not find " . $path, E_USER_WARNING);
        }
    }
    
    /*****************************************************************************
     * Validates user input. Returns True if input data successfully validated, 
     * otherwise returns error message string.
     */
    function validate($value, $varName)
    {
        // check input not empty
        if ($value != "")
        {
            // for name input
            if ($varName == "name")
            {
                // if input is not only alphabetical characters, apostrophes,
                // spaces (white list) construct invalid error message.
                $valueChecked = preg_match("/[^a-zA-Z'\s]/", $value);
                if ($valueChecked)
                {
                    $error = "Please enter a valid name.";
                }
            }
            // for email input
            else if ($varName == "email")
            {                
                // if input not valid sequence (white list) then construct invalid
                // error message.
                $valueVal = filter_var($value, FILTER_VALIDATE_EMAIL);
                if ($valueVal === false)
                {
                    $error = "Please enter a valid email address.";
                }
            }            
        }
        // otherwise construct empty error message
        else
        {
            $error = "Please enter your " . $varName . ".";
        }
        
        // if error found return error message, otherwise return true
        if (isset($error))
        {
            return $error;
        }
        else
        {
            return true;
        }
    }
    
?>