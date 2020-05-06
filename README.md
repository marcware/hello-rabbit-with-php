
## Code

[Tutorial one: "Hello World!"](https://www.rabbitmq.com/tutorials/tutorial-one-php.html):

    php send.php
    php receive.php


[Tutorial two: Work Queues](https://www.rabbitmq.com/tutorials/tutorial-two-php.html):

    php new_task.php "A very hard task which takes two seconds.."
    php worker.php
    
    Colas durable true, tanto al consumer como al producer


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
