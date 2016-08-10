<?php

function nda_pre_upload($file){
    add_filter('upload_dir', 'nda_custom_upload_dir');
    return $file;
}

function nda_post_upload($fileinfo){
    remove_filter('upload_dir', 'nda_custom_upload_dir');
    return $fileinfo;
}

function nda_custom_upload_dir($path){
    $extension = substr(strrchr($_POST['name'],'.'),1);
    if(!empty($path['error']) ||  $extension != 'pdf') { return $path; } //error or other filetype; do nothing.
    $customdir = '/certificates';
    $path['path']    = str_replace($path['subdir'], '', $path['path']); //remove default subdir (year/month)
    $path['url']     = str_replace($path['subdir'], '', $path['url']);
    $path['subdir']  = $customdir;
    $path['path']   .= $customdir;
    $path['url']    .= $customdir;
    return $path;
}
