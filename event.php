<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <button id="elema" onclick="alert('Click!');">Autoclick</button> -->
    <!-- <div id ="elem" contenteditable="true">viens du trys</div> -->
    <!-- <input type="text" autofocus value="value text" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" /> -->
    <!-- <input type="text" autofocus="autofocus" value="ths" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" name="comment" class="c-post__comment-btn js-comment-input"/> -->
    <p id="elem" contenteditable="true">edit</p>
    <script>
        const elem = document.getElementById('elem');
        // let event = new Event("click");
        // elem.dispatchEvent(event);
        elem.focus();
    </script>
</body>
</html>