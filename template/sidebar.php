<div class="container-fluid">
  <div class="row">
    <?php
    $uri_path = parse_url($_SERVER['REQUEST_URI'], 
    PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $menu = $uri_segments[2];

    $userLogin = $_SESSION['ssUserRM'];
    $cekUser = mysqli_query($koneksi, "SELECT * FROM 
    tbl_user WHERE username = '$userLogin'");
    $dataUser = mysqli_fetch_assoc($cekUser);


    ?>

    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 
              'index.php' ? 'active' : null ?> "
              aria-current="page" href="<?= $main_url ?>" >
                <svg class="bi">
                  <use xlink:href="#house-fill" />
                </svg>
                Dashboard
              </a>
            </li>
            <?php 
            if ($dataUser['jabatan'] == 1) { ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 
              'user' ? 'active' : null ?>" href=
              "<?= $main_url ?>user">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                User
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 
              'otentikasi' ? 'active' : null ?>" href="<?= $main_url ?>otentikasi/password.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                  <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                  <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                </svg>
                Ganti Password
              </a>
            </li>
          </ul>


          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>Data</span>
          </h6>

          <ul class="nav flex-column mb-auto">
          <?php if ($dataUser['jabatan'] != 3) { ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 
              'pasien' ? 'active' : null ?>" href="
              <?= $main_url ?>pasien">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                </svg>
                Pasien
              </a>
            </li>
            <?php } ?>
            <?php if ($dataUser['jabatan'] != 3) { ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" <?= $menu == 
              'obat' ? 'active' : null ?> href="<?= $main_url ?>obat">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-capsule-pill" viewBox="0 0 16 16">
                  <path d="M11.02 5.364a3 3 0 0 0-4.242-4.243L1.121 6.778a3 3 0 1 0 4.243 4.243l5.657-5.657Zm-6.413-.657 2.878-2.879a2 2 0 1 1 2.829 2.829L7.435 7.536zM12 8a4 4 0 1 1 0 8 4 4 0 0 1 0-8m-.5 1.042a3 3 0 0 0 0 5.917zm1 5.917a3 3 0 0 0 0-5.917z" />
                </svg>
                Obat
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 
              'rekamedis' ? 'active' : null ?> " href="<?= $main_url ?>rekamedis">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2" />
                </svg>
                Rekam Medis
              </a>
            </li>
            
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>Laporan</span>
          </h6>
          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2<?= $menu == 
              'riwayat-perekaman' ? 'active' : null ?> " href="<?= $main_url ?>riwayat-perekaman">
                <svg class="bi">
                  <use xlink:href="#file-earmark-text" />
                </svg>
                Riwayat Rekaman
              </a>
            </li>
          </ul>

          

          
        </div>
      </div>
    </div>