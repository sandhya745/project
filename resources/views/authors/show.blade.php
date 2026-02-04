<div>
     <p><strong>Author:</strong> {{ $book->author?->author_name ?? 'N/A' }}</p>

@if($book->author)
    <p class="mt-2 text-gray-600">
        <strong>Bio:</strong><br>
        {{ $book->author->bio }}
    </p>
@endif
</div>
