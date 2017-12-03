<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LoadBackground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'background:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'load background';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //忽略SSL错误
        $this->client =  new Client(['verify' => false]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $images = [];
        $reader = new \XMLReader();
        $reader->open(config('app.rss_url'), 'UTF-8');
        while ($reader->read()){
            if($reader->nodeType == \XMLReader::ELEMENT){
                $nodeName = $reader->name;
                if($nodeName=='enclosure'){
                    if( $reader->getAttribute('type') == 'image/jpeg'){
                        array_push($images,$reader->getAttribute('url'));
                    }
                }
            }
        }
        $iiii = 0;
        foreach ($images as $image){
            $this->client->get($image,['save_to' => public_path( "imgs/" . ($iiii++) . ".jpg")]);
        }

    }
}
