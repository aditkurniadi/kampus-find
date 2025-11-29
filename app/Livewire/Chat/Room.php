<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use App\Models\LostItem;
use App\Events\MessageSent;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class Room extends Component
{
    use WithFileUploads;

    public LostItem $lostItem;
    public $newMessage = '';
    public $image = null;
    public $messages = [];

    public function mount($id)
    {
        $this->lostItem = LostItem::with('category')->findOrFail($id);

        // Cekk Akses
        $isOwner = (int)auth()->id() === (int)$this->lostItem->user_id; // <-- Perbaikan type casting
        $isAdmin = in_array(auth()->user()->role, ['superadmin', 'keamanan']);

        if (!$isAdmin && !$isOwner) {
            abort(403);
        }

        // Tandai pesan sebagai TERBACA
        Message::where('lost_item_id', $this->lostItem->id)
            ->where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->loadMessages();

        // Auto-send info barang saat pertama kali chat (jika belum ada pesan)
        $this->autoSendItemInfo();
    }

    public function autoSendItemInfo()
    {
        // Cek apakah sudah ada pesan di chat ini
        $hasMessages = Message::where('lost_item_id', $this->lostItem->id)->exists();

        // Jika belum ada pesan DAN yang buka adalah admin, auto-send info barang
        if (!$hasMessages && (auth()->user()->role === 'superadmin' || auth()->user()->role === 'keamanan')) {
            // Format pesan yang lebih rapi dan terstruktur
            $messageText = "📋 Informasi Barang Hilang\n";
            $messageText .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $messageText .= "Nama Barang:\n" . $this->lostItem->item_name . "\n\n";
            $messageText .= "Kategori:\n" . ($this->lostItem->category->name ?? '-') . "\n\n";
            $messageText .= "Lokasi Hilang:\n" . $this->lostItem->location . "\n\n";
            $messageText .= "Deskripsi:\n" . $this->lostItem->description . "\n\n";
            $messageText .= "Status:\n" . ucfirst($this->lostItem->status);

            $autoMessage = Message::create([
                'sender_id' => auth()->id(), // Admin yang mengirim
                'receiver_id' => $this->lostItem->user_id, // Pemilik barang
                'lost_item_id' => $this->lostItem->id,
                'message' => $messageText,
                'image_path' => $this->lostItem->image_path, // Include foto barang jika ada
            ]);

            // Broadcast event
            broadcast(new MessageSent($autoMessage->load('sender')))->toOthers();

            // Reload messages
            $this->loadMessages();
            $this->dispatch('chat-scroll');
        }
    }

    // --- BAGIAN INI YANG KITA PAKAI (LEBIH STABIL) ---
    public function getListeners()
    {
        // Pastikan lostItem sudah ter-load
        if (!isset($this->lostItem->id)) {
            return [];
        }

        return [
            // PERHATIKAN:
            // 1. Ada titik (.) di depan MessageSent
            // 2. Penulisan 'MessageSent' harus sama persis (Case Sensitive)
            "echo-private:chat.{$this->lostItem->id},.MessageSent" => 'refreshMessages'
        ];
    }

    public function refreshMessages($event)
    {
        // Reload messages dari database
        $this->loadMessages();

        // Trigger scroll ke bawah setelah DOM di-update
        $this->dispatch('chat-scroll');
    }
    // --------------------------------------------------

    public function loadMessages()
    {
        $this->messages = Message::where('lost_item_id', $this->lostItem->id)
            ->with('sender')
            ->oldest()
            ->get()
            ->toArray();
    }

    public function sendMessage()
    {
        // Validasi: minimal harus ada pesan atau gambar
        $this->validate([
            'newMessage' => 'nullable|string|required_without:image',
            'image' => 'nullable|image|max:5120', // Max 5MB
        ], [
            'newMessage.required_without' => 'Pesan atau gambar harus diisi.',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('chat/images', 'public');
        }

        $createdMessage = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->lostItem->user_id,
            'lost_item_id' => $this->lostItem->id,
            'message' => $this->newMessage ?? '',
            'image_path' => $imagePath,
        ]);

        // Broadcast Event
        broadcast(new MessageSent($createdMessage->load('sender')))->toOthers();

        $this->newMessage = '';
        $this->image = null;
        $this->loadMessages(); // Load pesan sendiri
        $this->dispatch('chat-scroll'); // Scroll sendiri
    }

    public function render()
    {
        return view('livewire.chat.room');
    }
}
