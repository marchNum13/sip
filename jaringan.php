<?php 
    session_start();
    error_reporting(0);
    include "config/jaringanConfig.php";
    $pageTitle = "jaringan" 
?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>SIP Member - Shaf</title>
    <?php include "partial/seo.php" ?>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link rel="stylesheet" href="assets/css/style.css">
    <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->

    <!--end::Vendor Stylesheets-->
    
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <?php include "partial/header.php" ?>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <?php include "partial/sidebar.php" ?>
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1
                                        class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                        Shaf</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <span class="text-muted text-hover-primary">Shaf</span>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <!-- <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li> -->
                                        <!--end::Item-->
                                        
                                        <!--begin::Item-->
                                        <!-- <li class="breadcrumb-item text-muted">Poin</li> -->
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <?php 
                                    if($idUpline != $_SESSION["id_user"]){
                                        $href = "jaringan"; 
                                        $backUplines = $userTableClass->selectUser(
                                            fields: "upline",
                                            key: "id_user = '$idUpline' LIMIT 1"
                                        )['data'][0]['upline'];
                                        if($backUplines != $_SESSION["id_user"]){
                                            $href = '?level=' . $lvlJaringan - 1 . '&upline=' . $backUplines;
                                        }
                                ?>
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Menu toggle-->
                                    <a href="<?= $href ?>" class="btn btn-sm btn-flex btn-primary fw-bold"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-solid  ki-black-left fs-6 text-muted me-1"></i>
                                        Kembali
                                    </a>
                                </div>
                                <!--end::Actions-->
                                <?php } ?>
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!-- ISI DISINI -->
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Shaf <?= $lvlJaringan ?></h3>
                                        <div class="card-toolbar">
                                    <!--begin::Menu toggle-->
                                    <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>Filter</a>
                                    <!--end::Menu toggle-->
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                        data-kt-menu="true" id="kt_menu_65a1215586dff">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-gray-900 fw-bold">Filter</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <form action="" method="post" class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10 row">
                                                <div class="col-12 col-sm-12 mb-2">
                                                    <label for="usernameEmailFilter" class="form-label">Username / Email</label>
                                                    <input type="text" id="usernameEmailFilter" value="<?= $usernameEmailFilter ?>" name="usernameEmailFilter" class="form-control" placeholder="Masukkan Username / Email">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <a href="jaringan" type="reset" class="btn btn-sm btn-light btn-active-light-primary fw-semibold me-2 px-6">Reset</a>
                                                <button type="submit" class="btn btn-sm btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" name="cari">Cari</button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                    </div>
                                    <!--end::Menu 1-->

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- begin::Table-->
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle table-row-dashed fs-8 gy-5">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800">
                                                        <th class="min-w-150px">Profil</th>
                                                        <th class="min-w-150px">Tanggal Gabung</th>
                                                        <th class="min-w-125px">Regist by</th>
                                                        <th class="min-w-125px">Upline</th>
                                                        <th class="min-w-125px">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-semibold">
                                                    <?php  
                                                        if($dataTable['row'] == 0){
                                                            echo '<tr><td colspan="2" align="center">Data tidak ditemukan.</td><td colspan="3"></td></tr>';
                                                        }else{
                                                            foreach($dataTable['data'] as $row){
                                                                $profile = dataUser($row['id_user']);
                                                                $registBy = dataUser($row['regist_by']);
                                                                $upline = dataUser($row['upline']);
                                                    ?>
                                                    <tr>
														<td class="d-flex align-items-center">
															<!--begin:: Avatar -->
															<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
																<a href="#">
																	<div class="symbol-label">
																		<img src="assets/media/avatars/<?= $row['package'] ?>.png" alt="Emma Smith" class="w-100" />
																	</div>
																</a>
															</div>
															<!--end::Avatar-->
															<!--begin::User details-->
															<div class="d-flex flex-column">
																<a href="?level=<?= $lvlJaringan + 1 ?>&upline=<?= $row['id_user'] ?>" class="text-gray-800 text-hover-primary mb-1"><?= $row['username'] ?></a>
																<span class="text-muted"><?= $row['email'] ?></span>
																<a href="https://api.whatsapp.com/send/?phone=62<?= $profile['number_whatsapp'] ?>" target="_blank" class="text-muted">62<?= $profile['number_whatsapp'] ?></a>
																<span class="text-success fw-bold">Tim <?= $row['team'] ?> -></span>
															</div>
															<!--begin::User details-->
														</td>
														<td><?= toUTCorIndo($row['date_time'])['indo'] ?> wita</td>
														<td>
                                                            <span class="text-gray-800 text-hover-primary"><?= ucwords($registBy['username']) ?></span>
                                                        </td>
														<td>
                                                            <span class="text-gray-800 text-hover-primary"><?= ucwords($upline['username']) ?></span>
                                                        </td>
														<td>
															<div class="badge badge-light-<?= $row['status'] == 'Aktif' ? 'success' : 'danger'  ?> fw-bold"><?= $row['status'] ?></div>
														</td>
                                                    </tr>
                                                    <?php }} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end::Table-->
                                    </div>
                                    <?php if($dataTable['row'] < 3){ ?>
                                    <form class="card-footer" method="post" action="" enctype="multipart/form-data">                          
                                        <h3 class="card-title text-center">Tambah Shaf</h3>
                                        <hr>
                                        <!--begin::Input-->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Upline</label>
                                            <input type="hidden" name="idUpline" value="<?= $idUpline ?>">
                                            <input type="text" class="form-control form-control-solid" value="<?= ucwords(dataUser($idUpline)['username']) ?>" readonly/>
                                        </div>
                                        <!--end::Input-->
                                        <h4 class="card-title">Pembayaran</h4>
                                        <hr>
                                        <!--begin::Input-->
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="paket" class="required form-label">Pilih Paket</label>
                                                    <select name="paket" id="paket" class="form-select form-select-sm form-select-solid">
                                                        <option value="">--PILIH PAKET--</option>
                                                        <?php  
                                                            $dataPackage = dataPackage();
                                                            foreach($dataPackage as $package){
                                                                $selected = $paket == $package['name'] ? 'selected="selected"' : '';
                                                        ?>
                                                        <option value="<?= $package['name'] ?>" <?= $selected ?>><?= $package['name'] ?> (Rp<?= number_format($package['fee']) ?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="codePIN" class="required form-label">Kode PIN</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">SIP-</span>
                                                        <input type="text" class="form-control form-control-sm form-control-solid" name="codePIN" id="codePIN" placeholder="SA7***" value="<?= $codePIN ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                        <h4 class="card-title">Info Akun</h4>
                                        <hr>

                                        <div class="mb-3">
                                            <label for="fullname" class="required form-label">Nama Lengkap</label>
                                            <input type="text" name="fullname" id="fullname" class="form-control form-control-sm form-control-solid" value="<?= $fullname ?>" placeholder="Masukkan nama lengkap...">
                                        </div>

                                        <div class="mb-3">
                                            <label for="wa" class="required form-label">No. Whatsapp</label>
                                            <div class="input-group">
                                                <span class="input-group-text">+62</span>
                                                <input type="number" name="wa" id="wa" class="form-control form-control-sm form-control-solid" value="<?= $wa ?>" placeholder="Masukkan nomor whatsapp...">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="required form-label">Alamat Email</label>
                                            <input type="text" name="email" id="email" class="form-control form-control-sm form-control-solid" value="<?= $email ?>" placeholder="Masukkan alamat email...">
                                        </div>

                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="username" class="required form-label">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control form-control-sm form-control-solid" value="<?= $username ?>" placeholder="Masukkan username...">
                                                </div>
                                                <div class="col">
                                                    <label for="pass" class="required form-label">Password Default</label>
                                                    <input type="text" name="pass" id="pass" class="form-control form-control-sm form-control-solid" placeholder="Masukkan password..." value="<?= $pass ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-sm btn-primary" name="submitData" onclick="toggleLoading(this)">Simpan</button>
                                            <button type="button" class="btn btn-sm btn-primary" disabled style="display: none;">
                                                <!--begin::Indicator progress-->
                                                Silahkan tunggu...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                <!--end::Indicator progress-->
                                            </button>
                                            <script>
                                                function toggleLoading(button) {
                                                    // Temukan tombol utama dan tombol loading
                                                    const buttonPrimary = button;
                                                    const buttonLoading = button.nextElementSibling;

                                                    // Sembunyikan tombol utama dan tampilkan tombol loading
                                                    buttonPrimary.style.display = 'none';
                                                    buttonLoading.style.display = 'inline-block';
                                                    
                                                    // Simulasikan proses selesai (misalnya setelah 2 detik)
                                                    setTimeout(() => {
                                                        // Tampilkan kembali tombol utama dan sembunyikan tombol loading
                                                        buttonPrimary.style.display = 'inline-block';
                                                        buttonLoading.style.display = 'none';
                                                    }, 2000); // 2000ms = 2 detik
                                                }
                                            </script>
                                        </div>
                                    </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->

                    </div>
                    <!--end::Content wrapper-->

                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        <div
                            class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <!--begin::Copyright-->
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2024&copy;</span>
                                <a href="#" target="_blank"
                                    class="text-gray-800 text-hover-primary">SIP</a>
                            </div>
                            <!--end::Copyright-->
                        </div>
                        <!--end::Footer container-->
                    </div>
                    <!--end::Footer-->

                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Javascript-->
        <script>
            var hostUrl = "assets/";
        </script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <!--end::Vendors Javascript-->

        <!--begin::Custom Javascript(used for this page only)-->
        <script>
            document.getElementById('username').addEventListener('input', function (e) {
                // Hapus karakter selain huruf kecil dan ganti spasi dengan kosong
                e.target.value = e.target.value.toLowerCase().replace(/[^a-z0-9]/g, '');
            });
            document.getElementById('codePIN').addEventListener('input', function (e) {
                // Hapus karakter selain huruf kecil dan ganti spasi dengan kosong
                e.target.value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });
        </script>
        <?php if($alertError != ""){ ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "<?= $alertError ?>",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php } ?>
        <?php if($_SESSION["alertSuccess"] != ""){ ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "<?= $_SESSION["alertSuccess"] ?>",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php } ?>
        <!--end::Custom Javascript-->
    
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
<?php $_SESSION["alertSuccess"] = "" ?>