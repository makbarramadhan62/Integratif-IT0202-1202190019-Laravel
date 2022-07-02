<?php

namespace Database\Seeders;

use DOMXPath;
use DOMDocument;
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
            'name' => 'japanese Station',
            'username' => 'japanesestation',
            'url' => 'https://japanesestation.com/feed'
        ]);

        Rss::create([
            'name' => 'CBR.com',
            'username' => 'cbr',
            'url' => 'https://www.cbr.com/feed/category/anime-news/'
        ]);
        
        Rss::create([
            'name' => 'Anime Global',
            'username' => 'animeanime.global',
            'url' => 'https://animeanime.global/feed'
        ]);

        // $curl_handle = curl_init();
        // curl_setopt($curl_handle, CURLOPT_URL, 'https://www.cbr.com/feed/category/anime-news/ format=flv');
        // curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        // $query = curl_exec($curl_handle);
        // curl_close($curl_handle);


        $myXMLData = file_get_contents("https://japanesestation.com/feed");
        $myXMLData2 = file_get_contents("https://comicbook.com/feed/");
        // $myXMLData2 = file_get_contents("https://animecorner.me/feed/");
        // $myXMLData2 = file_get_contents("https://otakumode.com/news/feed");
        $myXMLData3 = file_get_contents("https://animeanime.global/feed");
        $xml = simplexml_load_string($myXMLData) or die("Error : Cannot create object");
        $xml2 = simplexml_load_string($myXMLData2) or die("Error : Cannot create object");
        $xml3 = simplexml_load_string($myXMLData3) or die("Error : Cannot create object");

        $dom = new DOMDocument();
        libxml_use_internal_errors(True);
        $dom->loadXML($myXMLData);
        $dom->formatOutput = True;

        $xpath = new DOMXPath($dom);
        $nodes = $xpath->query('channel/item/description');

        foreach ($nodes as $node) {
            $html = new DOMDocument();
            $html->loadHTML($node->nodeValue);
            Image::create([
                'url' => $html->getElementsByTagName('img')->item(0)->getAttribute('src')
            ]);
        }

        foreach ($xml->channel->item as $item) {
            Post::create([
                'title' => $item->title,
                'category' => $item->category,
                'content' => $item->children("content", true),
                'rss_id' => 1
            ]);
        }

        foreach ($xml2->channel->item as $item) {
            Post::create([
                'title' => $item->title,
                'category' => $item->category,
                'content' => $item->children("content", true),
                'rss_id' => 2
            ]);
        }
        
        foreach ($xml3->channel->item as $item) {
            Post::create([
                'title' => $item->title,
                'category' => $item->category,
                'content' => $item->children("content", true),
                'rss_id' => 3
            ]);
        }

        Category::create([
            'name' => 'Japan Travel'
        ]);

        Category::create([
            'name' => 'Entertainment'
        ]);

        Category::create([
            'name' => 'News'
        ]);

        Category::create([
            'name' => 'Anime Manga'
        ]);
    }
}
