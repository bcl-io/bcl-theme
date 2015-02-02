<?php

// show contact page, etc

// exclude those pages
$pageAZ = get_page_by_title('a-z');
$pageFront = get_page_by_title('all');

$args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'exclude' => array($pageAZ->ID, $pageFront->ID)		// exclude a-z from being shown
);

$pages = get_pages($args);

foreach ($pages as $page) {
	echo '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . "</a><br />\n";
}

?>