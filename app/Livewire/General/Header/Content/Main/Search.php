<?php

namespace App\Livewire\General\Header\Content\Main;

use Livewire\Component;

class Search extends Component
{
    public $query = '';

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.main.search');
    }

    public function search() {
        if ($this->query != '') {
            //Redireccionar
            return redirect()->route('search.show', $this->query);
        }
    }
}