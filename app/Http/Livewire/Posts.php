<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts;
    public $postId,$judul_buku,$penulis,$penerbit;
    public $isOpen =0;

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.posts');
    }

    public function showModal(){
        $this->isOpen = true;
    }

    public function hideModal(){
        $this->isOpen = false;
    }

    public function simpan(){
        $this->validate(
            [
                'judul_buku' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
            ]
        );

        post::updateOrCreate(['id' => $this->postId], [
            'judul_buku' => $this->judul_buku,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            
            ]);

            $this->hideModal();

            $this->postId='';
            $this->judul_buku='';
            $this->penulis='';
            $this->penerbit='';
    }
    public function edit($id){
        $post = Post::findOrfail($id);
        $this->postId = $id ;
        $this->judul_buku = $post->judul_buku;
        $this->penulis = $post->penulis;
        $this->penerbit = $post->penerbit;

        $this->showModal();
    }

    public function hapus($id){
        Post::find($id)->delete();
    }
}
