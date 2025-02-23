<?php 
    session_start();
    error_reporting(0);
    include "config/poinTimConfig.php";
    $pageTitle = "poin-tim" 
?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>SIP Member - Poin Tim</title>
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
    <style>
        .list-check::after{
            content: "✔ "; /* Simbol checklist */
            color: green; /* Warna checklist */
            font-weight: bold;
            margin-left: 8px; /* Jarak antara checklist dan teks */
        }
    </style>
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
                                        Poin Tim</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <span class="text-muted text-hover-primary">Poin Tim</span>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <!-- <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li> -->
                                        <!--end::Item-->
                                        
                                        <!--begin::Item-->
                                        <!-- <li class="breadcrumb-item text-muted">Bonus Ujroh</li> -->
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!-- ISI DISINI -->

                                <!-- total -->
                                <div class="card radius-10 bg-primary mb-2 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <p class="mb-1 text-white">Total</p>
                                                <h3 class="mb-0 text-white"><?= number_format($countAllPoin) ?> Poin
                                                </h3>
                                            </div>
                                            <div class="ms-auto widget-icon bg-white-1 text-white">
                                                <i class="ki-outline ki-medal-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row g-0 mb-2">
                                    <div class="col-4">
                                        <div class="card radius-10 bg-danger mb-2 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <p class="mb-1 text-white">Tim A</p>
                                                        <h6 class="mb-0 text-white"><?= number_format($counttimA) ?> Poin
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card radius-10 bg-warning mb-2 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <p class="mb-1 text-white">Tim B</p>
                                                        <h6 class="mb-0 text-white"><?= number_format($counttimB) ?> Poin
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card radius-10 bg-info mb-2 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <p class="mb-1 text-white">Tim C</p>
                                                        <h6 class="mb-0 text-white"><?= number_format($counttimC) ?> Poin
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- total -->

                                <!--begin::List widget 20-->
                                <div class="card h-xl-100">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h2 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-900">Reward Poin</span>
                                            <span class="text-muted mt-1 fw-semibold fs-7">Kumpulkan poin dan dapatkan reward!</span>
                                        </h2>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-6">
                                        <?php  
                                            foreach($dataPoin as $poin){
                                        ?>
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <!--begin:Author-->
                                                <div class="flex-grow-1 me-2">
                                                    <span class="text-gray-800 text-hover-primary fs-6 fw-bold"><?= ucwords(strtolower($poin['desk'])) ?></span>
                                                    <span class="text-muted fw-semibold d-block fs-7"><i>Senilai: Rp<?= number_format($poin['reward']) ?></i></span>
                                                </div>
                                                <!--end:Author-->
                                                <!--begin::Actions-->
                                                <?php if(isCheckList($poin['code'])){ ?>
                                                <span class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-double-check fs-2 text-success">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <?php }else{ ?>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#details<?= $poin['code'] ?>" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-arrow-right fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                                <?php } ?>
                                                <!--begin::Actions-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-4"></div>
                                        <!--end::Separator-->
                                        <?php } ?>

                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::List widget 20-->

                            
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                        <?php  
                            foreach($dataPoin as $poin){
                                if(isCheckList($poin['code'])){
                                    continue;
                                }
                        ?>
                        <!-- begin::modal -->
                        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="details<?= $poin['code'] ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="flex-grow-1 me-2">

                                            <h3 class="modal-title"><?= ucwords(strtolower($poin['desk'])) ?></h3>
                                            <span class="text-muted fw-semibold d-block fs-7"><i>Senilai: Rp<?= number_format($poin['reward']) ?></i></span>
                                        </div>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body">
                                       <span class="text-gray-800 fs-6 fw-bold">Syarat dan Ketentuan:</span>
                                       <ul>
                                            <li <?= $totalTim == 3 ? 'class="list-check"' : '' ?>>Memiliki <strong><?= $totalTim ?>/3</strong> Tim</li>
                                            <li <?= $countAllPoin >= $poin['poin'] ? 'class="list-check"' : '' ?>>Total Poin: <strong><?= number_format($countAllPoin > $poin['poin'] ? $poin['poin'] : $countAllPoin) ?>/<?= number_format($poin['poin']) ?></strong> Poin</li>
                                            <li <?= timLemah($poin['poin']*0.30) == $poin['poin']*0.30 ? 'class="list-check"' : '' ?>>Total Poin Tim Lemah: <strong><?= number_format(timLemah($poin['poin']*0.30)) ?>/<?= number_format($poin['poin']*0.30) ?></strong> Poin</li>
                                       </ul>
                                    </div>

                                    <form method="post" action="" class="modal-footer">
                                        <input type="hidden" name="codeReward" value="<?= $poin['code'] ?>">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-primary" name="klaim" onclick="toggleLoadingTf(this)">Klaim</button>
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
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end::modal -->
                        <?php } ?>
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