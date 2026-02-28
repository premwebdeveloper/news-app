<?php

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public $post;
    public $body = '';
    public $parentId = null;

    protected $rules = [
        'body' => 'required|string|min:3|max:1000'
    ];

    public function mount($post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        if (!Auth::check()) {
            abort(403);
        }

        $this->validate();

        Comment::create([
            'post_id'   => $this->post->id,
            'user_id'   => Auth::id(),
            'parent_id' => $this->parentId,
            'body'      => $this->body,
        ]);

        $this->reset(['body', 'parentId']);
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();

        $this->dispatch('toast', message: 'Comment deleted successfully!');
    }

    public function getCommentsProperty()
    {
        return Comment::with(['user', 'childrenRecursive'])
            ->where('post_id', $this->post->id)
            ->whereNull('parent_id')
            ->latest()
            ->get();
    }

    public function selectReply($id)
    {
        $this->parentId = $id;

        $this->dispatch('focus-comment-input');
    }
};
?>

<div  
    x-data="{
        parentId: @entangle('parentId'),
        init() {
            this.$watch('parentId', value => {
                if (value) {
                    this.$nextTick(() => {
                        this.$refs.commentInput.focus();
                        this.$refs.commentInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    });
                }
            });
        }
    }">

    {{-- MAIN CONTENT --}}
    <div class="space-y-4">

        @auth
            <form wire:submit.prevent="addComment" class="space-y-2">
                <textarea 
                    x-ref="commentInput"
                    wire:model.defer="body"
                    class="w-full border rounded p-2"
                    placeholder="Write a comment..."
                ></textarea>

                @error('body') 
                    <p class="text-red-500 text-sm">{{ $message }}</p> 
                @enderror

                <button type="submit" style="background:red; color:white; padding:10px;">
                    POST COMMENT
                </button>
            </form>
        @else
            <p class="text-gray-500">Login required to comment.</p>
        @endauth

        <div class="mt-6 space-y-4">
            @foreach($this->comments as $comment)
                @include('components.post.comment-item', [
                    'comment' => $comment,
                    'level' => 0
                ])
            @endforeach
        </div>

    </div>

    {{-- TOAST --}}
    <div 
        x-data="{ show: false, message: '' }"
        x-on:toast.window="
            show = true; 
            message = $event.detail.message; 
            setTimeout(() => show = false, 3000)
        "
        x-show="show"
        x-transition
        style="
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            display: none;"
            >
        <span x-text="message"></span>
    </div>

    {{-- CONFIRM SCRIPT --}}
    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('confirm-delete', (data) => {

                if (confirm('Are you sure you want to delete this comment?')) {
                    Livewire.dispatch('delete-confirmed', { id: data.id });
                }

            });

        });
    </script>

    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('focus-comment-input', () => {
                setTimeout(() => {
                    const input = document.getElementById('commentInput');
                    if (input) {
                        input.focus();
                    }
                }, 50);
            });

        });
    </script>

</div>