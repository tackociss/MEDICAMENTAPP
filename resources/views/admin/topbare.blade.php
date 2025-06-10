<div class="app-header-inner">
    <div class="container-fluid py-2">
        <div class="app-header-content">
            <div class="row justify-content-between align-items-center">

                <div class="col-auto">
                    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                            role="img">
                            <title>Menu</title>
                            <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"
                                d="M4 7h22M4 15h22M4 23h22"></path>
                        </svg>
                    </a>
                </div><!--//col-->
                <div class="search-mobile-trigger d-sm-none col">
                    <i class="search-mobile-trigger-icon fas fa-search"></i>
                </div><!--//col-->
                <div class="app-search-box col">
                    <form class="app-search-form">
                        <input type="text" placeholder="Recherche Medica..." name="search"
                            class="form-control search-input">
                        <button type="submit" class="btn search-btn btn-primary" value="Recherche"><i
                                class="fas fa-search"></i></button>
                    </form>
                </div><!--//app-search-box-->

                <div class="app-utilities col-auto">
                    @php
                        $user = Auth::user();
                        $initials = strtoupper(substr($user->prenom, 0, 1) . substr($user->nom, 0, 1));
                    @endphp

                    <div class="app-utility-item app-user-dropdown dropdown">
                        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                           role="button" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                         class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-2"
                                         style="width: 40px; height: 40px; font-weight: bold; font-size: 16px;">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <span class="d-none d-md-inline ms-2">{{ $user->prenom }} {{ $user->nom }}</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu p-0" aria-labelledby="user-dropdown-toggle">
                            <div class="p-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                             class="rounded-circle me-2" style="width: 48px; height: 48px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-2"
                                             style="width: 48px; height: 48px; font-weight: bold; font-size: 18px;">
                                            {{ $initials }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $user->prenom }} {{ $user->nom }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                        @if($user->role)
                                            <div class="badge bg-primary mt-1">{{ $user->role }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item px-3 py-2 rounded" href="{{ route('profil') }}">
                                    <i class="fas fa-user me-2"></i>Mon Profil
                                </a>
                                <a class="dropdown-item px-3 py-2 rounded" href="{{ route('parametre') }}">
                                    <i class="fas fa-cog me-2"></i>Paramètres
                                </a>
                                <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item px-3 py-2 rounded text-danger" href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Se Déconnecter
                                </a>
                            </div>
                        </ul>
                    </div>
                </div><!--//app-utilities-->
            </div><!--//row-->
        </div><!--//app-header-content-->
    </div><!--//container-fluid-->
</div><!--//app-header-inner-->
