<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Adminfix extends Component
{
    public $users = [];
    public $selectedRole = [];
    public $search = '';

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        // Simpan role awal
        foreach ($this->users as $u) {
            $this->selectedRole[$u['id']] = $u['role'];
        }
    }

    public function updateRole($userId)
    {
        $role = $this->selectedRole[$userId] ?? 'user';
        $user = User::find($userId);
        if ($user) {
            $user->update(['role' => $role]);
            $this->dispatch('role-updated');
        }
    }

    public function render()
    {
        return view('livewire.admin.adminfix');
    }
}
