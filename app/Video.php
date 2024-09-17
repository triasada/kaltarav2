<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'video';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'url'];

    public function getYoutubeEmbedLinkAttribute()
    {
        $youtubeUrl = $this->url;
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $youtubeUrl, $youtubeId);

        if(isset($youtubeId[1]))
        {
            return "https://www.youtube.com/embed/".$youtubeId[1];
        }
        else
        {
            return "https://i1.ytimg.com/vi/null/mqdefault.jpg";
        }

    }

    public function getYoutubeThumbMqAttribute()
    {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $this->url, $youtubeId);

        if(isset($youtubeId[1]))
        {
            return "https://i1.ytimg.com/vi/".$youtubeId[1]."/mqdefault.jpg";
        }
        else
        {
            return "https://i1.ytimg.com/vi/null/mqdefault.jpg";
        }

    }

    public function getYoutubeThumbMaxResAttribute()
    {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $this->url, $youtubeId);

        if(isset($youtubeId[1]))
        {
            return "https://i1.ytimg.com/vi/".$youtubeId[1]."/maxresdefault.jpg";
        }
        else
        {
            return "https://i1.ytimg.com/vi/null/mqdefault.jpg";
        }

    }
}
