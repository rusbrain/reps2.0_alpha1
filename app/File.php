<?php

namespace App;

use App\Traits\ModelRelations\FileRelation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class File extends Model
{
    use FileRelation;
    /**
     * Using table name
     *
     * @var string
     */
    protected $table='files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'link',
        'size',
        'type',
        'resource_type'
    ];

    /**
     * Storage new file
     *
     * @param UploadedFile $file
     * @param $dir_name
     * @param string $file_title
     * @param bool $file_name
     * @return mixed
     */
    public static function storeFile($file, $dir_name, $file_title = '', $flag= false, $charactor = false, $fileType = '')
    {
        $uploading_path = $dir_name.'/'.Carbon::now()->format('Y-m-d');

        // check chat smile or picture
        if ($charactor) {
            $ext =  (!$flag || $flag == 'picture')  ? pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) : 'gif';
            $original_name = Carbon::now()->timestamp. '.' .$ext;

            if ($flag && $charactor) {
                $original_name = str_replace(":","",$charactor) . '.' . $ext;
                $uploading_path = $dir_name;
            }
        } else {
            $original_name = Carbon::now()->timestamp. '_' . $file->getClientOriginalName();
        }

        $path = str_replace('public', '/storage',  $file->storeAs('public/' . $uploading_path, $original_name));

        if($flag == 'smile') {
            $img = Image::make(public_path($path))->resize(16, 16, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($path));
        }

        if($flag == 'picture') {
            list($width, $height) = getimagesize(public_path($path));
            if ($width > 200 || $height > 200) {
                $img = Image::make(public_path($path))->resize(200, 200, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($path));
            }
        }

        $file_boj = File::create([
            'user_id' => Auth::id(),
            'title' => $file_title,
            'link' => $path,
            'size' => $file->getSize(),
            'type' => $file->getMimeType(),
            'resource_type' => $fileType
        ]);

        return $file_boj;
    }

    public function getSizeFormatted()
    {
        return round($this->size / 1000, 1);
    }

    public function getFileName()
    {
        $linkParts = explode('/', $this->link);
        return end($linkParts);
    }
}
