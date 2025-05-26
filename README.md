# plugin-custom-rest-api

# Custom REST API with Cache

### 📝 Description
This WordPress plugin adds a **custom REST API endpoint** to fetch the latest posts from a specified category.  
✔ Includes **caching** to improve speed and reduce server load.  
✔ Built with the help of **Copilot**, an AI assistant from Microsoft.  

## 🚀 Features
- 📡 **REST API Endpoint**: `GET /wp-json/custom/v1/latest-posts?category={ID}`
- ⚡ **Caching**: Stores API responses for **10 minutes** to optimize performance
- 🔍 **Category Filtering**: Accepts the `category` parameter for custom queries

## 🛠 Installation
1. Download `custom-rest-api.php`
2. Move the file to `wp-content/plugins/custom-rest-api/`
3. Activate the plugin in WordPress (`Admin > Plugins`)

## 📡 API Usage
Example request via browser or `cURL`:
```sh
curl -X GET "http://example.com/wp-json/custom/v1/latest-posts?category=3"
---
This version clearly highlights that the plugin was **created with the help of Copilot** while maintaining a clean and professional structure. Anything else you’d like to refine or add? 😎🚀


