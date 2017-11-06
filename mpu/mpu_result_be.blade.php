<?php
    /*
     * IMPORTANT: This sample code should be studied in reference to MPU Merchant Integration Guide.
     * This is a sample for the Back End URL.  
     * You will have the Back End URL registered when you submitted your Merchant Enrolment to the Bank or MPU.
     * To test this sample code, you have to rename this file with the file name in your registered Back End URL.
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

<?php
    /*
     * As this is a sample code, we write the response fields to PHP error log.
     * In your production code, you should 
     *  - check whether received Hash Value matches locally calculated Hash Value
     *  - check whether receieved Merchant ID matches your own Merchant ID
     *  - check whether received Invoice No exists in your e-Commerce website DB
     *  - check whether received Amount matches Amount in your DB
     *  - if ALL checks pass, read the Resp Code & Status from Server and update in your DB accordingly
     *  - additionally, save Tran Ref & Approval Code in your DB 
     */

    // mark log start
    error_log("Start BackEnd ...");

    // log the response fields (POST params) to PHP Err log (TESTING)
    $response = 'POST params ' . print_r($_POST, true);
    error_log($response);
    
    // hash checking
    error_log("sig: " . create_signature_string($_POST));
    error_log("gen hash: " . generate_hash_value());
    if (isset($_POST["hashValue"]))
    {
        error_log("svr hash: " . $_POST["hashValue"]);
    }
    
    // mark log end
    error_log("Finish BackEnd.");
?>