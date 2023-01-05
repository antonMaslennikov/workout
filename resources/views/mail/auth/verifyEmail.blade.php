<p>Вы прошли регистрацию</p>
<p>Чтобы её завершить пройдите по ссылке <a href="{{ route('register.verify', ['token' => $user->verify_token])  }}">{{ route('register.verify', ['token' => $user->verify_token])  }}</p>
