Please wait, connecting with PayUmoney....
<html>
<head>
    <script>
        var hash = '<?php echo html_escape($hash); ?>';
        function submitPayuForm() {
            if(hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
    </script>
</head>
<body onload="submitPayuForm()">
    <form action="<?=html_escape($action)?>" method="post" name="payuForm">
        <input type="hidden" name="key" value="<?php echo html_escape($key); ?>" />
        <input type="hidden" name="hash" value="<?php echo html_escape($hash); ?>"/>
        <input type="hidden" name="txnid" value="<?php echo html_escape($txnid); ?>" />
        <input name="amount" type="hidden" value="<?php echo html_escape($amount); ?>" />
        <input type="hidden" name="firstname" id="firstname" value="<?php echo html_escape($firstname); ?>" />
        <input type="hidden" name="email" id="email" value="<?php echo html_escape($email); ?>" />
        <input type="hidden" name="phone" value="<?php echo html_escape($phone); ?>" />
        <input type="hidden" name="productinfo" value="<?php echo html_escape($productinfo); ?>" />
        <input type="hidden" name="surl" value="<?php echo html_escape($surl); ?>" />
        <input type="hidden" name="furl" value="<?php echo html_escape($furl); ?>" />
        <input type="hidden" name="service_provider" value="" size="64" />
    </form>
</body>
</html>
