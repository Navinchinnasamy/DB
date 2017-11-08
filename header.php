<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Dynamic Insert
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": [ "Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700" ]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="assets/base/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/base/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="assets/image/DB.png"/>
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">
<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[2];
?>
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- begin::Header -->
    <header class="m-grid__item		m-header " data-minimize-mobile="hide" data-minimize-offset="200"
            data-minimize-mobile-offset="200" data-minimize="minimize">
        <div class="m-header__top">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- begin::Brand -->
                    <div class="m-stack__item m-brand">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="index.html" class="m-brand__logo-wrapper">
                                    <img alt="" src="assets/base/media/img/logo/logo.png"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end::Brand -->
                    <!-- begin::Topbar -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        data-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
													<span class="m-topbar__userpic m--hide">
														<img src="assets/image/avatar.png"
                                                             class="m--img-rounded m--marginless m--img-centered"
                                                             alt=""/>
													</span>
                                            <span class="m-topbar__welcome">
														Hello,&nbsp;
													</span>
                                            <span class="m-topbar__username">
														Palani Velayudam
													</span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center"
                                                     style="background: url('assets/image/user_profile_bg.jpg'); background-size: cover;">
                                                    <div class="m-card-user m-card-user--skin-dark">
                                                        <div class="m-card-user__pic">
                                                            <img src="assets/image/avatar.png"
                                                                 class="m--img-rounded m--marginless" alt=""/>
                                                        </div>
                                                        <div class="m-card-user__details">
																	<span class="m-card-user__name m--font-weight-500">
																		Mark Andre
																	</span>
                                                            <a href=""
                                                               class="m-card-user__email m--font-weight-300 m-link">
                                                                mark.andre@gmail.com
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav m-nav-grid--skin-dark">
                                                            <li class="m-nav__item">
                                                                <a href="#"
                                                                   class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                    Logout
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end::Topbar -->
                </div>
            </div>
        </div>
        <div class="m-header__bottom">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- begin::Horizontal Menu -->
                    <div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
                        <div id="m_header_menu"
                             class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                
								<li class="m-menu__item <?php if ($first_part=="insert.php") {echo "m-menu__item--active"; } else  {echo "noactive";}?>" aria-haspopup="true">
                                    <a href="insert.php" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
													Insert
												</span>
                                    </a>
                                </li>

                                <li class="m-menu__item <?php if ($first_part == "delete.php") {
                                    echo "m-menu__item--active";
                                } else {
                                    echo "noactive";
                                } ?>" aria-haspopup="true">
                                    <a href="delete.php" class="m-menu__link ">
                                        <span class="m-menu__item-here"></span>
                                        <span class="m-menu__link-text">
													Delete
												</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- end::Horizontal Menu -->
                </div>
            </div>
        </div>
    </header>
    <!-- end::Header -->