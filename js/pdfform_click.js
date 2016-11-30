function if_change()
{/*
 if (document.getElementById('191').value == 3)
 {
 document.getElementById('191_1').disabled = 0;
 }
 else
 {
 document.getElementById('191_1').disabled = 1;
 } */


    if (document.getElementById('current_account').value == 3)
    {
        document.getElementById('val').disabled = 0;

    } else
    {
        document.getElementById('val').disabled = 1;

    }

    //  if (document.getElementById('191_2').value == 1)
    // {
    //     document.getElementById('191_3').disabled = 0;
    //     document.getElementById('191_4').disabled = 0;
    // }
    // else
    // {
    //     document.getElementById('191_3').disabled = 1;
    //     document.getElementById('191_4').disabled = 1;
    // }


    if (document.getElementById('191_5').value == 1)
    {
        document.getElementById('191_6').disabled = 0;

    } else
    {
        document.getElementById('191_6').disabled = 1;
    }

    // if (document.getElementById('100').value == 1)
    // {
    //     document.getElementById('101').disabled = 0;
    //     //document.getElementById('102').disabled = 0;
    // }
    // else
    // {
    //     document.getElementById('101').disabled = 1;
    //     //document.getElementById('102').disabled = 0;
    // }

}