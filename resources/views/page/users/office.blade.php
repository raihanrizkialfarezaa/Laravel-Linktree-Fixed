<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" href="{{ asset('assets/image/link.png') }}">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="" style="margin-left: 800px; margin-top: -20px">
                @auth
                    <div class="seperti-itu text-center">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger">LogOut</button>
                        </form>
                        <form action="{{ route('link-user') }}" class="d-inline">
                            <button class="btn btn-primary">My Links</button>
                        </form>
                        <form action="{{ route('links.index') }}" class="d-inline">
                            <button class="btn btn-primary">Manage Links</button>
                        </form>
                    </div>
                @else
                    <div class="seperti-itu text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    </div>
                @endauth
            </div>
            <div class="col-md-12 mt-5">
                <img src="{{ asset('assets/image/link.png') }}" width="100" height="100" class="image-bunder rounded-circle d-block mx-auto">
                <div class="mt-5"></div>
                <div class="mt-2"></div>
                <div class="text">
                    <h1 class="text-center text-h1">General Office Links</h1>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="mt-5"></div>
                <div class="mt-2"></div>
                <div class="seperti-itu">
                    @forelse ($office as $row)
                        @if ($row->name != null)
                            <a href="https://{{ $row->link }}" class="luweh-emboh emboh">
                                <p class="text-emboh text-embohparah">{{ $row->name }}</p>
                            </a>
                        @else
                            <a href="https://{{ $row->link }}" class="luweh-emboh emboh">
                                <p class="text-emboh text-embohparah">{{ $row->link }}</p>
                            </a>
                        @endif
                    @empty
                        <button class="luweh-emboh emboh red-bg">
                            <p class="text-emboh text-embohparah">belum ada link general</p>
                        </button>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="mt-5"></div>
                <div class="mt-2"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  </body>
</html>