{{-- resources/views/emails/contact.blade.php --}}
<p>Имя: {{ $data['name'] }}</p>
<p>Email: {{ $data['email'] }}</p>
<p>Тема: {{ $data['subject'] }}</p>
<p>Сообщение:</p>
<p>{{ $data['message'] }}</p>