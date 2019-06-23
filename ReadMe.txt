Tenderama is an online tendering system developed by a team of 2 for a project using php, js and runs on a xampp server.
This is the Informatics and Computer Systems Project of 100446 AND 99460 during their year 2 at Strathmore University for the award of a Degree.

<----------------------------------------------------------------------------------------------------------------------------------------->

Please note initial configuration before use:
->The folder 'Fixes' contains an sql file. Please import it into your database of choice and alter the 'config.php' file accordingly.
The database is already populated with sample data. Please refer to it for credentials.
->The folder 'Fixes' also contains two files in the 'Mail' subfolder.
--->Import the 'php.ini' folder into your server's php folder. It is advisable to backup the original file beforehand.
--->Import the 'sendmail.ini' folder into your server's sendmail folder. It is advisable to backup the original file beforehand.
--->If your server is already configured to allow for mail then set your configuration details as follows:
smtp_port=587
smtp_server = smtp.gmail.com
auth_username = tenderama254@gmail.com
auth_password = Julian2.2
sendmail_from = tenderama254@gmail.com
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
--->Remember to restart your server to load the changes made.
->The 'applications' folder contains sample application documents from tenderers. Altering them would cause an exception and a breach of security.
->The 'assets' folder contains images and styling and scripts used for various pages hence should not be altered.
