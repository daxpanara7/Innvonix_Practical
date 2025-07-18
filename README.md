📝 Task Management System
A full-stack Task Management web application using Laravel 12 (API) and React.js for managing tasks with features like:

User Authentication (Register/Login)

Task CRUD (Create, Read, Update, Delete)

Role-based permissions (Admin/User)

Email notifications on task assignment

Filtering, Search, Validation, and Toast notifications

Modern, responsive UI

📁 Project Structure

/task-backend        -> Laravel 12 REST API
/task-frontend       -> React.js UI (React Router, Axios, Toastify)

⚙️ Backend Setup (Laravel 12)
⚛️ Frontend Setup (React.js)

✅ Prerequisites:
PHP ≥ 8.2


🔐 API Authentication
 use Laravel Sanctum for authentication.

⚛️ Frontend Setup (React.js)

🧑‍💼 Admin vs User Roles (Bonus Feature)
Admin users can view all tasks, assign tasks to users.

Regular users can view only their own tasks.

Admin middleware applied in Laravel using role field (admin or user).

📬 Email Notification (Bonus Feature)
When a task is assigned, an email is sent to the assigned user using Laravel's Mail class.

Preview Emails:
Use Mailtrap or any test SMTP server.

✅ Features Implemented
Feature	Status ✅
Register & Login with Sanctum	✅
Task CRUD (Create/Edit/Delete)	✅
Filter/Search by Status/Priority	✅
Toast Notifications	✅
Email Notification on Assignment	✅
Admin/User Role-Based Access	✅
Form Validation (Frontend + Backend)	✅
Loader UI during task submit	✅
Protected Routes using Context	✅

🔐 Default Users
Role	Email	Password
Admin	admin@example.com	password
User	user@example.com	password




