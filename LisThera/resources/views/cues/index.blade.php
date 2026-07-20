@extends('layouts.app')

@section('title', 'Memory Cue Templates')

@section('content')
<div class="page-header">
    <h1>Memory Cue Templates</h1>
</div>

@php $grouped = $templates->groupBy('category'); @endphp

@foreach($grouped as $category => $items)
<div class="card" style="margin-bottom: 1.5rem">
    <h2>{{ $category }}</h2>
    <table class="data-table">
        <thead><tr><th>Label</th><th>Hotkey</th><th>Descri&ccedil;&atilde;o</th></tr></thead>
        <tbody>
            @foreach($items as $t)
            <tr>
                <td><strong>{{ $t->label }}</strong></td>
                <td><code>{{ $t->hotkey ?? '—' }}</code></td>
                <td>{{ $t->description ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach
@endsection
