<form class="login-form" action="/login" method="post">
    <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
            <span class="input-group-addon"><i class="icon_profile"></i></span>
            <input type="text" name="login" class="form-control" placeholder="Логин" autofocus>
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="icon_key_alt"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Пароль">
        </div>
        <div>
            {if isset( $errors )}
                {foreach item = tabItem from = $errors}
                    {$tabItem}<br />
                {/foreach}
            {/if}
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Вход</button>
    </div>
</form>
<div class="text-right">
    <div class="credits">
        <!-- -->
    </div>
</div>