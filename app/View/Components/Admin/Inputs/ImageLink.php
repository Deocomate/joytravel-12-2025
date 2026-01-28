<?php

namespace App\View\Components\Admin\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageLink extends Component
{
    public string $label;
    public string $name;
    public string $value;
    public bool $required;

    public function __construct($label, $name, $value = null, $required = true)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value != null ? $value : "";
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.inputs.image-link');
    }
}
