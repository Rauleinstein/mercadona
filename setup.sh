#!/bin/bash

# Create necessary directories
mkdir -p backend/var/cache
mkdir -p backend/var/log
mkdir -p backend/config/jwt
mkdir -p docker/nginx/conf.d
mkdir -p frontend/.next
mkdir -p frontend/node_modules

# Set permissions
chmod -R 777 backend/var
chmod -R 777 backend/config/jwt

# Create .env files if they don't exist
if [ ! -f .env ]; then
    cp .env.example .env 2>/dev/null || echo "No .env.example found"
fi

if [ ! -f backend/.env ]; then
    cp backend/.env.example backend/.env 2>/dev/null || echo "No backend/.env.example found"
fi

if [ ! -f frontend/.env ]; then
    cp frontend/.env.example frontend/.env 2>/dev/null || echo "No frontend/.env.example found"
fi

echo "Setup completed!" 
