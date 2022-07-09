<?php

namespace Database\Seeders;

use App\Models\Rss;
use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Rss::create([
            'name' => 'Japanese Station',
            'username' => 'japanesestation',
            'url' => 'https://japanesestation.com/feed'
        ]);

        Rss::create([
            'name' => 'Anime Global',
            'username' => 'animeglobal',
            'url' => 'https://animeanime.global/feed'
        ]);

        Rss::create([
            'name' => 'Comic Book',
            'username' => 'comicbook',
            'url' => 'https://comicbook.com/feed/'
        ]);   

        $myXMLData = file_get_contents("https://japanesestation.com/feed");
        $myXMLData2 = file_get_contents("https://animeanime.global/feed");
        $myXMLData3 = file_get_contents("https://comicbook.com/feed/");
        $xml = simplexml_load_string($myXMLData) or die("Error : Cannot create object");
        $xml2 = simplexml_load_string($myXMLData2) or die("Error : Cannot create object");
        $xml3 = simplexml_load_string($myXMLData3) or die("Error : Cannot create object");
        
        foreach ($xml3->channel->item as $item) {
            Post::create([
                'title' => $item->title,
                'category' => $item->category,
                'url' => $item->link,
                'img' => $item->children('media', True)->content->attributes(),
                'rss_id' => 3
            ]);
        }

        foreach ($xml2->channel->item as $item) {
            Post::create([
                'title' => $item->title,
                'category' => $item->category,
                'url' => $item->guid,
                'img' => $item->children('media', True)->thumbnail->attributes(),
                'rss_id' => 2
            ]);
        }

        foreach ($xml->channel->item as $item) {
            Post::create([
                'title' => $item->title,
                'category' => $item->category,
                'url' => $item->guid,
                'img' => $item->children('media', True)->content->attributes(),
                'rss_id' => 1
            ]);
        }
    }
}
