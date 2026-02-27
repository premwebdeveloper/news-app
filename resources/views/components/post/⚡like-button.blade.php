<?php

use Livewire\Component;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public int $postId;
    public bool $liked = false;
    public int $likesCount = 0;

    public function mount($post)
    {
        $this->postId = $post->id;

        $post = Post::withCount('likes')->find($this->postId);

        $this->likesCount = $post->likes_count;

        if (Auth::check()) {
            $this->liked = Like::where('post_id', $this->postId)
                ->where('user_id', Auth::id())
                ->exists();
        }
    }

    public function toggle()
    {
        if (!Auth::check()) return;

        $like = Like::firstWhere([
            'post_id' => $this->postId,
            'user_id' => Auth::id(),
        ]);

        if ($like) {
            $like->delete();
            $this->liked = false;
            $this->likesCount--;
        } else {
            Like::create([
                'post_id' => $this->postId,
                'user_id' => Auth::id(),
            ]);

            $this->liked = true;
            $this->likesCount++;
        }
    }
};
?>

<div>
    <button 
        wire:click="toggle"
        class="btn {{ $liked ? 'btn-danger' : 'btn-outline-danger' }}"
    >
        ❤️ {{ $likesCount }}
    </button>
</div>