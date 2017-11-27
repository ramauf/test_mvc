<div class="row">
    <div class="col-xs-12">
        <section class="panel">
            {foreach item = tabItem from = $balance}
                {$tabItem.typeName}: {$tabItem.amount}<br />
            {/foreach}
            <h3>Текущий баланс: {$currentBalance}</h3>

            <div class="alert alert-success fade in" style="{if $status == 'success'}display:;{else}display:none;{/if}">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                <strong>Поздравляем!</strong> Запрос успешно выполнен
            </div>

            <div class="alert alert-block alert-danger fade in" style="{if $status == 'fail'}display:;{else}display:none;{/if}">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                <strong>Ошибка!</strong> Вывести не удалось
            </div>



            {if $balance > 0}
                <button type="button" class="btn btn-primary" id="withdrawRequestButton">Вывести</button>
                <div class="row" style="display:none;" id="withdrawRequestDiv">
                    <div class="col-xs-4">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label for="address">Реквизиты</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Номер карты Visa">
                            </div>
                            <div class="form-group">
                                <label for="amount">Сумма</label>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Сумма к списанию">
                            </div>
                            <div class="form-group">
                                <label for="password">Платежный пароль</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-primary">Вывести</button>
                        </form>
                    </div>
                </div>
            {/if}
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Операция</th>
                        <th>Сумма</th>
                        <th>Реквизиты</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach item = tabItem from = $operations}
                    <tr style="{if $tabItem.type == 'in'}color:#8FBF8F{else}color:#BF8F8F{/if}">
                        <td>{$tabItem.id}</td>
                        <td>{$tabItem.typeName}</td>
                        <td>{$tabItem.amount}</td>
                        <td>{$tabItem.address}</td>
                        <td>{date('Y-m-d H:i:s', $tabItem.date)}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </section>
    </div>
</div>
