# ChatApp 💬

A modern, real-time chat application built with PHP, MySQL, and JavaScript. This application allows users to register, sign in, and chat with other users in real-time with a beautiful neumorphic design.

![ChatApp Banner](assets/screenshots/banner.png)

## ✨ Features

- **User Authentication**: Secure signup and signin system
- **Real-time Messaging**: Instant messaging between users
- **User Profiles**: Customizable user profiles with photo upload
- **Online Status**: See who's online or offline
- **Search Users**: Find and start conversations with other users
- **Responsive Design**: Works on desktop and mobile devices
- **Neumorphic UI**: Modern and elegant user interface
- **Emoji Support**: Express yourself with emojis in messages
- **Profile Management**: Update personal information and profile pictures

## 📸 Screenshots

### Sign In Page
![Sign In](assets/screenshots/signin.png)

### Sign Up Page
![Sign Up](assets/screenshots/signup.png)

### Chat Interface
![Chat Interface](assets/screenshots/chat-interface.png)

### User List
![User List](assets/screenshots/user-list.png)

### Profile Page
![Profile](assets/screenshots/profile.png)

## 🛠️ Tech Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Styling**: Bootstrap 5, Custom Neumorphic CSS
- **Icons**: Font Awesome 6.1.1
- **Emoji**: EmojiOneArea
- **AJAX**: jQuery for real-time updates

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Web server (Apache/Nginx) or XAMPP/WAMP/MAMP
- Modern web browser

## 🚀 Local Installation

### Method 1: Using XAMPP (Recommended for Windows)

1. **Download and Install XAMPP**
   ```
   Download from: https://www.apachefriends.org/
   ```

2. **Clone the Repository**
   ```bash
   git clone https://github.com/mohatamimhaque/chatapp.git
   ```

3. **Move to XAMPP Directory**
   ```bash
   # Copy the chatapp folder to your XAMPP htdocs directory
   # Windows: C:\xampp\htdocs\
   # macOS: /Applications/XAMPP/htdocs/
   # Linux: /opt/lampp/htdocs/
   ```

4. **Start XAMPP Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

5. **Create Database**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create a new database named `chatapp`
   - Import the SQL file: `chatapp.sql`

6. **Configure Database Connection**
   - Open `includes/config.php`
   - Update database credentials if needed:
   ```php
   $host = "localhost";
   $username = "root";
   $password = "";
   $database = "chatapp";
   ```

7. **Create Upload Directory**
   ```bash
   # Make sure the upload directory has write permissions
   chmod 755 upload/
   chmod 755 upload/image/
   ```

8. **Access the Application**
   ```
   http://localhost/chatapp
   ```

### Method 2: Using Native LAMP Stack

1. **Install LAMP Stack**
   ```bash
   # Ubuntu/Debian
   sudo apt update
   sudo apt install apache2 mysql-server php php-mysql php-gd php-mbstring
   
   # CentOS/RHEL
   sudo yum install httpd mysql-server php php-mysql php-gd php-mbstring
   ```

2. **Clone Repository**
   ```bash
   cd /var/www/html
   sudo git clone https://github.com/mohatamimhaque/chatapp.git
   sudo chown -R www-data:www-data chatapp/
   sudo chmod -R 755 chatapp/
   ```

3. **Setup Database**
   ```bash
   mysql -u root -p
   CREATE DATABASE chatapp;
   USE chatapp;
   SOURCE /var/www/html/chatapp/chatapp.sql;
   ```

