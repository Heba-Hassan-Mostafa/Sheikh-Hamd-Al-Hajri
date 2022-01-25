<?php

namespace App\Models;

use App\Models\Lesson;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;


class NewsItem extends Lesson implements Feedable
{
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->slug,
            'title' => $this->name,
            'summary' => !empty($this->content) ? $this->content : '',
            'updated' => $this->created_at,
            'link' => route('frontend.lessons.lesson-show',$this->slug),
            'author' => setting()->siteName,
        ]);
    }


    public static function getFeedItems()
{
   return NewsItem::all();
}
}