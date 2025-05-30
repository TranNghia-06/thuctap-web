<?php

namespace App\View\Components\ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * @property array<int, array{url: string, label: string}> $breadcrumbs
 */
class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     * @param array<int, array{url: string, label: string}> $breadcrumbs
     */
    public function __construct(public array $breadcrumbs, public ?int $isAdmin, public ?bool $isDark) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.breadcrumb');
    }
}
