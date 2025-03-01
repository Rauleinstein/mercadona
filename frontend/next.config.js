/** @type {import('next').NextConfig} */
const nextConfig = {
  images: {
    domains: ['localhost'], // Add your image domains here
  },
  experimental: {
    serverActions: true,
  },
}

module.exports = nextConfig 