<?php

namespace App\Http\Livewire\Component;

use App\Models\BaseFolders;
use Livewire\Component;

class DetailPanel extends Component
{
    public $name, $owner, $access_type, $created_at, $updated_at;

    protected $listeners = [
        'setDetailFolder' => 'showDetailFolder',
        'resetDetailFolder' => 'resetDetail'
    ];

    public function render()
    {
        return view('livewire..component.detail-panel');
    }

    public function showDetailFolder($folder)
    {
        $this->resetDetail();
        $folders = BaseFolders::where('slug', $folder['slug'])->first();
        $this->name = $folders->name;
        $this->owner = $folders->user->name;
        $this->access_type = $folders->access_type;
        $this->created_at = $folders->created_at;
        $this->updated_at = $folders->updated_at;
    }

    public function resetDetail()
    {
        $this->name = "";
        $this->owner = "";
        $this->access_type = "";
        $this->created_at = "";
        $this->updated_at = "";
    }
}