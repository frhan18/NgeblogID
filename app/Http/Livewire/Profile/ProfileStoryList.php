<?php

namespace App\Http\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ProfileStoryList extends Component
{
  public $data = null;
  public $user = null;

  public function mount()
  {
    $this->data = Post::with('user')
      ->whereHas('user', function (Builder $query) {
        $query->where('username', \Auth::user()->username);
      })->where('status', 'publish')->orderBy('post_title', 'DESC')->get();

    $this->user = User::where('username', \Auth::user()->username)->first();
  }
  public function render()
  {
    return view('livewire.profile.profile-story-list', [
      'page_title' => 'Semua Cerita'
    ])
      ->extends('layouts.dashboard.index')
      ->section('content');
  }
}
