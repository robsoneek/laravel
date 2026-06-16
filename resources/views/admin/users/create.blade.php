@extends('layouts.main')

@section('title', 'Správa uživatelů')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Přidat uživatele</h2>
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Uživatelské jméno</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required maxlength="45">
            </div>
            <div class="mb-3">
                <label class="form-label">Heslo</label>
                <input type="password" name="password" class="form-control" required minlength="4">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="is_admin" class="form-select" required>
                    <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>Uživatel</option>
                    <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Administrátor</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Vytvořit</button>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>

        @if($users->count())
            <hr>
            <h5>Existující uživatelé</h5>
            <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ $user->username }}
                            @if($user->is_admin)
                                <span class="badge bg-warning text-dark ms-1">Admin</span>
                            @endif
                        </span>
                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                  onsubmit="return confirm('Smazat uživatele {{ $user->username }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Smazat</button>
                            </form>
                        @else
                            <span class="text-muted small">(přihlášen)</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
