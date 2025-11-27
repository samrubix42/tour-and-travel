<?php

namespace App\Livewire\Public\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Blog extends Component
{
    use WithPagination;

    public $tag = '';

    protected $queryString = [
        'tag' => ['except' => ''],
    ];

    public function render()
    {
        $query = Post::with('category')->latest();

        if (!empty($this->tag)) {
            $tag = strtolower($this->tag);
            $query->whereRaw('LOWER(tags) LIKE ?', ["%{$tag}%"]);
        }

        $posts = $query->paginate(9);

        return view('livewire.public.blog.blog', compact('posts'));
    }
}
