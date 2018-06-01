<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
        
        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

        <style>
            body {
                background-color:#eee;
                min-height:100vh;
            }
        </style>

    </head>

    <body>

        <section class="section">

            <div class="container">

                <div class="colums">
                    
                    <div class="column is-half is-offset-one-quarter">

                        <h1 class="title">Custom Search</h1>

                        <div class="box is-success is-outlined">

                            <form method="get" action="">
                            
                                <div class="columns is-multiline is-mobile">
                                    
                                    <div class="column is-half">
                                        <div class="field">
                                            <label class="label">Origin</label>
                                            <div class="control">
                                                <input class="input" type="text" name="origin" value="<?php echo $this->input->get('origin'); ?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-half">
                                        <div class="field">
                                            <label class="label">Destination</label>
                                            <div class="control">
                                                <input class="input" type="text" name="destination" value="<?php echo $this->input->get('destination'); ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="column is-half">
                                        <div class="field">
                                            <label class="label">Departure Date</label>
                                            <div class="control">
                                                <input class="input monthPicker" type="text" name="depart_date" value="<?php echo $this->input->get('depart_date'); ?>"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-half">
                                        <div class="field">
                                            <label class="label">Return Date</label>
                                            <div class="control">
                                                <input class="input monthPicker" type="text" name="return_date" value="<?php echo $this->input->get('return_date'); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="button is-primary">Search</button>

                            </form>

                        </div>

                    <?php
                    if($data != NULL and $data->success == 1) {

                        foreach($data->data as $dest) {

                            foreach($dest as $ticket) {

                                $search_params = array(
                                    'origin' => $request_params['origin'],
                                    'destination' => $request_params['destination'],
                                    'depart_date' => $ticket->departure_at,
                                    'return_date' => $ticket->return_at
                                );
                    ?>
                        
                        <div class="box">

                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-64x64" style="background-color:#eee;border-color:#ccc;">
                                        <img class="" src="<?php echo airline_logo($ticket->airline, 200, 200); ?>" alt="<?php echo $ticket->airline; ?>">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong><?php echo $label; ?></strong>
                                            <ul>
                                                <li>Airline : <?php echo airline($ticket->airline)->name; ?></li>
                                                <li>Departure : <?php echo datetime_proper($ticket->departure_at); ?></li>
                                                <li>Return : <?php echo datetime_proper($ticket->return_at); ?></li>
                                                <li>Expiration : <?php echo datetime_proper($ticket->expires_at); ?></li>
                                            </ul>
                                            <?php for($x=1;$x<=3;$x++) { ?>
                                                <a href="<?php echo flight_search_url($search_params, $x) ?>" class="button is-success is-small" target="_blank"><?php echo $x; ?> Pax</a>
                                            <?php } ?>
                                        </p>
                                    </div>
                                    
                                </div>
                                <div class="media-right">
                                    <strong><big><?php echo $ticket->price; ?></big> <small><?php echo strtoupper($data->currency); ?></small></strong>
                                </div>
                            </article>

                        </div>

                    <?php }
                        }
                    } else { ?>

                        <div class="box">
                            <p class="has-text-centered">No results found</p>
                        </div>

                    <?php } ?>

                    </div>

                </div>

            </div>

        </section>

        <!-- scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

        <script>
            
            $(document).ready(function(){

                $(".monthPicker").datepicker({ 
                    dateFormat: 'yy-mm',
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,

                    onClose: function(dateText, inst) {  
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
                        $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
                    }
                });

                $(".monthPicker").focus(function () {
                    $(".ui-datepicker-calendar").hide();
                    $("#ui-datepicker-div").position({
                        my: "center top",
                        at: "center bottom",
                        of: $(this)
                    });    
                });
            });

        </script>


    </body>

</html>