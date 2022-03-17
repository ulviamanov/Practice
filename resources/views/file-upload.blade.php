<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <title>Laravel File Upload</title>
    <style>
        .container {
            max-width: 500px;
        }

    </style>
</head>

<body>

    <div class="container mt-5">
        <form id="laravel-ajax-file-upload" method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-5" >Upload File in Laravel</h3>

            <div class="alert alert-success" style="display:none">
            <strong id="success-msg"></strong>
            </div>

            <div class="alert alert-danger" style="display:none">
                     <strong id="error-msg"></strong>
            </div>


            <div class="custom-file">
                <input type="file" name="file" class="custom-file-inputs" id="chooseFile">
                <!-- <label class="custom-file-label" for="chooseFile">Select file</label> -->
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button>
        </form>
        <div id="fileList" >
        </div>
    </div>

<script>

    
    $('#laravel-ajax-file-upload').submit(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('/upload-file')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    if(data.success){
                        $(".alert-success").css("display", "block");
                        $(".alert-danger").css("display", "none");
                        $("#success-msg").html(data.msg);
                        $("#fileList").html(data.views);
                    }else{
                        $(".alert-success").css("display", "none");
                        $(".alert-danger").css("display", "block");
                        $("#error-msg").html(data.msg);
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
</script>

</body>
</html>