**Professional Blog - PHP Project**

**Project Overview**

This project is part of a professional training in PHP web development. It consists of creating a personal blog to showcase my skills as a PHP developer. The website is divided into two main sections:
- Public pages accessible to all visitors.
- An administration section for managing blog posts, accessible only to registered and validated users.
The blog serves as a portfolio and a platform to demonstrate my proficiency in web development, while maintaining best practices in terms of security and project management.

**Features**

**Public Pages:**

- Home Page: displays my name, a photo/logo, a tagline, a contact form (name, email, message), a link to my CV (PDF), and social media links (GitHub, LinkedIn, Twitter, etc.).
- Blog Page: lists all blog posts (sorted by date), showing the title, last modified date, a short summary, and a link to the full blog post.
- Single Blog Post Page: displays the full content of a blog post including title, summary, content, author, last update date, and a comment form. A list of approved and published comments is also displayed.
- User Authentication: user registration and login functionalities.

**Administration Pages (Restricted Access):**

- Add Blog Post (Admin page): allows administrators to add new blog posts (title, summary, content, author).
- Edit Blog Post : allows administrators to modify the title, summary, content, and author of an existing post.
- Delete Blog Post (Admin page): allows administrators to delete blog posts.
- My account: allows registered users to access, modify and delete their personal data and comments.

Only administrators can access the blog management interface. Regular users can leave comments, but they themselves need to be registered, and comments require approval before publication.

**Security:**

Implemented measures to prevent vulnerabilities such as XSS, CSRF, SQL Injection, session hijacking, and unauthorized file uploads.

**Technologies Used**

PHP: For backend development and server-side logic.
MySQL: To manage the database and store blog posts, user data, and comments.
Theme: Zenblog with Bootstrap
Composer: For managing external PHP libraries and dependencies.

**Installation**

Requirements:
PHP 7.4 or higher
MySQL
Composer

**Setup Instructions:**

Clone the repository: git clone https://github.com/username/project-name.git

Navigate to the project directory: cd project-name

Install dependencies with Composer: composer install

Create a .env file for your environment variables, including your database credentials.

Import the database structure (SQL dump provided in the repository): mysql -u username -p database_name < database.sql

Run the project using a local server or deploy it to a web hosting environment.

**Usage:**

Open your browser and go to the home page: http://localhost/the_project_name/.
To access the admin panel, register an account and log in as an administrator.

**Issues & Pull Requests**

All development tasks are tracked via issues in this repository. Each feature is implemented and reviewed through pull requests.

**License**
This project is open-source and available under the MIT License.
