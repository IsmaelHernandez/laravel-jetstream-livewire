<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;


    public $search = '';
    public $post;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_edit = false;
    public $cant = '10';
    public $readyToLoad = false;

    //escuchar evento
    protected $listeners = ['render','delete'];

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    protected $queryString = [
        'cant' => ['except' => '10'], 
        'sort' => ['except' => 'id'], 
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    
    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                    ->orwhere('content', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->cant);

        
       
        return view('livewire.show-posts', compact('posts'));
    }

    public function edit(Post $post)
    {
        $this->post = $post;
        $this->open_edit = true;

    }

    public function update()
    {
        //metodo validate verifica reglas de validacion
        $this->validate();
        //mandar a llamar a la propiedad post y pasarle el metodo save
        $this->post->save();
         //mandamos a llamar a reset method
         $this->reset(['open_edit']); 
        //emitimos evento alert para una alert
        $this->emit('alert','El post se edito satisfactoriamente');
    }

    //se ejecuta cada que cambia search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($sort)
    {
        if($this->sort == $sort){

            if($this->direction == 'desc'){
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        
    }

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    public function delete(Post $post)
    {
        $post->delete();
    }

}
