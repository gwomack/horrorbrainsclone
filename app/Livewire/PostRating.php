<?php

namespace App\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PostRating extends Component
{
    /**
     * The post instance.
     *
     * @var \App\Models\Post
     */
    public $post;

    /**
     * The user rating.
     *
     * @var int
     */
    #[Validate('required|integer|min:1|max:5')]
    public $userRating;

    /**
     * Mount the component.
     *
     * @param  \App\Models\Post  $post
     */
    public function mount($post)
    {
        $this->post = $post;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.post-rating', [
            'avgRating' => $this->getAvgRating(),
            'ratingCount' => $this->getRatingCount(),
        ]);
    }

    /**
     * Get the rating of the post.
     *
     * @return float
     */
    public function getAvgRating()
    {
        return $this->post->rating;
    }

    /**
     * Get the rating count of the post.
     *
     * @return int
     */
    public function getRatingCount()
    {
        return $this->post->postRatings()->count();
    }

    /**
     * Save the user rating.
     */
    public function saveUserRating($rating)
    {
        $checksum = getPublicUserChecksum();
        $executed = RateLimiter::attempt(getRateLimiterKey($checksum, $this->post->getKey()),
            5, function () {});

        if (! $executed) {
            Notification::make()
                ->title('Rate limit exceeded')
                ->body('You have exceeded the rate limit for rating this post.')
                ->send();

            return;
        }

        $this->userRating = $rating;
        $this->validate();

        $data = [
            'rating' => $this->userRating,
            'public_user' => $checksum,
        ];

        if (auth()->check()) {

            $save = $this->post->postRatings()->updateOrCreate(
                ['user_id' => auth()->user()->id],
                $data,
            );

        } else {

            $save = $this->post->postRatings()->updateOrCreate(
                ['public_user' => $checksum],
                $data,
            );
        }

        if ($save->wasRecentlyCreated) {
            Notification::make()
                ->title('Rating saved')
                ->body('Your rating has been saved')
                ->send();
        } else {
            Notification::make()
                ->title('Rating updated')
                ->body('Your rating has been updated')
                ->send();
        }

        $this->post->refresh();
    }
}
