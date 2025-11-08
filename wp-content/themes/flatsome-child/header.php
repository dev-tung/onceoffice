<!DOCTYPE html>
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="<?php flatsome_html_classes(); ?>"> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

	<style>
		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-Regular.otf) format("otf");
			font-weight: 400;
			font-style: normal;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-RegularItalic.otf) format("otf");
			font-weight: 400;
			font-style: italic;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-Bold.otf) format("otf");
			font-weight: 700;
			font-style: normal;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-BoldItalic.otf) format("otf");
			font-weight: 700;
			font-style: italic;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-Light.otf) format("otf");
			font-weight: 300;
			font-style: normal;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-LightItalic.otf) format("otf");
			font-weight: 300;
			font-style: italic;
		}

		@font-face {
			font-family: "SF Pro Text";
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-Medium.otf) format("otf");
			font-weight: 500;
			font-style: normal;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-MediumItalic.otf) format("otf");
			font-weight: 500;
			font-style: italic;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-Semibold.otf) format("otf");
			font-weight: 600;
			font-style: normal;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-SemiboldItalic.otf) format("otf");
			font-weight: 600;
			font-style: italic;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-Semibold.otf) format("otf");
			font-weight: 600;
			font-style: normal;
		}

		@font-face {
			font-family: "SF Pro Text", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-SemiboldItalic.otf) format("otf");
			font-weight: 600;
			font-style: italic;
		}

		@font-face {
			font-family: "SF Pro Text Heavy", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-Heavy.otf) format("otf");
			font-weight: 400;
			font-style: normal;
		}

		@font-face {
			font-family: "SF Pro Text Heavy", sans-serif;
			src: url(<?php echo get_stylesheet_directory_uri(); ?>/fonts/SF-Pro-Text-HeavyItalic.otf) format("otf");
			font-weight: 400;
			font-style: italic;
		}

		body {
			color: #212b36;
			font-family: "SF Pro Text", sans-serif;
			font-size: 14px;
			line-height: 24px;
			background: #f4f6f8;
		}

		#wrapper,
		#main {
			background: transparent;
		}

		.non_padding_bottom {
			padding-bottom: 0 !important;
		}

		.box-text {
			font-size: 14px;
		}

		.h1,
		.h2,
		.h3,
		.h4,
		.h5,
		.h6,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-family: inherit;
			font-weight: 500;
			line-height: 1.1;
			color: inherit
		}

		.h1 .small,
		.h1 small,
		.h2 .small,
		.h2 small,
		.h3 .small,
		.h3 small,
		.h4 .small,
		.h4 small,
		.h5 .small,
		.h5 small,
		.h6 .small,
		.h6 small,
		h1 .small,
		h1 small,
		h2 .small,
		h2 small,
		h3 .small,
		h3 small,
		h4 .small,
		h4 small,
		h5 .small,
		h5 small,
		h6 .small,
		h6 small {
			font-weight: 400;
			line-height: 1;
			color: #777
		}

		.h1,
		.h2,
		.h3,
		h1,
		h2,
		h3 {
			margin-top: 20px;
			margin-bottom: 10px
		}

		.h1 .small,
		.h1 small,
		.h2 .small,
		.h2 small,
		.h3 .small,
		.h3 small,
		h1 .small,
		h1 small,
		h2 .small,
		h2 small,
		h3 .small,
		h3 small {
			font-size: 65%
		}

		.h4,
		.h5,
		.h6,
		h4,
		h5,
		h6 {
			margin-top: 10px;
			margin-bottom: 10px
		}

		.h4 .small,
		.h4 small,
		.h5 .small,
		.h5 small,
		.h6 .small,
		.h6 small,
		h4 .small,
		h4 small,
		h5 .small,
		h5 small,
		h6 .small,
		h6 small {
			font-size: 75%
		}

		.h1,
		h1 {
			font-size: 36px
		}

		.h2,
		h2 {
			font-size: 30px
		}

		.h3,
		h3 {
			font-size: 24px
		}

		.h4,
		h4 {
			font-size: 18px
		}

		.h5,
		h5 {
			font-size: 14px
		}

		.h6,
		h6 {
			font-size: 12px
		}

		p {
			margin: 0 0 10px
		}

		.banner h1 {
			font-size: 44px;
			line-height: 64px;
			font-weight: 500;
		}

		.section.title h1 {
			font-size: 32px;
			font-weight: 500;
			line-height: 48px;
			margin-top: 0;
			margin-bottom: 0;
		}

		.btn-phone {
			color: #fff;
			padding: 10px 32px;
			display: inline-block;
			background: linear-gradient(45deg, #11a48d 0%, #156eb7 100%);
			line-height: 20px;
			font-size: 14px;
			font-weight: normal;
			border: 0;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
			margin: 0;
		}

		.btn-trang {
			color: #00a1b2 !important;
			background: #fff !important;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
			padding: 10px 32px;
			line-height: 20px;
			border: 0;
			font-weight: normal;
			margin: 0;
		}

		#masthead ul.header-nav>li.menu-item {
			padding: 0 15px;
			display: inline-flex;
			position: relative;
			margin: 0;
		}

		#masthead ul.header-nav>li.menu-item:before,
		#masthead ul.header-nav>li.menu-item:after {
			content: none;
		}

		#masthead ul.header-nav>li.menu-item>a {
			color: #535353;
			font-family: "SF Pro Text", sans-serif;
			font-size: 12px;
			font-weight: 500;
			line-height: 14px;
			text-transform: uppercase;
			padding: 28px 0;
			display: inline-block;
			position: relative;
			background: 0 0;
			overflow: hidden;
			font-weight: bold;
		}

		#masthead ul.header-nav>li.menu-item>a:before {
			content: "";
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			height: 4px;
			background-color: #00a1b2;
			-webkit-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
			opacity: 0;
			-webkit-transform: scaleX(0);
			-moz-transform: scaleX(0);
			-ms-transform: scaleX(0);
			-o-transform: scaleX(0);
			transform: scaleX(0);
		}

		#masthead ul.header-nav>li.menu-item:hover>a:before,
		#masthead ul.header-nav>li.current-menu-item>a:before {
			opacity: 1;
			top: 0;
			-webkit-transform: scaleX(1);
			-moz-transform: scaleX(1);
			-ms-transform: scaleX(1);
			-o-transform: scaleX(1);
			transform: scaleX(1);
		}

		#masthead ul.header-nav .icon-angle-down {
			display: none;
		}

		#masthead ul.header-nav>li.menu-item>.sub-menu {
			border-top: 1px solid rgba(255, 255, 255, .1);
			position: absolute;
			top: 100%;
			left: 0;
			width: 250px;
			box-shadow: none;
			background-color: #00a1b2;
			-webkit-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
			margin-top: 20px;
			visibility: hidden;
			opacity: 0;
			padding: 0;
			border: 0;
		}

		#masthead ul.header-nav>li.menu-item:hover>.sub-menu {
			opacity: 1;
			visibility: visible;
			margin-top: 0;
		}

		#masthead ul.header-nav>li.menu-item>.sub-menu>li {
			border-bottom: 1px solid rgba(255, 255, 255, .1);
		}

		#masthead ul.header-nav>li.menu-item>.sub-menu>li>a {
			color: #fff;
			font-size: 12px;
			font-weight: 500;
			line-height: 14px;
			text-transform: uppercase;
			padding: 18px 20px;
			display: block;
			margin: 0;
			border: 0;
		}

		#masthead ul.header-nav>li.menu-item>.sub-menu>li:hover>a {
			color: #00ff00;
		}

		.info {
			font-size: 18px;
			line-height: 28px;
		}

		.info h2 {
			margin: 0 0 20px;
			font-size: 32px;
			font-weight: 600;
			line-height: 48px;
			color: #212b36;
		}

		.address h2 {
			font-size: 28px;
			font-weight: 600;
			line-height: 32px;
		}

		.reason h2 {
			font-size: 28px;
			font-weight: 500;
			line-height: 32px;
		}

		.reason .col.dark h3 {
			font-size: 18px;
			font-weight: 600;

			color: #00a1b2;
		}

		.reason .col.dark p {
			color: #637381;
		}

		.reason .col-inner {
			height: 100%;
		}

		.member h2 {
			font-size: 28px;
			line-height: 32px;
			font-weight: 600;
		}

		.member .icon-box h3 {
			font-size: 16px;
			font-weight: 600;
			line-height: 20px;
			color: #212b36;
		}

		.member .icon-box p {
			color: #637381;
			font-size: 12px;
			font-weight: 500;
			line-height: 14px;
		}

		.member .flickity-prev-next-button.previous {
			left: 0 !important;
		}

		.member .flickity-prev-next-button.next {
			right: 0 !important;
		}

		.quy_trinh h2 {
			font-size: 28px;
			font-weight: 600;
			line-height: 36px;
		}

		.quy_trinh .accordion {
			counter-reset: quy-trinh;
		}

		.quy_trinh .accordion-item {
			list-style: none;
			background: #fff;
			margin-left: 62px;
			padding: 24px 32px;
			margin-bottom: 15px;
			position: relative;
		}

		.quy_trinh .accordion-item:before {
			top: 50%;
			z-index: 1;
			color: #fff;
			left: -62px;
			width: 32px;
			height: 32px;
			display: flex;
			position: absolute;
			align-items: center;
			justify-content: center;
			-webkit-border-radius: 50%;
			-moz-border-radius: 50%;
			-ms-border-radius: 50%;
			-o-border-radius: 50%;
			border-radius: 50%;
			counter-increment: quy-trinh;
			content: counter(quy-trinh);
			-webkit-transform: translateY(-50%);
			-moz-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			-o-transform: translateY(-50%);
			transform: translateY(-50%);
			background-color: #00a1b2;
		}

		.quy_trinh .accordion-item:not(:last-child):after {
			z-index: 0;
			content: "";
			top: 50%;
			left: -46px;
			height: 100%;
			display: block;
			margin-top: 10px;
			position: absolute;
			border-left: 1px dashed #dee0e3;
		}

		.quy_trinh .accordion-title {
			padding: 0;
			border: 0;
			margin-top: 0;
			font-size: 18px;
			font-weight: 600;
			margin-bottom: 4px;
			text-transform: uppercase;
			color: #212b36;
			line-height: 28px;
		}

		.quy_trinh .accordion .toggle {
			display: none;
		}

		.quy_trinh .accordion-inner {
			display: block !important;
			height: auto !important;
			padding: 0 !important;
		}

		.customer h2 {
			font-size: 28px;
			font-weight: 600;
			line-height: 36px;
		}

		.feedback h2 {
			font-size: 28px;
			font-weight: 600;
			line-height: 36px;
		}

		.feedback .slider .row {
			justify-content: center;
		}

		.feedback .slider .row .col {
			max-width: 75%;
			-ms-flex-preferred-size: 75%;
			flex-basis: 75%;
		}

		.feedback .slider .row .col .col-inner {
			padding: 30px 60px 0;
			font-size: 12px;
			font-weight: 500;
			line-height: 14px;
			position: relative;
			color: #637381;
			background-color: #fff;
			-webkit-box-shadow: 0 4px 24px -5px rgba(33, 43, 54, .1);
			box-shadow: 0 4px 24px -5px rgba(33, 43, 54, .1);
			text-align: center;
		}

		.feedback .slider .row .col .col-inner p {
			font-size: 16px;
			line-height: 26px;
		}

		.feedback .slider .row .col .col-inner>p:last-child {
			padding: 70px;
			position: relative;
		}

		.feedback .slider .row .col .col-inner>p:last-child>img {
			margin: 0;
			position: absolute;
			top: -5px;
			left: 50%;
			transform: translate(-50%, 0);
			width: 170px;
		}

		.feedback .slider .flickity-prev-next-button {
			opacity: 1;
		}

		.feedback>.section-content>.row>.col:last-child {
			/*padding-bottom: 80px;*/
			padding-bottom: 0;
		}

		.process h2 {
			font-size: 28px;
			font-weight: 600;
			line-height: 38px;
		}

		.process .box .box-image {
			margin-bottom: 15px;
		}

		.process .box .box-text h4>a {
			transition: all 0.3s;
		}

		.process .box .box-text h4>a:hover {
			color: #00a1b2;
		}

		.process .box .box-text p {
			color: #dde3ed;
		}

		.process .box .box-text p:last-child>a {
			color: #fff;
			font-weight: 500;
			line-height: 30px;
			display: flex;
			margin-top: 5px;
			margin-bottom: 16px;
			align-items: center;
		}

		.process .box .box-text p:last-child>a>i {
			font-size: 20px;
			margin-left: 6px;
		}


		.logo_footer p {
			margin-bottom: 0;
		}

		#footer .section-title-container {
			margin: 0;
		}

		#footer .section-title {
			font-size: 14px;
			font-weight: 600;
			line-height: 24px;
			border: 0;
		}

		#footer .section-title b {
			display: none;
		}

		#footer .section-title span {
			border: 0;
		}

		#footer p,
		#footer a,
		#footer li {
			color: #dde3ed;
			font-size: 12px;
			line-height: 24px;
			margin: 0;
			padding-left: 0;
			list-style: none;
		}

		#footer a,
		#footer li {
			font-size: 14px;
			line-height: 30px;
		}

		#footer .social-icons a {
			font-size: 16px;
			color: #fff;
			margin: 5px 20px 20px 0;
		}

		#footer .absolute-footer {
			padding: 10px 0;
			color: #fff;
			background: #191919;
		}

		#footer .absolute-footer a {
			color: #fff;
		}

		.lien_he .col .col-inner,
		.title .col .col-inner {
			text-align: center;
		}

		.lien_he .btn-phone,
		.lien_he .btn-trang,
		.title .btn-phone,
		.title .btn-trang {
			margin: 5px;
		}

		.wpcf7-form .wpcf7-form-control {
			height: 40px;
			-webkit-box-shadow: none;
			box-shadow: none;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			-ms-border-radius: 2px;
			-o-border-radius: 2px;
			border-radius: 2px;
			border-color: #bec0c6;
		}

		.wpcf7-form h4 {
			font-size: 18px;
			line-height: 24px;
			font-weight: 600;
		}

		.wpcf7-form .col.action .col-inner {
			padding-top: 20px;
			border-top: 1px solid #dfe3e8;
		}

		.wpcf7-form .wpcf7-submit {
			color: #fff;
			padding: 9px 32px;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			-ms-border-radius: 2px;
			-o-border-radius: 2px;
			border-radius: 2px;
			border: 1px solid rgba(0, 0, 0, .1);
			background: linear-gradient(45deg, #11a48d 0%, #156eb7 100%);
			margin: 0;
			line-height: normal;
			text-transform: inherit;
			font-weight: normal;
		}

		.wpcf7-form .wpcf7-file {
			margin: 0;
		}

		.archive-page-header .large-12.text-center.col {
			padding-bottom: 0;
		}

		.archive-page-header .page-title {
			display: none;
		}

		.archive-page-header .taxonomy-description {
			position: relative;
			padding-bottom: 30px;
		}

		.archive-page-header .taxonomy-description>p:nth-child(1),
		.archive-page-header .taxonomy-description>p:nth-child(1)>img,
		.archive-page-header .taxonomy-description>p:nth-child(2) {
			margin: 0;
		}

		.archive-page-header .taxonomy-description>p:nth-child(1) {
			padding-top: 31%;
			position: relative;
		}

		.archive-page-header .taxonomy-description>p:nth-child(1)>img {
			right: 0;
			width: 100%;
			height: 100%;
			bottom: 0;
			left: 0;
			top: 0;
			position: absolute;
			object-position: 50% 50%;
			object-fit: cover;
			font-family: 'object-fit: cover;';
			z-index: 1
		}

		.archive-page-header .taxonomy-description>p:nth-child(1):before {
			top: 0;
			left: 0;
			width: 100%;
			content: "";
			height: 100%;
			display: block;
			position: absolute;
			background-color: rgba(0, 161, 178, 0.4);
			z-index: 2
		}

		.archive-page-header .taxonomy-description>p:nth-child(2) {
			position: absolute;
			top: 50%;
			left: 50%;
			z-index: 3;
			color: #fff;
			transform: translate(-50%, -50%);
			font-size: 24px;
			width: 100%;
			line-height: 45px;
			margin-top: -15px;
		}

		aside.widget .menu {
			background-color: #fff;
			border: 1px solid #eaecee;
		}

		aside.widget .menu>li {
			border-top: 0;
		}

		aside.widget .menu>li>a {
			padding: 20px;
			display: block;
			border-right: 2px solid transparent;
			line-height: 20px;
			color: #212b36;
			transition: all 0.3s;
		}

		aside.widget .menu>li:not(:last-child) {
			border-bottom: 1px solid #dfe3e8;
		}

		aside.widget .menu>.current-menu-item>a,
		aside.widget .menu>li:hover>a {
			color: #00a1b2;
			border-right-color: #00a1b2;
		}

		aside.widget.block_widget {
			background-color: #f9fafb;
			border: 1px solid #eaecee;
			padding: 30px 20px 0;
		}

		aside.widget.block_widget h2 {
			margin-top: 0;
			margin-bottom: 30px;
			font-size: 18px;
			font-weight: 600;
			line-height: 24px;
			text-align: center;
		}

		aside.widget .btn-phone {
			padding: 10px;
			display: block;
			font-weight: 500;
			text-align: center;
			margin-bottom: 20px;
			color: #fff;
			background: #00a1b2;
			border: 1px solid rgba(0, 0, 0, .1);
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
			width: 100%;
		}

		aside.widget .btn-trang {
			padding: 10px;
			display: block;
			font-weight: 500;
			text-align: center;
			margin-bottom: 20px;
			color: #00a1b2;
			border: 1px solid #00a1b2;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
			width: 100%;
		}

		#post-list>article {
			display: flex;
			flex-wrap: wrap;
			margin-bottom: 15px;
		}

		#post-list>article .article-inner {
			display: flex;
			flex-wrap: wrap;
		}

		#post-list>article .entry-header {
			width: 35%;
		}

		#post-list>article .entry-header-text {
			width: 65%;
			background: #fff;
			padding: 24px 24px 20px;
		}

		#post-list>article .entry-category,
		#post-list>article .entry-divider,
		#post-list>article .entry-meta {
			display: none;
		}

		#post-list>article .entry-content {
			padding: 0;
		}

		#post-list>article .entry-header-text h2 {
			margin: 0;
			display: flex;
			flex-wrap: wrap;
		}

		#post-list>article .entry-header-text h2 a {
			font-size: 16px;
			font-weight: 500;
			line-height: 26px;
			display: inline-block;
			color: #272b48;
			width: 100%;
			margin-bottom: 10px;
			display: block;
		}

		#post-list>article .entry-header-text h2 a:hover {
			color: #00a1b2;
		}

		#post-list>article .entry-content {
			color: #637381;
			font-size: 14px;
			line-height: 24px;
		}

		#post-list>article .entry-content .more-link {
			margin-top: 10px;
			color: #00a1b2;
			display: inline-block;
			border: 0;
			text-transform: inherit;
			font-size: 14px;
			font-weight: normal;
			background: transparent;
			padding: 0;
			margin: 0;
			line-height: normal;
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			margin-top: 5px;
		}

		#post-list>article .entry-content .more-link:hover {
			color: #ef6594;
		}

		#post-list>article .entry-content .more-link i {
			line-height: normal;
			margin: 0;
			top: auto;
			position: relative;
			height: auto;
			margin-left: 3px;
			font-size: 16px;
		}

		#post-list>article .entry-image a {
			position: relative;
			padding-top: 65%;
			display: block;
		}

		#post-list>article .entry-image a img {
			right: 0;
			width: 100%;
			height: 100%;
			bottom: 0;
			left: 0;
			top: 0;
			position: absolute;
			object-position: 50% 50%;
			object-fit: cover;
			font-family: 'object-fit: cover;';
		}

		ul.page-numbers {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
		}

		ul.page-numbers>li {
			background: #fff;
			margin-bottom: 8px;
			display: inline-block;
			margin: 0;
		}

		ul.page-numbers>li>span,
		ul.page-numbers>li>a {
			padding: 7px 13px;
			display: inline-block;
			border: 1px solid #eaecee;
			border-radius: 0;
			font-weight: normal;
			background: transparent !important;
			line-height: normal;
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			justify-content: center;
			height: auto;
		}

		ul.page-numbers>li>span,
		ul.page-numbers>li>a:hover {
			color: #00a1b2 !important;
			border-color: #00a1b2 !important;
		}

		ul.page-numbers>li>a>i {
			line-height: normal;
			top: auto;
			font-size: 15px;
		}

		.blog-single .entry-category,
		.blog-single .entry-divider,
		.blog-single .entry-meta,
		.blog-single .entry-header-text .entry-content {
			display: none;
		}

		.blog-single .entry-header-text {
			padding: 0;
		}

		.blog-single article {
			padding: 34px 40px 50px;
			border: 1px solid #dee0e3;
			background-color: #fff;
			margin-bottom: 0;
			display: flex;
			flex-wrap: wrap;
		}

		.blog-single .entry-header-text h1 {
			font-size: 28px;
			font-weight: 600;
			line-height: 36px;
			margin-bottom: 28px;
			border-bottom: 1px solid #f0f0f0;
			padding-bottom: 3px;
		}

		.blog-single .entry-header {
			display: none;
		}

		.blog-single .entry-content.single-page {
			padding: 0;
		}

		.blog-single #comments {
			display: none;
		}

		.blog-single .related-news {
			padding-top: 30px;
		}

		.blog-single .related-news h3 {
			margin-top: 0;
			color: #212b36;
			font-size: 18px;
			font-weight: 600;
			line-height: 24px;
			margin-bottom: 24px;
		}

		.blog-single .related-news ul {
			color: #00a1b2;
			list-style: disc;
			padding-left: 15px;
			margin-bottom: 0;
		}

		.blog-single .related-news li {
			margin-bottom: 12px;
		}

		.blog-single .related-news li a {
			color: #00a1b2;
		}

		.category-page-title .flex-col.medium-text-center:last-child {
			display: none;
		}

		.product-main {
			padding-bottom: 0;
		}

		.col_image_large {
			max-width: 100%;
			-ms-flex-preferred-size: 100%;
			flex-basis: 100%;
		}

		.col_image_large>.row {
			display: flex;
			flex-wrap: wrap;
			flex-direction: row-reverse;
			justify-content: flex-end;
		}

		.col_image_large>.row>.large-10 {
			max-width: 79%;
			-ms-flex-preferred-size: 79%;
			flex-basis: 79%;
			padding-bottom: 0;
		}

		.col_image_large>.row>.large-2 {
			max-width: 21%;
			-ms-flex-preferred-size: 21%;
			flex-basis: 21%;
		}

		.col_image_large>.row>.large-2 .product-thumbnails .flickity-slider>.col {
			padding-bottom: 10px !important;
		}

		.col_image_large>.row>.large-2 .product-thumbnails .flickity-slider>.col:last-child {
			padding-bottom: 0 !important;
		}

		.col_image_large>.row>.large-2.vertical-thumbnails {}

		/* width */
		.col_image_large>.row>.large-2.vertical-thumbnails::-webkit-scrollbar {
			width: 7px;
		}

		/* Track */
		.col_image_large>.row>.large-2.vertical-thumbnails::-webkit-scrollbar-track {
			background: #f0f0f0;
		}

		/* Handle */
		.col_image_large>.row>.large-2.vertical-thumbnails::-webkit-scrollbar-thumb {
			background: #00a1b2;
		}

		/* Handle on hover */
		.col_image_large>.row>.large-2.vertical-thumbnails::-webkit-scrollbar-thumb:hover {
			background: #888;
		}

		.product-thumbnails img {
			opacity: 1;
		}

		.product-info {
			padding-bottom: 0;
		}

		.product-info .tab-item {
			margin-bottom: 35px;
		}

		.product-info .tab-item .tab-title,
		.product-footer .product-section h5.mt {
			margin: 0;
			font-size: 14px;
			font-weight: 600;
			margin-bottom: 0;
			line-height: 24px;
			padding: 10px 24px;
			text-transform: uppercase;
			color: #00a1b2;
			background: #dfe3e8;
		}

		.product-info .tab-item .tab-title strong {
			font-weight: bold;
		}

		.product-info .tab-item .tab-content,
		.product-footer .product-section .entry-content {
			background: #fff;
			line-height: 20px;
			padding: 12px 17px;
			font-size: 13px;
		}

		.product-info .tab-item .tab-content:before,
		.product-info .tab-item .tab-content:after {
			content: "";
			display: table;
			clear: both;
		}

		.product-info .tab-item .tab-content>ul {
			width: 50%;
			display: inline-block;
			float: left;
		}

		.product-info .tab-item .tab-content>ul>li {
			padding: 12px 15px 0;
			display: inline-table;
			width: 100%;
			height: 44px;
			margin: 0;
		}

		.product-info .tab-item .tab-content>ul>li>strong {
			display: table-cell;
			width: 33%;
		}

		.product-info .tab-item .tab-content.gia_thue>ul>li>strong {
			display: table-row;
			width: 100%;
		}

		.product-info .tab-item .tab-content>ul>li span {
			color: #00a1b2;
		}

		.product-info .tab-item .tab-content>ul>li:after {
			content: "";
			clear: both;
			display: block;
		}

		.product-info>* {
			display: none;
		}

		.product-info>.box-item {
			display: block;
		}

		.product-footer .product-section {
			border: 0;
			margin-bottom: 35px;
			display: none;
		}

		.product-footer .product-section:first-child {
			display: block;
		}

		.product-footer .product-section>.row {
			display: flex;
			flex-wrap: wrap;
		}

		.product-footer .product-section>.row>.col {
			max-width: 100%;
			-ms-flex-preferred-size: 100%;
			flex-basis: 100%;
		}

		.product-footer .product-section .entry-content {
			padding: 32px 32px 29px;
		}

		#product-sidebar .thongtinsp {
			padding-bottom: 32px;
			margin-bottom: 32px;
			border-bottom: 1px solid #dee0e3;
		}

		#product-sidebar .thongtinsp h1 {
			margin-top: 0;
			font-size: 32px;
			font-weight: 700;
			line-height: 44px;
		}

		#product-sidebar .thongtinsp p {
			font-size: 16px;
		}

		#product-sidebar .thongtinsp .price {
			display: block;
			font-size: 18px;
			font-weight: 600;
			line-height: 28px;
			color: #00a1b2;
			margin-bottom: 24px;
		}

		#product-sidebar .thongtinsp .btn-care {
			background-color: #fff;
		}

		.kinh_nghiem {
			border-top: 1px solid #dee0e3;
		}

		.kinh_nghiem h2 {
			font-size: 28px;
			font-weight: 600;
			line-height: 32px;
			text-align: center;
		}

		.kinh_nghiem .tabbed-content.tabbed_content_description_term {
			padding-left: 0;
			padding-right: 0;
		}

		.kinh_nghiem .tabbed-content ul.nav-tabs {
			display: flex;
			border-bottom: 2px solid #dee0e3;
		}

		.kinh_nghiem .tabbed-content ul.nav-tabs>li {
			flex: 1;
			float: none;
			text-align: center;
			margin-bottom: -2px;
		}

		.kinh_nghiem .tabbed-content ul.nav-tabs>li.active>a {
			color: #00a1b2;
			background-color: transparent;
			border-bottom: 2px solid #00a1b2;
		}

		.kinh_nghiem .tabbed-content ul.nav-tabs>li>a {
			border: 0;
			background: transparent;
			text-transform: inherit;
			font-size: 14px;
			font-weight: normal;
			line-height: 24px;
			display: block;
			padding: 20px;
			color: #637381;
			-webkit-border-radius: 0;
			-moz-border-radius: 0;
			-ms-border-radius: 0;
			-o-border-radius: 0;
			border-radius: 0;
			border-bottom: 2px solid transparent;
			-webkit-transition: all 0.3s ease-in-out 0s;
			-o-transition: all 0.3s ease-in-out 0s;
			transition: all 0.3s ease-in-out 0s;
		}

		.kinh_nghiem .tabbed-content ul.nav-tabs>li>a:hover,
		.kinh_nghiem .tabbed-content ul.nav-tabs>li>a:focus {
			background-color: transparent;
			border-bottom-color: #00a1b2;
		}

		.kinh_nghiem .tab-panels {
			padding: 60px 60px 0;
			border: 0;
			background: transparent;
		}

		.kinh_nghiem .tab-panels .panel.active {
			margin: auto;
			padding: 40px;
			max-width: 74%;
			background-color: #fff;
			border: 1px solid #dee0e3;
		}

		.kinh_nghiem .tab-panels h2 {
			font-size: 24px;
			font-weight: 600;
			line-height: 38px;
		}

		.kinh_nghiem .tab-panels h3 {
			font-size: 20px;
			font-weight: 600;
			line-height: 32px;
		}

		.kinh_nghiem .tab-panels h4 {
			font-size: 14px;
			font-weight: 600;
			line-height: 20px;
		}

		.kinh_nghiem .tab-panels a {
			color: #00a1b2;
		}

		.kinh_nghiem .tab-panels a:hover,
		.kinh_nghiem .tab-panels a:focus {
			color: #ee578a;
		}

		.kinh_nghiem .tab-panels p {
			font-size: 15px;
			text-align: justify;
			line-height: 30px;
		}

		html.csncngbg_openq {
			overflow: hidden;
		}

		.csncngbg {
			padding: 0 !important;
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			position: fixed;
			top: 70px;
			left: 0;
			width: 100%;
			height: calc(100% - 70px);
			z-index: 9;
			opacity: 0;
			visibility: hidden;
			transition: all 0.3s;
			overflow-x: hidden;
			overflow-y: auto;
			background: rgba(0, 161, 178, 0.4);
		}

		body.admin-bar .csncngbg {
			top: 100px;
			height: calc(100% - 100px);
		}

		.csncngbg.openq {
			opacity: 1;
			visibility: visible;
		}

		.csncngbg .body_csncngbg {
			overflow: inherit;
			width: 992px;
			-webkit-transition: -webkit-transform .3s ease-out;
			-o-transition: -o-transform .3s ease-out;
			transition: transform .3s ease-out;
			-webkit-transform: translate(0, -25%);
			-ms-transform: translate(0, -25%);
			-o-transform: translate(0, -25%);
			transform: translate(0, -25%);
			-webkit-transform: translate(0, 0);
			-ms-transform: translate(0, 0);
			-o-transform: translate(0, 0);
			transform: translate(0, 0);
			position: relative;
			z-index: 2;
			margin: 30px auto;
			display: flex;
			flex-wrap: wrap;
			max-width: 100%;
		}

		.csncngbg .body_csncngbg .body_content_csncngbg {
			background: #fff;
		}

		.csncngbg .background_close_csncngbg {
			position: fixed;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			z-index: 1;
		}

		.csncngbg .close_csncngbg {
			color: #fff;
			top: 15px;
			right: 15px;
			opacity: .7;
			font-size: 24px;
			text-shadow: none;
			position: absolute;
			z-index: 1;
		}

		.csncngbg .close_csncngbg:hover {
			opacity: 1;
		}

		.csncngbg .close_csncngbg .close {
			margin: 0;
			padding: 0;
			height: auto;
			line-height: normal;
			border: 0;
			display: flex;
			min-height: auto;
		}

		.csncngbg .header_csncngbg h4 {
			color: #fff;
			margin: 0;
			padding: 22px 56px 22px;
			background-color: #00a1b2;
			position: relative;
			text-align: left;
			padding-right: 50px !important;
		}

		.csncngbg .body_csncngbg .body_content_csncngbg>.row {
			padding: 21px 56px 15px;
		}

		.csncngbg .footer_csncngbg {
			background-color: #f4f6f8;
			border-top: 1px solid #eaecee;
			padding: 14px 56px;
		}

		.csncngbg .footer_csncngbg .col-inner {
			text-align: right;
		}

		.csncngbg .body_content_csncngbg p,
		.csncngbg .body_content_csncngbg label,
		.csncngbg .body_content_csncngbg>.row h4 {
			color: #212b36 !important;
			text-align: left;
		}

		.csncngbg .body_content_csncngbg span {
			text-align: left;
		}

		section.section.section_zindex {
			z-index: 9;
		}

		.mfp-wrap .block_widget {
			display: none;
		}

		.shop-page-title.category-page-title.page-title {
			display: none;
		}

		.display_type_both .term-description {
			position: relative;
		}

		.display_type_both .term-description>p:first-child {
			position: relative;
			margin: 0;
			padding: 0;
			padding-top: 20%;
		}

		.display_type_both .term-description>p:first-child:before {
			content: "";
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			position: absolute;
			background: rgba(0, 161, 178, 0.4);
			z-index: 2;
		}

		.display_type_both .term-description>p:first-child>img {
			right: 0;
			width: 100%;
			height: 100%;
			bottom: 0;
			left: 0;
			top: 0;
			position: absolute;
			object-position: 50% 50%;
			object-fit: cover;
			font-family: 'object-fit: cover;';
			z-index: 1;
		}

		.display_type_both .term-description>h1 {
			position: absolute;
			width: 100%;
			top: 50%;
			left: 0;
			transform: translate(0, -50%);
			font-size: 32px;
			line-height: 48px;
			margin: 0;
			color: #fff;
			text-align: center;
			z-index: 3;
			padding-bottom: 45px;
		}

		.display_type_both .term-description>p:nth-child(3) {
			position: absolute;
			width: 100%;
			top: 50%;
			left: 0;
			transform: translate(0, -50%);
			margin: 0;
			color: #fff;
			text-align: center;
			z-index: 3;
			padding-top: 45px;
		}

		.search-filter {
			border: 1px solid #eaecee;
			margin-bottom: 30px;
		}

		.form-search {
			padding: 32px 0;
			background: #fff;
			border: 1px solid #eaecee;
			padding-bottom: 0;
		}

		.form-search form {
			display: flex;
			flex-wrap: wrap;
		}

		.form-search .search-field {
			padding: 0 32px 14px;
		}

		.quan-gia-page .form-search .search-field:nth-of-type(2n+2):before {
			content: "";
			top: 0;
			left: 0;
			bottom: 32px;
			position: absolute;
			border-left: 1px dashed #dfe3e8;
		}

		.form-search .search-field h3 {
			font-size: 14px;
			font-weight: 600;
			line-height: 24px;
			margin: 0 0 16px;
		}

		.quan-gia-page .form-search .search-field h3 {
			padding: 6px 15px;
			text-align: center;
			margin-bottom: 27px;
			-webkit-border-radius: 18px;
			-moz-border-radius: 18px;
			-ms-border-radius: 18px;
			-o-border-radius: 18px;
			border-radius: 18px;
			background: #f4f6f8;
		}

		body .quan-gia-page .form-search .search-field h3 {
			margin-bottom: 23px;
		}

		.form-search .list-filter {
			margin: 0;
		}

		.form-search .list-filter>li {
			display: inline-block;
		}

		.quan-gia-page .form-search .search-field {
			width: 50%;
			position: relative;
			padding-bottom: 18px;
			border-bottom: 1px solid #eaecee;
		}

		.quan-gia-page .form-search .search-field+.search-field {
			border-top: none;
			padding-top: 0;
			padding-bottom: 0;
		}

		.quan-gia-page .form-search .search-field h3 {
			margin-bottom: 23px;
		}

		.quan-gia-page .form-search .list-filter {
			display: flex;
			flex-wrap: wrap;
		}

		.quan-gia-page .quan .quan_filter .col {
			display: flex;
			flex-wrap: wrap;
			padding: 0;
		}

		.quan-gia-page .quan .quan_filter .col .item {
			width: 50%;
			padding-left: 15px;
			padding-right: 15px;
		}

		body .custom-checkbox {
			margin-bottom: 24px;
			cursor: pointer;
		}

		.custom-checkbox {
			font-size: 14px;
			line-height: 17px;
			position: relative;
			padding-left: 24px;
			margin-bottom: 28px;
			font-weight: normal;
		}

		.custom-checkbox input {
			width: 0;
			height: 0;
			opacity: 0;
			cursor: pointer;
			position: absolute;
		}

		.custom-checkbox .checkmark {
			position: absolute;
			top: 0;
			left: 0;
			width: 17px;
			height: 17px;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			-ms-border-radius: 3px;
			-o-border-radius: 3px;
			border-radius: 3px;
			border: 1px solid #c4cdd5;
		}

		body .custom-checkbox .checkmark {
			width: 16px;
			height: 16px;
		}

		.custom-checkbox input:checked~.checkmark {
			border-color: #00a1b2;
		}

		.custom-checkbox input:checked~.checkmark:after {
			display: block;
		}

		.custom-checkbox .checkmark:after {
			top: 1px;
			left: 5px;
			width: 5px;
			content: "";
			height: 10px;
			display: none;
			position: absolute;
			border: solid #00a1b2;
			border-width: 0 2px 2px 0;
			-webkit-transform: rotate(45deg);
			-moz-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			-o-transform: rotate(45deg);
			transform: rotate(45deg);
		}

		.form-search .tz-search-btn {
			margin: auto;
			color: #fff;
			margin-top: 32px;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			-ms-border-radius: 2px;
			-o-border-radius: 2px;
			border-radius: 2px;
			border-color: rgba(0, 0, 0, .1);
			background: linear-gradient(45deg, #11a48d 0%, #156eb7 100%);

			padding: 9px 40px;
			font-weight: 500;
			min-width: 248px;

			line-height: normal;
			text-transform: inherit;
			text-align: center;
			cursor: pointer;
		}

		.list-filter .btn-filter {
			padding: 8px 16px;
			margin: 0 16px 16px 0;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			-ms-border-radius: 2px;
			-o-border-radius: 2px;
			border-radius: 2px;
			border: 1px solid rgba(0, 0, 0, .1);
			background-color: rgba(25, 54, 102, .05);
			-webkit-transition: all .3s ease-in-out 0s;
			-o-transition: all .3s ease-in-out 0s;
			transition: all .3s ease-in-out 0s;
			line-height: 20px;
			padding: 7px 16px;
			font-size: inherit;
			color: inherit;
			display: inline-block;
		}

		.list-filter .btn-filter.active {
			background-color: rgba(25, 54, 102, .2);
		}

		.form-search .search-field .note {
			font-size: 10px;
			margin-top: 40px;
			line-height: 20px;
		}

		body .form-search .search-field .note {
			margin-top: 0;
		}

		.form-search .search-field .note .fa-info {
			width: 14px;
			height: 14px;
			line-height: 12px;
			margin-right: 5px;
			text-align: center;
			-webkit-border-radius: 50%;
			-moz-border-radius: 50%;
			-ms-border-radius: 50%;
			-o-border-radius: 50%;
			border-radius: 50%;
			border: 1px solid #212b36;
		}

		.form-search .search-field .note .note-item>span {
			font-weight: 600;
		}

		.quan-gia-page .gia .layout-slider .widget-title,
		.quan-gia-page .gia .layout-slider .is-divider,
		.quan-gia-page .gia .layout-slider .price_slider_amount .button {
			display: none;
		}

		.category-page-row .col_kqtim {
			max-width: 100%;
			-ms-flex-preferred-size: 100%;
			flex-basis: 100%;
		}

		.category-page-row .col_kqtim.kqtim_btn_care {
			max-width: inherit;
		}

		.category-page-row .col_kqtim .products {
			display: flex;
			flex-wrap: wrap;
		}

		.category-page-row .col_kqtim .products>.col {
			max-width: 25%;
			-ms-flex-preferred-size: 25%;
			flex-basis: 25%;
		}

		.form-search.search-duong {
			text-align: center;
			padding: 30px 30px 30px 34px;
		}

		.form-search.search-duong .search-title {
			font-size: 14px;
			border-radius: 18px;
			background-color: #f4f6f8;
			font-weight: 600;
			line-height: 24px;
			padding: 6px 0;
			color: #212b36;
			width: 185px;
			text-align: center;
			max-width: 100%;
			display: inline-block;
			margin: 0;
		}

		.form-search.search-duong .list-duong {
			position: relative;
			text-align: left;
		}

		.form-search.search-duong .character-title {
			height: 24px;
			width: 24px;
			color: #fff;
			font-size: 14px;
			font-weight: 500;
			line-height: 24px;
			text-align: center;
			background: #00a1b2;
			margin: 32px 7px 7px;
			-webkit-border-radius: 50%;
			-moz-border-radius: 50%;
			-ms-border-radius: 50%;
			-o-border-radius: 50%;
			border-radius: 50%;
		}

		.form-search.search-duong .character-title:nth-of-type(1) {
			margin-top: 27px;
		}

		.form-search.search-duong .duong-item {
			width: 25%;
			float: left;
			background-color: #fff;
			color: #212b36;
			font-size: 14px;
			line-height: 20px;
			padding: 10px 16px 9px;
		}

		.form-search.search-duong .duong-item:hover {
			color: #00a1b2;
		}

		.form-search.search-duong .line-item {
			border-top: 1px solid #dee0e3;
			display: block;
			width: 100%;
			clear: both;
		}

		.category-page-row aside.widget {
			display: none;
		}

		.category-page-row aside.widget:first-child,
		.category-page-row aside.widget:last-child {
			display: block;
		}

		.form-search .search-suggest span.widget-title,
		.form-search .search-suggest .is-divider {
			display: none;
		}

		.form-search.search-title-building {
			padding: 31px;
			text-align: center;
		}

		.form-search.search-title-building .search-title {
			font-size: 14px;
			border-radius: 18px;
			background-color: #f4f6f8;
			font-weight: 600;
			line-height: 24px;
			padding: 6px 0;
			color: #212b36;
			width: 359px;
			text-align: center;
			max-width: 100%;
			display: inline-block;
			margin: 0;
		}

		.form-search.search-title-building .search-suggest {
			margin: 32px 0;
			position: relative;
		}

		.form-search.search-title-building .search-field {
			border: 1px solid #c4cdd5;
			border-radius: 2px;
			background-color: #fff;
			padding: 10px 16px 8px;
			color: #637381;
			line-height: 20px;
			margin: 0;
			width: 100%;
			-webkit-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
			box-shadow: none;
			height: 40px;
			margin-bottom: 30px !important;
		}

		.form-search.search-title-building .search-field:hover,
		.form-search.search-title-building .search-field:focus {
			border-color: #00a1b2;
		}

		.form-search.search-title-building .ux-search-submit {
			position: absolute;
			left: 50%;
			top: 100%;
			transform: translate(-50%, 0);

			max-width: 100%;
			border: 1px solid rgba(0, 0, 0, .1);
			border-radius: 2px;
			padding: 9px 44px;
			background: linear-gradient(45deg, #11a48d 0%, #156eb7 100%);
			box-shadow: inset 0 1px 0 1px rgba(255, 255, 255, .06), 0 1px 0 0 rgba(22, 29, 37, .1);
			color: #fff;
			font-weight: 500;
			line-height: 20px;
			text-align: center;
			text-transform: inherit;
		}

		.building-rank .sec-building-top {
			display: flex;
		}

		.building-rank .sec-building-top .heading {
			width: 100%;
		}

		.building-rank .readmore {
			text-indent: 5px;
			color: #00a1b2;
			white-space: nowrap;
		}

		.list-building {
			padding-bottom: 10px;
		}

		.building-rank .sec-building-top {
			display: flex;
		}

		.building-rank .heading {
			margin: 0 0 30px;
			font-size: 18px;
			font-weight: 600;
			line-height: 24px;
			color: #00a1b2;
		}

		.building-rank .sec-building-top .heading {
			width: 100%;
		}

		.building-rank .heading:before {
			content: "";
			height: 20px;
			padding-right: 10px;
			border-left: 4px solid #00a1b2;
		}

		.building-item {
			font-size: 12px;
			line-height: 18px;
			font-weight: 500;
			background: #fff;
			margin-bottom: 30px;
			border: 1px solid #eaecee;
		}

		.building-item .thumb {
			height: 197px;
			overflow: hidden;
		}

		.building-item .thumb img {
			display: block;
			max-width: 100%;
			object-fit: cover;
			width: 100%;
			height: 100%;
		}

		body .building-item .content {
			padding: 15px 20px 18px;
		}

		body .building-item h3 {
			margin-top: 0;
			margin-bottom: 5px;
		}

		.building-item .name {
			font-size: 16px;
			font-weight: 600;
			line-height: 19px;
			color: #272b48;
		}

		body .building-item .name {
			-webkit-transition: color .3s ease-in-out;
			-o-transition: color .3s ease-in-out;
			transition: color .3s ease-in-out;
		}

		.building-item .vitri {
			display: block;
			height: 36px;
			margin-bottom: 10px;
			color: rgba(39, 43, 72, .5);
		}

		.building-item .meta {
			display: flex;
			align-items: center;
		}

		.building-item .meta .price {
			width: 100%;
		}

		body .building-item .meta .price {
			font-weight: 600;
		}

		.btn-care {
			display: inline-flex;
			justify-content: center;
			align-items: center;
			align-content: center;
			cursor: pointer;
			color: rgba(33, 43, 54, .7);
			border: none;
			font-size: 10px;
			padding: 5px 18px;
			line-height: 12px;
			text-align: center;
			white-space: nowrap;
			-webkit-border-radius: 12.5px;
			-moz-border-radius: 12.5px;
			-ms-border-radius: 12.5px;
			-o-border-radius: 12.5px;
			border-radius: 12.5px;
			background-color: #f4f6f8;
			-webkit-transition: .3s ease-in-out 0s;
			-o-transition: .3s ease-in-out 0s;
			transition: .3s ease-in-out 0s;
		}

		.btn-care:hover,
		.btn-care.active {
			color: #00a1b2;
			background-color: rgba(230, 42, 106, .05);
			-webkit-box-shadow: 0 1px 0 0 rgba(22, 29, 37, .05);
			box-shadow: 0 1px 0 0 rgba(22, 29, 37, .05);
		}

		.btn-care span {
			position: relative;
		}

		.btn-care i {
			margin-right: 5px;
			-webkit-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
		}

		.btn-care span .fa-thumbs-o-up {
			opacity: 1;
			visibility: visible;
		}

		.btn-care span .fa-thumbs-up {
			position: absolute;
			left: 0;
			top: 0;
			opacity: 0;
			visibility: hidden;
		}

		.btn-care:hover span .fa-thumbs-o-up,
		.btn-care.active span .fa-thumbs-o-up {
			opacity: 0;
			visibility: hidden;
		}

		.btn-care:hover span .fa-thumbs-up,
		.btn-care.active span .fa-thumbs-up {
			opacity: 1;
			visibility: visible;
		}

		.product-category.col.product {
			display: none;
		}

		.display_type_none .term-description {
			padding: 40px;
			background-color: #fff;
			border: 1px solid #dee0e3;
			position: relative;
			margin-top: 30px;
		}

		.display_type_none .term-description:before {
			position: absolute;
			top: -30px;
			left: 0;
			width: 100%;
			content: "";
			border-top: 1px solid #dee0e3;
		}

		.product-main #product-sidebar .widget_product_search {
			display: none;
		}

		.searchtrongoi .widget_product_categories {
			padding: 0;
		}

		.searchtrongoi .widget_product_categories .is-divider {
			display: none;
		}

		.searchtrongoi .widget_product_categories .widget-title {
			position: absolute;
			top: 0;
			left: 30px;
			background: #fff;
			padding: 0 10px;
			font-size: 10px;
			color: #aaa;
			line-height: 1.5em;
			transform: translateY(-50%);
			z-index: 1;
			text-transform: inherit;
			font-weight: normal;
		}

		.searchtrongoi .widget_product_categories .select2 .select2-selection {
			border: 1px solid #c4cdd5;
			border-radius: 2px;
			background-color: #fff;
			padding: 14px 16px 12px;
			color: #637381;
			line-height: 20px;
			height: 46px;
			margin: 0;
			width: 100%;
			-webkit-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
			box-shadow: none;
		}

		.searchtrongoi .widget_product_categories .select2 .select2-selection .select2-selection__rendered {
			line-height: normal;
		}

		.searchtrongoi .btn-phone {
			width: 100%;
		}

		.searchtrongoi h1 {
			font-size: 36px;
			line-height: 1.3;
			font-weight: 700;
			margin-bottom: 20px;
			margin-top: 0;
		}

		.contact .csncngbg {
			position: relative;
			top: auto !important;
			height: auto !important;
			opacity: 1;
			visibility: visible;
			background: transparent;
		}

		.contact .csncngbg .background_close_csncngbg,
		.contact .csncngbg .close_csncngbg {
			display: none;
		}

		#masthead .btn-list-care {
			display: flex;
			color: #535353;
			font-family: "SF Pro Text", sans-serif;
			font-size: 12px;
			font-weight: 500;
			line-height: 16px;
			padding: 27px 0;
			cursor: pointer;
		}

		#masthead .btn-list-care .icon-care {
			height: 16px;
			width: 16px;
			display: flex;
			justify-content: center;
			align-items: center;
			align-content: center;
			overflow: hidden;
			-webkit-border-radius: 50%;
			-moz-border-radius: 50%;
			-ms-border-radius: 50%;
			-o-border-radius: 50%;
			border-radius: 50%;
			position: relative;
			margin-right: 4px;
		}

		#masthead .btn-list-care .icon-care:before {
			content: "";
			position: absolute;
			left: 0;
			top: 0;
			right: 0;
			bottom: 0;
			opacity: .1;
			background-color: #00a1b2;
			box-shadow: 0 1px 0 0 rgba(22, 29, 37, .05);
		}

		#masthead .btn-list-care .icon-care:after {
			content: "";
			height: 6px;
			width: 6px;
			-webkit-border-radius: 50%;
			-moz-border-radius: 50%;
			-ms-border-radius: 50%;
			-o-border-radius: 50%;
			border-radius: 50%;
			background-color: #00a1b2;
			box-shadow: 0 1px 0 0 rgba(22, 29, 37, .05);
			display: inline-block;
		}

		#masthead .btn-list-care .icon-mobile-care {
			display: none;
			font-size: 22px;
			position: relative;
		}

		#masthead .btn-list-care .icon-mobile-care .count-care {
			position: absolute;
			font-size: 10px;
			width: 14px;
			height: 14px;
			background: #00a1b2;
			color: #fff;
			display: inline-flex;
			justify-content: center;
			align-items: center;
			border-radius: 50%;
			right: 0;
			top: 0;
			margin-right: -5px;
			margin-top: -5px;
		}

		.care-container .care-info {
			position: absolute;
			top: 100%;
			right: 0;
			width: 280px;
			border-radius: 3px;
			background-color: #fff;
			padding: 16px;
			box-shadow: 0 0 0 1px rgba(6, 44, 82, .1), 0 1px 3px 0 rgba(64, 66, 69, .12), 0 2px 16px 0 rgba(33, 43, 54, .08);
			-webkit-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
			margin-top: 10px;
			opacity: 0;
			visibility: hidden;
		}

		.care-container .care-info.empty {
			width: 500px;
			padding: 24px 32px;
		}

		.care-container:hover .care-info,
		.care-container:focus .care-info,
		.care-container:active .care-info,
		.care-container.active .care-info {
			margin-top: 0;
			opacity: 1;
			visibility: visible;
		}

		.care-container .care-info .care-empty {
			color: #212b36;
			font-size: 18px;
			font-weight: 600;
			line-height: 28px;
			display: none;
			margin: 0;
		}

		.care-container .care-info.empty .care-empty {
			display: inline-block;
		}

		.care-container .care-info .care-note {
			color: #637381;
			font-size: 14px;
			line-height: 20px;
			display: inline-block;
			margin: 0 0 16px;
		}

		.care-container .care-info.empty .care-note,
		.care-container .care-info.empty .care-page-link {
			display: none;
		}

		.care-container .care-info .care-page-link {
			color: #fff;
			font-size: 14px;
			font-weight: 500;
			line-height: 20px;
			border: 1px solid rgba(0, 0, 0, .1);
			border-radius: 2px;
			padding: 7px 16px 6px;
			display: inline-block;
			background: linear-gradient(45deg, #11a48d 0%, #156eb7 100%);
			box-shadow: inset 0 1px 0 1px rgba(255, 255, 255, .06), 0 1px 0 0 rgba(22, 29, 37, .1);
		}

		.care-container .care-info.empty .care-note,
		.care-container .care-info.empty .care-page-link {
			display: none;
		}

		.widget_price_filter .ui-slider .ui-slider-handle,
		.widget_price_filter .ui-slider .ui-slider-range {
			background: #00a1b2;
		}

		.row_5 .col.large-3 {
			max-width: 20%;
			-ms-flex-preferred-size: 20%;
			flex-basis: 20%;
		}

		@media (min-width: 768px) {
			.process .box .box-text {
				padding-bottom: 0;
			}
		}

		@media (max-width: 767px) {
			.banner h1 {
				font-size: 21px;
				line-height: 33px;
			}

			.quy_trinh .accordion-item {
				margin-left: 34px;
				padding: 20px;
			}

			.quy_trinh .accordion-item:before {
				left: -34px;
				width: 24px;
				height: 24px;
			}

			.quy_trinh .accordion-item:after {
				left: -22px !important;
			}

			.feedback .slider .row .col {
				max-width: 100%;
				-ms-flex-preferred-size: 100%;
				flex-basis: 100%;
			}

			.feedback .slider .row .col .col-inner {
				padding: 15px 15px 0
			}

			#post-list>article .entry-header {
				width: 100%;
			}

			#post-list>article .entry-header-text {
				width: 100%;
			}

			.blog-single article {
				padding: 15px;
			}

			.blog-single .entry-header-text h1 {
				margin-top: 0;
			}

			.product-info .tab-item .tab-content>ul {
				width: 100%;
				display: block;
				float: none;
			}

			.kinh_nghiem .tabbed-content ul.nav-tabs {
				flex-wrap: wrap;
				border: 0;
			}

			.kinh_nghiem .tab-panels {
				padding: 30px 0 0;
			}

			.kinh_nghiem .tab-panels .panel.active {
				padding: 15px;
				max-width: 100%;
			}

			.kinh_nghiem .tabbed-content ul.nav-tabs>li {
				margin: 0;
				width: 100%;
				flex: auto;
				position: relative;
				border-bottom: 2px solid #dee0e3;
			}

			.kinh_nghiem .tabbed-content ul.nav-tabs>li>a {
				padding: 15px 0 10px;
			}

			.kinh_nghiem .tabbed-content ul.nav-tabs>li>a:after {
				content: "";
				position: absolute;
				left: 0;
				bottom: -2px;
				right: 0;
				border-bottom: 2px solid #00a1b2;
				-webkit-transition: all .3s ease-in-out;
				-o-transition: all .3s ease-in-out;
				transition: all .3s ease-in-out;
				opacity: 0;
				visibility: hidden;
			}

			.kinh_nghiem .tabbed-content ul.nav-tabs>li.active>a {
				border-bottom: none;
			}

			.kinh_nghiem .tabbed-content ul.nav-tabs>li.active>a:after {
				opacity: 1;
				visibility: visible;
			}

			body.admin-bar .csncngbg {
				top: 70px;
				height: calc(100% - 70px);
			}

			.csncngbg .body_csncngbg {
				margin: 30px 15px;
			}

			.csncngbg .body_csncngbg .body_content_csncngbg>.row,
			.csncngbg .header_csncngbg h4,
			.csncngbg .footer_csncngbg {
				padding: 15px;
			}

			.category-page-row .col_kqtim .products>.col {
				max-width: 50%;
				-ms-flex-preferred-size: 50%;
				flex-basis: 50%;
			}

			.display_type_none .term-description {
				padding: 15px;
			}

			.form-search {
				padding: 15px 0;
			}

			.form-search .search-field {
				padding-bottom: 0;
				padding-left: 15px;
				padding-right: 15px;
			}

			.list-filter .btn-filter {
				margin: 0 8px 8px 0;
			}

			.display_type_both .term-description>p:first-child {
				padding-top: 56%;
			}

			.display_type_both .term-description>h1 {
				font-size: 22px;
				line-height: 28px;
			}

			.quan-gia-page .form-search .search-field {
				width: 100%;
			}

			.quan-gia-page .form-search .search-field:nth-of-type(2n+2):before {
				content: none;
			}

			.quan-gia-page .form-search .search-field+.search-field {
				padding: 15px;
			}

			.form-search.search-duong .duong-item {
				width: 100%;
				border-bottom: 1px solid #dee0e3;
			}

			.form-search.search-duong .line-item {
				border: 0;
			}

			.form-search.search-duong {
				padding: 15px;
			}

			.col_image_large>.row>.large-2,
			.col_image_large>.row>.large-10 {
				max-width: 100%;
				-ms-flex-preferred-size: 100%;
				flex-basis: 100%;
			}

			.product-main #product-sidebar {
				display: block !important;
			}

			.product-footer .product-section .entry-content {
				padding: 15px;
			}

			.header-main li.html.custom {
				display: block;
			}

			#masthead .btn-list-care .text-care,
			#masthead .btn-list-care .icon-care {
				display: none;
			}

			#masthead .btn-list-care .icon-mobile-care {
				display: block;
			}

			.category-page-row .col_kqtim .products>.col {
				max-width: 100%;
				-ms-flex-preferred-size: 100%;
				flex-basis: 100%;
			}

			.care-container .care-info,
			.care-container .care-info.empty {
				width: 100vw;
				right: -50px;
				top: 70px;
			}

			.slider-wrapper .flickity-prev-next-button {
				display: block;
			}

			.flickity-prev-next-button.previous {
				left: -15px;
			}

			.flickity-prev-next-button.next {
				right: -15px;
			}

			.row_5 {
				justify-content: center;
			}

			.row_5 .col.large-3 {
				max-width: 33.33%;
				-ms-flex-preferred-size: 33.33%;
				flex-basis: 33.33%;
			}
		}
	</style>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"
		integrity="sha512-aUhL2xOCrpLEuGD5f6tgHbLYEXRpYZ8G5yD+WlFrXrPy2IrWBlu6bih5C9H6qGsgqnU6mgx6KtU8TreHpASprw=="
		crossorigin="anonymous"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			//$('.absolute-footer .copyright-footer').html('<div><a href="https://omnis.vn/" target="_blank">Thiết kế web</a> bởi: <a href="https://omnis.vn/" target="_blank">Omnis.vn</a></div>');
			$('.product-footer .product-section #reviews').closest('.product-section').addClass('hidden');
			$('.product-footer .product-section .shop_attributes').closest('.product-section').addClass('hidden');
			$('.product-footer .product-section').find('h5.mt').each(function (index, el) {
				if ($(this).html() == 'Mô tả') {
					$(this).html('Thông tin chi tiết');
				}
			});

			$('#product-sidebar .thongtinsp').prepend('<h1>' + $('.product-info .product-title').html() + '</div>');

			$('.btn-trang').click(function (event) {
				var form = $(this).next().find('form');

				if (form.attr('method') == 'post') {
					$('html').addClass('csncngbg_openq');
					form.find('.csncngbg').addClass('openq');
					form.closest('.section').addClass('section_zindex');
					form.closest('.section').addClass('section_zindex');
				}
			});

			$('.background_close_csncngbg').click(function (event) {
				$(this).closest('.csncngbg').removeClass('openq');
				$('html').removeClass('csncngbg_openq');
				$(this).closest('.wpcf7-form').closest('.section').removeClass('section_zindex');
			});
			$('.close_csncngbg').click(function (event) {
				$(this).closest('.csncngbg').removeClass('openq');
				$('html').removeClass('csncngbg_openq');
				$(this).closest('.wpcf7-form').closest('.section').removeClass('section_zindex');
			});

			var list = new cookieList("btn_care");
			list.remove('undefined');
			list.remove('null');
			capNhatCare(list);
			$('.care-container .care-info .care-page-link').attr('href', '<?php echo get_site_url(); ?>/quan-tam');

			$('.js-btn-care').click(function (event) {
				var product_id = $(this).attr('data-id');
				var str_list = list.items();
				if (str_list.indexOf(product_id) != -1) {
					list.remove(product_id);
					// alert(list.items());
					$(this).removeClass('active');
					$(this).html('<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Quan tâm');
				} else {
					list.add(product_id);
					// alert(list.items());
					$(this).addClass('active');
					$(this).html('<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Đã quan tâm');
				}
				capNhatCare(list);
			});
		});

		function capNhatCare(list) {
			var count_care = 0;
			var str_list = '';
			//alert(list.items());
			if (list.items().toString()) {
				str_list = list.items().toString().split(',');
			}
			jQuery.each(str_list, function (index, value) {
				//alert(index + ': ' + value);
				count_care++;
				jQuery('body').find('.js-btn-care').each(function (index, el) {
					var product_id = jQuery(this).attr('data-id');
					if (product_id == value) {
						jQuery(this).addClass('active');
						jQuery(this).html('<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Đã quan tâm');
					}
				});
			});

			jQuery('#masthead .care-container .count-care').html(count_care);
			if (count_care > 0) {
				jQuery('#masthead .care-container .care-info').removeClass('empty');
			} else {
				jQuery('#masthead .care-container .care-info').addClass('empty');
			}
		}

		//This is not production quality, its just demo code.
		var cookieList = function (cookieName) {
			//When the cookie is saved the items will be a comma seperated string
			//So we will split the cookie by comma to get the original array
			var cookie = jQuery.cookie(cookieName);
			//Load the items or a new array if null.
			var items = cookie ? cookie.split(/,/) : new Array();

			//Return a object that we can use to access the array.
			//while hiding direct access to the declared items array
			//this is called closures see http://www.jibbering.com/faq/faq_notes/closures.html
			return {
				"add": function (val) {
					//Add to the items.
					items.push(val);
					//Save the items to a cookie.
					//EDIT: Modified from linked answer by Nick see 
					//      http://stackoverflow.com/questions/3387251/how-to-store-array-in-jquery-cookie
					jQuery.cookie(cookieName, items.join(','), { path: '/' });
				},
				"remove": function (val) {
					//EDIT: Thx to Assef and luke for remove.
					indx = items.indexOf(val);
					if (indx != -1) items.splice(indx, 1);
					jQuery.cookie(cookieName, items.join(','), { path: '/' });
				},
				"clear": function () {
					items = null;
					//clear the cookie.
					jQuery.cookie(cookieName, null, { path: '/' });
				},
				"items": function () {
					//Get all the items.
					return items;
				}
			}
		}

		function setCookie(cname, cvalue, extimes) {
			var d = new Date();
			d.setTime(d.getTime() + (extimes));
			var expires = "expires=" + d.toUTCString();
			document.cookie = cname + "=" + cvalue + "; " + expires;
		}

		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') c = c.substring(1);
				if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
			}
			return "";
		}

		function empty(e) {
			switch (e) {
				case "":
					return true;
				case null:
					return true;
				case false:
					return true;
				case typeof this == "undefined":
					return true;
				default: return false;
			}
		}
	</script>
</head>

<body <?php body_class(); ?>>

	<?php do_action( 'flatsome_after_body_open' ); ?>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'flatsome' ); ?></a>

	<div id="wrapper">

		<?php do_action( 'flatsome_before_header' ); ?>

		<header id="header" class="header <?php flatsome_header_classes(); ?>">
			<div class="header-wrapper">
				<?php get_template_part( 'template-parts/header/header', 'wrapper' ); ?>
			</div>
		</header>

		<?php do_action( 'flatsome_after_header' ); ?>

		<main id="main" class="<?php flatsome_main_classes(); ?>">