# Colors for better visibility
YELLOW := \033[1;33m
GREEN := \033[1;32m
RED := \033[1;31m
NC := \033[0m # No Color

# Project variables
DOCKER_COMPOSE = docker-compose
SYMFONY = cd backend && symfony
COMPOSER = cd backend && composer
NPM = cd frontend && npm

.PHONY: help install start stop build test lint clean setup logs restart restart-backend restart-frontend

## Display help information
help:
	@echo "$(YELLOW)Mercadona Project Makefile$(NC)"
	@echo "$(GREEN)Available commands:$(NC)"
	@echo ""
	@echo "$(YELLOW)Docker Commands:$(NC)"
	@echo "  make up              - Start all docker containers"
	@echo "  make down            - Stop all docker containers"
	@echo "  make build           - Build docker images"
	@echo "  make logs            - Show docker logs"
	@echo "  make restart         - Restart all services"
	@echo "  make restart-backend - Restart only backend service"
	@echo "  make restart-frontend - Restart only frontend service"
	@echo ""
	@echo "$(YELLOW)Backend Commands:$(NC)"
	@echo "  make backend-install - Install Symfony dependencies"
	@echo "  make zsh   - Access backend container with Zsh"
	@echo "  make backend-start   - Start Symfony server"
	@echo "  make backend-stop    - Stop Symfony server"
	@echo "  make backend-test    - Run PHPUnit tests"
	@echo "  make backend-lint    - Run PHP CS Fixer"
	@echo "  make db-init         - Initialize database"
	@echo "  make db-migrate      - Run migrations"
	@echo "  make db-fixtures     - Load fixtures"
	@echo ""
	@echo "$(YELLOW)Frontend Commands:$(NC)"
	@echo "  make frontend-install - Install Node dependencies"
	@echo "  make frontend-dev     - Start Next.js development server"
	@echo "  make frontend-build   - Build Next.js production"
	@echo "  make frontend-lint    - Run ESLint"
	@echo "  make frontend-test    - Run Jest tests"
	@echo ""
	@echo "$(YELLOW)Combined Commands:$(NC)"
	@echo "  make install         - Install all dependencies"
	@echo "  make start           - Start the entire application"
	@echo "  make stop            - Stop the entire application"
	@echo "  make clean           - Clean all generated files"
	@echo "  make setup           - Initial project setup"

# Docker commands
up:
	@echo "$(GREEN)Starting docker containers...$(NC)"
	$(DOCKER_COMPOSE) up -d

down:
	@echo "$(YELLOW)Stopping docker containers...$(NC)"
	$(DOCKER_COMPOSE) down

build:
	@echo "$(GREEN)Building docker images...$(NC)"
	$(DOCKER_COMPOSE) build

logs:
	$(DOCKER_COMPOSE) logs -f

# Backend commands
backend-install:
	@echo "$(GREEN)Installing Symfony dependencies...$(NC)"
	$(COMPOSER) install

backend-start:
	@echo "$(GREEN)Starting Symfony server...$(NC)"
	$(SYMFONY) serve -d

backend-stop:
	@echo "$(YELLOW)Stopping Symfony server...$(NC)"
	$(SYMFONY) server:stop

backend-test:
	@echo "$(GREEN)Running PHPUnit tests...$(NC)"
	cd backend && php bin/phpunit

backend-lint:
	@echo "$(GREEN)Running PHP CS Fixer...$(NC)"
	cd backend && php-cs-fixer fix

backend-cache:
	@echo "$(GREEN)Clearing Symfony cache...$(NC)"
	$(SYMFONY) console cache:clear

# Database commands
db-init: 
	@echo "$(GREEN)Initializing database...$(NC)"
	$(SYMFONY) console doctrine:database:drop --force --if-exists
	$(SYMFONY) console doctrine:database:create
	$(SYMFONY) console doctrine:migrations:migrate --no-interaction

db-migrate:
	@echo "$(GREEN)Running database migrations...$(NC)"
	$(SYMFONY) console doctrine:migrations:migrate --no-interaction

db-fixtures:
	@echo "$(GREEN)Loading fixtures...$(NC)"
	$(SYMFONY) console doctrine:fixtures:load --no-interaction

# Frontend commands
frontend-install:
	@echo "$(GREEN)Installing Node dependencies...$(NC)"
	$(NPM) install

frontend-dev:
	@echo "$(GREEN)Starting Next.js development server...$(NC)"
	$(NPM) run dev

frontend-build:
	@echo "$(GREEN)Building Next.js production...$(NC)"
	$(NPM) run build

frontend-lint:
	@echo "$(GREEN)Running ESLint...$(NC)"
	$(NPM) run lint

frontend-test:
	@echo "$(GREEN)Running Jest tests...$(NC)"
	$(NPM) run test

# Combined commands
install: backend-install frontend-install
	@echo "$(GREEN)All dependencies installed successfully!$(NC)"

start: up
	@echo "$(GREEN)Application started successfully!$(NC)"

stop: down backend-stop
	@echo "$(YELLOW)Application stopped successfully!$(NC)"

clean:
	@echo "$(RED)Cleaning project...$(NC)"
	$(DOCKER_COMPOSE) down -v
	rm -rf backend/var/cache/*
	rm -rf frontend/.next
	rm -rf frontend/node_modules
	rm -rf backend/vendor
	@echo "$(GREEN)Clean completed!$(NC)"

setup: build install db-init db-fixtures
	@echo "$(GREEN)Project setup completed successfully!$(NC)"

# Add new backend-shell command
zsh:
	@echo "$(GREEN)Accessing backend container with Zsh...$(NC)"
	$(DOCKER_COMPOSE) exec backend zsh

# Restart commands
restart: down up
	@echo "$(GREEN)All services restarted successfully!$(NC)"

restart-backend:
	@echo "$(GREEN)Restarting backend service...$(NC)"
	$(DOCKER_COMPOSE) restart backend
	@echo "$(GREEN)Backend service restarted successfully!$(NC)"

restart-frontend:
	@echo "$(GREEN)Restarting frontend service...$(NC)"
	$(DOCKER_COMPOSE) restart frontend
	@echo "$(GREEN)Frontend service restarted successfully!$(NC)"

# Default target
.DEFAULT_GOAL := help 
