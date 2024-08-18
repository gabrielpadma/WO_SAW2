<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class ModalLogin extends Component
{

    #[Validate('required|email|max:50')]
    public $email;

    #[Validate('required')]
    public $password;


    public function mount()
    {
        // Memastikan modal terbuka saat pertama kali
        $this->dispatch('openLoginModal');
    }

    public function login()
    {
        $credential = $this->validate();

        if (Auth::attempt($credential)) {
            request()->session()->regenerate();
            session()->flash('login', ['message' => 'Login Success', 'icon' => 'success', 'title' => 'Login berhasil']);
            return redirect()->intended('/')->with('login', ['message' => 'Login Success', 'icon' => 'success', 'title' => 'Login berhasil']);
        }

        return redirect('/')->with('login', ['message' => 'Username atau password anda salah !!!', 'icon' => 'error', 'title' => 'Login gagal']);
    }




    public function render()
    {
        return view('livewire.auth.modal-login');
    }
}