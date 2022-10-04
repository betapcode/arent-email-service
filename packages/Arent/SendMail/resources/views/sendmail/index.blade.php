
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://arent3d.com/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Arent tool sendmail simple</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/floating-labels/floating-labels.css" rel="stylesheet">
    <style>
        .form-signin {
            max-width: 620px !important;
        }
    </style>
</head>

<body>
    <form class="form-signin" method="post" action="{{ route('arent.sendmail.sendmail') }}">
        @csrf
        <div class="text-center mb-4">
            <img class="mb-4" src="https://arent3d.com/assets/images/common/logo_arent.png" alt="" width="217" height="46">
            <h1 class="h3 mb-3 font-weight-normal">Arent tool sendmail simple</h1>
            @if(session('success'))
                <div class="text-success text-center">{{session('success')}}</div>
            @endif
        </div>

        <div class="form-label-group">
            <input type="text" id="inputEmail" name="emails" value="{{ old('emails') }}" class="form-control" placeholder="Input Emails address. Ex: betapcode@gmail.com, pnminh.it@gmail.com" required autofocus>
            <label for="inputEmail">Emails address. Ex: betapcode@gmail.com, pnminh.it@gmail.com</label>
            @error('emails')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="text" id="inputSubject" name="subject" value="{{ old('subject') }}" class="form-control" placeholder="Subject" required>
            <label for="inputSubject">Subject</label>
            @error('subject')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-label-group">
            <textarea class="form-control" id="inputPassword" name="content" value="{{ old('content') }}" rows="10" placeholder="Content Detail" required></textarea>
            @error('content')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Send Mail</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2022</p>
    </form>
</body>
</html>
