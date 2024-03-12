<?php
/**
 * Image Model 
 */

 class Image{

    /**
     * Crop images
     *
     * @param string $src_img_path
     * @param string $dest_img_path
     * @param integer $max_size
     * 
     */
    private function crop_image($src_img_path, $dest_img_path, $max_size = 600 ){
        if (file_exists($src_img_path)) {
            $ext = strtolower(pathinfo($src_img_path, PATHINFO_EXTENSION ));
            if ($ext == 'png') {
                $src_img = imagecreatefrompng($src_img_path);
            }else{
                $src_img = imagecreatefromjpeg($src_img_path);
            }

            if ($src_img) {
                $img_width  = imagesx($src_img);
                $img_height = imagesy($src_img);

                if ($img_width > $img_height ) {
                    $extra_space = $img_width - $img_height;
                    $srcX = $extra_space / 2;
                    $srcY = 0;

                    $srcW = $img_height;
                    $srcH = $img_height;
                }else{
                    $extra_space = $img_height - $img_width;
                    $srcY = $extra_space / 2;
                    $srcX = 0;

                    $srcW = $img_width;
                    $srcH = $img_width;
                }

                $dest_img = imagecreatetruecolor($max_size, $max_size );
                imagecopyresampled($dest_img, $src_img, 0, 0, $srcX, $srcY, $max_size, $max_size, $srcW, $srcH );

                // Saving every image as jpeg
                imagejpeg($dest_img ,$dest_img_path);

            }
        }
    }


    /**
     * profile image resize and show
     *
     * @param string $img_path
     * @return string
     */
    public function profile_image($img_path){
        $crop_size = 600;
        $ext = strtolower(pathinfo($img_path, PATHINFO_EXTENSION ));

        $thumb = str_replace( '.' .$ext, '_thumb.' . $ext , $img_path );

        if (!file_exists( $thumb )) {
            $this->crop_image($img_path , $thumb, $crop_size );
        }

        return $thumb;

    }
 }