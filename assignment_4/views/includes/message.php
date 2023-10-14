<?php 
      if(isset($_SESSION['error'])){ ?>
        <?php $errors = (array)  App\Classes\Session::getFlashMessage('error')?>
        <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"">
          <?php foreach(array_flatten($errors) as $message){ ?>
            <li><?= $message ?></li>
          <?php } ?>
        </ul>
      <?php } ?>

<?php 
      if(isset($_SESSION['success'])){ ?>
        <?php $successes = (array)  App\Classes\Session::getFlashMessage('success')?>
        <ul class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert"">
          <?php foreach(array_flatten($successes) as $message){ ?>
            <li><?= $message ?></li>
          <?php } ?>
        </ul>
      <?php } ?>