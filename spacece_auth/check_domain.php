<?php
if (isset($_GET['domain'])) {
    $domain = $_GET['domain'];
    if (!empty($domain)) {
        if (checkdnsrr($domain, 'MX')) {
            echo "valid";
        } else {
            echo "invalid";
        }
    } else {
        echo "invalid";
    }
} else {
    echo "invalid";
}
?>
