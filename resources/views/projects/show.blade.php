@extends('layouts.app')

@section('content')
    <tasks :project="{{ $project }}"></tasks>
@endsection