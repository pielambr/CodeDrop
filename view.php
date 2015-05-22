<?php
$exists = false;
if (isset($_GET) && key($_GET)) {
    $file = key($_GET);
    if (file_exists("snippets/" . $file . ".txt")
        && strpos($file, '\\') === false
        && strpos($file, '/') === false
        && strpos($file, '.') === false
    ) {
        $snippet = fopen("snippets/" . $file . ".txt", "r");
        $exists = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CodeDrop</title>
    <link rel="stylesheet" href="kickstart.css" />
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
                <code>
                    <?php
                        $content = fread($snippet, filesize("snippets/" . $file . ".txt"));
                        echo htmlspecialchars(utf8_encode($content));
                        fclose($snippet);
                    ?>
                </code>
            </pre>
        </main>
    <?php } ?>
</div>
</body>
</html>
