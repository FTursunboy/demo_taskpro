<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class Person
{
    public string $name = '';
    public string $surname = '';
    public int $age = 0;

    public function __construct($name_, $surname_, $age_)
    {
        $name_ = $this->name;
        $surname_ = $this->surname;
        $age_ = $this->age;
    }
}


$person = new Person('Bahodur', 'Akhunov', 22);
