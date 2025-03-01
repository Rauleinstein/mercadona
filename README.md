# Recipe App

A modern recipe management application built with Symfony 6.4 + EasyAdmin 3 backend and Next.js 14 + Shadcn UI + Tailwind CSS frontend.

## Features

- Recipe management with detailed information
- Ingredient database with pricing
- Shopping list management
- Social features (sharing, following, rating)
- Smart recipe scaling and cost calculation
- Advanced search and filtering

For a complete list of features and roadmap, see the `.roadmap` file.

## Tech Stack

### Backend
- Symfony 6.4
- EasyAdmin 3
- API Platform
- PostgreSQL 15
- JWT Authentication
- Doctrine ORM

### Frontend
- Next.js 14
- TypeScript
- Shadcn UI
- Tailwind CSS
- React Query
- React Hook Form
- Zod Validation

## Prerequisites

- Docker and Docker Compose
- Node.js 20.x
- PHP 8.2+
- Composer
- Make (optional, but recommended)

## Development Setup

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd recipe-app
   ```

2. Copy environment files:
   ```bash
   cp .env.example .env
   cp frontend/.env.example frontend/.env
   cp backend/.env.example backend/.env
   ```

3. Start Docker containers:
   ```bash
   make start
   # or
   docker-compose up -d
   ```

4. Install dependencies:
   ```bash
   make install
   # or
   docker-compose exec backend composer install
   docker-compose exec frontend npm install
   ```

5. Set up the database:
   ```bash
   docker-compose exec backend php bin/console doctrine:migrations:migrate
   ```

6. Generate JWT keys (for authentication):
   ```bash
   docker-compose exec backend php bin/console lexik:jwt:generate-keypair
   ```

## Development

### Running the Application

- Frontend: http://localhost:3000
- Backend API: http://localhost:8000
- Admin Panel: http://localhost:8000/admin
- API Documentation: http://localhost:8000/api/docs

### Common Commands

```bash
# Start all services
make start

# Stop all services
make stop

# Frontend development
make frontend-dev

# Backend development
make backend-start

# Run tests
make frontend-test
make backend-test

# Linting
make frontend-lint
make backend-lint

# Database commands
make db-migrate    # Run migrations
make db-diff       # Generate migration diff
make db-fixtures  # Load fixtures

# Clean up
make clean
```

### Code Style and Standards

#### Backend (PHP)
- Follow PSR-12 coding standards
- Use type hints and return types
- Write PHPUnit tests for business logic
- Document API endpoints with OpenAPI/Swagger

#### Frontend (TypeScript)
- Follow ESLint and Prettier configurations
- Use TypeScript strict mode
- Write component tests with Jest and Testing Library
- Follow React best practices and hooks guidelines

### Git Workflow

1. Create a feature branch from `main`
2. Make your changes
3. Write/update tests
4. Create a pull request
5. Wait for review and CI checks
6. Merge after approval

## Deployment

### Production Setup

1. Build production images:
   ```bash
   docker-compose -f docker-compose.prod.yml build
   ```

2. Configure production environment:
   - Set up SSL certificates
   - Configure production database
   - Set up proper environment variables

3. Deploy:
   ```bash
   docker-compose -f docker-compose.prod.yml up -d
   ```

### Monitoring

- Use Symfony's built-in profiler in dev
- Configure logging for production
- Set up error tracking (e.g., Sentry)
- Monitor server resources

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, please open an issue in the repository or contact the development team. 
