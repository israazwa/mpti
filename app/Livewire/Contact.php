<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class Contact extends Component
{
    public $kategori, $pesan;
    public $messages = [];

    protected $rules = [
        'pesan' => 'required',
    ];
    public function mount()
    {
        $this->refreshMessages();
    }

    public function refreshMessages()
    {
        $this->messages = ContactMessage::where('user_id', Auth::id())
            ->latest()
            ->get()
            ->toArray();
    }


    public function submit()
    {
        $this->validate();

        ContactMessage::create([
            'user_id' => Auth::id(),
            'kategori' => $this->kategori,
            'pesan' => $this->pesan,
        ]);

        // Reset input agar kosong
        $this->reset(['kategori', 'pesan']);

        // Refresh daftar pesan
        $this->refreshMessages();

        // Dispatch event untuk notifikasi Alpine
        $this->dispatch('message-sent');
    }

    public function render()
    {
        $this->messages = ContactMessage::with('replies')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'asc') // urutkan dari lama ke baru
            ->get()
            ->toArray();

        return view('livewire.contact-us');
    }
}
