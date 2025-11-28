<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class FeedbackManager extends Component
{
    use WithPagination;

    public $search = '';

    // Reset pagination jika user melakukan search
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Fungsi untuk menyembunyikan/menampilkan review di Welcome Page
    public function toggleVisibility($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->is_visible = !$feedback->is_visible;
            $feedback->save();

            // Opsional: Kirim notifikasi toast
            $status = $feedback->is_visible ? 'ditampilkan' : 'disembunyikan';
            $this->dispatch('show-toast', type: 'success', message: "Feedback berhasil $status.");
        }
    }

    // Fungsi Hapus
    public function delete($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->delete();
            $this->dispatch('show-toast', type: 'success', message: 'Feedback berhasil dihapus.');
        }
    }

    public function render()
    {
        $feedbacks = Feedback::with('user')
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhere('message', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.feedback-manager', [
            'feedbacks' => $feedbacks
        ]);
    }
}
