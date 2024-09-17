<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'published_at'];

    public function contentType()
    {
        return $this->belongsTo('App\ContentType');
    }

    public function contentStatus()
    {
        return $this->belongsTo('App\ContentStatus');
    }

    public function post()
    {
        return $this->hasOne('App\Post');
    }

    public function gallery()
    {
        return $this->hasOne('App\Gallery');
    }

    /**
     * Scope a query to only include published content
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('content_status_id', CONTENT_STATUS_PUBLISHED);
    }

    /**
     * Scope a query to only include post content
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTypePost($query)
    {
        return $query->where('content_type_id', CONTENT_TYPE_POST);
    }

    /**
     * Scope a query to only include type gallery
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTypeGallery($query)
    {
        return $query->where('content_type_id', CONTENT_TYPE_GALLERY);
    }

    /**
     * Scope a query to only include notDeleted
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDeleted($query)
    {
        return $query->where('content_status_id', '!=', CONTENT_STATUS_DELETED);
    }
}
