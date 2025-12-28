<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]

class Replies extends Component
{
    public $search = '';
    public $selectedMessageId = null;
    public $replyBody = '';

    protected $rules = [
        'replyBody' => 'required|min:2',
    ];

    public function mount(): void
    {
        // opsional: pilih pesan pertama
        $first = ContactMessage::latest()->first();
        $this->selectedMessageId = $first?->id;
    }

    public function selectMessage($id): void
    {
        $this->selectedMessageId = $id;
        $this->reset('replyBody');
    }

    public function sendReply(): void
    {
        $this->validate();

        if (!$this->selectedMessageId) {
            $this->addError('replyBody', 'Pilih pesan yang ingin dibalas.');
            return;
        }

        ContactMessageReply::create([
            'contact_message_id' => $this->selectedMessageId,
            'admin_id' => Auth::id(),
            'body' => $this->replyBody,
            'status' => 'sent',
        ]);

        $this->reset('replyBody');

        // Emit agar UI bisa menampilkan toast atau scroll ke bawah
        $this->dispatch('reply-sent');
    }

    public function getMessagesProperty()
    {
        return ContactMessage::with('replies')
            ->when($this->search, fn($q) => $q->where('pesan', 'like', "%{$this->search}%")
                ->orWhere('kategori', 'like', "%{$this->search}%"))
            ->latest()
            ->get();
    }

    public function getSelectedMessageProperty()
    {
        return $this->messages->firstWhere('id', $this->selectedMessageId);
    }

    public function render()
    {
        return view('livewire.admin.replies', [
            'messages' => $this->messages,
            'selected' => $this->selectedMessage,
        ]);
    }
}
