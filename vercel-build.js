import { execSync } from 'child_process';
import fs from 'fs-extra';

// Build script for Vercel deployment
console.log('Building assets with Vite...');
execSync('npm run build', { stdio: 'inherit' });

console.log('Ensuring api/index.php exists...');
fs.ensureDirSync('api');
const indexPhpContent = `<?php
require __DIR__ . '/../public/index.php';
`;
fs.writeFileSync('api/index.php', indexPhpContent);

console.log('Build completed successfully!');
