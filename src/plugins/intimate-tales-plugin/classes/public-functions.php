<?php

use IntimateTales\Plugin;

function intimate_tales() {
	return Plugin::instance();
}

function view($slug, $args = []) {
	intimate_tales()->templates->view($slug, $args);
}
