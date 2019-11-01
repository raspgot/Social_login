<?php
    require __DIR__ . '/vendor/autoload.php';
    require 'config.php';

    use Hybridauth\Hybridauth;
    $hybridauth = new Hybridauth($config);
    $adapters = $hybridauth->getConnectedAdapters();
    
    if ($adapters) {
        $db = new MysqliDb ('localhost', 'root', '', 'social');
        foreach ($adapters as $name => $adapter) {
            $userInfo = $adapter->getUserProfile();
            dump($userInfo);
            $data = Array (
                'oauth_provider' => $name,
                'oauth_uid'      => $userInfo->identifier,
                'first_name'     => $userInfo->firstName,
                'last_name'      => $userInfo->lastName,
                'username'       => $userInfo->displayName,
                'email'          => $userInfo->email,
                'picture'        => $userInfo->photoURL,
                'link'           => $userInfo->profileURL,
                'created_at'     => $db->now(),
            );
        }
        $id = $db->insert ('users', $data);
    }

    $title = 'Social Login';
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <title><?=$title?></title>
  </head>

  <body>
    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1"><?=$title?></span>
    </nav>
    <div class="container-fluid mt-4">
        <?php foreach ($hybridauth->getProviders() as $name) : ?>
            <?php if (!isset($adapters[$name])) : ?>
                    <a href="<?= $config['callback'] . "?provider={$name}"; ?>" class="btn btn-info btn-lg">
                    Sign in with <strong><?= $name ?></strong>
                    </a>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($adapters) : ?>
            <h1 class="mt-3">You are logged in:</h1>
            <ul>
                <?php foreach ($adapters as $name => $adapter) : ?>
                    <li>
                        <strong><?= $adapter->getUserProfile()->displayName; ?></strong> from
                        <i><?= $name; ?></i>
                        <span>(<a href="<?= $config['callback'] . "?logout={$name}"; ?>">Log Out</a>)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
  </body>

</html>