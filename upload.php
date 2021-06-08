<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Upload Files</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <script src="https://kit.fontawesome.com/85a9462cb0.js" crossorigin="anonymous"></script>

        <style>
        input[type="file"] { 
            z-index: -1;
            position: absolute;
            opacity: 0;
            }

            input:focus + label {
            outline: 2px solid;
            }

            label {
            display: inline-block;
            position: relative;
            width: fit-content;
            }
        </style>
    </head>
    <body>
       <form action="uploads.php" method="POST" enctype="multipart/form-data">
            <!-- <label for="test">
                <i class="far fa-images"></i>
                <input type="file" id="test" name="file">
            </label> -->
            <!-- <label for="in"> -->
                <input type="file" id="in" name="file" accept=".jpg, .jpeg, .png">
                <!-- ok
            </label>
            <div id="file-upload-filename"></div> -->
            <input type="file" name="file">
            <button type="submit" name="submit">Upload image</button>
       </form>

        
        <script>
            var input = document.getElementById( 'in' );
            var infoArea = document.getElementById( 'file-upload-filename' );

            this.input.addEventListener( 'change', showFileName );

            function showFileName( event ) {
                var input = event.srcElement;
                var fileName = input.files[0].name;

                console.log(fileName);
                infoArea.textContent = 'File name: ' + fileName;
            }
        </script>
    </body>
</html>