<?php 
    session_start();
    error_reporting(0);
    include "config/ujrohConfig.php"; 
    $pageTitle = "ujroh";
?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../"/>
    <title>SIP Admin - Bonus Ujroh</title>
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
                                        Ujroh</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <span class="text-muted text-hover-primary">Bonus</span>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Ujroh</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">

                                    <!--begin::Filter menu-->
                                    <div style="display: none;">
                                        <div class="m-0">
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
                                                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Menu separator-->
                                                <div class="separator border-gray-200"></div>
                                                <!--end::Menu separator-->
                                            </div>
                                            <!--end::Menu 1-->
                                        </div>
                                    </div>
                                    <!--end::Filter menu-->

                                    <!--begin::Primary button-->
                                    <!-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_create_app">Create</a> -->
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
                                <form class="card shadow-sm" method="post" action="">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Bonus Ujroh</h3>
                                        <div class="card-toolbar">
                                            <!-- <button type="button" class="btn btn-sm btn-light">
                                                Action
                                            </button> -->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php foreach($namePackage as $key => $name){ ?>
                                        <!--begin::Input-->
                                        <div class="mb-3">
                                            <label for="rekrut<?= $name ?>" class="required form-label">Rekrut <?= $name ?></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="rekrut<?= $name ?>-addon1">Rp</span>
                                                <input type="number" name="rewardRekrut[]" id="rekrut<?= $name ?>" class="form-control form-control-solid" value="<?= $rewardPackage[$key] ?>" placeholder="cth:1000000" aria-label="rekrut<?= $name ?>" aria-describedby="rekrut<?= $name ?>-addon1"/>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-sm btn-primary" name="submitData" onclick="toggleLoading(this)">Simpan Perubahan</button>
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