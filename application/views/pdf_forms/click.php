
<h2>Шаблон заявления на текущий счет «КЛИК»</h2>

</br>

<div class="col-md-6">
    <form id="form_id1" method="post" action="/pdfgenerator/createpdf">

        <div class="form-group">
            <label for="currency_account">Прошу открыть на мое имя текущий счет </label>
            <select class="form-control" name="currency_account" id="currency_account" value="1" onchange="if_change()">
                <option value="1">в российских рублях</option>
                <option value="2">в долларах США</option>
                <option value="3">в евро</option>
                <option value="4">в другой валюте</option>
            </select>
        </div>

        <div class="form-group">
            <label for="currency" >Валюта</label>
            <input required class="form-control" type="text" name="currency" id="currency" value="" disabled="" >
        </div>

        <div class="form-group">
            <label for="codeword">Кодовое слово</label>
            <input required class="form-control" type="text" name="codeword" id="codeword" value="" >
        </div>

        <div class="form-group">
            <label for="otheraccounts">Наличие других счетов в АО ЮниКредит Банк </label>
            <select class="form-control" name="otheraccounts" id ="otheraccounts" value="1" onchange="if_change()" >
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
        </div>

        <div class="form-group">
            <label for="clientnumber" >Клиентский номер</label>
            <input required class="form-control" type="text" name="clientnumber" id="clientnumber" value="">
        </div>

        <div class="form-group">
            <label for="ischanged">Претерпели ли изменения персональные данные ?</label>
            <div class="controls">
                <select class="form-control" name="ischanged" id ="ischanged" value="1" >
                    <option value="1">Нет</option>
                    <option value="2">Да</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" >Фамилия*</label>
            <input required class="form-control" type="text" name="lastname" id="lastname" value="">
        </div>

        <div class="form-group">
            <label for="firstname" >Имя*</label>
            <input required class="form-control" type="text" name="firstname" id="firstname" value="">
        </div>

        <div class="form-group">
            <label for="middlename" >Отчество*</label>
            <input required class="form-control" type="text" name="middlename" id="middlename" value="">
        </div>

        <h3>Паспортные данные:</h3>

        <div class="form-group">
            <label for="passportser" >Серия*</label>
            <input required class="form-control" type="text" name="passportser" id="passportser" value="">
        </div>    

        <div class="form-group">
            <label for="passportnum" >Номер*</label>
            <input required class="form-control" type="text" name="passportnum" id="passportnum" value="">
        </div>

        </br>   

        <div>
            <input type="button" class="btn btn-primary btn-large" value="Сформировать заявление" onclick="AjaxFormRequest('result_div_id1', 'form_id1', '/pdfgenerator/createpdf')" >
            <a href="/pdfgenerator/reset"><input type="button" class="btn btn-primary btn-large" value="Очистить поля"></a>
        </div>

        <div id="result_div_id1"> </div>
        
        </br>   
    </form>
</div>

<script src="/js/pdfform_click.js"></script>
<script src="/js/ajaxformrequest.js"></script>

