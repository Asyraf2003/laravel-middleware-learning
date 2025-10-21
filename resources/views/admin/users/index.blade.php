<x-app-layout>
    <x-slot name="header">
        <h2>Users (Admin)</h2>
    </x-slot>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin-bottom: 12px;">
        <form method="GET" action="{{ route('admin.users.index') }}">
            <input type="search" name="q" value="{{ $q ?? request('q') }}" placeholder="Cari name/email..." />
            <button type="submit">Search</button>
            <a href="{{ route('admin.dashboard') }}">Kembali ke Admin Dashboard</a>
        </form>
    </div>

    <table border="1" cellpadding="6" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align:left;">ID</th>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Email</th>
                <th style="text-align:left;">Role</th>
                <th style="text-align:left;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $u)
                
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role_value }}</td>
                    <td style="display:flex; gap:8px; flex-wrap:wrap;">

                        @can('update', $u)
                            <a href="{{ route('admin.users.edit', $u) }}">Edit</a>
                        @endcan

                        @can('delete', $u)
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                  onsubmit="return confirm('Yakin hapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        @endcan

                        @can('changeRole', $u)
                            <form method="POST" action="{{ route('admin.users.changeRole', $u) }}">
                                @csrf
                                @method('PATCH')
                                <select name="role">
                                    <option value="admin" @selected($u->roleString()==='admin')>admin</option>
                                    <option value="user"  @selected($u->roleString()==='user')>user</option>
                                    <option value="other" @selected($u->roleString()==='other')>other</option>
                                </select>
                                <button type="submit">Ubah Role</button>
                            </form>
                        @endcan

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:12px;">
        {{ $users->onEachSide(1)->links() }}
    </div>
</x-app-layout>
