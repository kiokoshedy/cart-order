# **Cart-Order Application**

## **Documentation**

### **1. How to Run the Application Locally**

#### **Backend (Laravel Project)**

##### **Prerequisites**
- PHP >= 8.1
- Composer >= 2.0
- PostgreSQL database
- Redis
- Node.js >= 18.x and npm (for frontend assets, optional)
- Docker (optional, for containerized setup)

---

##### **Steps to Set Up**

2. **Install Dependencies**
   - Install PHP dependencies using Composer:
     ```bash
     composer install
     ```
   - Install Node.js dependencies (optional, for frontend assets):
     ```bash
     npm install
     ```

3. **Configure Environment**
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database and Redis credentials:
     ```dotenv
     DB_CONNECTION=pgsql
     DB_HOST=localhost
     DB_PORT=5432
     DB_DATABASE=cart_order
     DB_USERNAME=postgres
     DB_PASSWORD=data

     REDIS_HOST=127.0.0.1
     REDIS_PORT=6379
     ```

4. **Set Application Key**
   Generate the Laravel application key:
   ```bash
   php artisan key:generate

5. **Run Database Migrations**

   Run migrations to set up the database tables:
   ```bash
   php artisan migrate

6. **Run Redis Server**
    Start Redis in the background:
    ```bash
    redis-server

7. **Start the Laravel Development Server**
    ```bash
    php artisan serve

8. **Access the Backend**
    http://127.0.0.1:8000
