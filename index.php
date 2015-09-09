<!DOCTYPE html>
<html>
<head>
    <title>CodeDrop</title>
    <link rel="stylesheet" href="kickstart.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="kickstart.js"></script>
</head>
<body style="margin-top:30px">
<div class="wrapper wrapper-fixed">
    <h1>CodeDrop</h1>
    <?php
    if(isset($_GET["err"])){
        $message = "An error occured, please try again";
        switch($_GET["err"]) {
            case "400":
                $message = "Please fill in all the fields";
                break;
            case "413":
                $message = "We currently support only up to 50k characters";
                break;
        }
        echo '<div class="alert">
            <h1>' . $message . '</h1>
        </div>';
    }
    ?>
    <div class="container container-green">
        <header>
            <p>Paste a snippet</p>
        </header>
        <main>
            <form id="snippet_form" class="form" method="POST" action="upload.php">
                <div class="form_group">
                    <label for="file">Snippet</label><br>
                    <textarea style="width:100%" id="snippet" name="snippet" placeholder="Paste your code here"></textarea><br>
                </div>
                <input type="submit" value="Upload">
            </form>
        </main>
    </div>
</div>
</body>
</html>