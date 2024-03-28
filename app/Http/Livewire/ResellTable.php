<?php

namespace App\Http\Livewire;

use App\Models\Reseller;
use App\Models\User;
use Livewire\Component;

class ResellTable extends Component
{
    public $search;
    public function render()
    {
        $resell_ids = Reseller::latest()->pluck('resell_id')->values()->toArray();
        $query = $this->search;

        $users = User::whereIn('id', $resell_ids);

        if ($query) {
            $users = $users->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%');
            });
        }

        $users = $users->latest()->paginate(10);

        return view('livewire.resell-table', compact('users'));
    }
}
