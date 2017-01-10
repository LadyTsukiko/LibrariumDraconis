<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 06.01.2017
 * Time: 17:53
 */
?>



<form action="index.php?action=register" method="post">
    <p><input class="field" placeholder="<?php echo $username; ?>" name="login" required></p>
    <div><div id="rsp_email"><!-- --></div>
        <input class="field" id="email" placeholder="E-Mail" name="email" onkeyup="if(this.value != '') callAjax('checkEmail', this.value, this.id);" required>
     </div>
    <p><input class="field" type="password" placeholder="<?php echo $password; ?>" name="pw" required></p>
    <p><input class="button confirm" type="submit" value="<?php echo $register; ?>"></p>
</form>


<script>

    function callAjax(method, value, target)
    {
        if(encodeURIComponent) {
            var req = new AjaxRequest();
            var params = "method=" + method + "&value=" + encodeURIComponent(value) + "&target=" + target;
            req.setMethod("POST");
            req.loadXMLDoc('../../controller/validate.php', params);

        }
    }

</script>