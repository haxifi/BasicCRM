<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title>Gestione Account</title>

<div style="text-align: left;" class="col-lg-12">
    <button class="shortoption btn btn-info" data-toggle="modal" data-target="#MyAddUser" type="button" ><i class="fas fa-user-plus"></i> Aggiungi</button>
    <button class="shortoption btn btn-danger" data-toggle="modal" data-target="#MyDeleteUser"  type="button" ><i class="fas fa-trash-alt"></i> Elimina</button>
</div>

<hr>


<!------------------------------------ MODAL ADD USER ----------------------------------------------------------------->

<div class="modal fade" id="MyAddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Aggiungi Nuovo</h4>
            </div>
            <div class="modal-body">

                <div class="col-lg-12">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-user-alt"></i></span>
                            <input id="DataUsername" type="text" class="form-control" placeholder="Username" />
                        </div>
                        <div style="text-align: right;">
                            <label>* Da 5 a 12 caratteri, spazio non ammesso</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-key"></i></span>
                            <input id="DataPassword" type="password" class="form-control" placeholder="Password" />
                        </div>
                        <div style="text-align: right;">
                            <label>* Minimo 8 caratteri</label>
                        </div>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                        <input id="DataEmail" type="text" class="form-control" placeholder="E-Mail" />
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="button" id="btn-addUser" class="btn btn-primary">Aggiungi Utente</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------------------------------------------->


<!------------------------------------ MODAL DELETE USER -------------------------------------------------------------->

<div class="modal fade" id="MyDeleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Elimina Utente</h4>
            </div>
            <div class="modal-body">

                <div class="col-lg-12">

                    <select class="form-control" id="userID">
                        <option selected disabled>Seleziona Utente</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user["id"]; ?>"><?php echo $user["username"]; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="button" id="DeleteUser" class="btn btn-danger">Elimina</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------------------------------------------->





<div class="col-lg-12">

    <table id="datatabsystem" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Creato Il</th>
        </tr>
        </thead>
        <tbody>


        <?php foreach ($users as $user): ?>

            <tr class="row-item-<?php echo $user["id"]; ?>">
                <td><?php echo $user["id"]; ?></td>
                <td><?php echo $user["username"]; ?></td>
                <td><?php echo $user["email"]; ?></td>
                <td><?php echo explode(' ',$user["createdAt"])[0]; ?></td>
            </tr>

        <?php endforeach; ?>


    </table>

</div>


<script>

    $("#btn-addUser").click(function () {
        var url  = "<?php echo $homepage; ?>api/manager/user/add";
        var send = {
            username: $("#DataUsername").val(),
            password: $("#DataPassword").val(),
            email:    $("#DataEmail").val()
        };
        $.post(url,send ,function (data) {
            if(data["response"] == "success")
            {
                $("#MyAddUser").modal('hide');
                $.notify(data["message"], "success");

                var param =  [
                    data["rows"]["id"],
                    data["rows"]["username"],
                    data["rows"]["email"],
                    data["rows"]["createdAt"].split(' ')[1]
                ];

                DataTable.row.add(param).draw( true );


            }else{
                $.notify(data["message"], "error");
            }
        });
    });


    $("#DeleteUser").click(function () {
        var url  = "<?php echo $homepage; ?>api/manager/user/delete";

        var send = {
            userID: $("#userID").val()
        }

        $.post(url,send,function (data) {

            if(data["response"] == "success"){
                $("#MyDeleteUser").modal('hide');
                $.notify(data["message"], "success");
                DataTable.row(('.row-item-' + send['userID'])).remove().draw( true );

            }else{
                $.notify(data["message"], "error");
            }
        });

    });


</script>


