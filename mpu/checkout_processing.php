<?php
    // IMPORTANT: This sample code should be studied in reference to MPU Merchant Integration Guide.

    // replace with actual Secret Key provided by the Bank or MPU
    $secret_key = "W21TFCTIJBMITOFF4EQXMA4AI0AI41XS";
	
    $pgw_test_url = "http://122.248.120.252:60145/UAT/Payment/Payment/pay";
    $pgw_live_url = "https://www.mpu-ecommerce.com/Payment/Payment/pay";   
    
    function create_signature_string($input_fields_array)
    {
        sort($input_fields_array, SORT_STRING);
        
        $signature_string = "";
        foreach($input_fields_array as $value)
        {
            if ($value != "")
            {
                $signature_string .= $value;    
            }
        }
        
        return $signature_string;
    }
    
    
    function generate_hash_value()
    {
        $input_fields_array = $_POST;
                            
        $signature_string = create_signature_string($input_fields_array);
        global $secret_key;
        
        $hash_value = hash_hmac('sha1', $signature_string, $secret_key, false);
        $hash_value = strtoupper($hash_value);
		
		error_log("Processing_mpu:signature".$signature_string);
		error_log("Processing_mpu:hash".$hash_value);
        
        return $hash_value;
    }
?>

<!--

Create a form that contains hidden fields whose names and values are identical to the ones from $_POST
    as well as new hidden field hashValue.
From JS, automatically submit the hidden form (POST).
In case JS is disabled, show a visible Submit button with msg 
    like "Click here if the site is taking too long to redirect!" 

-->

<html>

<head>
</head>

<body>
    <h1>Redirecting to MPU Payment Gateway ...</h1>

    <form id="hidden_form" name="hidden_form" method="post" action="<?php echo $pgw_test_url; ?>">
        <input type="submit" value="Click here if it is taking too long to redirect!" />
        <div style="visibility: hidden;">
            <?php foreach($_POST as $key => $value): ?>
                <?php if ($value != ""): ?>
                    <label><?php echo htmlspecialchars($key); ?></label>
                    <input type="text" name="<?php echo htmlspecialchars($key); ?>" 
                        value="<?php echo htmlspecialchars($value); ?>" />
                    <br />
                <?php endif; ?>
            <?php endforeach; ?>
            <input type="text" name="hashValue" value="<?php echo generate_hash_value(); ?>" />
            <br />
        </div>
    </form>
    
   
</body>

</html>