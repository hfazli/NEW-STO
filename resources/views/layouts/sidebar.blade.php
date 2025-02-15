<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Master BOM</li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('inventory.index') }}">
            <i class="bi bi-box"></i><span>Inventory List</span>
        </a>
      </li><!-- End Inventory List Nav -->

      <li class="nav-heading">Daily FG</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#daily-inventory-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-check2-square"></i><span>Stok Daily Stok</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="daily-inventory-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('daily.index') }}">
              <i class="bi bi-circle"></i><span>Part FG Stok</span>
            </a>
          </li>
          <li>

          </li>
        </ul>
      </li><!-- End Daily Inventory FG Nav -->

      <li class="nav-heading">Reports</li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('reports.index') }}">
            <i class="bi bi-file-earmark-bar-graph"></i><span>Report STO</span>
        </a>
      </li><!-- End Reports Nav -->

      <li class="nav-heading">User Management</li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="bi bi-person"></i><span>User</span>
        </a>
      </li>

      <li class="nav-heading">AUTH</li>

      <li class="nav-item">
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i><span>Logout</span>
        </a>
      </li>

    </ul>

</aside>