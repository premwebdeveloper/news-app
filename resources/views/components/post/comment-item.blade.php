<div 
    class="mt-3"
    style="
        margin-left: {{ $level * 30 }}px;
        border-left: {{ $level > 0 ? '3px solid #dee2e6' : 'none' }};
        padding-left: 10px;
        background: {{ $parentId == $comment->id ? '#fff3cd' : 'transparent' }};
    "
    wire:key="comment-{{ $comment->id }}"
>

    <div class="card p-3 shadow-sm" style="background: {{ $level > 0 ? '#f8f9fa' : '#ffffff' }};">
        
        <div style="font-weight:600;">
            {{ $comment->user->name }}
        </div>

        <div class="mt-2">
            {{ $comment->body }}
        </div>

        <div class="mt-2" style="font-size:13px;">
            <span 
                wire:click="$set('parentId', {{ $comment->id }})"
                style="cursor:pointer; color:#0d6efd;"
            >
                Reply
            </span>

            @if(auth()->id() === $comment->user_id)

                <span 
                    wire:click="deleteComment({{ $comment->id }})"
                    wire:confirm="Are you sure you want to delete this comment?"
                    style="cursor:pointer; color:red; margin-left:10px;"
                >
                    Delete
                </span>
            @endif
        </div>

    </div>

    {{-- Children --}}
    @foreach($comment->childrenRecursive as $child)
        @include('components.post.comment-item', [
            'comment' => $child,
            'level' => $level + 1
        ])
    @endforeach

</div>