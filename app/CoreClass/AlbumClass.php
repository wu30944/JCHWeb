<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/6
 * Time: 下午6:40
 */
namespace App\CoreClass;
use Storage;
use Imagecow\Image;
use Response;
use StdClass;
use URL;
use Validator;

use App\Repositories\AlbumDRepository;

class AlbumClass {

    private $Files;
    private $AlbumPath;
    private $AlbumName;
    private $FullAlbumPath;
    private $EntityStoragePath;
    private $VirtualStoragePath;


    public function __construct($strImage=null,$strAlbumName=null){
        $this->EntityStoragePath=$this->getEntitiyStoragePath();
    }

    public function getEntitiyStoragePath(){
        return Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
    }

    public function CreateAlbum($strAlbumName=null){


        if($strAlbumName==null)
        {
            Storage::makeDirectory($this->VirtualStoragePath);
            Storage::makeDirectory($this->VirtualStoragePath.'/thumb');
        }else{
            Storage::makeDirectory('public/'.config('app.album').'/'.$strAlbumName);
            Storage::makeDirectory('public/'.config('app.album').'/'.$strAlbumName.'/thumb');
        }

    }

    public function UploadAlbum($strAlbumId){


        foreach ($this->Files as $file) {
            //\Debugbar::info($path);
            $ImageName = $file->getClientOriginalName();
            //$uploadFlag = $file->move($path,$ImageName);
            /*
             * 2017/12/22   使用Laravel內建儲存檔案的方法
             *              此處會將檔案存到指定路徑下(storage下)，
             *              第一個參數是完整資料夾
             *              第二個參數是圖片檔案
             * */
            $uploadFlag=Storage::put(
                $this->VirtualStoragePath.'/'.$ImageName,
                file_get_contents($file->getRealPath())
            );


            \Debugbar::info(storage_path());
            \Debugbar::info(Storage::url($this->VirtualStoragePath));
            \Debugbar::info(URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName)));
            \Debugbar::info(Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix());
            \Debugbar::info(URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName)));
            \Debugbar::info(URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName)));

            //\Debugbar::info($file->getRealPath());
            if($uploadFlag){
                //Using Imagick:
                $Image = Image::fromFile($this->EntityStoragePath.$this->FullAlbumPath.'/'.$ImageName);
                $Image->resize('8%', '8%');
                $Image->save($this->EntityStoragePath.$this->FullAlbumPath.'/thumb/'.$ImageName);
                $info = new StdClass;
                $info->name = $ImageName;
                $info->id = $ImageName;
                $info->size = 1024;
                $info->type = 'png';
                $info->VirtualPath = $this->VirtualStoragePath.'/'.$ImageName;
                $info->url = URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName));
                $info->thumbnailUrl = URL::to(Storage::url($this->FullAlbumPath.'/thumb/'.$ImageName));
                $info->deleteUrl = URL::to(Storage::url($this->FullAlbumPath.'/'.$ImageName));
                $info->delete_method = 'GET';
                $info->error = null;
                $data[] = $info;
                AlbumDRepository::Save($strAlbumId,$data);
            }
            else {

            }
        }
        return $data;
    }

    public function DeleteAlbum(){

        Storage::deleteDirectory($this->VirtualStoragePath);

    }

    public function DeleteAlbumImage($DeleteFiles){
        Storage::delete($DeleteFiles);
    }

    public function UpdateAlbum(){

    }

    public function SetAlbumName($strAlbumName){
        $this->AlbumName=$strAlbumName;
        $this->FullAlbumPath = config('app.album').'/'.$strAlbumName;
        $this->VirtualStoragePath = 'public/'.$this->FullAlbumPath;
    }

    public function SetAlbumPath($strAlbumPath){
        $this->AlbumPath=$strAlbumPath;
    }

    public function SetFiles($strFiles){

        if($strFiles->hasFile('fileupload')){
            $rules = array('fileupload'  => 'image');
            $data = array('image' => $strFiles->file('fileupload'));
            // Validation
            $validation = Validator::make($data, $rules);
//            \Debugbar::info($strFiles);
            if ($validation->fails())
            {
                \Debugbar::info('433');
                throw new Exception($validation->messages()->all()); // 丟出一個測試用的例外
            }

            \Debugbar::info($strFiles->file('fileupload'));
            $this->Files=$strFiles->file('fileupload');

        }

    }

    public function GetAlbumPath(){
        return $this->FullAlbumPath;
    }

    public function GetAlbumContent($strImages){
        if($images = $strImages){
            $OriginImage = array();
            $Count=0;
            foreach($images as $image){
                $OriginImage[$Count]['name'] = $image->name;
                $OriginImage[$Count]['id'] = $image->id;
                $OriginImage[$Count]['url'] = $image->photo_path;
                $OriginImage[$Count]['delete_url'] = URL::to(Storage::url($this->FullAlbumPath.'/'.$image->name));
                $OriginImage[$Count]['url_thumb'] = URL::to(Storage::url($this->FullAlbumPath.'/thumb/'.$image->name));
                $OriginImage[$Count]['delete_method'] = 'GET';
                $Count++;
            }
            return $OriginImage;
        }

    }


}