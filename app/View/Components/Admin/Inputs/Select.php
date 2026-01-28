<?php

namespace App\View\Components\Admin\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Select extends Component
{
    public string $label;
    public string $name;
    public bool $required;
    public mixed $value;
    public array $options;
    public bool $multiple;
    public bool $searchable;

    public function __construct(
        $label,
        $name,
        $value = null,
        $options = [],
        $multiple = false,
        $required = false,
        $searchable = true
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->value = $value;
        if ($options instanceof Collection) {
            $this->options = $options->toArray();
        } else {
            $this->options = is_array($options) ? $options : [];
        }
        $this->multiple = $multiple;
        $this->searchable = $searchable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.inputs.select');
    }
}
