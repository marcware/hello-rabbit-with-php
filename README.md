# Demo RabbitMQ implementation in PHP

https://www.bizmate.biz/news/it-articles/getting-started-with-php-and-rabbitmq-queues-using-docker-in-style/

Using `php-amqplib/php-amqplib` with a full dockerised setup to minimise setup and provide a fully working environment.
Based on https://www.rabbitmq.com/tutorials/tutorial-two-php.html

This setup works on Macs and Linux, not tested on Windows

## Start stack

`make up`

Once rabbitMQ is started you can see the queue in the management console at  http://localhost:15672/#/queues

## Send several messages

This steps calls the sender infinitely to start queueing messages. Notice that the queue will grow considerably so to
stop it do it in your console with CTRL + C (or similar depending on your Operating system)

`make push_jobs`

## See the logs

`make tail`

## Stop the stack

`make down`

# PHP code for RabbitMQ tutorials

Here you can find PHP code examples from [RabbitMQ
tutorials](https://www.rabbitmq.com/getstarted.html).

To successfully use the examples you will need a running RabbitMQ server.

## Requirements

### PHP 5.3+

You need `PHP 5.3` and `php-amqplib`. To get these
dependencies on Ubuntu type:

    sudo apt-get install git-core php5-cli


### Composer

Then [install Composer](https://getcomposer.org/download/) per instructions on their site.


### Client Library

Then you can install `php-amqplib` using [Composer](https://getcomposer.org).

To do that install Composer and add it to your path, then run the following command
inside this project folder:

    composer.phar install
    
Or you can require it to the existing project using a command:

    composer.phar require php-amqplib/php-amqplib

## Code

[Tutorial one: "Hello World!"](https://www.rabbitmq.com/tutorials/tutorial-one-php.html):

    php send.php
    php receive.php


[Tutorial two: Work Queues](https://www.rabbitmq.com/tutorials/tutorial-two-php.html):

    php new_task.php "A very hard task which takes two seconds.."
    php worker.php


[Tutorial three: Publish/Subscribe](https://www.rabbitmq.com/tutorials/tutorial-three-php.html)

    php receive_logs.php
    php emit_log.php "info: This is the log message"

[Tutorial four: Routing](https://www.rabbitmq.com/tutorials/tutorial-four-php.html):

    php receive_logs_direct.php info
    php emit_log_direct.php info "The message"


[Tutorial five: Topics](https://www.rabbitmq.com/tutorials/tutorial-five-php.html):

    php receive_logs_topic.php "*.rabbit"
    php emit_log_topic.php red.rabbit Hello

[Tutorial six: RPC](https://www.rabbitmq.com/tutorials/tutorial-six-php.html):

    php rpc_server.php
    php rpc_client.php
