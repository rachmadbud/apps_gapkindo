@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    @php
        use App\Models\CustomClass;

        $rootApp = app(CustomClass::class)->rootApp();
        $menuColors = [
            ['accent' => '#2563eb', 'soft' => '#eff6ff', 'gradient' => 'linear-gradient(135deg, #3b82f6, #2563eb)'],
            ['accent' => '#059669', 'soft' => '#ecfdf5', 'gradient' => 'linear-gradient(135deg, #10b981, #059669)'],
            ['accent' => '#d97706', 'soft' => '#fffbeb', 'gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)'],
            ['accent' => '#7c3aed', 'soft' => '#f5f3ff', 'gradient' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)'],
            ['accent' => '#db2777', 'soft' => '#fdf2f8', 'gradient' => 'linear-gradient(135deg, #ec4899, #db2777)'],
            ['accent' => '#0891b2', 'soft' => '#ecfeff', 'gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)'],
        ];
    @endphp

    <style>
        .dashboard-welcome {
            background: linear-gradient(120deg, #173b70, #315c9b 58%, #526fc0);
            overflow: hidden;
            position: relative;
        }

        .dashboard-welcome::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: -55px;
            top: -105px;
            border: 35px solid rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .dashboard-menu-card {
            border-top: 4px solid var(--menu-accent) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dashboard-menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(31, 45, 61, 0.12) !important;
        }

        .dashboard-menu-icon {
            background: var(--menu-soft);
            color: var(--menu-accent);
        }

        .dashboard-submenu-link {
            background: #fff;
            border-color: #edf0f5 !important;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .dashboard-submenu-link:hover {
            background: var(--menu-soft);
            border-color: var(--menu-accent) !important;
            color: var(--menu-accent) !important;
            text-decoration: none;
        }
    </style>

    <div class="container-fluid pt-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 elevation-2 dashboard-welcome" style="border-radius: 14px;">
                    <div class="card-body p-4">
                        <p class="text-uppercase text-white-50 text-xs font-weight-bold mb-2"
                            style="letter-spacing: 1.5px;">Dashboard</p>
                        <h2 class="font-weight-bold text-white mb-2">
                            Selamat datang, {{ auth()->user()->name }}
                        </h2>
                        <p class="text-white-50 mb-0">
                            Pilih menu yang tersedia untuk mulai bekerja.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-th-large text-primary mr-2"></i>
            <h5 class="font-weight-bold text-dark mb-0">Menu yang dapat diakses</h5>
        </div>

        <div class="row">
            @php
                $menuCount = 0;
            @endphp

            @foreach ($stmtMenu as $menu)
                @php
                    $subMenus = $stmtSubMenu->where('id_menu', $menu->id);
                    $menuUrl = trim($menu->link ?? '');
                    $hasDirectLink = $menuUrl !== '' && $menuUrl !== '#' && rtrim($menuUrl, '/') !== '/dashboard';
                    $hasSubMenus = $subMenus->isNotEmpty();
                    $menuColor = $menuColors[$menuCount % count($menuColors)];
                @endphp

                @if ($hasDirectLink || $hasSubMenus)
                    @php
                        $menuCount++;
                    @endphp

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 elevation-1 dashboard-menu-card"
                            style="--menu-accent: {{ $menuColor['accent'] }}; --menu-soft: {{ $menuColor['soft'] }}; border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="dashboard-menu-icon d-flex align-items-center justify-content-center rounded mr-3"
                                        style="width: 46px; height: 46px;">
                                        <i class="fas fa-folder-open fa-lg"></i>
                                    </div>
                                    <h5 class="font-weight-bold text-dark mb-0">{{ $menu->nama }}</h5>
                                </div>

                                @if ($hasDirectLink)
                                    <a href="{{ $rootApp }}{{ $menuUrl }}" class="btn btn-block text-left font-weight-bold"
                                        style="background: {{ $menuColor['gradient'] }}; color: #fff;">
                                        Buka {{ $menu->nama }} <i class="fas fa-arrow-right float-right mt-1"></i>
                                    </a>
                                @endif

                                @if ($hasSubMenus)
                                    <div class="{{ $hasDirectLink ? 'mt-3' : '' }}">
                                        @foreach ($subMenus as $subMenu)
                                            <a href="{{ $rootApp }}{{ $subMenu->link }}"
                                                class="dashboard-submenu-link d-flex align-items-center justify-content-between border rounded p-3 mb-2 text-dark">
                                                <span>
                                                    <i class="far fa-circle mr-2"
                                                        style="color: {{ $menuColor['accent'] }};"></i>
                                                    {{ $subMenu->nama }}
                                                </span>
                                                <i class="fas fa-chevron-right text-muted text-xs"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if ($menuCount === 0)
                <div class="col-12">
                    <div class="card border-0 elevation-1" style="border-radius: 12px; border-left: 4px solid #d97706 !important;">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-th-large fa-2x mb-3" style="color: #d97706;"></i>
                            <p class="text-muted mb-0">
                                Belum ada menu yang diberikan untuk role Anda. Silakan hubungi administrator.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
