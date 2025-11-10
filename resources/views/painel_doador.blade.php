<h2>Bem-vindo, {{ Auth::guard('doador')->user()->nome }}</h2>
<form action="{{ route('logout.doador') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Sair</button>
</form>
