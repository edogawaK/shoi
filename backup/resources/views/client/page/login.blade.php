<form action="{{ route('handleLogin') }}" method="post">
    {{ csrf_field() }}
    <input placeholder="Email" name="user_email">
    <input placeholder="Password" name="user_password">
    <input type="submit" value="Login">
</form>