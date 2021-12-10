<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == '' ? 'active' : '' ?>" href="/admin">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'karyawan' ? 'active' : '' ?>" href="/admin/karyawan">
              <span data-feather="users"></span>
              Data Karyawan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'jenis' ? 'active' : '' ?>" href="/admin/jenis">
              <span data-feather="file"></span>
              Jenis Kendaraan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'kendaraan' ? 'active' : '' ?>" href="/admin/kendaraan">
              <span data-feather="file"></span>
              Data Kendaraan
            </a>
          </li>
        </ul>
      </div>
    </nav>
