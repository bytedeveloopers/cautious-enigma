#!/bin/bash

# Build assets with Vite
npm run build

# Create output directory
mkdir -p dist

# Copy public directory contents to dist
cp -r public/* dist/

# Copy api directory
cp -r api dist/

echo "Build completed successfully"
