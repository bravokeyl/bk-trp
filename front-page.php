<?php

add_action('genesis_before_content','trp_before_content');
function trp_before_content() {
  echo '<div class="bk-home-top">';
  genesis_widget_area( 'home-left', array(
		'before' => '<div id="home-left" class="home-left"><div class="wrap">',
		'after'  => '</div></div>',
	) );
  genesis_widget_area( 'home-right', array(
		'before' => '<div id="home-right" class="home-right"><div class="wrap">',
		'after'  => '</div></div>',
	) );
  echo '</div>';
}

genesis();
