<nav class="read-to-lead-nav py-4">
    <div class="nav-container">
        <!-- Category Navigation -->
        <div class="category-nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.read-to-lead.index') ? 'active' : '' }}"
                        href="{{ route('client.read-to-lead.index') }}">
                        <i class="fas fa-home"></i>
                        <span>TRANG CHỦ</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button">
                        <i class="fas fa-layer-group"></i>
                        <span>SORTED BY LEVEL</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request()->get('level') == 'Beginner' ? 'active' : '' }}"
                                href="?level=Beginner">
                                <i class="fas fa-star"></i> Beginner
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->get('level') == 'Intermediate' ? 'active' : '' }}"
                                href="?level=Intermediate">
                                <i class="fas fa-star-half-alt"></i> Intermediate
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->get('level') == 'Advanced' ? 'active' : '' }}"
                                href="?level=Advanced">
                                <i class="fas fa-stars"></i> Advanced
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.read-to-lead.discovery') ? 'active' : '' }}"
                        href="{{ route('client.read-to-lead.discovery') }}">
                        <i class="fas fa-compass"></i>
                        <span>DISCOVERY</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.read-to-lead.health') ? 'active' : '' }}"
                        href="{{ route('client.read-to-lead.health') }}">
                        <i class="fas fa-heartbeat"></i>
                        <span>HEALTH & LIFESTYLE</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.read-to-lead.culture') ? 'active' : '' }}"
                        href="{{ route('client.read-to-lead.culture') }}">
                        <i class="fas fa-theater-masks"></i>
                        <span>CULTURE</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.read-to-lead.travel') ? 'active' : '' }}"
                        href="{{ route('client.read-to-lead.travel') }}">
                        <i class="fas fa-plane"></i>
                        <span>TRAVEL</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.read-to-lead.cuisine') ? 'active' : '' }}"
                        href="{{ route('client.read-to-lead.cuisine') }}">
                        <i class="fas fa-utensils"></i>
                        <span>CUISINE</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .read-to-lead-nav {
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .category-nav {
        padding: 0.5rem 0;
    }

    .nav-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1rem;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #333;
        text-decoration: none;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .nav-link i {
        margin-right: 0.5rem;
        font-size: 1.1rem;
        opacity: 0.8;
    }

    .nav-link:hover {
        color: #007bff;
        background: rgba(0, 123, 255, 0.1);
    }

    .nav-link.active {
        color: #007bff;
        background: rgba(0, 123, 255, 0.1);
    }

    /* Dropdown Styles */
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        padding: 0.5rem;
        min-width: 200px;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dropdown-item i {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .dropdown-item:hover {
        background: rgba(0, 123, 255, 0.1);
        color: #007bff;
    }

    .dropdown-item.active {
        background: rgba(0, 123, 255, 0.1);
        color: #007bff;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .nav-list {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            /* Firefox */
        }

        .nav-list::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Edge */
        }

        .nav-link {
            white-space: nowrap;
            padding: 0.5rem 0.75rem;
        }
    }

    @media (max-width: 768px) {
        .nav-link span {
            font-size: 0.9rem;
        }

        .nav-link i {
            font-size: 1rem;
        }
    }
</style>
