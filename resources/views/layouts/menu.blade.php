<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a href="{{route('dashboard')}}" class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-text mx-3">Orgnanik mi Organik</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @if(Request::segment(1) == '') active @endif">
            <a href="{{route('dashboard')}}" class="nav-link" href="">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            İçerik Yönetimi
        </div>


        <li class="nav-item @if(Request::segment(1) == 'urunler') active @endif"> <!-- urunler = products -->
            <a href="{{route('urunler.index')}}" class="nav-link" href="">
                <i class="fab fa-product-hunt"></i>
                <span>Ürünler</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'kategoriler') in @else collapsed @endif" href="#"
               data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-boxes"></i>
                <span>Stok İşlemleri</span>
            </a>
            <div id="collapseTwo"
                 class="collapse @if(Request::segment(1) == 'stok') show @endif"
                 aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Stok İşlemleri</h6>
                    <a class="collapse-item @if(Request::segment(1) == 'stok' and Request::segment(2) == 'create') active @endif"
                       href="{{route('stok.create')}}">
                        <i class="fas fa-truck mr-1" style="opacity: .7 !important;"></i>
                        Stok Giriş Çıkışı
                    </a>
                    {{--<a class="collapse-item @if(Request::segment(1) == 'stok' and Request::segment(2) == 'create') active @endif"
                       href="">
                        <i class="fas fa-truck mr-1 fa-rotate-180 fa-flip-horizontal" style="opacity: .7 !important;"></i>
                        Stok Çıkışı
                    </a>--}}
                    <a href="{{route('stok.index')}}" class="collapse-item @if(Request::segment(1) == 'stok' and Request::segment(2) == '') active @endif"
                       href="">
                        <i class="fas fa-history mr-1" style="opacity: .7 !important;"></i>
                        Stok Geçmişi
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item @if(Request::segment(1) == 'markalar') active @endif"><!-- markalar = brands -->
            <a href="{{route('markalar.index')}}" class="nav-link" href="">
                <i class="fas fa-copyright"></i>
                <span>Markalar ve Birimler</span></a>
        </li>

        <li class="nav-item @if(Request::segment(1) == 'kategoriler') active @endif"><!-- markalar = brands -->
            <a href="{{route('kategoriler.index')}}" class="nav-link" href="">
                <i class="fas fa-sitemap"></i>
                <span>Kategoriler</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <h3 class="ml-3 mt-2">@yield('headerTitle')</h3>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                        </a>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Kullanıcı İşlemleri
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Çıkış Yap
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
