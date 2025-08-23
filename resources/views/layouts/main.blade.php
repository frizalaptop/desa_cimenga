<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desa Cimenga</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1a56a7;
            --secondary-color: #2c6fd1;
            --light-color: #e9f0f9;
            --dark-color: #0d3b7a;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .sidebar {
            background-color: white;
            min-height: calc(100vh - 56px);
            box-shadow: 1px 0 5px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: #495057;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--light-color);
            color: var(--primary-color);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }
        
        .card-primary {
            border-left: 4px solid var(--primary-color);
        }
        
        .bg-primary-light {
            background-color: var(--light-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
        }
        
        .table th {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        /* Tombol toggle sidebar mobile */
        #sidebarToggle{
            position: fixed;
            top: 50%;
            left: .5rem;
            transform: translateY(-50%);
            z-index: 1046; /* di atas backdrop (1045) */
            padding: .6rem .7rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-landmark me-2"></i>
                SISTEM ADMINISTRASI DESA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Tombol toggle sidebar (hanya di mobile) -->
    <button id="sidebarToggle" class="btn btn-primary rounded-pill d-md-none"
        type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"
        aria-controls="mobileSidebar" aria-label="Buka menu">
        <i class="fa-solid fa-angle-right"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Desktop -->
            <div class="col-lg-2 col-md-3 d-none d-md-block sidebar p-0">
                <div class="p-3">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Desa" class="img-fluid" style="max-height: 80px;">
                        <h5 class="mt-2 mb-0 fw-bold">Desa Cimenga</h5>
                        <small class="text-muted">Kabupaten Kuningan</small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}" id="dashboard-menu">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('residents.show', Auth::user()->id) }}" id="residents-menu">
                                <i class="fas fa-user"></i> Data Diri
                            </a>
                        </li>

                        @if(Auth::user()->role == 'Sekretaris')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}" id="users-menu">
                                <i class="fas fa-users"></i> Daftar Pengguna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petitions.statistic') }}" id="statistics-menu">
                                <i class="fas fa-chart-line"></i> Statistik Surat
                            </a>
                        </li>
                        @endif
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('letters.index') }}" id="letters-menu">
                                <i class="fas fa-envelope"></i> Surat Menyurat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petitions.index') }}" id="reports-menu">
                                <i class="fas fa-chart-bar"></i> Laporan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 ms-sm-auto px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('action-buttons')
                    </div>
                </div>

                <!-- Notifikasi -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Konten Utama -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Sidebar Mobile (Offcanvas) -->
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="mobileSidebarLabel">Desa Cimenga</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
      </div>
      <div class="offcanvas-body p-0">
        <div class="p-3 border-bottom text-center">
          <img src="{{ asset('images/logo.png') }}" alt="Logo Desa" class="img-fluid" style="max-height: 60px;">
          <div class="mt-2 fw-bold">Desa Cimenga</div>
          <small class="text-muted">Kabupaten Kuningan</small>
        </div>

        <ul class="nav flex-column p-3">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}" id="dashboard-menu-m">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('residents.show', Auth::user()->id) }}" id="residents-menu-m">
              <i class="fas fa-user"></i> Data Diri
            </a>
          </li>

          @if(Auth::user()->role == 'Sekretaris')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}" id="users-menu-m">
              <i class="fas fa-users"></i> Daftar Pengguna
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('petitions.statistic') }}" id="statistics-menu-m">
              <i class="fas fa-chart-line"></i> Statistik Surat
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a class="nav-link" href="{{ route('letters.index') }}" id="letters-menu-m">
              <i class="fas fa-envelope"></i> Surat Menyurat
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('petitions.index') }}" id="reports-menu-m">
              <i class="fas fa-chart-bar"></i> Laporan
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light border-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-muted">&copy; {{ date('Y') }} Sistem Administrasi Desa</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span class="text-muted">Versi 1.0.0</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Tentukan menu aktif berdasarkan URL
      const currentPath = window.location.pathname;

      const map = [
        { match: (p)=> p.includes('/data-diri') || p.includes('/residents'), ids: ['residents-menu','residents-menu-m'] },
        { match: (p)=> p.includes('/pengguna') || p.includes('/users'), ids: ['users-menu','users-menu-m'] },
        { match: (p)=> p.includes('/surat') || p.includes('/letters'), ids: ['letters-menu','letters-menu-m'] },
        { match: (p)=> p.includes('/laporan') || p.includes('/petitions'), ids: ['reports-menu','reports-menu-m'] },
        { match: (p)=> p.includes('/pengaturan') || p.includes('/settings'), ids: ['settings-menu','settings-menu-m'] },
        { match: (p)=> p.includes('/statistik') || p.includes('/statistic'), ids: ['statistics-menu','statistics-menu-m'] },
      ];

      // default dashboard
      let activeIds = ['dashboard-menu','dashboard-menu-m'];
      for (const m of map) {
        if (m.match(currentPath)) { activeIds = m.ids; break; }
      }

      // hapus active lama, lalu set yang baru
      document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
      activeIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.add('active');
      });

      // Ganti ikon panah saat offcanvas buka/tutup
      const toggleBtn = document.getElementById('sidebarToggle');
      const icon = toggleBtn?.querySelector('i');
      const offcanvasEl = document.getElementById('mobileSidebar');
      if (offcanvasEl && icon) {
        offcanvasEl.addEventListener('show.bs.offcanvas', ()=> {
          icon.classList.remove('fa-angle-right');
          icon.classList.add('fa-angle-left');
        });
        offcanvasEl.addEventListener('hide.bs.offcanvas', ()=> {
          icon.classList.remove('fa-angle-left');
          icon.classList.add('fa-angle-right');
        });
      }
    });
    </script>
    @stack('scripts')
</body>
</html>
