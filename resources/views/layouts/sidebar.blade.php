<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @if (auth()->user()->roles == 'admin' || auth()->user()->roles == 'staff' )
                    <div class="sb-sidenav-menu-heading">Data</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Data Master
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            @if (auth()->user()->roles == 'admin')
                            <a class="nav-link" href="{{route('user')}}">User</a>
                            <a class="nav-link" href="{{route('dokter')}}">Dokter</a>
                            @endif
                            @if (auth()->user()->roles == 'admin' || auth()->user()->roles == 'staff' )
                            <a class="nav-link" href="{{route('pasien')}}">Pasien</a>
                            @endif
                        </nav>
                    </div>
                @endif

                <div class="sb-sidenav-menu-heading">Rekam Medis</div>
                <a class="nav-link" href="{{route('rekamMed')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Rekam Medis
                </a>


    </nav>
</div>
