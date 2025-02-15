<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .form {
            box-shadow: 10px 5px 15px 3px rgba(0, 0, 0, 0.3);

        }
    </style>



    <title>Hello, world!</title>
</head>

<body>
    <div class="container">

        <div class=" d-flex justify-content-center align-items-center min-vh-100">

            <form id="form" class="card w-50 p-5 form">
                <h1 class="text-center my-5">Fill the details</h1>
                <label class="font-weight-bold">Enter the base 64 image</label>
                <textarea class="form-control" placeholder="Please enter the base64 URL" id="base64string" required></textarea>

                <div class=" d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-success w-25">Submit</button>
                </div>
            </form>
        </div>

    </div>





    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });




        $("#form").on("submit", function(e) {

            e.preventDefault();
            var base64 = $("#base64string").val().trim();


            $.ajax({

                url: "{{ route('submit') }}",
                method: "post",
                data: {
                    base64: base64,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {

                        $("#form")[0].reset();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "Image uploaded successfully"
                        });

                    } else {
                        $("#form")[0].reset();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "error",
                            title: `${response.msg}`
                        });
                    }

                }


            })



        })
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>