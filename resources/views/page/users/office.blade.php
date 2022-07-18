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
    <link rel="icon" href="{{ asset('assets/image/man.png') }}">

    <title>Link Office : All</title>
  </head>
  <body>
    <div class="d-lg-none">
        <img src="{{ asset('assets/image/Logo BPS Baru 2.png') }}" class="d-block mx-auto" width="256" alt="">
    </div>
    <div class="d-sm-none d-md-none d-lg-block d-smi-none">
        <img src="{{ asset('assets/image/Logo BPS Baru 2.png') }}" style="margin-left: 20px;" width="256" alt="">
    </div>
      <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="d-sm-none d-md-none d-lg-block d-smi-none" style="margin-left: 500px; margin-top: -130px">
                <div class="" style="margin-top: -20px;"></div>
                @auth
                    @if (Auth::user()->roles == 'KETUA')
                        <div class="seperti-itu text-center">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger">LogOut</button>
                            </form>
                            <form action="{{ route('links.index') }}" class="d-inline">
                                <button class="btn btn-primary">Manage Links</button>
                            </form>
                            <form action="{{ route('link-user') }}" class="d-inline">
                                <button class="btn btn-primary">My Links</button>
                            </form>
                            <form action="{{ route('link-ketua') }}" class="d-inline">
                                <button class="btn btn-primary">Ketua Links</button>
                            </form>
                        </div>
                    @else
                        <div class="seperti-itu text-center">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger">LogOut</button>
                            </form>
                            <form action="{{ route('links.index') }}" class="d-inline">
                                <button class="btn btn-primary">Manage Links</button>
                            </form>
                            <form action="{{ route('link-user') }}" class="d-inline">
                                <button class="btn btn-primary">My Links</button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="seperti-itu text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    </div>
                @endauth
            </div>
            <div class="d-lg-none" style="margin-top: -40px; margin-bottom: 70px">
                @auth
                    @if (Auth::user()->roles == 'KETUA')
                        <div class="seperti-itu text-center">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger">LogOut</button>
                            </form>
                            <form action="{{ route('links.index') }}" class="d-inline">
                                <button class="btn btn-primary">Manage Links</button>
                            </form>
                            <form action="{{ route('link-user') }}" class="d-inline">
                                <button class="btn btn-primary">My Links</button>
                            </form>
                            <form action="{{ route('link-ketua') }}" class="d-inline">
                                <button class="btn btn-primary">Ketua Links</button>
                            </form>
                        </div>
                    @else
                        <div class="seperti-itu text-center">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger">LogOut</button>
                            </form>
                            <form action="{{ route('links.index') }}" class="d-inline">
                                <button class="btn btn-primary">Manage Links</button>
                            </form>
                            <form action="{{ route('link-user') }}" class="d-inline">
                                <button class="btn btn-primary">My Links</button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="seperti-itu text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    </div>
                @endauth
            </div>
            <div class="col-md-12">
                <img src="{{ asset('assets/image/programmer.png') }}" width="100" height="100" class="image-bunder rounded-circle d-block mx-auto">
                <div class="mt-5"></div>
                <div class="mt-2"></div>
                @auth
                    <div class="rounded-border mx-auto">
                        <h1 class="text-center h1-text">{{ Auth::user()->name }}</h1>
                    </div>
                    <div class="mt-4"></div>
                    @if (Auth::user()->roles == 'KETUA')
                        <div class="rounded-border-1 mx-auto">
                            <h1 class="text-center h1-text">Sebagai : KETUA SUPERVISI</h1>
                        </div>
                    @else
                        <div class="rounded-border-2 mx-auto">
                            <h1 class="text-center h1-text">Sebagai : {{ Auth::user()->roles }}</h1>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="mt-5"></div>
                <div class="mt-2"></div>
                <div class="seperti-itu">
                    @forelse ($category as $cat)
                        @if ($cat->offices->count() != null)
                            <div class="text pt-4 pb-2">
                                <h1 class="text-h1 text-center">{{ $cat->name }}</h1>
                            </div>
                        @endif
                        @foreach ($cat->offices as $link)
                            @if (strpos($link->link, 'http') === 0 || strpos($link->link, 'https') === 0)
                                <a href="{{ $link->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $link->link }}</p>
                                </a>
                            @else
                                <a href="https://{{ $link->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $link->link }}</p>
                                </a>
                            @endif
                        @endforeach
                    @empty
                        <a class="luweh-emboh emboh">
                            <p class="text-emboh text-embohparah">User belum memiliki link</p>
                        </a>
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