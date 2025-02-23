<?php 
    session_start();
    error_reporting(0);
    include "config/pinConfig.php";
    $pageTitle = "pin" 
?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../"/>
    <title>SIP Admin - Pin</title>
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
                                        Pin</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <span class="text-muted text-hover-primary">Pin</span>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <!-- <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li> -->
                                        <!--end::Item-->
                                        
                                        <!--begin::Item-->
                                        <!-- <li class="breadcrumb-item text-muted">Pembelian Paket</li> -->
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">

                                    

                                    <!--begin::Primary button-->
                                    <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#transfer">Transfer</a>
                                    <!--end::Primary button-->
                                    
                                    <!--begin::Primary button-->
                                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#create">Create</a>
                                    <!--end::Primary button-->

                                </div>
                                <!--end::Actions-->
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
                                        <h3 class="card-title">Data Pin</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- begin::Table-->
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle table-row-dashed fs-8 gy-5">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800">
                                                        <th class="min-w-125px">Member</th>
                                                        <th class="min-w-125px">PIN</th>
                                                        <th class="min-w-150px">Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-semibold">
                                                    <?php  
                                                        $dataTable = dataTable($page);
                                                        if($dataTable['row'] == 0){
                                                            echo '<tr><td colspan="3" align="center">Data tidak ditemukan.</td></tr>';
                                                        }else{
                                                            foreach($dataTable['data'] as $row){
                                                                $member = dataUser($row['id_user']);
                                                                if($row['status'] == 'Belum Terpakai'){
                                                                    $colorBd = "warning";
                                                                }elseif($row['status'] == 'Terpakai'){
                                                                    $colorBd = "success";
                                                                }
                                                    ?>
                                                    <tr>
														<td>
                                                            <div  class="d-flex align-items-center">
                                                                <!--begin:: Avatar -->
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            <img src="assets/media/avatars/<?= $member['package'] ?>.png" alt="Emma Smith" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <!--end::Avatar-->
                                                                <!--begin::User details-->
                                                                <div class="d-flex flex-column">
                                                                    <span class="text-gray-800 text-hover-primary mb-1"><?= $member['username'] ?></span>
                                                                    <span class="text-muted"><?= $member['email'] ?></span>
                                                                    <a href="https://api.whatsapp.com/send/?phone=62<?= $member['number_whatsapp'] ?>" target="_blank" class="text-muted">62<?= $member['number_whatsapp'] ?></a>
                                                                </div>
                                                                <!--begin::User details-->
                                                            </div>
                                                        </td>
														<td>
                                                            <div class="text-gray-800 text-hover-primary">Paket <?= $row['package'] ?></div>
                                                            <div class="text-gray-800 text-hover-primary">Kode: SIP-<?= $row['code_pin'] ?></div>
                                                            <div class="badge badge-<?= $colorBd ?> fw-bold"><?= $row['status'] ?></div>
                                                        </td>
														<td><?= toUTCorIndo($row['date_time'])['indo'] ?> wita</td>
                                                    </tr>
                                                    <?php }} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end::Table-->
                                    </div>
                                    <?php  
                                        $hrefAdd = "";
                                        // $dari != "" ? $hrefAdd .= "&dari=" . $dari : '';
                                        // $sampai != "" ? $hrefAdd .= "&sampai=" . $sampai : '';
                                        // $statusFil != "" ? $hrefAdd .= "&statusFilter=" . $statusFil : '';

                                        $limit = 5;
                                        $total = countDataTable()['total'];
                                        $total_pages = ceil($total / $limit);
                                        $prev = max(1, $page - 1);
                                        $next = min($total_pages, $page + 1);

                                        if($total_pages > 0 && $dataTable['row'] > 0){
                                    ?>
                                    <div class="card-footer text-center">
                                        <ul class="pagination">
                                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=<?= $prev.$hrefAdd ?>" aria-label="Previous">
                                                    <span aria-hidden="true">«</span>
                                                </a>
                                            </li>
                                            <?php  
                                                        if($total_pages <= 6){
                                                            for($i = 1; $i <= $total_pages; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                                            </li>
                                            <?php  
                                                            }
                                                        }else{
                                                            if($page < 5){
                                                                for($i = 1; $i <= 5; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                                            </li>
                                            <?php
                                                                }
                                                    ?>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <li class="page-item <?= $page == $total_pages ? 'active' : '' ?>">
                                                <a class="page-link"
                                                    href="admin/pin?page=<?= $total_pages.$hrefAdd ?>"><?= $total_pages; ?></a>
                                            </li>
                                            <?php
                                                            }elseif($page == $total_pages || $total_pages-$page < 4){
                                                    ?>
                                            <li class="page-item <?= $page == 1 ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=1<?= $hrefAdd ?>">1</a>
                                            </li>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <?php  
                                                                for($i = $total_pages-4; $i <= $total_pages; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                                            </li>
                                            <?php
                                                                }
                                                            }else{
                                                    ?>
                                            <li class="page-item <?= $page == 1 ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=1<?= $hrefAdd ?>">1</a>
                                            </li>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <?php  
                                                                for($i = $page-1; $i <= $page+1; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=<?= $i.$hrefAdd ?>"><?= $i; ?></a>
                                            </li>
                                            <?php  
                                                                }
                                                    ?>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <li class="page-item <?= $page == $total_pages ? 'active' : '' ?>">
                                                <a class="page-link"
                                                    href="admin/pin?page=<?= $total_pages.$hrefAdd ?>"><?= $total_pages; ?></a>
                                            </li>
                                            <?php
                                                            }
                                                        }
                                                    ?>
                                            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                                <a class="page-link" href="admin/pin?page=<?= $next.$hrefAdd ?>" aria-label="Next">
                                                    <span aria-hidden="true">»</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->

                        <!-- begin::modal -->
                        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="transfer">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="post" action="" class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Transfer Pin</h3>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label for="kodePin" class="required form-label">Kode PIN</label>
                                            <div class="input-group">
                                                <span class="input-group-text">SIP-</span>
                                                <input type="text" class="form-control form-control-sm form-control-solid" name="kodePin" id="kodePin" placeholder="SA7***" value="<?= $kodePin ?>">
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="paketTf" class="required form-label">Paket PIN</label>
                                            <select name="paketTf" id="paketTf" class="form-select form-select-sm form-select-solid">
                                                <option value="">--PILIH PAKET--</option>
                                                <?php  
                                                    $dataPackage = array("Hamdalah", "Basmalah", "Upgrade", "Upgrade 100 Hari");
                                                    foreach($dataPackage as $package){
                                                        $selected = $paketTf == $package ? 'selected="selected"' : '';
                                                ?>
                                                <option value="<?= $package ?>" <?= $selected ?>><?= $package ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="pemilikPin" class="required form-label">Pemilik Pin</label>
                                            <input type="text" name="pemilikPin" id="pemilikPin" value="<?= $pemilikPin ?>" class="form-control form-control-solid form-control-sm" placeholder="Masukkan alamat email atau username">
                                        </div>
                                        <div class="mb-2">
                                            <label for="penerimaPin" class="required form-label">Penerima Pin</label>
                                            <input type="text" name="penerimaPin" id="penerimaPin" value="<?= $penerimaPin ?>" class="form-control form-control-solid form-control-sm" placeholder="Masukkan alamat email atau username">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-primary" name="tf" onclick="toggleLoadingTf(this)">Simpan</button>
                                        <button type="button" class="btn btn-sm btn-primary" disabled style="display: none;">
                                            <!--begin::Indicator progress-->
                                            Silahkan tunggu...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            <!--end::Indicator progress-->
                                        </button>
                                        <script>
                                            function toggleLoadingTf(button) {
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
                            </div>
                        </div>
                        <!-- end::modal -->
                        <!-- begin::modal -->
                        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="create">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="post" action="" class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Kirim Pin</h3>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label for="jumlah" class="required form-label">Jumlah PIN</label>
                                            <input type="number" name="jumlah" id="jumlah" value="<?= $jumlah ?>" class="form-control form-control-solid form-control-sm" placeholder="Masukkan Jumlah PIN">
                                        </div>
                                        <div class="mb-2">
                                            <label for="memberinput" class="required form-label">Member</label>
                                            <input type="text" name="memberinput" id="memberinput" value="<?= $memberinput ?>" class="form-control form-control-solid form-control-sm" placeholder="Masukkan alamat email atau username">
                                        </div>
                                        <div class="mb-2">
                                            <label for="paket" class="required form-label">Pilih Paket</label>
                                            <select name="paket" id="paket" class="form-select form-select-sm form-select-solid">
                                                <option value="">--PILIH PAKET--</option>
                                                <?php  
                                                    $dataPackage = array("Hamdalah", "Basmalah", "Upgrade", "Upgrade 100 Hari");
                                                    foreach($dataPackage as $package){
                                                        $selected = $paket == $package ? 'selected="selected"' : '';
                                                ?>
                                                <option value="<?= $package ?>" <?= $selected ?>><?= $package ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-primary" name="kirim" onclick="toggleLoading(this)">Kirim</button>
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
                            </div>
                        </div>
                        <!-- end::modal -->

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