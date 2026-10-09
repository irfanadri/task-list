@extends('layouts.app')

@section('title', 'The List of tasks')


@section('content')
  {{-- @if (count (@tasks)) --}}
  @forelse ($tasks as $task)
      <div>
        <a href="{{ route('task.show', ['id' => $task->id]) }}">{{ $task->title }}</a>
      </div>
  @empty
    <div>There are no task</div>
  @endforelse
  {{-- @endif --}}
@endsection


