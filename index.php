<!DOCTYPE html>
<html>
<head>
    <title>Создание платежа LinePay с использование AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#submitBtn").click(function() {
                var amount = $("#amount").val();
                var phone = $("#phone").val();
                var email = $("#email").val();
                var currency = $("#currency").val();
                var method = $("#method").val();

                $.ajax({
                    type: "POST",
                    url: "linepay.php", // Укажите здесь путь к вашему PHP-файлу
                    data: {
                        amount: amount,
                        phone: phone,
                        email: email,
                        currency: currency,
                        method: method
                    },
                    success: function(response) {
                        $("#response").html("<pre>" + response + "</pre>");
                    },
                    error: function(xhr, status, error) {
                        $("#response").html("<p>Error: " + error + "</p>");
                    }
                });
            });
        });
    </script>
</head>
<body>
<h2>Создание платежа LinePay с использование AJAX</h2>
<form>
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount"><br><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone"><br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email"><br><br>

    <label for="currency">Currency:</label>
    <select id="currency" name="currency">
        <option value="RUB">RUB</option>
        <option value="UAH">UAH</option>
        <option value="KZT">KZT</option>
    </select><br><br>

    <label for="method">Method:</label>
    <select id="method" name="method">
        <option value="qiwi">Qiwi кошелек</option>
        <option value="ym">Юmoney Кошелек</option>
        <option value="sbp">Система Быстрых Платежей</option>
        <option value="card">Visa Mastercard Mir</option>
        <option value="cardworld">Visa Mastercard Весь Мир</option>
        <option value="visakzt">Visa Mastercard Казахстан</option>
        <option value="visauah">Visa Mastercard Украина</option>
        <option value="bank_trans">Банковский перевод</option>
        <option value="sber">Сбербанк</option>
        <option value="tinkoff">Тинькофф</option>
        <option value="payeer">Payeer Кошелек</option>
        <option value="piastrix">Piastrix Кошелек</option>
        <option value="skinsback">Скины Steam</option>
        <option value="mts">МТС</option>
        <option value="tele2">Tele2</option>
        <option value="megafon">Мегафон</option>
        <option value="yota">Yota</option>
        <option value="perfectmoney">Perfect Money</option>
        <option value="cryptocloud">CryptoCloud</option>
        <option value="fkwallet">FK Wallet</option>
    </select><br><br>

    <button type="button" id="submitBtn">Submit</button>
</form>

<div id="response"></div>
</body>
</html>
