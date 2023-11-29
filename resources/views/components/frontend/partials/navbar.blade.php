<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{route('welcome')}}">Phoenix Rise Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a></li>
                @can('view_users')
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                @endcan
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($categories as $slug => $name)
                            <li><a class="dropdown-item" href="{{route('category.products',$slug)}}">
                            {{$name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            
            <!-- Move the authentication buttons to the right -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    @auth
                    <a class="btn btn-outline-light" href="{{route('carts.index')}}">
                        <i class="bi-cart-fill me-1"></i>
                        <span class="badge bg-light text-dark ms-1 rounded-pill">
                            {{auth()->user()->cart ? auth()->user()->cart->cartItems()->count() : 0}}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">Settings</a></li>
                            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="dropdown-item">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item"><a href="{{route('login')}}" class="btn btn-outline-light">Log in</a></li>
                    <li class="nav-item"><a href="{{route('register')}}" class="btn btn-outline-light">Register</a></li>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
