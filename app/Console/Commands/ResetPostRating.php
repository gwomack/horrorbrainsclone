<?php

namespace App\Console\Commands;

use App\Models\Post\Post;
use Illuminate\Console\Command;

class ResetPostRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:reset-rating {post_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the rating of a post';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $post = Post::find($this->argument('post_id'));
        if (! $post) {
            $this->error('Post not found');

            return;
        }

        $post->rating = 0;
        $post->save();

        $post->postRatings()->delete();

        $this->info('Post rating reset successfully');
    }
}
