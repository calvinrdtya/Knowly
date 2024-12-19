<!-- Header Area Start -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="{{ url('/') }}" class="logo">
                        {{-- <h1>Knowly</h1> --}}
                        <img src="{{ asset('home/assets/images/logo.png') }}" alt="" style="width: 20% !important">
                    </a>
                    <div class="search-input">
                        <form id="search" action="#">
                            <input type="text" placeholder="Cari" id='' name="searchKeyword" onkeypress="handle" />
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login | Daftar</a>
                        </li>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Area End -->