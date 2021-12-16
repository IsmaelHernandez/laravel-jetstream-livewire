<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = false;
    public $title;
    public $content;

    protected $rules = [
        'title' => 'required',
        'content' => 'required'
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    
    {
        //metodo validate verifica las rules 
        $this->validate();

        //metodo para guardar los post en la bd
        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        //llamar al metodo reset
        $this->reset(['open','title','content']);
        //emitir un evento
        $this->emitTo('show-post','render'); //emitTo solo para que escuche el componete showpost
        //emitir evento alert
        $this->emit('alert','El post se creo satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
