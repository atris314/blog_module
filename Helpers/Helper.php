<?php

if (!function_exists('file_upload')) {
    function file_upload($file_upload, $path_upload, $prefix_upload)
    {
        $array = array('gif', 'jpg', 'png', 'jpeg', 'pdf', 'mp4', 'webp','xlsx','ico','svg');
        $extension = $file_upload->getClientOriginalExtension();
        if (in_array(strtolower($extension), $array)) {
            $file = $file_upload;
            $originalName = $file_upload->getClientOriginalName();
            $destinationPath = $path_upload;
            $extension = $file->getClientOriginalExtension();
            $fileName = $prefix_upload . md5(time() . uniqid() . '-' . $originalName) . '.' . $extension;
            $file->move($destinationPath, $fileName);
            $exist_path = $destinationPath . "" . $fileName;


            return $exist_path;
        }
        return null;
    }
}



