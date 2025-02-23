<?php 
    session_start();
    error_reporting(0);
    include "config/laporanBonusUjrohConfig.php";
    $pageTitle = "laporan-bonus-ujroh" 
?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../"/>
    <title>SIP Admin - Laporan Bonus Ujroh</title>
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
                                        Bonus Ujroh</h1>
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
                                        <li class="breadcrumb-item text-muted">Bonus Ujroh</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Menu toggle-->
                                    <?php  
                                        $hrefAddDownload = "";
                                        $dari != "" ? $hrefAddDownload .= "dari=" . $dari : '';
                                        $sampai != "" ? $hrefAddDownload .= "&sampai=" . $sampai : '';
                                    ?>
                                    <a href="admin/laporan-bonus-ujroh-download?<?= $hrefAddDownload ?>" class="btn btn-sm btn-flex btn-primary fw-bold">
                                        Download
                                    </a>
                                    <!--end::Menu toggle-->
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
                                        <form action="" method="get" class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10 row">
                                                <!-- <div class="col-12 col-sm-6 mb-2">
                                                    <label for="tipeDetail" class="form-label">Tipe Data</label>
                                                    <select name="tipeDetail" id="tipeDetail" class="form-select">
                                                        <option value="Detail">Detail</option>
                                                        <option value="Rekap">Rekap</option>
                                                    </select>
                                                </div> -->
                                                <div class="col-12 col-sm-6 mb-2">
                                                    <label for="dari" class="form-label">Dari</label>
                                                    <input type="date" id="dari" value="<?= $dari ?>" name="dari" class="form-control">
                                                </div>
                                                <div class="col-12 col-sm-6 mb-2">
                                                    <label for="sampai" class="form-label">Sampai</label>
                                                    <!-- COUNT OF THE MONTH -->
                                                    <input type="date" id="sampai" value="<?= $sampai ?>" name="sampai"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <a href="admin/laporan-bonus-ujroh" class="btn btn-sm btn-light btn-active-light-primary fw-semibold me-2 px-6">Reset</a>
                                                <button type="submit" class="btn btn-sm btn-primary fw-semibold px-6" data-kt-menu-dismiss="true">Cari</button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                    </div>
                                    <!--end::Menu 1-->
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

                                <!-- total -->
                                <?php $countDataTable = countDataTable(); ?>
                                <div class="card radius-10 bg-primary mb-2 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <p class="mb-1 text-white">Total Bonus</p>
                                                <h3 class="mb-0 text-white" data-kt-countup="true" data-kt-countup-value="<?= ($countDataTable['jumlah']-($countDataTable['jumlah']*0.025)) ?>" data-kt-countup-prefix="Rp">Rp0
                                                </h3>
                                            </div>
                                            <div class="ms-auto widget-icon bg-white-1 text-white">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- total -->

                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Bonus Ujroh</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- begin::Table-->
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle table-row-dashed fs-8 gy-5">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800">
                                                        <th class="min-w-125px">Penerima bonus</th>
                                                        <th class="min-w-125px">Jumlah</th>
                                                        <th class="min-w-150px">Bank</th>
                                                        <th class="min-w-150px">Pemberi Bonus</th>
                                                        <th class="min-w-150px">Tgl Bonus Diterima</th>
                                                        <th class="min-w-100px">Kategori</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-semibold">
                                                    <?php  
                                                        $dataTable = dataTable($page);
                                                        if($dataTable['row'] == 0){
                                                            echo '<tr><td colspan="2" align="center">Data tidak ditemukan.</td><td colspan="2"></td></tr>';
                                                        }else{
                                                            foreach($dataTable['data'] as $row){
                                                                $penerima = dataUser($row['id_user_recruiter']);
                                                                $pemberi = dataUser($row['id_user_recruited']);
                                                                $bank = dataBank($row['id_user_recruiter']);
                                                    ?>
                                                    <tr>
														<td>
                                                            <div  class="d-flex align-items-center">
                                                                <!--begin:: Avatar -->
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            <img src="assets/media/avatars/<?= $penerima['package'] ?>.png" alt="Emma Smith" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <!--end::Avatar-->
                                                                <!--begin::User details-->
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1"><?= ucwords($penerima['username']) ?></a>
                                                                    <span class="text-muted"><?= $penerima['email'] ?></span>
                                                                    <a href="https://api.whatsapp.com/send/?phone=62<?= $penerima['number_whatsapp'] ?>" target="_blank" class="text-muted">62<?= $penerima['number_whatsapp'] ?></a>
                                                                </div>
                                                                <!--begin::User details-->
                                                            </div>
                                                        </td>
														<td>
                                                            <span class="text-gray-800 text-hover-primary">Rp<?= number_format(($row['reward']-($row['reward']*0.025))) ?></span>
                                                        </td>
														<td>
                                                            <div  class="d-flex align-items-center">
                                                                <!--begin::User details-->
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1"><?= ucwords($bank['rek']) ?></a>
                                                                    <span class="text-muted"><?= strtoupper($bank['bank']) ?></span>
                                                                    <span class="text-muted"><?= strtoupper($bank['nama']) ?></span>
                                                                </div>
                                                                <!--begin::User details-->
                                                            </div>
                                                        </td>
														<td>
                                                            <div  class="d-flex align-items-center">
                                                                <!--begin:: Avatar -->
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <div class="symbol-label">
                                                                            <img src="assets/media/avatars/<?= $pemberi['package'] ?>.png" alt="Emma Smith" class="w-100" />
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <!--end::Avatar-->
                                                                <!--begin::User details-->
                                                                <div class="d-flex flex-column">
                                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1"><?= ucwords($pemberi['username']) ?></a>
                                                                    <span class="text-muted"><?= $pemberi['email'] ?></span>
                                                                    <a href="https://api.whatsapp.com/send/?phone=62<?= $pemberi['number_whatsapp'] ?>" target="_blank" class="text-muted">62<?= $pemberi['number_whatsapp'] ?></a>
                                                                </div>
                                                                <!--begin::User details-->
                                                            </div>
                                                        </td>
														<td><?= toUTCorIndo($row['date_time'])['indo'] ?> wita</td>
														<td>
															<div class="fw-bold">
                                                                <?= $row['category'] == "Hamdalah" || $row['category'] == "Basmalah" ? "Paket " . $row['category'] : $row['category'] ?>
                                                            </div>
														</td>
                                                    </tr>
                                                    <?php }} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end::Table-->
                                    </div>
                                    <?php  
                                        $hrefAdd = "";
                                        $dari != "" ? $hrefAdd .= "&dari=" . $dari : '';
                                        $sampai != "" ? $hrefAdd .= "&sampai=" . $sampai : '';

                                        $limit = 5;
                                        $total = $countDataTable['total'];
                                        $total_pages = ceil($total / $limit);
                                        $prev = max(1, $page - 1);
                                        $next = min($total_pages, $page + 1);

                                        if($total_pages > 0 && $dataTable['row'] > 0){
                                    ?>
                                    <div class="card-footer text-center">
                                        <ul class="pagination">
                                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=<?= $prev.$hrefAdd ?>" aria-label="Previous">
                                                    <span aria-hidden="true">«</span>
                                                </a>
                                            </li>
                                            <?php  
                                                        if($total_pages <= 6){
                                                            for($i = 1; $i <= $total_pages; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                                            </li>
                                            <?php  
                                                            }
                                                        }else{
                                                            if($page < 5){
                                                                for($i = 1; $i <= 5; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                                            </li>
                                            <?php
                                                                }
                                                    ?>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <li class="page-item <?= $page == $total_pages ? 'active' : '' ?>">
                                                <a class="page-link"
                                                    href="admin/laporan-bonus-ujroh?page=<?= $total_pages.$hrefAdd ?>"><?= $total_pages; ?></a>
                                            </li>
                                            <?php
                                                            }elseif($page == $total_pages || $total_pages-$page < 4){
                                                    ?>
                                            <li class="page-item <?= $page == 1 ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=1<?= $hrefAdd ?>">1</a>
                                            </li>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <?php  
                                                                for($i = $total_pages-4; $i <= $total_pages; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=<?= $i.$hrefAdd ?>"><?= $i ?></a>
                                            </li>
                                            <?php
                                                                }
                                                            }else{
                                                    ?>
                                            <li class="page-item <?= $page == 1 ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=1<?= $hrefAdd ?>">1</a>
                                            </li>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <?php  
                                                                for($i = $page-1; $i <= $page+1; $i++){
                                                    ?>
                                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=<?= $i.$hrefAdd ?>"><?= $i; ?></a>
                                            </li>
                                            <?php  
                                                                }
                                                    ?>
                                            <li class="page-item disabled">
                                                <a class="page-link">...</a>
                                            </li>
                                            <li class="page-item <?= $page == $total_pages ? 'active' : '' ?>">
                                                <a class="page-link"
                                                    href="admin/laporan-bonus-ujroh?page=<?= $total_pages.$hrefAdd ?>"><?= $total_pages; ?></a>
                                            </li>
                                            <?php
                                                            }
                                                        }
                                                    ?>
                                            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                                <a class="page-link" href="admin/laporan-bonus-ujroh?page=<?= $next.$hrefAdd ?>" aria-label="Next">
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