<?php

  // Add filter for changing upload dir for .pdf

function nda_pre_upload($file){
    add_filter('upload_dir', 'nda_custom_upload_dir');
    return $file;
}

  // Remove filter for changing upload dir for .pdf

function nda_post_upload($fileinfo){
    remove_filter('upload_dir', 'nda_custom_upload_dir');
    return $fileinfo;
}

  // Custom filter to change upload dir

function nda_custom_upload_dir($path){
    $extension = substr(strrchr($_POST['name'],'.'),1);
    if(!empty($path['error']) ||  $extension != 'pdf') { return $path; } //error or other filetype; do nothing.
    $customdir = '/certificates'; // custom dir
    $path['path']    = str_replace($path['subdir'], '', $path['path']); //remove default subdir (year/month)
    $path['url']     = str_replace($path['subdir'], '', $path['url']);
    $path['subdir']  = $customdir;
    $path['path']   .= $customdir;
    $path['url']    .= $customdir;
    return $path;
}
