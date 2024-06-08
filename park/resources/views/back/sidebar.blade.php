
                <!-- Dashboard -->
                @if(Auth::check())
                    @if(Auth::user()->role === 'admin')
                    <li class="menu-item active">
                        <a href="{{ route('parkings.index') }}" class="menu-link">
                            <div data-i18n="Analytics">PARKING</div>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="{{ route('tarifs.index') }}" class="menu-link">
                            <div data-i18n="Analytics">TARIFS</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('valide.monnaie') }}" class="menu-link">
                            <div data-i18n="Analytics">Validation Monnaie</div>
                        </a>
                    </li>

                    @elseif(Auth::user()->role === 'user')
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Pages</span>
                        </li>
                        <li class="menu-item ">
                            <a href="{{ route('liste.parkings') }}" class="menu-link">
                                <div data-i18n="Analytics">Liste Parking</div>
                            </a>
                        </li>
                        <li class="menu-item ">
                            <a href="{{ route('monnaieusers.index') }}" class="menu-link">
                                <div data-i18n="Analytics">Mon portefeuille</div>
                            </a>
                        </li>
                    @endif
                @endif


