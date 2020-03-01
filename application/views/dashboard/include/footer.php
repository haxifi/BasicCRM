                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>

    <script>
        var MobileSwitch = false;

        const Capitalize = (s) => {
            if (typeof s !== 'string') return ''
            return s.charAt(0).toUpperCase() + s.slice(1)
        }

        $(".logo").click(function () {
            if(!MobileSwitch){
                DesktopMode();
                MobileSwitch = true;
            }else{
                MobileMode();
                MobileSwitch = false;
            }
        });


        function SetDevice() {
            var width   = $(window).width();
            if (width < 768) {
                MobileMode();
                MobileSwitch = false;
            }
            else {
                DesktopMode();
                MobileSwitch = true;
            }
        }

        function DesktopMode(){
            var width   = $(window).width();

            $(".content")
                .css('position','relative')
                .css('padding','15px 15px 0 15px')
                .css('min-height','95%')
                .css('padding','15px')
                .css('margin-right','auto')
                .css('margin-left','auto')
                .css('overflow','auto')
                .css('height', '100%')
                .css('transition','1s');

            if(width > 768){
                $(".skin-blue .main-header .navbar")
                    .css('background-color','#3c8dbc');
                if($(".table").length) $(".table").removeClass('table-responsive');
            }
        }

        function MobileMode()
        {
            $(".content")
                .css('width','100%')
                .css('left','0px')
                .css('position','absolute')
                .css('overflow','auto')
                .css('height', '100%')
                .css('background-color','#ecf0f5')
                .css('min-height','95%')
                .css('padding','15px')
                .css('margin-right','auto')
                .css('margin-left','auto')
                .css('z-index','10000');

            var width   = $(window).width();

            if(width < 768){
                $(".skin-blue .main-header .navbar")
                    .css('background-color','#222d32');
                if($(".table").length) $(".table").addClass('table-responsive');
            }
        }


        var DataTable =  $('#datatabsystem').DataTable
        (
            {
                responsive: true,
                order: [[ 0, 'desc' ]],
                language:
                    {
                        lengthMenu:     " Visualizza &nbsp;  _MENU_ &nbsp; ",
                        zeroRecords:    "Nessun valore trovato",
                        info:           "_PAGE_ di _PAGES_",
                        infoEmpty:      "Nessun valore trovato",
                        infoFiltered:   "(filtered from _MAX_ total records)",
                        search:         "Cerca in elenco _INPUT_",
                        paginate:
                            {
                                first:      "Prima pagina",
                                last:       "Ultima pagina",
                                next:       "<i style='font-size: 16px;' class='fas fa-chevron-right'></i>",
                                previous:   "<i style='font-size: 16px;' class='fas fa-chevron-left'></i>"
                            }
                    }
            }
        );


        $(document).ready(function ()
        {

            var currentPageID   =   $('title').text().replace(new RegExp(' ', 'g'), '_');
            $("#Aside_" + currentPageID).addClass('active');

            SetDevice();
        });

        $(window).resize(function() {
            SetDevice();
        });


    </script>




</html>