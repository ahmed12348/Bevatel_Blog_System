# User and Role Management System

A web-based application for managing users and their roles with a permission-based access system. This project is built using Laravel, designed with scalability and ease of use in mind.

---

## 🌟 Features

- Role-based access control (RBAC)
- User management with search and pagination
- Role management with permissions
- Import/export functionality for users
- Blog CRUD with export and import options
- Responsive and intuitive dashboard interface

---

## 🛠️ Tech Stack

- **Backend**: Laravel
- **Frontend**: Blade Templates, Bootstrap
- **Database**: MySQL
- **Other Tools**: Maatwebsite Excel for import/export

---

## 📋 Prerequisites

Make sure you have the following installed:

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL
- Git

---

## 🚀 Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/ahmed12348/Bevatel_Blog_System.git
    cd Bevatel_Blog_System
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Configure the environment:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Update the `.env` file with your database credentials.

4. Run migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```

5. Start the server:
    ```bash
    php artisan serve
    npm run dev
    ```

Access the application at `http://localhost:8000`.

---

## 🌐 Deployment

### Deploy to a Hosting Provider:
1. Upload your project files to the server.
2. Set up the environment file (`.env`) with production credentials.
3. Run migrations on the production server:
    ```bash
    php artisan migrate --force
    ```
4. Set permissions for storage and bootstrap directories:
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```

---

## 🛡️ Permissions Overview

### User Permissions
- `view_users`: View users.
- `create_users`: Create new users.
- `edit_users`: Edit existing users.
- `delete_users`: Delete users.

### Role Permissions
- `role-list`: View roles.
- `role-create`: Create roles.
- `role-edit`: Edit roles.
- `role-delete`: Delete roles.

### Blog Permissions
- `view_blog`: View blogs.
- `create_blog`: Create blogs.
- `edit_blog`: Edit blogs.
- `delete_blog`: Delete blogs.
- `export_blog`: Export blogs.
- `import_blog`: Import blogs.

---

## 📑 How to Contribute

1. Fork the repository.
2. Create a feature branch:
    ```bash
    git checkout -b feature-name
    ```
3. Commit your changes:
    ```bash
    git commit -m "Add some feature"
    ```
4. Push to the branch:
    ```bash
    git push origin feature-name
    ```
5. Open a pull request.

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 📬 Contact

If you have any questions or feedback, feel free to contact:

- **Email**: ahmed.elbatal954@gmail.com
- **GitHub**: [yourusername](https://github.com/ahmed12348)


---

Thank you for using this system! Your contributions are always welcome! 🚀
