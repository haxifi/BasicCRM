<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<title>Richieste Pagamento</title>


<div style="text-align: left;" class="col-lg-12">
    <button class="shortoption btn btn-info" data-toggle="modal" data-target="#MyAddRequest" type="button" ><i class="fas fa-wallet"></i> Aggiungi</button>
</div>
<hr>


<!----------------------------------------- MODAL EDIT ---------------------------------------------------------------->
<div class="modal fade" id="MyEditRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modifica Ordine N° <span id="updateOrderID"></span> </h4>
            </div>
            <div class="modal-body">

                <div class="col-lg-12">
                    <div style="margin-top: 15px;" class="form-group input-group">
                        <span class="input-group-addon"><i class="fas fa-euro-sign"></i></span>
                        <input type="number" class="form-control" id="EditImport" placeholder="Importo" />
                    </div>

                    <div style="margin-top: 15px;" class="form-group input-group">
                        <span class="input-group-addon"><i class="fas fa-shield-alt"></i></span>
                        <select id="editStatus" class="form-control">
                            <option selected disabled>Seleziona Stato</option>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="button" id="btn-updateOrder" class="btn btn-primary">Aggiorna</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------------------------------------------->




<!------------------------------------ MODAL ADD REQUEST -------------------------------------------------------------->
<div class="modal fade" id="MyAddRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Aggiungi Nuovo</h4>
            </div>
            <div class="modal-body">

                <div class="col-lg-12">

                    <div style="margin-top: 15px;" class="form-group input-group">
                        <span class="input-group-addon"><i class="fas fa-euro-sign"></i></span>
                        <input type="number" class="form-control" id="ServiceImport" placeholder="Importo da pagare" />
                    </div>

                    <div style="margin-top: 15px;" class="form-group input-group">
                        <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                        <input maxlength="100" type="text" class="form-control"  id="ServiceEmail" placeholder="Email cliente" />
                    </div>

                    <div style="margin-top: 15px;" class="form-group input-group">
                        <textarea placeholder="Descrizione Servizio" id="ServiceType" rows="5" style="resize: none" class="form-control"></textarea>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="button" id="btn-addPay" class="btn btn-primary">Aggiungi</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------------------------------------------->


<div class="col-lg-12">
    <table id="datatabsystem" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
        <thead>
        <tr>
            <th>Ordine</th>
            <th>Servizio</th>
            <th>Email</th>
            <th>Importo</th>
            <th>Stato</th>
            <th>Aperto il</th>
            <th>Azioni</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($richieste as $richiesta): ?>
            <tr>
                <td>
                    <?php echo $richiesta["ID"]; ?>
                </td>
                <td><?php echo $richiesta["Servizio"]; ?></td>
                <td><?php echo $richiesta["Email"]; ?></td>
                <td id="row-import-<?php echo $richiesta['ID']; ?>"><?php echo $richiesta["Importo"]; ?> &euro;</td>
                <td id="row-status-<?php echo $richiesta['ID']; ?>"><?php echo ucfirst($richiesta["Stato"]); ?></td>
                <td><?php echo explode(' ',$richiesta["CreatedAt"])[0]; ?></td>
                <td>
                    <button data-toggle="modal" data-target="#MyEditRequest" style="width: 30%;" onclick="ManageRequest(<?php echo $richiesta["ID"]; ?>)" type="button" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                    <button <?php echo $richiesta['ButtonMail']; ?> id="sendRequest-<?php echo $richiesta["ID"]; ?>" type="button" style="width: 30%;"  onclick="sendRequest(<?php echo $richiesta["ID"]; ?>)" class="btn btn-success"><i class="fas fa-envelope-open"></i></button>
                    <button type="button" style="width: 30%"  onclick="DeleteRequest(<?php echo $richiesta["ID"]; ?>,this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>



<script>

    var baseURL     =   "<?php echo $homepage; ?>";

    function DeleteRequest(ID,Event){
        swal({
            title: "Attenzione",
            text: "Si desidera procedere con l'eliminazione della richiesta?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((Delete) =>
            {
                if(Delete){
                    $.post((baseURL + "api/request/delete")  ,{Order:ID}, function (resp) {

                        if(resp["response"] == "success")
                        {
                            $.notify(resp["message"], "success");
                            $(Event).parent().parent().addClass('deleteData');
                            DataTable.row('.deleteData').remove().draw( true );

                        }else{
                            $.notify(resp["message"], "error");
                        }
                    });
                }else{
                    $.notify("Nessun record è stato cancellato", "info");
                }
            });
    }


    function ManageRequest(ID) {
        $("#updateOrderID").html(ID);
        $.post((baseURL + "api/request/get"), {ID:ID}, function (resp)
        {
            $("#EditImport").val(resp["Importo"]);
            $("#editStatus").val(resp["Stato"]);
        });
    }


    function sendRequest(ID){
        $("#sendRequest-" +ID).attr("disabled", true);
        $.post((baseURL + "api/request/send"), {ID:ID}, function (resp) {
            if(resp["response"] == "success")
            {
                $.notify(resp["message"], "success");

            }else{
                $("#sendRequest-" +ID).attr("disabled", false);
                $.notify(resp["message"], "error");
            }
        });
    }

    $("#btn-updateOrder").click(function () {

        var data =
         {
            ID:     $("#updateOrderID").text(),
            import: $("#EditImport").val(),
            status: $("#editStatus").val()
        };

        $.post((baseURL + "api/request/edit"), data, function (resp) {
            if(resp["response"] == "success")
            {
                $("#MyEditRequest").modal('hide');
                $.notify(resp["message"], "success");

                $("#row-import-" + data['ID']).text(data['import'] + " \u20ac");
                $("#row-status-" + data['ID']).text(Capitalize(data['status']));
            }else{
                $.notify(resp["message"], "error");
            }
        });

    });



    $("#btn-addPay").click(function () {
        var data =
        {
            service: $("#ServiceType").val(),
            import:  $("#ServiceImport").val(),
            email:   $("#ServiceEmail").val()
        };

        $.post(baseURL + "api/request/add",data,function (resp)
        {

            if(resp["response"] == "success")
            {
                $("#MyAddRequest").modal('hide');
                $.notify(resp["message"], "success");

                DataTable.row.add
                (
                    [
                        '<strong>'+resp['rows']['ID']+'</strong>',
                        resp['rows']['Servizio'],
                        resp['rows']['Email'],
                        resp['rows']['Importo'] + '&euro;',
                        'Pending',
                        resp['rows']['CreatedAt'].split(' ')[1],
                        '<button data-toggle="modal" data-target="#MyEditRequest" style="width: 30%;" onclick="ManageRequest('+ resp['rows']['ID'] +')" type="button" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>\n' +
                        '<button id="sendRequest-'+ resp['rows']['ID'] +'" type="button" style="width: 30%;"  onclick="sendRequest('+resp['rows']['ID']+')" class="btn btn-success"><i class="fas fa-envelope-open"></i></button>\n' +
                        '<button type="button" style="width: 30%"  onclick="DeleteRequest('+resp['rows']['ID']+')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>',
                    ]
                ).draw( true );


            }else{
                $.notify(resp["message"], "error");
            }
        });

    });

</script>



