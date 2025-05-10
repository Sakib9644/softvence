<?php

use Illuminate\Support\Facades\File;


if (!function_exists('upload_image')) {
    function upload_image($request, $user) {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if (!empty($fileds) && File::exists(public_path($user))) {
                File::delete(public_path($user));
            }
    
            $folderName = (new $user)->getTable();
            $thumbnail = $request->file('image');
            $thumbnailName = $request->name . '_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('/uploads/' . $folderName . '/'), $thumbnailName);
    
            return '/uploads/' . $folderName . '/' . $thumbnailName;
        }
    }
}
