/** @type {import('next').NextConfig} */
const nextConfig = {
  images: {
    domains: ['localhost', 'images.unsplash.com'], // Add your image domains here
  },
  experimental: {
    serverActions: true,
  },
}

module.exports = nextConfig 