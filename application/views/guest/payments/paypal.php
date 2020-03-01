<html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <title><?php echo $title; ?></title>
</head>

<?php if($Form["Enabled"]): ?>

<table>
    <tr>
        <td>
            <form action="https://www.paypal.com/cgi-bin/webscr" style="display: none;" method="post" name="form-pp">
                <input type="hidden" name="business" value="<?php echo $mail; ?>">
                <input type="hidden" name="image_url" value="http://www.e-type.it/panel/assets/img/panel_logo.png">
                <input type="hidden" name="charset" value="utf8">
                <input type="hidden" name="item_name" value="<?php echo $Form["Items"]; ?>">
                <input type="hidden" name="invoice" value="<?php echo $Form["Order"]; ?>">
                <input type="hidden" name="item_number" value="1">
                <input type="hidden" name="amount" value="<?php echo $Form["Import"]; ?>">
                <input type="hidden" name="currency_code" value="EUR">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="return" value="<?php echo $Form["SuccessPage"]; ?>">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="cancel_return" value="<?php echo $Form["DefaultPage"]; ?>">
                <input style="width:90px;height:70px" type="submit" id="PayMent" name="Pay" Value="Pay Now!" />
            </form>
        </td>
    </tr>
</table>


<script type="text/javascript" src="<?php echo $root; ?>assets/js/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function(){
        $("#PayMent").click();
    });
</script>

<?php endif; ?>

</html>