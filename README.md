# PHP Include and Form Validation

My Stellar website from a past lab, changed from HTML to PHP for this assignment.

## Files uploaded
- index.php: main page, it only uses include for each section
- includes folder: the section files (header, navigation, hero, scale, galaxies, planets, footer, scripts, config, auth_sky)
- login.php and register.php: forms with PHP validation using regular expressions
- logout.php, style.css, script.js
- CODE_SCREENSHOTS.pdf: screenshots of the code
- OUTPUT_SCREENSHOTS.pdf: screenshots of the output

## Regex rules
- Name: letters, spaces, apostrophe, dot, hyphen (2 to 60 characters)
- Email: valid email format
- Password: at least 6 characters, with a letter and a number

## How to run
Put the files in XAMPP's htdocs, start Apache, then open
http://localhost/agna_php/login.php

Demo account: admin / 12345