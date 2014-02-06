<?php

function show_run($text, $command, $canFail = false)
{
    echo "\n* $text\n$command\n";
    passthru($command, $return);
    if (0 !== $return && !$canFail) {
        echo "\n/!\\ The command returned $return\n";
        exit(1);
    }
}


show_run("Changing permissions", "chmod -R 777 app/cache app/logs web/");
show_run("database:drop", "app/console doctrine:database:drop --force");
show_run("database:drop", "app/console doctrine:mongodb:schema:drop");

show_run("database:create", "app/console doctrine:database:create");
show_run("mongodb:schema:create", "app/console doctrine:mongodb:schema:create --index");
show_run("schema:update", "app/console doctrine:schema:update --force");

show_run("braincrafted:install", "app/console braincrafted:bootstrap:install");

show_run("Destroying cache dir manually", "rm -rf app/cache/*");   

show_run("Creating directories for app kernel", "mkdir -p app/cache/dev app/logs");   

show_run("Warming up dev cache", "php app/console --env=dev cache:clear");

show_run("Changing permissions", "chmod -R 777 app/cache app/logs web/");
show_run("fixtures:load", "app/console doctrine:mongodb:fixtures:load --no-interaction");

show_run("assets:install", "app/console assets:install --symlink");
show_run("assets:dump", "app/console assetic:dump");

show_run("Warming up dev cache", "php app/console --env=dev cache:clear --no-warmup");
show_run("Changing permissions", "chmod -R 777 app/cache app/logs web/");   

exit(0);