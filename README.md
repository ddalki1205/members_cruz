## READ ME
  - This code is work in progress
  - I'm f****d if this is not allowed, yet"
  - Sir will prolly question who made this
  - Boss parang awa gaya-gaya lang nmn ako sa ibang tao sa github, pa approve pu plspslpslsplspls


## UPDATES MADE
  - User.php : separated the function inside "--register-view-users.php--" and put it in this file. (para di makalat!)
  - RegisterController.php : this controller/function came originally from "--register-page.php--" (para di makalat!)


## FUNCTIONALITIES
  - User can register using first name, last name, email, and password
  - User cannot re-use registered emails!


## TO ADD/FIX
  - Add pages for  hypertext transfer protocol (HTTP) standard response code (prolly 404, 408, or the common top 10)
  - Make password req atleast 1 num 1 symbol and should be 8 characters long
  - Fix info column


## LAYOUT
```
/registration_system/
├── README.md                                        # Project documentation
|
├── /public/                                         # Publicly accessible files
│   ├── index.php                                    # Main entry point of the application
│   |
│   ├── /css/               
│   │   ├── info-col.css
│   │   ├── registration-thanks.css
│   │   ├── registration.css
│   │   └── web_design.css
│   |
│   ├── /images/                                     # Image files (if any)
│   │   ├── Twice.png
│   │   └── art.png
│   │
│   └── /assets/                                     # Other assets (fonts, etc.) TO be USED for final designs SOON!
|
├── /src/                                            # Source code for web logic
│   ├── /controllers/                                # Controllers for handling logic 
│   │   └── RegisterController.php
│   │
│   ├── /models/                                     # Database models
│   │   └── User.php                                 # I removed this so register-view-users.php wont look super cluttered
│   │
│   ├── /views/                                      # Views (HTML files)
│   │   ├── register-page.php
│   │   ├── register-thanks.php
│   │   ├── register-view-users.php
│   │   └── about_us.php
│   │
│   ├── /includes/                                   # Reusable components (header, footer, etc.)
│   │   ├── header.php
│   │   ├── header_small.php
│   │   ├── info-col.php
│   │   ├── footer.php
│   │   └── nav.php
│   │
└── └── /config/                                     # Configuration files
        └── mysqli_connect.php                       # Database connection file
```