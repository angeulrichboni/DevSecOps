<nav class="main-header navbar navbar-expand  navbar-white navbar-light">
    <div class="container">
            <a href="{{route('dashboard')}}" class="navbar-brand">
                <span class="brand-text text-success font-weight-bold">Task-<strong>LIST</strong></span>
            </a>
        <!-- Left navbar links -->
{{--        <ul class="navbar-nav">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>--}}
{{--                </li>--}}
{{--        </ul>--}}

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-home mr-2"></i> Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-hands-helping"></i> Services
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="{{route('tasks.index')}}" class="dropdown-item">
                            <i class="fas fa-eye"></i> Consulter la liste des taches
                        </a>

                    </div>
                </li>

            <li class="nav-item dropdown">
                <a class="nav-link image" data-toggle="dropdown" href="#">
                    Bienvenue {{Auth::user()->name}} <img src="{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : asset('backend/dist/img/profil.png') }}" class="img-circle elevation-2 mt-n1 mx-1" alt="User Image" style="height: 35px; width: 35px">
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    {{--                <span class="dropdown-item dropdown-header">15 Notifications</span>--}}
                    <div class="dropdown-divider"></div>
                    <a href="{{route('profile.edit')}}" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"  style="background: none; border: none; color: inherit; cursor: pointer;">
                            <i class="fas fa-door-closed mr-2"></i> Deconnexion
                        </button>
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>
