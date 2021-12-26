<?php

namespace App\Listeners\ArticleActive;

use App\Author;
use App\Events\ArticleActive;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveAuthor implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticleActive  $event
     * @return void
     */
    public function handle(ArticleActive $event)
    {
        foreach ($event->articles_info as $author){
            try{
                if( Author::where('email',$author->email)->exists() ){
                    continue;
                }
                Author::create([
                    'name' => $author->name,
                    'email' => $author->email,
                    'rate' => $author->rate,
                    'dependency' => $author->dependency,
                    'biography' => '...',
                ]);
            }catch (\Exception $e){
                return response()->json([
                    'message'=>'error'
                ]);
            }

        }
    }
}
