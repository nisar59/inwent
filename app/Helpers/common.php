<?php


function FileUpload($file, $path)
{
	if($file!=null) {        
        //get filename with extension
        $filenamewithextension = $file->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $file->getClientOriginalExtension();
 
        //filename to store
        $filenametostore =$path.'/'.$filename.'_'.uniqid().'.'.$extension;
 
        //Upload File to external server
        if(Storage::disk('ftp')->put($filenametostore, fopen($file, 'r+'))){
            return Storage::disk('ftp')->url($filenametostore);
        }

    }
}

function StorageUrl()
{
    $storage_config=(object) Storage::disk('ftp')->getConfig();
    
    return $storage_config->ftp_url;
}

function FileExists($filename)
{
    return Storage::disk('ftp')->exists($filename);
}

function StorageFile($filename)
{
   if(FileExists($filename)){
    return StorageUrl().$filename;
   }else{
    return StorageUrl().'default/no-image.png';
   }
}
