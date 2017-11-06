

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Banyan</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    
<div class='col-xs-12' style='position:relative;top:0px;background-color:#f8f8f8;width:100%;padding-left:45px;;font-size:43px;font-weight:bolder;border:1px solid #e7e7e7;'>
   The Banyan  
    </div>
<div class="row"></div>

<div class="container">

    <div class="row"  style="text-align:center;color:rgb(143, 149, 153);font-size:32px;font-weight:bolder;">
       @php
            switch ($re['respCode']) {
            case 00:
                echo " Successfully sent with mpu to your account .
                 Check Your Balance";
                 break;
            case 01:
                echo "Refer to Card Issuer";
                 
                 case 12:
                echo "Invalid Transaction";
                 case 13:
                echo "Invalid Amount";
                 case 33:
                echo "Expired Card - Pick Up";
                 case 41:
                echo "Lost Card - Pick Up";
                 case 50:
                echo "Host Down";
                 case 55:
                echo "Incorrect PIN";
                case 61:
                echo "Exceeds Withdrawal Amount Limits";
                 case 61:
                echo "Exceeds Withdrawal Amount Limits";
                case 64:
                echo "Original Amount Incorrect";
                default:
                echo 'Fail';

            }
        @endphp

         
        
    </div>
</div>
    <div class="row"></div>

<div class='col-xs-12' style='position:absolute;bottom:0px;background-color:#f8f8f8;width:100%;padding-left:45px;text-align:center;font-size:13px;font-weight:bolder;border:1px solid #e7e7e7;'>
2016 © THE BANYAN, All rights reserved with Mastery Company Limited  |     </div>
 <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>