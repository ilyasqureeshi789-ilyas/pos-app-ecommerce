# SMI Store - Laravel eCommerce CRUD Application

A complete eCommerce web application built with Laravel featuring product management, shopping cart, and order processing.

## 🚀 Features

- **Product Management**
  - Create, Read, Update, Delete products
  - Product categories and brands
  - Image upload functionality
  - Stock management

- **Shopping Experience**
  - Advanced filtering (by category, brand, search)
  - Shopping cart with quantity management
  - Session-based cart storage
  - Product search functionality

- **Order System**
  - Checkout process
  - Order placement
  - Order history

- **User Interface**
  - Responsive Bootstrap design
  - Mobile-friendly layout
  - Professional product displays
  - Category-based browsing

## 🛠️ Technology Stack

- **Backend**: Laravel 12.36.1
- **Frontend**: Bootstrap 5.3, Font Awesome
- **Database**: MySQL
- **PHP**: 8.2.12

## 📦 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL
- Node.js (for frontend assets)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/mystore-ecommerce.git
   cd mystore-ecommerce
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install && npm run build
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mystore
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

## 🗄️ Database Structure

### Main Tables
- `users` - User accounts
- `products` - Product catalog
- `sessions` - User sessions
- `cache` - Application cache
- `jobs` - Queue jobs

### Product Fields
- `name` - Product name
- `brand` - Product brand (Dell, HP, Apple, etc.)
- `description` - Product description
- `price` - Product price
- `stock` - Available quantity
- `category` - Product category
- `image` - Product image path
- `user_id` - Product owner

## 🎯 Usage

### Adding Products
1. Navigate to `/products`
2. Click "Add New Product"
3. Fill in product details
4. Upload product image
5. Submit form

### Shopping Process
1. Browse products on homepage
2. Use filters to find specific items
3. Add products to cart
4. Adjust quantities in cart
5. Proceed to checkout
6. Place order

### Categories & Brands
**Predefined Categories:**
- Laptops
- Mobiles  
- Computers
- Accessories

**Predefined Brands:**
- Dell, HP, Lenovo, Apple, Samsung
- Asus, Acer, Microsoft, Sony, Toshiba
- LG, Google, OnePlus, Xiaomi, Huawei

## 🔧 API Routes

### Web Routes
- `GET /` - Homepage
- `GET /products` - Product listing
- `POST /products` - Create product
- `GET /products/create` - Product creation form
- `GET /products/{id}` - Product details
- `GET /products/{id}/edit` - Product edit form
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product

### Cart Routes
- `GET /cart` - View cart
- `POST /cart/add/{id}` - Add to cart
- `POST /cart/remove/{id}` - Remove from cart
- `POST /cart/clear` - Clear cart
- `POST /cart/update/{id}` - Update quantity
- `POST /cart/update-quantity/{id}` - Adjust quantity
  
### Order Routes
- `GET /checkout` - Checkout page
- `POST /order/place` - Place order
- `GET /orders` - Order history

## 🎨 Frontend Features

- **Responsive Design**: Works on all devices
- **Bootstrap 5**: Modern UI components
- **Font Awesome**: Professional icons
- **Image Optimization**: Proper image handling
- **Interactive Cart**: Real-time quantity updates
- **Advanced Filtering**: Multi-criteria product search

## 📱 Screenshots

*(Add your application screenshots here)*

- Homepage with category browsing
- Product listing with filters  
- Product detail pages
- Shopping cart interface
- Checkout process

## 🤝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 🐛 Troubleshooting

### Common Issues

1. **Migration errors**
   ```bash
   php artisan migrate:fresh
   ```

2. **Image upload issues**
   ```bash
   php artisan storage:link
   ```

3. **Cart session problems**
   - Clear browser cache
   - Check session configuration

4. **Filter not working**
   - Ensure products exist in database
   - Check category/brand assignments

## 🔮 Future Enhancements

- [ ] User authentication system
- [ ] Payment gateway integration
- [ ] Order email notifications
- [ ] Product reviews and ratings
- [ ] Wishlist functionality
- [ ] Admin dashboard
- [ ] Inventory management
- [ ] Sales reporting

**Built with ❤️ using Laravel**
