#!/bin/bash

# ChatApp Installation Script
# This script helps set up ChatApp on a local development environment

echo "🚀 ChatApp Installation Script"
echo "=============================="

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 7.4 or higher."
    exit 1
fi

# Check PHP version
PHP_VERSION=$(php -r "echo PHP_VERSION;")
echo "✅ PHP $PHP_VERSION detected"

# Check if MySQL is available
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL client not found. Make sure MySQL/MariaDB is installed."
fi

# Create upload directories
echo "📁 Creating upload directories..."
mkdir -p upload/image
chmod 755 upload
chmod 755 upload/image
echo "✅ Upload directories created"

# Check if database exists
echo "🗄️  Database Setup"
echo "=================="
echo "Please ensure you have:"
echo "1. Created a MySQL database named 'chatapp'"
echo "2. Imported the chatapp.sql file"
echo "3. Updated includes/config.php with your database credentials"
echo ""

# Check configuration
if [ -f "includes/config.php" ]; then
    echo "✅ Configuration file found"
else
    echo "❌ Configuration file missing: includes/config.php"
fi

# Start local server (optional)
read -p "🌐 Would you like to start a local PHP server? (y/n): " START_SERVER

if [ "$START_SERVER" = "y" ] || [ "$START_SERVER" = "Y" ]; then
    echo "🚀 Starting PHP development server..."
    echo "📱 Access your app at: http://localhost:8000"
    echo "🛑 Press Ctrl+C to stop the server"
    php -S localhost:8000
else
    echo "✅ Setup complete!"
    echo ""
    echo "📝 Next Steps:"
    echo "1. Configure your web server (Apache/Nginx) to serve this directory"
    echo "2. Or use XAMPP/WAMP and place this folder in htdocs"
    echo "3. Access the application through your web server"
    echo ""
    echo "🔗 Useful URLs:"
    echo "   - Local XAMPP: http://localhost/chatapp"
    echo "   - Local server: php -S localhost:8000"
fi