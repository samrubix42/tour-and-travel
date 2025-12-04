<?php

namespace App\Livewire\Public\Tour;

use Livewire\Component;
use App\Models\ContactForTour;
use Illuminate\Support\Facades\Log;

class ContactSidebar extends Component
{
    public $name;
    public $phone;
    public $email;
    public $message;
    public $tour_id;
    public $submitted = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:2000',
            'tour_id' => 'nullable|exists:tour_packages,id',
        ];
    }

    public function mount($tour_id = null)
    {
    
        $this->tour_id = $tour_id;
    }

    public function submit()
    {
        dd('test');
        try {
            Log::info('ContactSidebar: submit called', ['tour_id' => $this->tour_id]);
            $data = $this->validate();
            $data['ip'] = request()->ip();
            $data['status'] = 'pending';

            ContactForTour::create($data);

            $this->submitted = true;
            $this->reset(['name','phone','email','message']);
            $this->dispatchBrowserEvent('contact-submitted', ['message' => 'Your enquiry has been submitted.']);
            Log::info('ContactSidebar: created contact', ['data' => $data]);
        } catch (\Throwable $e) {
            Log::error('ContactSidebar submit error: ' . $e->getMessage(), ['exception' => $e]);
            $this->dispatchBrowserEvent('contact-submitted-error', ['message' => 'An error occurred. Please try again.']);
        }
    }

    public function render()
    {
        return view('livewire.public.tour.contact-sidebar');
    }
}
