<?php
get_header();

global $buildingController;
if ($buildingController && method_exists($buildingController, 'render_current')) {
    echo $buildingController->render_current();
}

get_footer();
