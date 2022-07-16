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
    <link rel="icon" href="{{ asset('assets/image/programmer.png') }}">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="d-sm-none d-md-none d-lg-block d-smi-none" style="margin-left: 800px; margin-top: -20px">
                @auth
                    <div class="seperti-itu text-center">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger">LogOut</button>
                        </form>
                        <form action="{{ route('links.index') }}" class="d-inline">
                            <button class="btn btn-primary">Manage Links</button>
                        </form>
                        <form action="{{ route('link-kantor') }}" class="d-inline">
                            <button class="btn btn-primary">Office Links</button>
                        </form>
                    </div>
                @else
                    <div class="seperti-itu text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    </div>
                @endauth
            </div>
            <div class="d-lg-none" style="margin-top: -20px">
                @auth
                    <div class="seperti-itu text-center">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger">LogOut</button>
                        </form>
                        <form action="{{ route('links.index') }}" class="d-inline">
                            <button class="btn btn-primary">Manage Links</button>
                        </form>
                        <form action="{{ route('link-kantor') }}" class="d-inline">
                            <button class="btn btn-primary">Office Links</button>
                        </form>
                    </div>
                @else
                    <div class="seperti-itu text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    </div>
                @endauth
            </div>
            <div class="col-md-12 mt-5">
                <img src="{{ asset('assets/image/programmer.png') }}" width="100" height="100" class="image-bunder rounded-circle d-block mx-auto">
                <div class="mt-5"></div>
                <div class="mt-2"></div>
                <div class="rounded-border mx-auto">
                    <h1 class="text-center h1-text">{{ Auth::user()->name }}</h1>
                </div>
                <div class="mt-4"></div>
                <div class="rounded-border-1 mx-auto">
                    <h1 class="text-center h1-text">Sebagai : {{ Auth::user()->roles }}</h1>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="mt-5"></div>
                <div class="mt-2"></div>
                <div class="seperti-itu mt-3">
                    {{-- @forelse ($links as $row)
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
                            <p class="text-emboh text-embohparah">user ini belum memiliki link</p>
                        </button>
                    @endforelse --}}
                    {{-- @if (Auth::user()->roles == 'KETUA')
                        @forelse ($links as $l)
                            <b>{{ $l->category->name }}</b>
                            @if ($l->name != null)
                                <a href="https://{{ $l->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $l->name }}</p>
                                </a>
                            @else
                                <a href="https://{{ $l->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $l->link }}</p>
                                </a>
                            @endif
                            @foreach ($link as $ls)
                            <b>{{ $link->category->name }}</b>
                                @if ($ls->name != null)
                                    <a href="{{ $ls->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ls->name }}</p>
                                    </a>
                                @else
                                    <a href="{{ $ls->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ls->link }}</p>
                                    </a>
                                @endif
                            @endforeach
                        @empty
                            <a class="luweh-emboh emboh">
                                <p class="text-emboh text-embohparah">User belum memiliki link</p>
                            </a>
                        @endforelse
                        @foreach ($ketua as $k)
                            @if ($k->name != null)
                                <a href="{{ $k->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $k->name }}</p>
                                </a>
                            @else
                                <a href="{{ $k->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $k->link }}</p>
                                </a>
                            @endif
                            @foreach ($ketuas as $ks)
                                @if ($ks->name != null)
                                    <a href="https://{{ $ks->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ks->name }}</p>
                                    </a>
                                @else
                                    <a href="https://{{ $ks->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ks->link }}</p>
                                    </a>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        @forelse ($links as $l)
                            @if ($l->name != null)
                                <a href="https://{{ $l->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $l->name }}</p>
                                </a>
                            @else
                                <a href="https://{{ $l->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $l->link }}</p>
                                </a>
                            @endif
                            @foreach ($link as $ls)
                                @if ($ls->name != null)
                                    <a href="{{ $ls->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ls->name }}</p>
                                    </a>
                                @else
                                    <a href="{{ $ls->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ls->link }}</p>
                                    </a>
                                @endif
                            @endforeach
                    @empty
                        <a class="luweh-emboh emboh">
                            <p class="text-emboh text-embohparah">User belum memiliki link</p>
                        </a>
                    @endforelse
                    @endif --}}
                    @forelse ($category as $cat)
                        <div class="text pt-4 pb-2">
                            <h1 class="text-h1 text-center">{{ $cat->name }}</h1>
                        </div>
                        @foreach ($cat->ketuas as $link)
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
                    {{-- @if (Auth::user()->roles == 'KETUA')
                        @forelse ($category as $cat)
                            @foreach ($link as $l)
                                @foreach ($cat->links as $li)
                                    @if ($li->link != $l->link)
                                        <a href="{{ $li->link }}" class="luweh-emboh emboh">
                                            <p class="text-emboh text-embohparah">{{ $li->link }}</p>
                                        </a>
                                    @else
                                        <a href="https://{{ $li->link }}" class="luweh-emboh emboh">
                                            <p class="text-emboh text-embohparah">{{ $li->link }}</p>
                                        </a>
                                    @endif
                                @endforeach
                            @endforeach
                        @empty
                            <a class="luweh-emboh emboh">
                                <p class="text-emboh text-embohparah">User belum memiliki link</p>
                            </a>
                        @endforelse
                        @foreach ($ketua as $k)
                            @if ($k->name != null)
                                <a href="{{ $k->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $k->name }}</p>
                                </a>
                            @else
                                <a href="{{ $k->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $k->link }}</p>
                                </a>
                            @endif
                            @foreach ($ketuas as $ks)
                                @if ($ks->name != null)
                                    <a href="https://{{ $ks->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ks->name }}</p>
                                    </a>
                                @else
                                    <a href="https://{{ $ks->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ks->link }}</p>
                                    </a>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        @forelse ($links as $l)
                            @if ($l->name != null)
                                <a href="https://{{ $l->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $l->name }}</p>
                                </a>
                            @else
                                <a href="https://{{ $l->link }}" class="luweh-emboh emboh">
                                    <p class="text-emboh text-embohparah">{{ $l->link }}</p>
                                </a>
                            @endif
                            @foreach ($link as $ls)
                                @if ($ls->name != null)
                                    <a href="{{ $ls->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ls->name }}</p>
                                    </a>
                                @else
                                    <a href="{{ $ls->link }}" class="luweh-emboh emboh">
                                        <p class="text-emboh text-embohparah">{{ $ls->link }}</p>
                                    </a>
                                @endif
                            @endforeach
                    @empty
                        <a class="luweh-emboh emboh">
                            <p class="text-emboh text-embohparah">User belum memiliki ini</p>
                        </a>
                    @endforelse
                    @endif --}}
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