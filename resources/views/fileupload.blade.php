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
                <h2 class="text-center mb-2">File Upload</h2>
            </div>
        </div>
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <input type="file" name="photo" accept="image/*">
                    <span class="text-danger">
                        @error('photo')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-sm btn-primary">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-6">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($users as $user)
                <div class="col-12 ">
                    <img class="img-fluid img-thumbnail w-50" src="{{ asset('/storage/' . $user->filename) }}"
                        alt="">
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Update</a>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
