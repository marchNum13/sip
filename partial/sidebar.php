<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="">
            <img alt="Logo" src="assets/media/logos/default-dark.svg" class="h-45px app-sidebar-logo-default" />
            <img alt="Logo" src="assets/media/logos/default-small.svg" class="h-45px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup:-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="true">
                    <!--begin:Menu item dasbor-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'dasbor' ? 'active' : '' ?>" href="dasbor">
                            <span class="menu-icon">
                                <i class="ki-outline ki-home fs-2"></i>
                            </span>
                            <span class="menu-title">Dasbor</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item dasbor-->
                    
                    <!--begin:Menu item jaringan-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'jaringan' ? 'active' : '' ?>" href="jaringan">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Shaf</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item jaringan-->

                    <!-- begin:Menu item laporan-->
                    <div data-kt-menu-trigger="click" class="menu-item here <?= $pageTitle == 'laporan-bonus-ujroh' || $pageTitle == 'laporan-bonus-jariyah' || $pageTitle == 'laporan-withdraw' || $pageTitle == 'laporan-pembelian-paket' || $pageTitle == 'laporan-automain' ? 'show' : '' ?> menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-questionnaire-tablet fs-2"></i>
                            </span>
                            <span class="menu-title">Laporan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item bonus ujroh-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link <?= $pageTitle == 'laporan-bonus-ujroh' ? 'active' : '' ?>" href="laporan-bonus-ujroh">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Bonus Ujroh</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item bonus ujroh-->

                            <?php if($dataLogin['package'] == "Hamdalah"){ ?>
                            <!--begin:Menu item bonus jariyah-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link <?= $pageTitle == 'laporan-bonus-jariyah' ? 'active' : '' ?>" href="laporan-bonus-jariyah">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Bonus Jariyah</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item bonus jariyah-->
                            <?php } ?>

                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item laporan-->

                    <!--begin:Menu item voucher-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'voucher' ? 'active' : '' ?>" href="voucher">
                            <span class="menu-icon">
                                <i class="ki-outline ki-gift fs-2"></i>
                            </span>
                            <span class="menu-title">Voucher</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item voucher-->

                    <!--begin:Menu item pin-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'pin' ? 'active' : '' ?>" href="pin">
                            <span class="menu-icon">
                                <i class="ki-outline ki-key fs-2"></i>
                            </span>
                            <span class="menu-title">Pin</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item pin-->

                    <?php if($dataLogin['package'] == "Hamdalah"){ ?>
                    <!--begin:Menu item poin tim-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'poin-tim' ? 'active' : '' ?>" href="poin-tim">
                            <span class="menu-icon">
                                <i class="ki-outline ki-medal-star fs-2"></i>
                            </span>
                            <span class="menu-title">Poin Tim</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item poin tim-->
                    <?php } ?>

                    <!--begin:Menu item title pengaturan-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Pengaturan</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item title pengaturan-->
                    
                    <!--begin:Menu item ubah profil-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'profil' ? 'active' : '' ?>" href="profil">
                            <span class="menu-icon">
                                <i class="ki-outline ki-profile-user fs-2"></i>
                            </span>
                            <span class="menu-title">Profil Saya</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item ubah profil-->
                    
                    <!--begin:Menu item ubah password-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'ubah-password' ? 'active' : '' ?>" href="ubah-password">
                            <span class="menu-icon">
                                <i class="ki-outline ki-lock fs-2"></i>
                            </span>
                            <span class="menu-title">Ubah Password</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item ubah password-->
                    
                    <!--begin:Menu item rekening-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link <?= $pageTitle == 'rekening' ? 'active' : '' ?>" href="rekening">
                            <span class="menu-icon">
                                <i class="ki-outline ki-bank fs-2"></i>
                            </span>
                            <span class="menu-title">Rekening</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item rekening-->
                    
                    <!-- example -->
                    <div style="display: none;">
                        <!-- begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-abstract-38 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Customers</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link active" href="apps/customers/getting-started.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Getting Started</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
    
                        <!--begin:Menu item-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Help</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs/base/utilities"
                                target="_blank">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-rocket fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Components</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item -->
                    </div>

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <!-- <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="https://preview.keenthemes.com/html/metronic/docs"
            class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
            title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">Docs & Components</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div> -->
    <!--end::Footer-->
</div>
<!--end::Sidebar-->