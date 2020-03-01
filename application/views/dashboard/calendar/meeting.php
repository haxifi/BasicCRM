<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<title>Gestione Impegni</title>




<!------------------------------------ MODAL ADD DATE -------------------------------------------------------------->
<div class="modal fade" id="MyAddRequest" tabindex="-1" role="dialog" aria-labelledby="MyCalendar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="MyCalendar">Aggiungi Nuovo Evento</h4>
            </div>
            <div class="modal-body">

                <div class="col-lg-12">

                    <div style="margin-top: 15px;" class="form-group input-group">
                        <span class="input-group-addon"><i class="far fa-clipboard"></i></span>
                        <input id="eventDescription" maxlength="40" type="text" class="form-control" placeholder="Descrizione" />
                    </div>

                    <div style="margin-top: 15px;" class="form-group input-group">
                        <span class="input-group-addon"><i class="far fa-calendar-plus"></i></span>
                        <input id="eventDate" type="date" class="form-control"  placeholder="Data" />
                    </div>

                    <div style="margin-top: 15px;" class="form-group input-group">
                        <span class="input-group-addon"><i class="far fa-clock"></i></span>
                        <input id="eventTime"  type="time" class="form-control"  />
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                <button type="button" id="btn-addDate" class="btn btn-primary">Aggiungi</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------------------------------------------->


<!------------------------------------------------ Calendar ----------------------------------------------------------->

<div style="max-width: 65%;" id='calendar'></div>

<!--------------------------------------------------------------------------------------------------------------------->


<script>

    var Calendario = null;

    $("#btn-addDate").click(function ()
    {
        var data       =
        {
            description:   $("#eventDescription").val(),
            data:          $("#eventDate").val(),
            time:          $("#eventTime").val()
        };
        var controller =  '<?php echo $eventsPath; ?>send';
        $.post(controller, data, function (resp) {

            if(resp["esito"] == "success")
            {
                $("#MyAddRequest").modal('hide');
                $.notify(resp["message"], "success");
                Flush();

            }else{
                $.notify(resp["message"], "error");
            }
        });
    });



    function Flush()
    {
        $("#calendar").html('');
        calendarEl = document.getElementById('calendar');
        this.Calendario = new FullCalendar.Calendar(calendarEl, {

            plugins: [ 'interaction', 'dayGrid' ],
            locale: 'it',
            defaultDate: '<?php echo date('Y-m-d'); ?>',
            customButtons: {
                reload:
                    {
                        text: 'Aggiungi evento',
                        click: function()
                        {
                            $('#MyAddRequest').modal({
                                show: true
                            });
                        }
                    }
            },
            header: {
                right: 'month,agendaWeek,agendaDay,listMonth, reload',
                center: 'title',
                left: 'prev,next'
            },
            editable: false,
            eventLimit: true,
            weekNumbers: true,
            events: '<?php echo $eventsPath; ?>read'
        });

        this.Calendario.render();
    }


    $(document).ready(function ()
    {
        Flush();
    });


</script>

