<div class="users">
<h2 class="users-title">Список пользователей в хранилище</h2>
<ul class="users-list" id="navigation">
    {% for user in users %}
        <li class="users-li">{{ user.getUserName() }}. День рождения: {{ user.getUserBirthday() | date('d.m.Y') }}</li>
    {% endfor %}
</ul>
</div>