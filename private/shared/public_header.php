<!doctype html>

<html lang="en">
  <head>
    <title>Globe Bank <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <a href="<?php echo url_for('/index.php'); ?>">
          <img src="<?php echo url_for('/images/gbi_logo.jpg'); ?>" width="150" height="100" alt="" />
        </a>
      </h1>
    </header>
