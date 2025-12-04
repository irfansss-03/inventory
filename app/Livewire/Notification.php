<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Notification extends Component
{
    public $message = '';
    public $type = 'success'; // success, error, warning, info
    public $show = false; // Controls visibility from Livewire

    protected $listeners = ['showNotification'];

    public function mount()
    {
        if (Session::has('success')) {
            $this->message = Session::get('success');
            $this->type = 'success';
            $this->show = true;
        } elseif (Session::has('error')) {
            $this->message = Session::get('error');
            $this->type = 'error';
            $this->show = true;
        } elseif (Session::has('warning')) {
            $this->message = Session::get('warning');
            $this->type = 'warning';
            $this->show = true;
        } elseif (Session::has('info')) {
            $this->message = Session::get('info');
            $this->type = 'info';
            $this->show = true;
        }
    }

    public function showNotification($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
