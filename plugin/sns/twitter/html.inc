<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Twitter OAuth in PHP</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>
    <div>
      <h2>Welcome to a Twitter OAuth PHP example.</h2>

      <p>This site is a basic showcase of Twitters OAuth authentication method. If you are having issues try <a href='./clearsessions.php'>clearing your session</a>.</p>

      <p>
        Links:
        <a href='http://github.com/abraham/twitteroauth'>Source Code</a> &amp;
        <a href='http://wiki.github.com/abraham/twitteroauth/documentation'>Documentation</a> |
        Contact @<a href='http://twitter.com/abraham'>abraham</a>
      </p>
      <hr />
      <?php if (isset($menu) && is_string($menu)) { ?>
        <?php echo htmlspecialchars($menu, ENT_QUOTES, 'UTF-8'); ?>
      <?php } ?>
    </div>
    <?php if (isset($status_text) && is_string($status_text)) { ?>
      <?php echo '<h3>'.htmlspecialchars($status_text, ENT_QUOTES, 'UTF-8').'</h3>'; ?>
    <?php } ?>
    <div>
      <pre>
        <?php if (isset($content) && (is_array($content) || is_object($content))) {
            echo htmlspecialchars(json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');
        } ?>
      </pre>
    </div>

  </body>
</html>
