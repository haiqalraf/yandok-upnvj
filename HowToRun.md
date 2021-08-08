Requirement:
  Composer    https://getcomposer.org/Composer-Setup.exe
  NPM/nodeJs  https://nodejs.org/dist/v14.17.0/node-v14.17.0-x64.msi

Step to run:
  1. Place all file in ../xampp/htdocs/FolderName
  2. Create .env file from .env.example and fill APP_KEY
  3. Add UPN_API_KEY="Basic c2lha2FkOlMxNGs0ZA==" in .env file
  4. open folder directory in cmd or PowerShell
  5. run Apache and MySQL in XAMPP
  6. run "php artisan migrate", "php artisan db:seed"
  7. run "php artisan serve" and let the command run (dont close the cmd or PowerShell windows), this command is used to run application in php development server
  8. access "http://localhost:8000/" in your web browser (its the default domain if you haven't change anything)

note:

login username and password

user/mahasiswa  : 18105

superadmin      : 18106

akpk            : 18107

dekan           : 18108

password: 123456
