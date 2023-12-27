npm install react react-dom nodemailer

npx parallel --halt --jobs 4 node_modules/react-scripts/bin/react-scripts.js build
npx parallel --halt --jobs 4 node_modules/react-scripts/bin/react-scripts.js start
