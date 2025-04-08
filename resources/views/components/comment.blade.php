<div class="comment-section">
    <h2 class="mb-6 text-2xl font-bold text-white md:text-3xl">User <span
            class="blood-red">Reviews</span></h2>

    <!-- Comment Form -->
    <div class="p-6 mb-8 bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold text-white">Leave a Review</h3>
        <livewire:comment-form :post="$post" />
    </div>

    <x-comment-list :post="$post" />

</div>