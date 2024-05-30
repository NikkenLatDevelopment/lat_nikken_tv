<?php

namespace App\Livewire\General\Header\Content\Main;

use Livewire\Component;
use Livewire\Attributes\On;

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
            //Limpiar búsqueda
            $search = preg_replace('/[^a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]/', '', $this->query);

            //Redireccionar
            return redirect()->route('search.show', $search);
        }
    }

    #[On('general.header.content.main.initialize')]
    public function initialize(string $search) {
        //Inicializar busqueda
        $this->query = $search;
    }
}
