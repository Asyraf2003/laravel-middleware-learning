<x-app-layout>
    <x-slot name="header">
        <h2>Admin Dashboard</h2>
    </x-slot>

    @php
        $roleVal = method_exists($user, 'roleString')
            ? $user->roleString()
            : ($user->role instanceof \App\Enums\Role ? $user->role->value : (string) $user->role);
    @endphp

    <p>Halo, {{ $user->name }} — Role: <strong>{{ $roleVal }}</strong></p>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <ul style="margin:12px 0;">
        <li><a href="{{ route('admin.users.index') }}">Kelola Users (Index)</a></li>
    </ul>
</x-app-layout>
