<?php  
    session_start();
    error_reporting(0);
    include "config/auth.php"
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>SIP Member - Sign In</title>
    <?php include "partial/seo.php" ?>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link rel="stylesheet" href="assets/css/style.css">
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
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
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('assets/media/auth/bg4.jpg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('assets/media/auth/bg4-dark.jpg');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="#" class="mb-7">
                        <!-- <img alt="Logo" src="assets/media/logos/custom-3.svg" style="max-width: 50rem;"/> -->
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <!-- <h2 class="text-white fw-normal m-0">Branding tools designed for your business</h2> -->
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        <!--begin::Form-->
                        <form class="form w-100" method="post" action="">
                            <!--begin::Heading-->
                            <div class="text-center mb-11 mt-0">
                                <div class="mb-3">
                                    <img src="assets/media/logos/logo.png" alt="" style="max-width: 150px;">
                                </div>
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Member Panel</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="Email / username" name="usernameEmail" autocomplete="off"
                                    class="form-control bg-transparent" value="<?= $usernameEmail ?>"/>
                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" placeholder="Password" name="password" autocomplete="off"
                                    class="form-control bg-transparent"/>
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <!--begin::Link-->
                                <a href="lupa-password" class="text-cloro">Lupa Password ?</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="sumbit" class="btn btn-primer" name="loginSip" onclick="toggleLoading(this)">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Sign In</span>
                                </button>
                                <button type="button" class="btn btn-primer" disabled style="display: none;">
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
                            <!--end::Submit button-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/custom/authentication/sign-in/general.js"></script>
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