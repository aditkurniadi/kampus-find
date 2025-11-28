<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedback;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class UserFeedback extends Component
{
    public $rating = 0;
    public $message = '';
    public $isSuccessful = false;

    public function setRating($val)
    {
        $this->rating = $val;
    }

    public function submit()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:500',
        ], [
            'rating.min' => 'Silakan pilih bintang minimal 1.',
            'message.required' => 'Mohon isi pesan feedback Anda.',
        ]);

        $isVisible = $this->rating >= 4;

        Feedback::create([
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'message' => $this->message,
            'is_visible' => $isVisible,
        ]);

        $this->isSuccessful = true;

        $this->reset(['rating', 'message']);
    }

    public function render()
    {
        return view('livewire.user-feedback');
    }
}
