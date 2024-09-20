<?php

namespace FroalaEditor;

use FroalaEditor\Utils\DiskManagement;

class Video {
  public static $defaultUploadOptions = array(
    'fieldname' => 'file',
    'validation' => array(
      'allowedExts' => array('mp4', 'webm', 'ogg'),
      'allowedMimeTypes' => array('video/mp4','video/webm', 'video/ogg')
    ),
    'resize' => NULL
  );

  /**
  * Video upload to disk.
  *
  * @param fileRoute string
  * @param options [optional]
  *   (
  *     fieldname => string
  *     validation => array OR function
  *   )
  * @return {link: 'linkPath'} or error string
  */
  public static function upload($fileRoute, $options = NULL) {
    if (is_null($options)) {
      $options = Video::$defaultUploadOptions;
    } else {
      $options = array_merge(Video::$defaultUploadOptions, $options);
    }
    return DiskManagement::upload($fileRoute, $options);
  }

  /**
  * Delete file from disk.
  *
  * @param src string
  * @return boolean
  */
  public static function delete($src) {

    return DiskManagement::delete($src);
  }
}

class_alias('FroalaEditor\Video', 'FroalaEditor_Video');
?>