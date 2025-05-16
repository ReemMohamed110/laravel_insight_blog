<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}" style="color: black">Laravel Insight</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href={{ url('/') }}
                        style="color: black">Home</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href={{ url('post_dashboard') }}
                        style="color: black">all posts</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href={{ url('about') }}
                        style="color: black">About</a></li>
                {{-- <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href={{ url('create_post') }}
                        style="color: black">add post</a>
                </li> --}}
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href={{ url('my_posts') }}
                        style="color: black">My
                        Posts</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href={{ url('contact') }}
                        style="color: black">Contact</a></li>
                <!-- Right side - Auth Menu -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href={{ url('create_post') }}
                                style="color: black">add post</a>
                        </li>
                        <!-- User Dropdown (like Breeze style) -->
                        <li class="nav-item dropdown">
                            
                            <a class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class=" dropdown-item px-lg-3 py-3 py-lg-4" style="color: rgb(88, 37, 241)">{{ Auth::user()->role }}</a>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="color: red">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Login/Register -->
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" style="color: black">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" style="color: black">Register</a></li>
                    @endauth
                </ul>
            </ul>
        </div>
    </div>
</nav>
