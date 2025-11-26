<?php

namespace App\Livewire\Public\Experience;

use Livewire\Component;
use App\Models\Experience as ExperienceModel;

class Experience extends Component
{
    public function render()
    {
        $experiences = ExperienceModel::where('status', true)
            ->orderBy('name')
            ->get();

        return view('livewire.public.experience.experience', [
            'experiences' => $experiences,
        ]);
    }
}
