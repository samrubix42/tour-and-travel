<?php

namespace App\Livewire\Admin\Enquires;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContactForTaxi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class Taxi extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $statusFilter = 'all';

    public $showViewModal = false;
    public $selected = null;

    protected $listeners = [
        'refreshList' => '$refresh'
    ];
    #[Layout('components.layouts.admin')]
    #[Title('Taxi Enquiries')]
    public function render()
    {
        $query = ContactForTaxi::query();

        if (!empty($this->search)) {
            $s = '%' . $this->search . '%';
            $query->where(function($q) use ($s) {
                $q->where('name', 'like', $s)
                  ->orWhere('email', 'like', $s)
                  ->orWhere('phone', 'like', $s)
                  ->orWhere('pickup_location', 'like', $s)
                  ->orWhere('drop_location', 'like', $s)
                  ->orWhere('car_model', 'like', $s);
            });
        }

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $enquires = $query->orderBy('created_at','desc')->paginate($this->perPage);

        return view('livewire.admin.enquires.taxi', [
            'enquires' => $enquires,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function viewEnquiry($id)
    {
        $this->selected = ContactForTaxi::find($id);
        if ($this->selected) $this->showViewModal = true;
    }

    public function closeView()
    {
        $this->showViewModal = false;
        $this->selected = null;
    }

    public function deleteEnquiry($id)
    {
        $e = ContactForTaxi::find($id);
        if ($e) {
            $e->delete();
         $this->dispatch('success', 'Enquiry deleted');
            $this->dispatch('refreshList');
        }
    }

    public function setStatus($id, $status)
    {
        $e = ContactForTaxi::find($id);
        if (!$e) return;
        $e->status = $status;
        $e->save();
     $this->dispatch('success', 'Status updated');
        $this->dispatch('refreshList');
    }
}
