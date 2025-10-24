import { execSync } from 'child_process';
import fs from 'fs-extra';

console.log('Building assets with Vite...');
execSync('npm run build', { stdio: 'inherit' });

console.log('Creating dist directory...');
fs.ensureDirSync('dist');

console.log('Copying public directory to dist...');
fs.copySync('public', 'dist', { overwrite: true });

console.log('Copying api directory to dist...');
fs.copySync('api', 'dist/api', { overwrite: true });

console.log('Build completed successfully!');
