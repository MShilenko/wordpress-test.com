<?php
/*
 * Plugin Name: SEORewrite
 * Description: MU-плаги созданный чтобы не захламлять functions.php и не потерять правки при возможном обновлении темы и т.п.
 */

/*
 * Добавление произвольной строки в секцию <head>
 */
function seoHeadAdjustments() {
	//echo '<meta name="yandex-verification" content="8c67752b3ca8f9ca" />';
}
add_action ( 'wp_head', 'seoHeadAdjustments' );

/*
 * Сквозные редиректы
 */
function seo301() {
  $aR301SkipCheck = [
    '/produkciya/'=>'/',
  ];
    if (isset($aR301SkipCheck[$_SERVER['REQUEST_URI']])) {
      if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST')) {
        wp_redirect( $aR301SkipCheck[$_SERVER['REQUEST_URI']], 301 );
        exit;
      }
    }
}
add_action( 'init', 'seo301' );
