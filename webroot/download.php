<?php

/*  This file is part of phpSANE.

    phpSANE is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    phpSANE is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with phpSANE.  If not, see <https://www.gnu.org/licenses/>.
    
  */
    
  include("incl/functions.php");
  include("incl/config.php");
  
  if($do_file_download) {
    //create zip file
    $selected_file_paths = array();
    foreach($_REQUEST['selected_files'] as $selected_file) {
      $selected_file_path = $save_dir . basename($selected_file);
      if(is_readable($selected_file_path)) {
        array_push($selected_file_paths, $selected_file_path);
      }
    }
    $zipfile_path =  $temp_dir . 'scanned_' . time() . '.zip';
    if(sizeof($selected_file_paths) > 0) {
      create_zip($selected_file_paths, $zipfile_path);
      if(is_readable($zipfile_path)) {
        //output path to created file
        echo $zipfile_path;
      }
    }
  }
  
  
  /* creates a compressed zip file */
  function create_zip($files = array(),$destination = '') {
    //if the zip file already exists, return false
    if(file_exists($destination)) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    if(is_array($files)) {
      //cycle through each file
      foreach($files as $file) {
        //make sure the file exists
        if(file_exists($file)) {
          $valid_files[] = $file;
        }
      }
    }
    //if we have good files...
    if(count($valid_files)) {
      // temporarily bump up maximum execution time for Raspberry Pi
      $zip_timeout = ini_get('max_execution_time');
      ini_set('max_execution_time', 600);
      //create the archive
      $zip = new ZipArchive();
      if($zip->open($destination, ZipArchive::CREATE) !== true) {
        return false;
      }

      //add the files
      foreach($valid_files as $file) {
        $zip->addFile($file, basename($file));
      }
      
      //close the zip
      $zip->close();
      
      ini_set('max_execution_time', $zip_timeout);
      
      //check to make sure the file exists
      return file_exists($destination);
    }
    else
    {
      return false;
    }
  }
?>
