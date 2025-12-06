# Student Management API - Symfony Demo Project

This is a Symfony 7.4 API project for managing students and classrooms, developed for SUPMTI CISI3 course.


## How to Clone the Project

```bash
git clone https://github.com/AbdelilahJbTeaching/demo_supmti.git
cd demo
```

## How to Install Dependencies

1. **Install PHP dependencies with Composer:**
   ```bash
   composer install
   ```

## Database Configuration

### How to Change Database URL

1. **Edit the `.env` file and update the `DATABASE_URL`:**
   ```dotenv
   # Example configurations:
   
   # For MySQL/MariaDB:
   DATABASE_URL="mysql://username:password@127.0.0.1:3306/database_name?serverVersion=8.0.40&charset=utf8mb4"
   
   # For PostgreSQL:
   DATABASE_URL="postgresql://username:password@127.0.0.1:5432/database_name?serverVersion=15&charset=utf8"
   ```

2. **Current configuration example:**
   ```dotenv
   DATABASE_URL="mysql://root:root@127.0.0.1:8889/demo_supmti?serverVersion=8.0.40&charset=utf8mb4"
   ```

### How to Launch Migrations

1. **Create the database:**
   ```bash
   php bin/console doctrine:database:create
   ```

2. **Run migrations to create tables:**
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

## Starting the Development Server

```bash
symfony server:start
```

The API will be available at `http://localhost:8000`

## API Endpoints

The StudentController provides the following endpoints:

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/student` | List all students |
| GET | `/student/{id}` | Get a specific student |
| POST | `/student` | Create a new student (with classroom) |
| PUT | `/student/{id}` | Update a student |
| DELETE | `/student/{id}` | Delete a student |

## How to Test the Controller with Postman

### 1. Import Postman Collection

Create a new Postman collection with the following requests:

### 2. Set Base URL

Set a collection variable:
- Variable: `baseUrl`
- Value: `http://localhost:8000`

### 3. API Requests

#### **GET - List All Students**
```
Method: GET
URL: {{baseUrl}}/student
Headers: 
  Content-Type: application/json
```

#### **GET - Get Student by ID**
```
Method: GET
URL: {{baseUrl}}/student/1
Headers: 
  Content-Type: application/json
```

#### **POST - Create New Student**
```
Method: POST
URL: {{baseUrl}}/student
Headers: 
  Content-Type: application/json
Body: (none - this endpoint creates a hardcoded student)
```

**Note:** The current implementation creates a hardcoded student with:
- Name: "Abdelilah Jabri"
- Date of Birth: "1997-04-09"
- Classroom: "CISI" Level 3

#### **PUT - Update Student**
```
Method: PUT
URL: {{baseUrl}}/student/1
Headers: 
  Content-Type: application/json
Body: (none - this endpoint updates name to "Amine Jabri")
```

#### **DELETE - Delete Student**
```
Method: DELETE
URL: {{baseUrl}}/student/1
Headers: 
  Content-Type: application/json
```

### 4. Expected Response Formats

#### Success Responses:
```json
// GET /student (List all)
[
  {
    "id": 1,
    "fullname": "Abdelilah Jabri",
    "dateOfBirth": "1997-04-09T00:00:00+00:00",
    "classroom": {
      "id": 1,
      "name": "CISI",
      "level": 3
    }
  }
]

// GET /student/1 (Single student)
{
  "id": 1,
  "fullname": "Abdelilah Jabri",
  "dateOfBirth": "1997-04-09T00:00:00+00:00",
  "classroom": {
    "id": 1,
    "name": "CISI", 
    "level": 3
  }
}
```

#### Error Responses:
```json
// Student not found (404)
{
  "message": "Student not found"
}
```

### 5. Testing Workflow

1. **Start with POST** to create a student
2. **Use GET** to list all students and verify creation
3. **Use GET with ID** to fetch the specific student
4. **Use PUT** to update the student
5. **Use GET with ID** again to verify the update
6. **Use DELETE** to remove the student
7. **Use GET** to verify deletion
## Project Structure

```
src/
├── Controller/
│   └── StudentController.php     # API endpoints
├── Entity/
│   ├── Student.php               # Student entity
│   └── Classroom.php             # Classroom entity
├── Service/
│   └── StudentService.php        # Business logic for students
└── Repository/
    ├── StudentRepository.php     # Student database operations
    └── ClassroomRepository.php   # Classroom database operations
```

## Additional Commands

### Clear Cache
```bash
php bin/console cache:clear
```

### Generate New Migration
```bash
php bin/console make:migration
```

### Validate Schema
```bash
php bin/console doctrine:schema:validate
```

## Troubleshooting

### Database Connection Issues
- Verify MySQL/MariaDB server is running
- Check DATABASE_URL credentials
- Ensure database exists

### Permission Issues
```bash
chmod -R 777 var/
```

### Clear Cache and Logs
```bash
rm -rf var/cache/* var/log/*
```

## Development Notes

This is a demo project for educational purposes. The current implementation:
- Uses hardcoded data in create/update methods
- Lacks input validation
- Missing proper error handling
- No authentication/authorization
