<?php

/**
 * Image Uploader
 *
 * Original author: Arthur Gareginyan https://mycyberuniverse.com/integration-wordpress-media-uploader-plugin-options-page.html
 * Modified by Andy Warren 07/18/17
 */
function arthur_image_uploader($optionName) {

    // Set variables
    $options = get_option($optionName);
    $default_image = 'https://www.placehold.it/115x115';

    if (!empty($options)) {
        $image_attributes = wp_get_attachment_image_src($options, 'full');
        $src = $image_attributes[0];
        $value = $options;
    } else {
        $src = $default_image;
        $value = '';
    }

    // Print HTML field
    echo '
        <div class="upload" style="max-width:400px;">
            <img data-src="' . $default_image . '" src="' . $src . '" style="max-width:100%; height:auto;"/>
            <div>
                <input type="hidden" name="' . $optionName . '" id="' . $optionName . '" value="' . $value . '" />
                <button type="submit" class="upload_image_button button" title="Upload Image">' . __('Upload', 'igsosd') . '</button>
                <button type="submit" class="remove_image_button button" title="Remove Image">&times;</button>
            </div>
        </div>
    ';
}
 ?>
