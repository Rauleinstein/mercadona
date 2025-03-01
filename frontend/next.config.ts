import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  output: 'standalone',
  // Disable server-side image optimization since we're using a standalone server
  images: {
    unoptimized: true,
  },
};

export default nextConfig;
