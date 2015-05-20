<?php

    /* Example usage of the Amazon Product Advertising API */
    require("amazon_api_class.php");

    $obj = new AmazonProductAPI();

    try
    {
        $result = $obj->getBrowseNodeInfo('165797011');
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }

    echo '<PRE>';
    print_r($result);
    echo '</PRE>';
?>
