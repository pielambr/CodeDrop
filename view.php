<?php
require __DIR__ . '/vendor/autoload.php';

$client = new Predis\Client();

$exists = false;
if (isset($_GET) && key($_GET)) {
    $filename = key($_GET);
    $exists = $client->exists($filename);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CodeDrop</title>
    <link rel="stylesheet" href="kickstart.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/monokai_sublime.min.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
    <script type="text/javascript" src="kickstart.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div class="container container-green">
    <?php
    if (!$exists) {
        echo '<div style="margin-top:30px" class="wrapper wrapper-fixed">
                <h1>Snippet not found</h1>
              </div>';
    } else {
        ?>
        <header>
            <p>Snippet</p>
        </header>
        <main>
            <pre>
                <?php
                $content = $client->get($filename);
                echo "<code>" . htmlspecialchars(utf8_encode($content)) . "</code>";
                ?>
            </pre>
        </main>
    <?php } ?>
</div>
</body>
</html>
