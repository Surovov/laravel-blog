<div class="tm-sidebar-left uk-visible@m">
    <h3>Админ Панель</h3>

    <ul class="uk-nav uk-nav-default tm-nav uk-margin-top">
        <li class="uk-nav-header">Разделы</li>
        <li class="{{ request()->is('admin') ? 'uk-active' : '' }}">
            <a href="/admin"><span uk-icon="icon: home"></span> Главная</a>
        </li>
        <li class="{{ request()->is('admin/categories*') ? 'uk-active' : '' }}">
            <a href="{{ route('categories.index') }}"><span uk-icon="icon: album"></span> Категории</a>
        </li>
        <li class="{{ request()->is('admin/tags*') ? 'uk-active' : '' }}">
            <a href="{{ route('tags.index') }}"><span uk-icon="icon: tag"></span> Теги</a>
        </li>
        <li class="{{ request()->is('admin/posts*') ? 'uk-active' : '' }}">
            <a href="{{ route('posts.index') }}"><span uk-icon="icon:  file-text"></span> Статьи</a>
        </li>
        <li class="{{ request()->is('admin/users*') ? 'uk-active' : '' }}">
            <a href="{{ route('users.index') }}"><span uk-icon="icon: users"></span> Users</a>
        </li>
        <li class="{{ request()->is('admin/comments*') ? 'uk-active' : '' }}">
            <a href="#"><span uk-icon="icon: comments"></span> Комментарии</a>
        </li>
        <li class="{{ request()->is('admin/subscribers*') ? 'uk-active' : '' }}">
            <a href="#"><span uk-icon="icon: mail"></span> Подписота</a>
        </li>
    </ul>
</div>


