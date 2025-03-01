# Colors for better visibility
YELLOW := \033[1;33m
GREEN := \033[1;32m
RED := \033[1;31m
NC := \033[0m # No Color

# Project variables
DOCKER_COMPOSE = docker compose
SYMFONY = $(DOCKER_COMPOSE) exec -T backend php bin/console
COMPOSER = $(DOCKER_COMPOSE) exec -T backend composer
NPM = $(DOCKER_COMPOSE) exec -T frontend npm

.PHONY: help
## Display help information
help:
	@echo "$(YELLOW)Mercadona Project Makefile$(NC)"
	@echo "$(GREEN)Available commands:$(NC)"
	@echo ""
	@echo "$(YELLOW)Docker Commands:$(NC)"
	@echo "  make up               - Start all docker containers"
	@echo "  make down             - Stop all docker containers"
	@echo "  make build            - Build docker images"
	@echo "  make build-no-cache   - Build docker images without cache"
	@echo "  make logs             - Show docker logs"
	@echo "  make restart          - Restart all services"
	@echo "  make restart-backend  - Restart only backend service"
	@echo "  make restart-frontend - Restart only frontend service"
	@echo ""
	@echo "$(YELLOW)Backend Commands:$(NC)"
	@echo "  make backend-install - Install Symfony dependencies"
	@echo "  make zsh             - Access backend container with Zsh"
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

.PHONY: init
init:
	@echo "$(GREEN)Initializing project...$(NC)"
	make down
	echo "$(YELLOW)Building docker images without cache...$(NC)"
	make build-no-cache
	echo "$(GREEN)Starting docker containers...$(NC)"
	make up
	echo "$(GREEN)Installing dependencies...$(NC)"
	make install
	echo "$(GREEN)Initializing database...$(NC)"
	make db-init
	echo "$(GREEN)Running database migrations...$(NC)"
	make db-migrate
	echo "$(GREEN)Loading fixtures...$(NC)"
	make db-fixtures

# Docker commands
.PHONY: up down build build-no-cache logs check-docker check-containers
up: check-docker
	@echo "$(GREEN)Starting docker containers...$(NC)"
	$(DOCKER_COMPOSE) up -d
	@echo "$(GREEN)Waiting for containers to be ready...$(NC)"
	@sleep 5
	@$(MAKE) check-containers

down:
	@echo "$(YELLOW)Stopping docker containers...$(NC)"
	$(DOCKER_COMPOSE) stop

build:
	@echo "$(GREEN)Building docker images...$(NC)"
	$(DOCKER_COMPOSE) build

build-no-cache:
	@echo "$(GREEN)Building docker images without cache...$(NC)"
	$(DOCKER_COMPOSE) build --no-cache

logs:
	$(DOCKER_COMPOSE) logs -f

# Backend commands
.PHONY: backend-install backend-start backend-stop backend-test backend-lint backend-cache zsh
backend-install:
	@echo "$(GREEN)Installing Symfony dependencies...$(NC)"
	$(COMPOSER) install --no-interaction

backend-start:
	@echo "$(GREEN)Starting Symfony server...$(NC)"
	@echo "$(YELLOW)Note: Symfony server not needed - PHP-FPM runs in container$(NC)"

backend-stop:
	@echo "$(YELLOW)Stopping Symfony server...$(NC)"
	@echo "$(YELLOW)Note: Symfony server not needed - PHP-FPM runs in container$(NC)"

backend-test:
	@echo "$(GREEN)Running PHPUnit tests...$(NC)"
	$(DOCKER_COMPOSE) exec -T backend ./vendor/bin/phpunit

backend-lint:
	@echo "$(GREEN)Running PHP CS Fixer...$(NC)"
	$(DOCKER_COMPOSE) exec -T backend ./vendor/bin/php-cs-fixer fix

backend-cache:
	@echo "$(GREEN)Clearing Symfony cache...$(NC)"
	$(SYMFONY) cache:clear

# Database commands
.PHONY: db-init db-migrate db-fixtures
db-init: 
	@echo "$(GREEN)Initializing database...$(NC)"
	$(SYMFONY) doctrine:database:drop --force --if-exists
	$(SYMFONY) doctrine:database:create
	$(SYMFONY) doctrine:migrations:migrate --no-interaction

db-migrate:
	@echo "$(GREEN)Running database migrations...$(NC)"
	$(SYMFONY) doctrine:migrations:migrate --no-interaction

db-fixtures:
	@echo "$(GREEN)Loading fixtures...$(NC)"
	$(SYMFONY) doctrine:fixtures:load --no-interaction

# Frontend commands
.PHONY: frontend-install frontend-dev frontend-build frontend-lint frontend-test
frontend-install:
	@echo "$(GREEN)Installing Node dependencies...$(NC)"
	$(NPM) install --no-audit

frontend-dev:
	@echo "$(GREEN)Starting Next.js development server...$(NC)"
	@echo "$(YELLOW)Note: Next.js dev server runs automatically in container$(NC)"

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
.PHONY: install start stop clean setup restart restart-backend restart-frontend
install: up backend-install frontend-install
	@echo "$(GREEN)All dependencies installed successfully!$(NC)"

start: up
	@echo "$(GREEN)Application started successfully!$(NC)"
	@echo "$(GREEN)Backend API available at http://localhost:8000$(NC)"
	@echo "$(GREEN)Frontend available at http://localhost:3000$(NC)"

stop: down
	@echo "$(YELLOW)Application stopped successfully!$(NC)"

clean:
	@echo "$(RED)Cleaning project...$(NC)"
	$(DOCKER_COMPOSE) down -v --remove-orphans
	rm -rf backend/var/cache/*
	rm -rf frontend/.next
	rm -rf frontend/node_modules
	rm -rf backend/vendor
	@echo "$(GREEN)Clean completed!$(NC)"

setup: check-docker build install db-init db-fixtures
	@echo "$(GREEN)Project setup completed successfully!$(NC)"
	@echo "$(GREEN)Backend API available at http://localhost:8000$(NC)"
	@echo "$(GREEN)Frontend available at http://localhost:3000$(NC)"

# Add container status check
check-containers:
	@echo "$(GREEN)Checking container status...$(NC)"
	@$(DOCKER_COMPOSE) ps backend | grep -q "Up" || (echo "$(RED)Error: Backend container not running$(NC)" && exit 1)
	@$(DOCKER_COMPOSE) ps frontend | grep -q "Up" || (echo "$(RED)Error: Frontend container not running$(NC)" && exit 1)

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

# Add new check-docker target
check-docker:
	@echo "$(GREEN)Checking Docker installation...$(NC)"
	@docker info >/dev/null 2>&1 || (echo "$(RED)Error: Docker daemon not running$(NC)" && exit 1)
	@docker compose version >/dev/null 2>&1 || (echo "$(RED)Error: Docker Compose not installed$(NC)" && exit 1)

# Default target
.DEFAULT_GOAL := help 
