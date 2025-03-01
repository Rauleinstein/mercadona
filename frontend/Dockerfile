# Development setup with hot reload
FROM node:20-alpine

# Set working directory and environment
WORKDIR /app
ENV NODE_ENV development
ENV NEXT_TELEMETRY_DISABLED 1

# Install dependencies including dev dependencies
COPY package*.json ./
RUN npm install --include=dev

# Copy source code
COPY . .

# Expose port and run dev server with hot reload
EXPOSE 3000
CMD ["npm", "run", "dev"]
