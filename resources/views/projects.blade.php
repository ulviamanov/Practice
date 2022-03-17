<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Integrate Bootstrap Datepicker in Laravel </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
</head>

<body>
   <div class="container mt-5" style="max-width: 450px">
        <h2 class="mb-4">Projekt List</h2>

        <div class="form-group">
            <strong>Start</strong>
            <div class='input-group date datetimepicker' id='datetimepicker'>
            <input type='text' name="start" id="start" class="form-control" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
            </div>
        </div>

        <div class="form-group">
            <strong>End</strong>
            <div class='input-group date datetimepicker' id='datetimepicker'>
                
            <input type='text'  name="end" id="end"  class="form-control" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
            </div>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-primary load-projects">Load Projekt</button>
        </div>
        <div id="companyList" >
        </div>
   </div>
</body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(function() {
           $('.datetimepicker').datetimepicker();
        });



    $("body").on("click", ".load-projects", function() { 
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax({
        data: {
            start: $("#start").val(),
            end: $("#end").val()
        },
        url:"{{ url('/load-project')}}",
        dataType: 'JSON',
        method: 'POST'
        }).done(function ( response ) {
            $("#companyList").html(response.views);
            $("#totalRecords").html(response.total);
        }).fail(function (x,y,z) {

            console.log(x);
            alert( "Request failed: " + y );
            console.log(z);
        });
    });

    </script>    
    <script>
     
    //  $(document).ready( function () {
    //      $('#basecone-log').DataTable(
    //          {	
    //              responsive: true,
    //              "order": [[ 1, "desc" ]],
    //               columnDefs: [{
    //              "targets": 1,
    //              "type": 'date',
    //          }]
    //          }
    //      );
    //  } );
  </script>

</html>