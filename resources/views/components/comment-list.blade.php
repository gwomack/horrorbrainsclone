<div class="space-y-2">
    @foreach ($comments as $comment)
    <div class="p-6 bg-gray-900">
        <div class="flex items-center mb-3">
            <div class="flex text-yellow-500">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <span class="ml-2 font-medium text-gray-300">5.0</span>
        </div>
        <p class="leading-relaxed text-gray-300">{{ $comment->comment }}</p>
        <div class="flex justify-between items-center mt-4">
            <span class="text-sm text-gray-400">By {{ $comment->name }}</span>
            <span class="text-sm text-gray-400">{{ $comment->created_at->format('M d, Y') }}</span>
        </div>
    </div>
    @endforeach

    {{ $comments->links() }}
</div>