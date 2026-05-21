## 🛠️ Installation & Setup

Follow these steps to get the project running locally on your machine.

### Prerequisites

Ensure you have the following installed on your system:
* **PHP**: `^8.2` or higher
* **Composer**: For managing PHP dependencies
* **Node.js & NPM**: For compiling assets
* **Database**: SQLite

---

### 1. Clone the Repository

```bash
git clone https://github.com/syfullzaedy/mobeecars.app.git
cd mobeecars.app
```

### 2. Install Dependencies

Install the required backend and frontend packages:

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Configuration

Copy the local environment file to create your local configurations:

```bash
cp .env.local .env
```

### 4. Run Database Migrations & Seeders

Create the database tables and populate them with initial data (if seeders exist):

```bash
php artisan migrate
```

### 5. Compile Assets

Compile your frontend assets using Vite:

```bash
# For local development (live-reloads asset changes)
npm run dev

# OR build assets for production
npm run build
```

### 6. Link Storage (Optional)

If your project handles file uploads or public media, link the storage directory:

```bash
php artisan storage:link
```

### 7. Start the Local Server

Run the built-in PHP development server:

```bash
php artisan serve
```

The application will now be accessible locally at [http://127.0.0.1:8000](http://127.0.0.1:8000).
