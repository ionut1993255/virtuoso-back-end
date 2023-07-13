# Back-end Virtuoso

Welcome to my "Virtuoso Synthesizer" app !!!

This is a complex app which I'm using to sing different songs with different instruments and to record and save my own musical compositions. I created the front-end with HTML, CSS and JavaScript. For the backend I created a RESTful API with the help of PHP and the Symfony framework. I made the connection to the MySQL database using the Doctrine library from Symfony. In this repository I put the back-end code. You can see the detached front-end by accessing this link: [https://github.com/ionut1993255/virtuoso-back-end](https://github.com/ionut1993255/virtuoso-front-end)

To activate the back-end you must install some tools by typing the following commands in the terminal of your IDE (Integrated Development Environment):

Composer Installation:
1. php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
2. php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
3. php composer-setup.php --install-dir=/usr/local/bin --filename=composer

Doctrine Installation:
1. php bin/console doctrine:database:create
   
Here you can see a small presentation of the project:

[Ilisei Ion - Presentation Virtuoso Synthesizer App.pptx](https://github.com/ionut1993255/virtuoso-back-end/files/12042688/Ilisei.Ion.-.Presentation.Virtuoso.Synthesizer.App.pptx)

Check out the custom favicon *wink *wink

Hope you enjoy !!!
