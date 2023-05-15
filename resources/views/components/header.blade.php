<?php
use Illuminate\View\Component;

class Header extends Component
{
    public $offer;

    public function __construct($offers)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.header');
    }
}

    ?>
