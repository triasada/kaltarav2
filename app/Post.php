<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';

    public function content()
    {
        return $this->belongsTo('App\Content');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function postCategory()
    {
        return $this->belongsTo('App\PostCategory');
    }

    /**
     * Scope a query to only include category news
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategoryNews($query)
    {
        return $query->where('post_category_id', POST_CATEGORY_NEWS);
    }

    /**
     * Scope a query to only include category announcement
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategoryAnnouncement($query)
    {
        return $query->where('post_category_id', POST_CATEGORY_ANNOUNCEMENT);
    }

    /**
     * Get the summary
     *
     * @param  string  $value
     * @return string
     */
    public function getSummaryAttribute()
    {
        if(is_null($this->excerpt))
        {
            return str_limit(strip_tags(html_entity_decode($this->body)), 300, '...');
        }
        return $this->excerpt;
    }

    /**
     * Get the thumbnail
     *
     * @param  string  $value
     * @return string
     */
    public function getThumbnailAttribute()
    {
        if(is_null($this->featured_image_path) || empty($this->featured_image_path))
        {
            return 'img/logo.png';
        }
        return $this->featured_image_path;
    }
}
