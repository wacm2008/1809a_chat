<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <textarea name="" id="tex" cols="30" rows="10"></textarea>
    <input type="button" value="envia" id="butt">
    <input type="text" id="uname">
    <script src="/js/jquery.js"></script>
    <script>
        var websocket_server = 'ws://chat.1809a.com:9502';
        var ws = new WebSocket(websocket_server);
        //建立websocket后发送数据
        ws.onopen = function () {
            $('#butt').click(function (e) {
                var tex = $('#tex').val();
                var name = $('#uname').val();
                if(name==''){
                    alert('请输入个聊天名哦');
                }
                if(tex==''){
                    alert('请输入聊天内容哦');
                }
                var data = {
                    type:'message',
                    content:tex,
                    name:name,
                    date:Date.now()
                }
                ws.send(JSON.stringify(data));//转json字符串
            });
        }
        //接到服务器响应数据
        ws.onmessage = function (d) {
            //console.log(JSON.parse(d.data));
            var data=JSON.parse(d.data);
            $('#tex').before(data.name+':'+data.content+'-'+data.date+'<br>');
            $('#tex').val('');
            //alert(d.data);
        }
    </script>
</body>
</html>
