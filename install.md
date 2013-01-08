Install / Setup
---------------


1) Clone / fork repo. 

2) Download yii from http://www.yiiframework.com/download/ (I have done most of my dev on 1.1.12 but I *believe* it should be pretty much the same until yii 2.0)

3) Update the yii file path in confess.io / index.php

4) Import confess_io.sql into mysql. (phpMyAdmin seems to be much more stable with this. I tested with mySQL workbench and got a lot of errors)

5) Make sure config settings are right in confess.io / protected / config / main.php (main things to look at are DB settings, and [optional] email settings)

6) Make sure confess.io / protected / runtime and confess.io / assets are writable by the server

7) Have fun!

