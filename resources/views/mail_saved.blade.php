<p>
@if ($url_exists)
	<img src="{{$url}}" height="200" alt="{{$answer}}">
@endif
</p>	
<p>Вопрос = "{{$question}}"?</p>
<p>Ответ = "{{$answer}}"</p>
<p>Данные сохранены.</p>
<p>{{$remote_addr}}</p>
<p>{{$http_user_agent}}</p>
