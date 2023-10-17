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
        $filenametostore =$path.'/'.$filename.'_'.uniqid().'_'.now()->timestamp.'.'.$extension;

        $filenametostore=str_replace(' ', '-', $filenametostore);
 
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
    if($filename==null OR $filename==""){
        return StorageUrl().'default/no-image.png';
    }
   else if(FileExists($filename)){
        return StorageUrl().$filename;
   }else{
        return StorageUrl().'default/no-image.png';
   }
}


function MoveStorageFiles($old, $new)
{
   if(Storage::disk('ftp')->move($old, $new)){
      return Storage::disk('ftp')->url($new);
   }else{
      return Storage::disk('ftp')->url($old);
   }

}


function DeleteStorageFiles($files)
{
   Storage::disk('ftp')->delete($files);
}


function DeleteStorageDirectory($dir)
{
    Storage::disk('ftp')->deleteDirectory($dir);
}