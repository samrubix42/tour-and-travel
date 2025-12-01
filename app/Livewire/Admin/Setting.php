<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Setting as SettingModel;
use Illuminate\Support\Str;

class Setting extends Component
{
    public $key = '';
    public $value = '';
    public array $settings = [];
    public array $common = [
        'address' => '',
        'phone' => '',
        'location' => '',
        'instagram' => '',
        'facebook' => '',
        'twitter' => '',
        'linkedin' => '',
        'youtube' => '',
    ];

    public function mount(): void
    {
        $this->loadSettings();
    }

    public function loadSettings(): void
    {
        $all = SettingModel::all()->pluck('value', 'key')->toArray();
        $this->settings = $all;
        foreach ($this->common as $k => $v) {
            $this->common[$k] = $all[$k] ?? '';
        }
    }

    public function saveCommon(): void
    {
        foreach ($this->common as $k => $v) {
            SettingModel::updateOrCreate(['key' => $k], ['value' => $v]);
        }

        $this->loadSettings();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Settings saved']);
    }

    public function addSetting(): void
    {
        $this->validate([
            'key' => 'required|string|max:191',
            'value' => 'nullable|string',
        ]);

        $k = Str::slug($this->key, '_');
        SettingModel::updateOrCreate(['key' => $k], ['value' => $this->value]);
        $this->key = '';
        $this->value = '';
        $this->loadSettings();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Setting saved']);
    }

    public function deleteSetting(string $key): void
    {
        SettingModel::where('key', $key)->delete();
        $this->loadSettings();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Setting removed']);
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.setting');
    }
}
