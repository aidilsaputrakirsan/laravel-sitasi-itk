<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public $message;
    public $success = false;
    public $error = false;

    #[On('alert:data')]
    public function setAlert($state, $message)
    {
        if ($state === 'success') {
            $this->success = true;
        } else {
            $this->error = true;
        }

        $this->message = $message;
    }

    public function closeAlert($state)  
    {
        if ($state === 'success') {
            $this->success = true;
        } else {
            $this->error = true;
        }
    }

    public function render()
    {
        return view('livewire.alert');
    }
}
