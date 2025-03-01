# 🥘 Mercadona Recipe Manager

A modern, full-stack recipe management and grocery shopping application built with Next.js and Symfony.

## 🌟 Overview

Mercadona Recipe Manager is a comprehensive platform that revolutionizes how users manage recipes, plan meals, and handle grocery shopping. The application combines recipe management with smart shopping features and social interactions, creating a seamless cooking and shopping experience.

## ✨ Core Features

### 📖 Recipe Management
- **Recipe Creation & Editing**
  - Detailed recipe information (name, description, cooking time, difficulty)
  - Step-by-step cooking instructions with rich text formatting
  - Serving size customization
  - Multi-category and tag system
  - High-quality photo management
  - Nutritional information calculation

### 🥕 Ingredient System
- **Smart Ingredient Database**
  - Comprehensive ingredient profiles
  - Real-time price tracking across supermarkets
  - Standardized measurement units
  - Detailed nutritional information
  - Smart alternative ingredient suggestions
  - Seasonal ingredient indicators

### 🛒 Shopping Experience
- **Intelligent Shopping Lists**
  - One-click ingredient to shopping list conversion
  - Automatic quantity aggregation
  - Real-time price comparison
  - Smart store section organization
  - Purchase tracking
  - Favorite items management
  - Multi-list support

### 👥 Social Features
- **Community Engagement**
  - Recipe sharing and discovery
  - User following system
  - Rating and review system
  - Public/private recipe collections
  - Collaborative shopping lists
  - Recipe export in multiple formats

### 🔍 Smart Search & Filtering
- **Advanced Search Capabilities**
  - Ingredient-based search
  - Time and difficulty filters
  - Dietary restriction filtering
  - Budget-based search
  - Smart recipe recommendations

### 🧠 AI-Powered Features
- **Intelligent Assistance**
  - Automatic portion scaling
  - Dynamic cost calculation
  - Smart meal planning
  - Personalized recipe recommendations
  - Inventory management suggestions

### 📱 User Experience
- **Modern Interface**
  - Responsive design
  - Dark/light mode
  - Offline support
  - Cross-device synchronization
  - Accessibility compliance

## 🛠 Technical Stack

### Frontend
- Next.js 14+ with App Router
- TypeScript 5+
- TailwindCSS for styling
- React Query for data fetching
- Zod for validation
- Jest & React Testing Library

### Backend
- Symfony 6.3+
- PHP 8.2+
- API Platform
- Doctrine ORM
- JWT Authentication
- MySQL/PostgreSQL

### Infrastructure
- Docker containerization
- Redis caching
- Nginx reverse proxy
- CI/CD with GitHub Actions
- AWS/Vercel deployment

## 🚀 Getting Started

Detailed installation and setup instructions will be provided in the `.setup` directory.

## 📈 Roadmap

- [ ] Core recipe management system
- [ ] Ingredient database integration
- [ ] Shopping list functionality
- [ ] Social features implementation
- [ ] AI-powered recommendations
- [ ] Mobile app development
- [ ] Integration with major supermarket APIs
- [ ] Advanced analytics dashboard

## 🤝 Contributing

We welcome contributions! Please see our contributing guidelines for more details.

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🔗 Links

- [Documentation](docs/)
- [API Reference](api-docs/)
- [Contributing Guidelines](CONTRIBUTING.md)
- [Code of Conduct](CODE_OF_CONDUCT.md)

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
