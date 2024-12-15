

https://maheshsamudra.medium.com/creating-a-simple-php-mvc-framework-from-scratch-7158f12340a0


 https://phptherightway.com/


 https://www.nikolaposa.in.rs/blog/2017/01/16/on-structuring-php-projects/



login
logout
signup
home
products
products-info
about
contact
user-profile

admin

'/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%!*\-])[A-Za-z\d@#$%!*\-]{8,}$/'

/^: Start of the regex.
(?=.*[A-Za-z]): Ensures the password contains at least one letter.
(?=.*\d): Ensures the password contains at least one digit.
(?=.*[@#$%!*\-]): Ensures the password contains at least one of the allowed symbols (@, #, $, %, !, *, -).
[A-Za-z\d@#$%!*\-]{8,}: Matches passwords that are at least 8 characters long and contain letters, digits, or the specified symbols.
$/: End of the regex.


beautify


http://localhost/web2202/cart.php
http://localhost/phpmyadmin/index.php