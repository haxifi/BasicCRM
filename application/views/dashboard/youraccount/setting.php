<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title>Profilo</title>

<div class="col-lg-12">

    <div class="col-lg-6">
         <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" disabled value="<?php echo ($loggedUser); ?>">
            </div>


            <div class="col">
                <input id="newPass" type="password" class="form-control" placeholder="Password">
            </div>

         </div>

    </div>

    <div style="margin-top: 10px; text-align: right;" class="col-lg-6">
        <button id="saveSettings" type="button" class="btn btn-primary">Salva modifiche</button>
    </div>



</div>


<script>

    $("#saveSettings").click(function ()
    {
        var url     = "<?php echo $homepage; ?>api/settings/update";
        var logOut  = "<?php echo $homepage; ?>account/logout";
        var param   = {newPass: $("#newPass").val()};

        $.post( url, param,function( data ) {

            $.notify(data['messaggio'], data['esito']);

            if(data['esito'] == 'success'){

                $.notify("Ti stiamo rimandando al login...", "info");
                setTimeout(
                    function()
                    {
                        location.href = logOut;
                    }, 2000);
            }
        })
    });

</script>