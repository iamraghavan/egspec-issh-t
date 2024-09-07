<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Session;

class EventSchedule extends Component
{
    public $departments;

    public function __construct()
    {
        // Fetch sessions where is_hide is 'show' and group them by department
        $this->departments = Session::where('is_hide', 'show')
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('department');
    }

    public function render()
    {
        return view('components.event-schedule', [
            'departments' => $this->departments,
        ]);
    }
}
