<?php

namespace App\Http\Livewire\Estimations;

use App\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $orderDesc = true;
    public $orderColumn = 'id';
    public $searchQuery = '';

    function updatingSearchQuery()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.estimations.index', [
            'estimations' => Cotizacion::search($this->searchQuery)
                ->orderBy($this->orderColumn, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
        ]);
    }
}
