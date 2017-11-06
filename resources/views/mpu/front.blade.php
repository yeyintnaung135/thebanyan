<?php
    /*
     * IMPORTANT: This sample code should be studied in reference to MPU Merchant Integration Guide.
     * This is a sample for the Front End URL.  
     * You will have the Front End URL registered when you submitted your Merchant Enrolment to the Bank or MPU.
     * To test this sample code, you have to rename this file with the file name in your registered Front End URL.
     */

    // replace with actual Secret Key provided by the Bank or MPU
    $secret_key = "W21TFCTIJBMITOFF4EQXMA4AI0AI41XS";

    function create_signature_string($input_fields_array)
    {
        unset($input_fields_array["hashValue"]);    // exclude hash value from signature string
        
        sort($input_fields_array, SORT_STRING);
        
        $signature_string = "";
        foreach($input_fields_array as $key => $value)
        {   
            $signature_string .= $value;    
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
        
        return $hash_value;
    }
    
    function is_hash_value_matched()
    {
        $is_matched = false;
        $generated_hash_value = generate_hash_value();        
        $server_hash_value = $_POST["hashValue"];
        
        if ($generated_hash_value == $server_hash_value)
        {
            $is_matched = true;
        }
        
        return $is_matched;
    }
?>

<html>

<head>

<style>
label {
    font-weight: bold;
}

.explanation {
    font-style: italic;
    font-weight: bold;
}

.notes {
    font-size: larger;
    font-weight: bold;
}
</style>

</head>


<body>
    <span class="notes">
    <p>
    IMPORTANT: This sample code should be studied in reference to MPU Merchant Integration Guide.<br />
    As this is a sample page, it shows the response fields (POST params) in an HTML form.<br />
    In your production code, you should
    <ul>
        <li>check whether received Hash Value matches locally calculated Hash Value</li>
        <li>check whether receieved Merchant ID matches your own Merchant ID</li>
        <li>check whether received Invoice No exists in your e-Commerce website DB</li>
        <li>check whether received Amount matches Amount in your DB</li>
        <li>if ALL checks pass, read the Resp Code &amp; Status from Server and</li>
        <ul>
            <li>show Payment Success or Failed msg to Customer</li>
            <ul>
                <li>if Success, depending on your requirements, you may show Customer Receipt, send confirmation email to Customer, etc. </li>
            </ul>
            <li>if NOT updated in your DB yet (if your Back End URL is working properly; DB will already be updated)</li>
            <ul>
                <li>update Status in your DB</li>
                <li>additionally, save Tran Ref &amp; Approval Code in your DB </li>
            </ul>
        </ul>
    </ul>
    </p>
    </span>
         
    <h1>Response from MPU Payment Gateway</h1>
    <form>
        <?php foreach ($_POST as $key => $value) : ?>
            <label> <?php echo htmlspecialchars($key); ?> </label>
            <input type="text" name="<?php echo htmlspecialchars($key); ?>" 
                value="<?php echo htmlspecialchars($value); ?>"
            />
            <br />
        <?php endforeach; ?>
        <label>Signature String:</label>
        <input type="text" name="signature_string" value="<?php echo create_signature_string($_POST); ?>"/>
        <br />
        <label>Generated Hash Value:</label>
        <input type="text" name="generated_hash_value" value="<?php echo generate_hash_value(); ?>"/>
        <br />
        <label>Is Hash Value Matched: </label>
        <input type="checkbox" name="is_hash_value_matched"
            <?php
                if (is_hash_value_matched()):
            ?> 
                checked="checked"
            <?php
				error_log("Hash Value is Matched");
				error_log("This is front End");
                endif;
            ?>
        />
    </form>

</body>

</html>


    
