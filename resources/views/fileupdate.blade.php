<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>File Upload</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-2"> Update File Upload</h2>
            </div>
        </div>
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-3">
                    <img class="img-responsive img-fluid" id="output" src="{{ asset('storage/' . $user->filename) }}"
                        alt="">
                </div>
                <div class="col-9">
                    <input type="file"
                        onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])"
                        name="photo" accept="image/*">
                    <span class="text-danger">
                        @error('photo')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="col-12">
                    <input type="submit" value="Update" class="btn btn-sm btn-primary">
                </div>
            </div>
        </form>


    </div>

</body>

</html>
