@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $project->name }}</h1>
        <tasks :project="{{ $project }}"></tasks>
    </div>
@endsection