4. **Configure Virtual Host (Optional)**
   ```apache
   <VirtualHost *:80>
       DocumentRoot /var/www/html/chatapp
       ServerName chatapp.local
       <Directory /var/www/html/chatapp>
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

5. **Restart Services**
   ```bash
   sudo systemctl restart apache2
   sudo systemctl restart mysql
   ```

## ☁️ Online Deployment

### Deploy on Render

1. **Prepare for Deployment**
   - Fork this repository to your GitHub account
   - Create a `render.yaml` file in the root directory:

   ```yaml
   services:
     - type: web
       name: chatapp
       env: php
       buildCommand: composer install --no-dev --optimize-autoloader
       startCommand: php -S 0.0.0.0:$PORT -t .
       envVars:
         - key: PHP_VERSION
           value: "8.1"
   ```

2. **Database Setup on Render**
   - Create a PostgreSQL database service on Render
   - Update `includes/config.php` for PostgreSQL:
   ```php
   // For PostgreSQL on Render
   $host = $_ENV['DATABASE_HOST'];
   $username = $_ENV['DATABASE_USER'];
   $password = $_ENV['DATABASE_PASS'];
   $database = $_ENV['DATABASE_NAME'];
   $port = $_ENV['DATABASE_PORT'];
   
   $con = pg_connect("host=$host port=$port dbname=$database user=$username password=$password");
   ```

3. **Deploy Steps**
   - Connect your GitHub repository to Render
   - Set environment variables in Render dashboard
   - Deploy the application

### Deploy on Heroku

1. **Install Heroku CLI**
   ```bash
   # Download from: https://devcenter.heroku.com/articles/heroku-cli
   ```

2. **Prepare Application**
   ```bash
   git clone https://github.com/mohatamimhaque/chatapp.git
   cd chatapp
   ```

3. **Create Heroku App**
   ```bash
   heroku create your-chatapp-name
   heroku addons:create cleardb:ignite
   ```

4. **Configure Database**
   ```bash
   heroku config:get CLEARDB_DATABASE_URL
   # Update config.php with the provided database URL
   ```

5. **Deploy**
   ```bash
   git add .
   git commit -m "Deploy to Heroku"
   git push heroku main
   ```

### Deploy on Traditional Shared Hosting

1. **Upload Files**
   - Upload all files via FTP/cPanel File Manager
   - Extract in your domain's public_html directory

2. **Create Database**
   - Create MySQL database via cPanel
   - Import `chatapp.sql` using phpMyAdmin

3. **Update Configuration**
   - Update `includes/config.php` with your hosting database credentials
   - Update the `base_url()` function with your domain

4. **Set Permissions**
   ```bash
   chmod 755 upload/
   chmod 755 upload/image/
   ```

## 🔧 Configuration

### Environment Variables

Create a `.env` file for production environments:

```env
DB_HOST=localhost
DB_USER=your_username
DB_PASS=your_password
DB_NAME=chatapp
BASE_URL=https://yourdomain.com/
TIMEZONE=Asia/Dhaka
```

### Important Files to Configure

1. **includes/config.php** - Database configuration
2. **includes/status.php** - User status management
3. **assets/css/style.css** - Custom styling
4. **assets/js/script.js** - Frontend JavaScript functionality

## 📱 Usage

### Getting Started

1. **Sign Up**
   - Visit the application URL
   - Click "Create an Account"
   - Fill in your details and upload a profile picture
   - Verify your account

2. **Start Chatting**
   - Sign in with your credentials
   - Browse online users
   - Click on a user to start chatting
   - Send messages with emoji support

3. **Manage Profile**
   - Click on your profile name
   - Update personal information
   - Change profile picture
   - Update account status

### Features Guide

- **Search Users**: Use the search bar to find specific users
- **Online Status**: Green indicator shows online users
- **Message Status**: See message delivery status
- **Emoji Support**: Click emoji button to add emojis
- **Responsive Design**: Works on all device sizes

## 🔒 Security Features

- **Session Management**: Secure PHP sessions
- **Input Validation**: Server-side input validation
- **SQL Injection Protection**: Prepared statements
- **File Upload Security**: Validated file uploads
- **XSS Protection**: Output escaping

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   ```
   Solution: Check database credentials in includes/config.php
   ```

2. **Image Upload Not Working**
   ```
   Solution: Check upload/ directory permissions (chmod 755)
   ```

3. **Real-time Chat Not Working**
   ```
   Solution: Ensure JavaScript is enabled and AJAX requests are working
   ```

4. **Styling Issues**
   ```
   Solution: Clear browser cache and check CSS/JS file paths
   ```

### Debug Mode

Enable debug mode by adding this to `config.php`:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Development Setup

```bash
git clone https://github.com/mohatamimhaque/chatapp.git
cd chatapp
# Set up local development environment as described above
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Mohatamim Haque**
- GitHub: [@mohatamimhaque](https://github.com/mohatamimhaque)
- Email: [your-email@example.com]

## 🙏 Acknowledgments

- Bootstrap team for the responsive framework
- Font Awesome for the beautiful icons
- EmojiOneArea for emoji support
- The PHP community for excellent documentation

## 📊 Project Stats

- **Language**: PHP
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **License**: MIT
- **Version**: 1.0.0

## 🔮 Future Enhancements

- [ ] Group chat functionality
- [ ] Voice message support
- [ ] File sharing capabilities
- [ ] Push notifications
- [ ] Mobile app (React Native/Flutter)
- [ ] Video calling integration
- [ ] Message encryption
- [ ] Theme customization
- [ ] Multi-language support

## 📞 Support

If you encounter any issues or have questions:

1. Check the [Issues](https://github.com/mohatamimhaque/chatapp/issues) page
2. Create a new issue with detailed information
3. Contact the maintainer

---

⭐ If you found this project helpful, please give it a star!

**Happy Chatting!** 🎉