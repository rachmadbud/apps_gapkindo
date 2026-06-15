@php
    use App\Models\CustomClass;
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4 main-sidebar-custom">

    <div class="sidebar">

        <div class="pt-4 pb-2 px-3">
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach ($stmtMenu as $menu)
                    <li
                        class="nav-item {{ !empty($stmtSubMenuId[0]->id_menu) && $menu->id == $stmtSubMenuId[0]->id_menu ? 'menu-open' : '' }}">
                        <a href="{{ app(CustomClass::class)->rootApp() }}{{ $menu->link }}"
                            class="nav-link {{ !empty($stmtMenuId[0]->id) && $menu->id == $stmtMenuId[0]->id ? 'active' : '' }}">
                            <i class='fas fa-chevron-circle-right'></i>
                            <p>{{ $menu->nama }}
                                @if ($menu->link == '#')
                                    <i class='fas fa-angle-left right'></i>
                                @endif
                            </p>
                        </a>

                        @foreach ($stmtSubMenu as $subMenu)
                            @if ($menu->id == $subMenu->id_menu)
                                <ul class='nav nav-treeview'>
                                    <li class='nav-item '>
                                        <a href='{{ app(CustomClass::class)->rootApp() }}{{ $subMenu->link }}'
                                            class="nav-link {{ !empty($stmtSubMenuId[0]->id) && $subMenu->id == $stmtSubMenuId[0]->id ? 'active' : '' }}">
                                            <i class='far fa-circle nav-icon'></i>
                                            <p>{{ $subMenu->nama }}</p>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
    <div class="sidebar-custom p-3" style="background: transparent; border-top: 1px solid rgba(255,255,255,0.04);">

        <div class="d-flex align-items-center p-2"
            style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.06); border-radius: 12px;">

            <div class="position-relative" style="width: 40px; height: 40px;">
                <img src="{{ asset('') }}assets/dist/img/icon_user_160x160.png"
                    class="img-circle elevation-1 w-100 h-100" alt="User Image"
                    style="object-fit: cover; border: 1px solid rgba(255,255,255,0.2);">
                <span class="position-absolute"
                    style="bottom: 1px; right: 1px; width: 10px; height: 10px; background-color: #28a745; border: 2px solid #343a40; border-radius: 50%;">
                </span>
            </div>

            <div class="ml-3 flex-grow-1" style="min-width: 0;">
                <h6 class="mb-0 text-white font-weight-normal text-truncate"
                    style="font-size: 0.85rem; letter-spacing: 0.3px;">
                    {{ Auth::user()->name }}
                </h6>
                <small class="text-muted d-block text-truncate"
                    style="font-size: 0.7rem; color: rgba(255,255,255,0.4) !important;">
                    Administrator
                </small>
            </div>

            <a href="{{ route('signout') }}"
                class="btn btn-link text-white-50 p-2 d-flex align-items-center justify-content-center"
                style="border-radius: 8px; transition: all 0.2s ease; text-decoration: none;" title="Keluar Sesi"
                onmouseover="this.style.background='rgba(220, 53, 69, 0.15)'; this.style.color='#ff6b6b';"
                onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.5)';">
                <i class="fas fa-power-off" style="font-size: 0.9rem;"></i>
            </a>
        </div>

    </div>
</aside>
