function if_change()
{
    if (document.getElementById('currency_account').value == 3)
    {
        document.getElementById('currency').disabled = 0;

    } else
    {
        document.getElementById('currency').disabled = 1;

    }

    if (document.getElementById('otheraccounts').value == 1)
    {
        document.getElementById('clientnumber').disabled = 0;

    } else
    {
        document.getElementById('clientnumber').disabled = 1;
    }

}