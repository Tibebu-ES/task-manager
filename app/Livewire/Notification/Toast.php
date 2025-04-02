<?php

namespace App\Livewire\Notification;

use Livewire\Component;

class Toast extends Component
{
    public string $message;
    public string $type = 'success'; //'success', 'error', 'info'
    public bool $show = false;

    protected $listeners = ['showToast'];
    public function showToast($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;

    }

    public function render()
    {
        return view('livewire.notification.toast');
    }
}
