<html>

<head>
    <title>Payment Gateway</title>
</head>

<body>
    <center>

        <form style="opacity: 0;" method="post" name="redirect"
            action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
            <?php
            echo "<input type=hidden name=encRequest value=$encrypted_data>";
            echo "<input type=hidden name=access_code value=$access_code>";
            
            ?>
           
        </form>
    </center>
    <script language='javascript'>
        document.redirect.submit();
    </script>
</body>

</html>
