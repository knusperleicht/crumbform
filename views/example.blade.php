<!-- This is only an example of both variants -->
<!-- First one is with pure html and the second one with javascript -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>
</head>

<body class="antialiased">

<div class="container">
    <p class="fs-3">Simple html form submission</p>
    <form action="http://package.mail-contact.test/forms/defaultform" method="post">
        <label for="email">Your Email</label>
        <input name="Email" id="email" value="test@test.com" type="email">
        <label for="name">Your Name</label>
        <input name="Name" id="name" value="Knusperleicht" type="text">
        <button type="submit">Submit</button>
    </form>

    <p class="fs-3">Simple javascript form submission</p>
    <form id="js-form">
        <label for="email">Your Email</label>
        <input name="email" id="email" value="test@test.com" type="email">
        <label for="name">Your Name</label>
        <input name="name" id="name" value="Knusperleicht" type="text">
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>

<script type="text/javascript">
    async function sendEmail(url = '', data = {}) {
        const response = await fetch(url, {
            method: 'POST',
            redirect: 'follow',
            body: data
        });
        return response.json()
    }

    window.onload = function () {
        const form = document.getElementById("js-form");
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(form);
            sendEmail('http://package.mail-contact.test/forms/defaultform', formData)
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.log(error)
                });
        });
    };
</script>

