# Todo List Application

## Features ✨
- ✅ Create, Read, Update, and Delete (CRUD) tasks
- 🔄 Toggle task completion status
- 📁 Separate sections for Active and Completed tasks
- 🎨 Clean and modern user interface
- 📱 Responsive design
- ⚡ Real-time updates without page reload
- 🔒 Form validation and CSRF protection
- 💾 MySQL database integration

## Technologies Used 🛠️
- **Backend Framework**: Laravel 11
- **Frontend**: HTML5, CSS3, JavaScript
- **Database**: MySQL
- **Styling**: Custom CSS with modern design
- **Server**: PHP 8.1+
- **Package Manager**: Composer

## Installation Guide 🚀

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js (optional for asset compilation)

### Setup Steps
1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/laravel-todo-list.git
   cd laravel-todo-list
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   - Create a MySQL database
   - Update `.env` file:
     ```env
     DB_DATABASE=your_database_name
     DB_USERNAME=your_db_username
     DB_PASSWORD=your_db_password
     ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` in your browser to access the application.

## Usage 📚

### Managing Tasks
- **Add Task**:
  - Type in the input field at the top
  - Click the "Add" button
  - Minimum 3 characters required

- **Complete Task**:
  - Check the checkbox next to a task
  - Automatically moves to the Completed section

- **Delete Task**:
  - Click the "Delete" button next to any task
  - Confirm deletion

- **Toggle Completion**:
  - Uncheck completed tasks to move them back to Active

## Project Structure 📂
```
laravel-todo-list/
├── app/
│   └── Http/Controllers/TodoController.php   # Main controller
├── database/
│   └── migrations/                           # Database schemas
│       └── ***_create_todos_table.php        # Todos migration
├── resources/
│   └── views/
│       └── todos/
│           └── index.blade.php               # Main view
├── public/
│   └── assets/
│       ├── css/
│       │   └── style.css                     # Custom styles
│       └── js/
│           └── app.js                        # JavaScript logic
├── routes/
│   └── web.php                               # Application routes
└── .env.example                              # Environment template
```

## API Endpoints 🌐
| Method | Endpoint          | Description                |
|--------|-------------------|----------------------------|
| GET    | /todos            | List all todos             |
| POST   | /todos            | Create a new todo          |
| PATCH  | /todos/{id}        | Update a todo              |
| DELETE | /todos/{id}        | Delete a todo              |
| PATCH  | /todos/{id}/toggle | Toggle completion status   |

## Contributing 🤝
Contributions are welcome! Please follow these steps:
1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License 📝
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments 🙏
- Built with [Laravel](https://laravel.com)
- UI inspired by modern task management apps
- Fonts by [Bunny Fonts](https://fonts.bunny.net)

---

**Happy Task Managing!** 🎉

