
<li class="nav-item">
    <a href="{{ route('parkings.index') }}" class="nav-link {{ Request::is('parkings*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Parkings</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('tarifs.index') }}" class="nav-link {{ Request::is('tarifs*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tarifs</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('vehicules.index') }}" class="nav-link {{ Request::is('vehicules*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Vehicules</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('monnaieusers.index') }}" class="nav-link {{ Request::is('monnaieusers*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Monnaieusers</p>
    </a>
</li>
