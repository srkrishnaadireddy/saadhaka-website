<?php
/**
 * Template Name: Inner Light Home
 * Description: Full-page dark cosmic homepage (bypasses Astra header/footer).
 */

defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<style>
		html { scroll-behavior: smooth; }
		body.innerlight-page {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			color: #E0E6ED;
			font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			overflow-x: hidden;
			background: radial-gradient(circle at 50% 40%, #131c27 0%, #0b0f14 70%) #0b0f14 !important;
		}
		body.innerlight-page *,
		body.innerlight-page *::before,
		body.innerlight-page *::after { box-sizing: border-box; }

		body.innerlight-page .il-header {
			width: 100%;
			max-width: 1200px;
			margin: 0 auto;
			padding: 2.5rem 2rem;
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 1.5rem;
		}
		body.innerlight-page .il-logo {
			font-size: 2.2rem;
			font-weight: 300;
			letter-spacing: 4px;
			color: #ffffff;
			text-transform: uppercase;
			text-shadow: 0 0 20px rgba(255,255,255,0.1);
			text-decoration: none;
		}
		body.innerlight-page .il-nav ul {
			display: flex;
			list-style: none;
			gap: 2.5rem;
			margin: 0;
			padding: 0;
		}
		body.innerlight-page .il-nav ul li a {
			color: #94a3b8;
			text-decoration: none;
			text-transform: uppercase;
			font-size: 0.85rem;
			letter-spacing: 2px;
			transition: all 0.3s ease;
			position: relative;
			padding-bottom: 4px;
		}
		body.innerlight-page .il-nav ul li a:hover,
		body.innerlight-page .il-nav ul li a.active {
			color: #ffffff;
			text-shadow: 0 0 10px rgba(255,255,255,0.5);
		}
		body.innerlight-page .il-nav ul li a.active::after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 25%;
			width: 50%;
			height: 1px;
			background: rgba(255,255,255,0.6);
			box-shadow: 0 0 8px #fff;
		}

		body.innerlight-page .il-main {
			flex-grow: 1;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			padding: 2rem;
			text-align: center;
			max-width: 900px;
			margin: 0 auto;
			width: 100%;
		}
		body.innerlight-page .visualization-container {
			position: relative;
			width: 100%;
			max-width: 820px;
			display: flex;
			justify-content: center;
			align-items: center;
			margin-bottom: 1rem;
		}
		body.innerlight-page .meditation-img {
			width: 100%;
			height: auto;
			position: relative;
			z-index: 2;
			display: block;
			-webkit-mask-image: radial-gradient(ellipse 68% 75% at 50% 50%, #000 55%, transparent 96%);
			mask-image: radial-gradient(ellipse 68% 75% at 50% 50%, #000 55%, transparent 96%);
		}
		body.innerlight-page .aura-glow {
			position: absolute;
			width: 320px;
			height: 320px;
			background: radial-gradient(circle, rgba(226, 180, 103, 0.2) 0%, rgba(13, 148, 136, 0.05) 45%, rgba(0,0,0,0) 70%);
			border-radius: 50%;
			z-index: 1;
			pointer-events: none;
			animation: il-deep-breath 8s infinite ease-in-out;
		}
		body.innerlight-page .meditation-svg {
			width: 100%;
			height: 100%;
			position: relative;
			z-index: 2;
		}

		body.innerlight-page .il-main h1 {
			font-size: 2.8rem;
			font-weight: 400;
			letter-spacing: 5px;
			color: #ffffff;
			margin: 0 0 1.2rem;
			text-transform: uppercase;
			text-shadow: 0 2px 15px rgba(0,0,0,0.5);
			font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		}
		body.innerlight-page .il-main p {
			font-size: 1.05rem;
			color: #94a3b8;
			line-height: 1.8;
			max-width: 580px;
			margin: 0 0 3rem;
			font-weight: 300;
			letter-spacing: 0.5px;
		}
		body.innerlight-page .cta-btn {
			display: inline-block;
			background: transparent;
			color: #ffffff;
			border: 1px solid rgba(255, 255, 255, 0.4);
			padding: 1.1rem 3rem;
			font-size: 0.9rem;
			text-transform: uppercase;
			letter-spacing: 3px;
			border-radius: 30px;
			cursor: pointer;
			text-decoration: none;
			box-shadow: 0 0 15px rgba(226, 180, 103, 0.05);
			transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
			position: relative;
			overflow: hidden;
		}
		body.innerlight-page .cta-btn:hover {
			color: #ffffff;
			border-color: rgba(255, 255, 255, 0.9);
			box-shadow: 0 0 25px rgba(226, 180, 103, 0.25);
			transform: translateY(-2px);
			background: rgba(255, 255, 255, 0.03);
		}
		body.innerlight-page .cta-btn:active { transform: translateY(0); }

		body.innerlight-page .il-footer {
			padding: 2rem;
			text-align: center;
			font-size: 0.8rem;
			color: #475569;
			letter-spacing: 1px;
		}
		body.innerlight-page .il-footer a {
			color: #475569;
			text-decoration: none;
			margin: 0 0.5rem;
			transition: color 0.3s ease;
		}
		body.innerlight-page .il-footer a:hover { color: #94a3b8; }

		@keyframes il-deep-breath {
			0%, 100% { transform: scale(0.92); opacity: 0.6; }
			50% { transform: scale(1.08); opacity: 1; }
		}
		@media (max-width: 768px) {
			body.innerlight-page .il-header { padding: 1.5rem 1rem; }
			body.innerlight-page .il-nav ul { gap: 1.5rem; }
			body.innerlight-page .il-main h1 { font-size: 2rem; letter-spacing: 3px; }
			body.innerlight-page .il-main p { font-size: 0.95rem; }
			body.innerlight-page .visualization-container { height: 300px; }
		}
	</style>
</head>
<body <?php body_class( 'innerlight-page' ); ?>>

	<header class="il-header">
		<a class="il-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">Saadhaka</a>
		<nav class="il-nav">
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="active">Home</a></li>
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
				<li><a href="<?php echo esc_url( home_url( '/practices/' ) ); ?>">Practices</a></li>
				<li><a href="<?php echo esc_url( home_url( '/quotes/' ) ); ?>">Quotes</a></li>
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
			</ul>
		</nav>
	</header>

	<main class="il-main">
		<div class="visualization-container">
			<div class="aura-glow"></div>
			<img class="meditation-img" src="<?php echo esc_url( content_url( '/uploads/2026/07/Home_Page_Img01-scaled.png' ) ); ?>" alt="" fetchpriority="high" />
		</div>
		<h1>Find Your Calm.</h1>
		<p>A simple guide to mindfulness and cultivating inner peace through meditation. Explore pristine techniques to quiet the mind and connect with your inner radiance.</p>
		<a class="cta-btn" href="<?php echo esc_url( home_url( '/practices/' ) ); ?>">Start Meditating</a>
	</main>

	<footer class="il-footer">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Saadhaka. <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy</a> | <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms</a></p>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
