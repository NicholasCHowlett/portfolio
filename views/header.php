<!DOCTYPE html>

<html lang="en">
  <head>

    <!-- The below 3 meta tags *must* come first in the head -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery library (also necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap library -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 

    <!-- Bootstrap CSS + optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Additional CSS -->
    <!--
    <style type="text/css">
        #my-details {
            border: 1px solid black;
        }
    -->
    <style type="text/css">
        header {
            text-align: right;
        }
        img {
            display: block;
            margin: 0 auto;
        }
        html, body {
          height: 100%;
        }
        footer {
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 95%;
        }
    </style>
    
    <!-- JavaScript/jQuery scripts -->
    <script>
    
      // when document ready execute
      $(document).ready(function() 
      {        
          // if any user error messages exist
          if ($('#error_user').length != 0)
          {
              // display contact content
              $('#projects').removeClass('active');
              $('#contact').addClass('active');
          
              // display contact navigation highlight
              $('li.active').removeClass();
              $('li:eq(2)').addClass('active');
          }

          // otherwise if either email confirmation/error messages exists
          else if ($('#confirmation').length != 0 || $('#error_email').length != 0)
          {          
              // hide any active content
              $('#projects').addClass('hidden');
              $('#contact').addClass('hidden');
          
              // hide navigation highlighting
              $('li.active').removeClass();
          }
          
          // when any navigation link (tab) clicked
          $('li').click(function() 
          { 
              // remove all confirmation/error content
              $('#confirmation').remove();
              $('.error').remove();  
              
              // unhide all content
              $('#projects').removeClass('hidden');
              $('#contact').removeClass('hidden');
              
              // remove repopulated user input (if any)
              $("#name").val('');
              $("#email").val('');
              $("#message").val('');
          });
      });
      
    </script>
    
    <title>Nicholas Howlett</title>  
  </head>
  <body>
    <div class="container-fluid">

      <!-- header/navigation -->
      <header>
        "&#60Insert thought-provoking quote here&#62"
      </header>
      <nav>
        <ul id="nav" class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#projects">Projects</a></li><!-- remove "class=active" for no tab highlight -->
          <li><a data-toggle="tab" href="#about">About</a></li>
          <li><a data-toggle="tab" href="#contact">Contact</a></li>
        </ul>
      </nav>

      <main class="tab-content">
