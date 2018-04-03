# server-monitor
a server minitoring application which can show realtime stats using websocket subscribe feature

- Do you feel like having a monitor in your server room which can show server status without much lag.
- Do you feel that processes aren't able to give their output to you

This app uses *zero mq* to send data from one php script to ratchet web socket. User can use the checkbox to subscribe or unsubscribe from updates

For this the steps are as follows:

1. install zmq from https://windows.php.net/downloads/pecl/releases/zmq/

If you are on PHP 7, then go in the `1.1.3` release . If your PHP version is `5.6`, then go to `1.1.2`. Then if you are using XAMPP for windows on windows 8 or 7, then go on to download the `php_zmq-1.1.2-5.6-ts-vc11-x86.zip`

zmq installs as PHP extension, you you have to copy the `php_zmq.dll` into the *ext* folder of php and add a line in php.ini
    extension=php_zmq.dll

After this, you can restart apache server so that zmq is available on web interface as well ( I think we will be using that from cli only)
If you happen to have some errors like can't find `libzmq.dll`, then copy this dll in `apache` and `php/ext` folders

Now you can run the pusher web socket server (that listens on *8080* port; you can change that from `bin\push-server.php`) by
    php bin/push-server.php

To test the logger, which reads from STDIN and writes to tcp port 5555, you can run
    echo "test" | php bin/logger.php

This will show up the content so sent (test here), into the websocket frames. 

# Next steps:

1. Formatting the apache logs in json format before sending to pusher
2. alter code to accept json for datatable and render the data on new row in table
3. Add functionality for other server vitals like memory, cpu, mysql processlist, etc,.

# how to run

- in one terminal run the push-server by `php bin/push-server`
- in another terminal, where you have incoming access logs or any other stream of date, run *tail -f* like this:

    tail -f access.laravel.local.log | php /var/www/html/server-monitor/bin/logger.php

Now you just have to subscribe to topic using checkbox and now you can see realtime logs of server on your browser



