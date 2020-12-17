<!DOCTYPE html>
<html>
<title>Mail Form - (Template)</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<head>
    <style>
        textarea[type='text'] {
            font-size: 16px;
        }

        button[type='button'] {
            font-size: 16px;
        }

        input[type='text'] {
            font-size: 16px;
        }

        input[type='file'] {
            font-size: 16px;
        }

        input[type='submit'] {
            font-size: 16px;
        }
    </style>
    <script type="text/javascript">
        function stripHTML(text) {
            const regex = /(<([^>]+)>)/ig;
            return text.replace(regex, "");
        }

        function Check() {
            let text = document.getElementById('content').value;
            document.getElementById('content').value = stripHTML(text);
        }

        function uploadCheck() {
            let uploadField = document.getElementById("file");
            if (uploadField.size > 10240) {
                alert("File is too big!");
            }
        }

        async function getCaptchaPair() {
            await fetch('http://localhost:32771/captcha/api/default').then(async (response) => {
                let json = await response.json();
                console.log(json);
                document.getElementById('img').src = json['img'];
                document.getElementById('key').value = json['key'];
            });
        }
    </script>
</head>
<body onload="getCaptchaPair()">

<h2>Mail Form - (Default)</h2>

<h3>
    <form action="/sendmail" method="post" enctype="multipart/form-data">

        <input type="hidden" id="template" name="template" value="template" maxlength="125">

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="test" maxlength="125"><br><br>
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="Test mail" maxlength="78"><br><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="06764399956" maxlength="125"><br><br>
        <label for="mail">EMail:</label><br>
        <input type="text" id="mail" name="mail" value="mathias.michalko@knusperleicht.at" maxlength="255"><br><br>
        <label for="copy">Send Copy:</label>
        <input type="checkbox" id="cc" name="cc" value=1>
        <br><br>

        <label for="content">Content:</label><br>
        <textarea type="text" id="content" name="content" rows="4" cols="50" onchange="Check()" maxlength="384000">Das ist eine Test Mail.</textarea><br><br>

        <input name="file" id="file" type="file" size="50" onchange="uploadCheck()"
               accept=".rtf,.txt,.doc,.docx,.pdf,.zip,.7zip"><br><br>

        <input type="hidden" name="key" id="key" value=""><br><br>

        <img id="img" class="img" src="">

        <button type="button" id="reload" name="reload" onclick="getCaptchaPair()">Refresh</button>
        <!-- class="reload" -->
        <br><br>
        <input type="text" id="captcha" name="captcha" value=""><br><br>

        <input type="submit" value="Submit">
    </form>
</h3>

</body>
<script type="text/javascript">
    $('.reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'http://localhost:32771/captcha/default',
            success: function (data) {
                $(".img").attr('src', data.img);
            }
        });
    });
</script>
</html>
