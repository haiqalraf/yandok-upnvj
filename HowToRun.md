Requirement:
  Composer    https://getcomposer.org/Composer-Setup.exe
  NPM/nodeJs  https://nodejs.org/dist/v14.17.0/node-v14.17.0-x64.msi

Step to run:
  1. Extract all file in ../xampp/htdocs/FolderName
  2. open folder directory in cmd or PowerShell
  3. run Apache and MySQL in XAMPP
  4. run "composer install"
  5. run "composer update"
  6. run "npm install"
  7. run "npm update"
  8. run "php artisan migrate:fresh --seed" to add data user to database
  9. run "php artisan serve" and let the command run (dont close the cmd or PowerShell windows), this command is used to run application in php development server
  10. access "http://localhost:8000/" in your web browser (its the default domain if you haven't change anything)

note:

login username and password

user/mahasiswa  : 1810511

superadmin      : 18110

akpk            : 18109

dekan           :
  feb           : 18101
  fk            : 18102
  ft            : 18103
  fisip         : 18104
  fik           : 18105
  fh            : 18106
  fikes         : 18107

password: 123456
