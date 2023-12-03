<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Movie;

class TrendingMovie extends Component
{
    use WithPagination;

    public $search = '';
    public $trending;

    public function mount()
    {
        $this->trending = 'day';
    }

    protected function queryString()
    {
        return [
            'search' => [
                'title' => $this->search,
            ],
            'trending' => [
                'trending' => $this->trending,
            ]
        ];
    }

    public function render()
    {
        return view('livewire.trending-movie', [
            'movies' => Movie::search('title', $this->search)
            ->when($this->trending == 'day', function ($query) {
                return $query->ofTrendingTime($this->trending);
            })
            ->when($this->trending == 'week', function ($query) {
                return $query->ofTrendingTime($this->trending);
            })
            ->paginate(12),
        ]);
    }
}
