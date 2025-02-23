<?php $pageTitle = "laporan-withdraw" ?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>SIP Member - Laporan Withdraw</title>
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
                                        Withdraw</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <span class="text-muted text-hover-primary">Laporan</span>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Withdraw</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">

                                    

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
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Withdraw</h3>
                                        <div class="card-toolbar">
                                            <!--begin::Filter menu-->
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
                                                <form action="" method="get" class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                    data-kt-menu="true" id="kt_menu_65a1215586dff">
                                                    <!--begin::Header-->
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-gray-900 fw-bold">Filter</div>
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator border-gray-200"></div>
                                                    <!--end::Menu separator-->
                                                    <div class="px-7 py-5">
                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <label for="member" class="form-label">Member</label>
                                                            <input type="text" class="form-control form-control-solid" id="member" name="member" placeholder="Email / username / nama lengkap"/>
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <label for="dari" class="form-label">Dari</label>
                                                            <input type="datetime-local" class="form-control form-control-solid" value="2024-04-04T13:00" id="dari" name="dari" placeholder="Email / Username / Nama Lengkap"/>
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <label for="sampai" class="form-label">Sampai</label>
                                                            <input type="datetime-local" class="form-control form-control-solid" value="2024-04-05T13:00" id="sampai" name="sampai" placeholder="Email / Username / Nama Lengkap"/>
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select name="status" id="status" class="form-select form-select-solid">
                                                                <option value="">Semua</option>
                                                                <option value="Menunggu" selected>Menunggu</option>
                                                                <option value="Diterima">Diterima</option>
                                                                <option value="Ditolak">Ditolak</option>
                                                            </select>
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Actions-->
                                                        <div class="d-flex justify-content-end">
                                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true">Reset</button>
                                                            <button type="submit" class="btn btn-sm btn-primary fw-semibold px-6" data-kt-menu-dismiss="true">Cari</button>
                                                        </div>
                                                        <!--end::Actions-->
                                                    </div>
                                                </form>
                                                <!--end::Menu 1-->
                                            </div>
                                            <!--end::Filter menu-->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- begin::Table-->
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle table-row-dashed fs-8 gy-5">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800">
                                                        <th class="min-w-130px">Nominal</th>
                                                        <th class="min-w-150px">Tgl request</th>
                                                        <th class="min-w-150px">Tgl konfirm</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-semibold">
                                                    <tr>
														<td>
                                                            <span class="text-gray-800 text-hover-primary">Rp1,000,000</span>
                                                            <span class="badge badge-warning fw-bold">Menunggu</span>
                                                        </td>
														<td>15 Apr 2024, 11:05 am</td>
														<td>-,-</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end::Table-->
                                    </div>
                                    <div class="card-footer text-center">
                                        <ul class="pagination">
                                            <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
                                            <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                            <li class="page-item "><a href="#" class="page-link">2</a></li>
                                            <li class="page-item "><a href="#" class="page-link">...</a></li>
                                            <li class="page-item "><a href="#" class="page-link">5</a></li>
                                            <li class="page-item next"><a href="#"  class="page-link"><i class="next"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->

                        <!-- begin::modal -->
                        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="confir_1">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="post" action="" class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Konfirmasi Withdraw</h3>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Total Wd</span>
                                            <span class="fw-bold fs-5">Rp1,000,000</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>AutoMain<sup class="text-danger">-10%</sup></span>
                                            <span class="fw-bold fs-5 text-danger">-Rp100,000</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Administrasi<sup class="text-danger">-2.5%</sup></span>
                                            <span class="fw-bold fs-5 text-danger">-Rp25,000</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-bold">Sisa</span>
                                            <span class="fw-bold fs-4">Rp875,000</span>
                                        </div>
                                        <h3>BANK TUJUAN</h3>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Bank:</span>
                                            <span class="fw-bold fs-5">BCA</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>A/n:</span>
                                            <span class="fw-bold fs-5">Barclays UK</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>No. Rekening:</span>
                                            <span class="fw-bold fs-5">1234567890934</span>
                                        </div>
                                        <hr>
                                        <!-- <span class="fs-8 text-muted">*Sebelum konfirmasi withdraw, pastikan anda sudah melakukan transfer ke bank transfer</span> -->
                                        <div class="form-check form-check-custom form-check-solid form-check-sm">
                                            <input class="form-check-input" type="checkbox" value="ya" id="confir1" name="confir"/>
                                            <label class="form-check-label" for="confir1">
                                                *Sebelum konfirmasi withdraw, pastikan anda sudah melakukan transfer ke bank tujuan.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Konfirmasi</button>
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
        
        <!--end::Custom Javascript-->
    
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>