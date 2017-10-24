
    function MessageShow($obj,$msg)
    {

        var strElementCount = getElementCount($obj);
        var objID='';
        for(var i=0;i<strElementCount;i++)
        {
            objID = '#'+$obj[i];
            if(typeof $msg == 'undefined' || $msg[i] == 'validation.required')
            {

                $(objID).tooltip({placement:'down'})
                        .tooltip('show');
            }else{
                $(objID).attr('title', $msg[i])
                    .tooltip({placement:'down'})
                    .tooltip('fixTitle')
                    .tooltip('show');
                //$(objID).tooltip('show');
            }

        }
    }


    /*
    * 20171020  取出程式驗證後，回傳的訊息數量
    * */
    function getElementCount($obj)
    {
        return $obj.length;
    }

    /*
    * 彈出視窗顯示錯誤訊息
    * */
    function AlterMessage($obj)
    {
        alert($obj.Message);
    }

