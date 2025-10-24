import { execSync } from 'child_process';
import fs from 'fs-extra';

// Build script for Vercel deployment
console.log('Building assets with Vite...');
execSync('npm run build', { stdio: 'inherit' });

console.log('Creating dist directory...');
fs.ensureDirSync('dist');

console.log('Copying all necessary files to dist...');
// Copy bootstrap, config, routes, resources, app, database, storage
fs.copySync('bootstrap', 'dist/bootstrap', { overwrite: true });
fs.copySync('config', 'dist/config', { overwrite: true });
fs.copySync('routes', 'dist/routes', { overwrite: true });
fs.copySync('resources', 'dist/resources', { overwrite: true });
fs.copySync('app', 'dist/app', { overwrite: true });
fs.copySync('database', 'dist/database', { overwrite: true });
fs.copySync('storage', 'dist/storage', { overwrite: true });

console.log('Copying public directory to dist...');
fs.copySync('public', 'dist/public', { overwrite: true });

console.log('Creating api directory and index.php...');
fs.ensureDirSync('dist/api');
const indexPhpContent = `<?php
require __DIR__ . '/../public/index.php';
`;
fs.writeFileSync('dist/api/index.php', indexPhpContent);

console.log('Copying root files...');
fs.copyFileSync('artisan', 'dist/artisan');

console.log('Build completed successfully!');
