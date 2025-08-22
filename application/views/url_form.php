<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Pemendek URL</title>
  <style>
    body {
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f2f5;
      margin: 0;
    }

    .container {
      text-align: center;
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 500px;
    }

    h1 {
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 1.5rem;
    }

    input[type="url"],
    input[type="text"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .customize-group {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .result {
      margin-top: 1.5rem;
    }

    .result a {
      word-break: break-all;
      color: #0056b3;
    }

    .error {
      color: red;
      margin-top: 1rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Pemendek URL</h1>
    <?php echo form_open('url/shorten'); ?>
    <input type="url" name="original_url" placeholder="Masukkan URL panjang di sini" required>
    <div class="customize-group">
      <span><?php echo base_url(); ?></span>
      <input type="text" name="custom_alias" placeholder="Alias (opsional)">
    </div>
    <button type="submit">Perpendek</button>
    <?php echo form_close(); ?>

    <?php if (isset($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (!empty($shortened_url)): ?>
      <div class="result">
        <p>URL pendek kamu:</p>
        <a href="<?php echo $shortened_url; ?>" target="_blank"><?php echo $shortened_url; ?></a>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>