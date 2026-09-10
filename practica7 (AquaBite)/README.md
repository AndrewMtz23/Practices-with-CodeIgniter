# Practice 7: AquaBite E-Commerce & Management Platform

## Overview

Practice 7, entitled **AquaBite**, represents a commercial web application encompassing storefront views, customer self-service workflows, administrative management consoles, and secure RESTful backend services. The architecture implements role-based route separation and applies industry-standard cryptographic practices for user credential storage.

---

## Architectural Separation

The application is structured into two core subsystems:
* **`app/`**: Client-facing portal and administrative panel built with CodeIgniter controllers and server-rendered views.
  * Public Views: `inicio` (Storefront Home), `acerca` (About Us), `cia` (Company Profile), `login` (Customer Login), `registro` (Customer Registration).
  * Administrative Views: `login_admin` (Admin Authentication), `home_admin` (Administrative Control Panel).
* **`webservice/`**: RESTful API service handling account persistence, role validation, and catalog management.

---

## Technical Stack

* **Backend Framework:** CodeIgniter 3.1.x (PHP)
* **Authentication & Cryptography:** PHP Native `password_hash()` utilizing the `PASSWORD_BCRYPT` algorithm
* **Frontend UI:** HTML5, CSS3, Bootstrap 5, FontAwesome 6
* **Database Engine:** MySQL / MariaDB (tables: `usuario` / `users`, `productos`, `promociones`)
* **Data Transport:** JSON over HTTP

---

## API Endpoints & Authentication Architecture

### 1. User Registration Service (`UserController.php`)

Endpoint: `POST /webservice/usercontroller/register`

Receives raw JSON payloads containing user credentials, validates required input attributes, hashes passwords using bcrypt, and persists the record:

```php
$postData = json_decode(file_get_contents('php://input'), true);

if ($postData) {
    $data = array(
        'usuario'      => $postData['usuario'],
        'email'        => $postData['email'],
        'password'     => password_hash($postData['password'], PASSWORD_BCRYPT),
        'tipo_usuario' => 1, // Default customer role
        'estatus'      => 1  // Active status
    );
    $this->db->insert('usuario', $data);
}
```

### 2. Catalog & Promotional Endpoints (`Back.php`)

* `GET /back/productos`: Retrieves product categories and items available for purchase.
* `GET /back/promociones`: Ingests active promotional deals and discounted prices.

---

## Security Features

1. **Bcrypt Password Hashing:**
   Plaintext passwords are never stored. The system relies on PHP's cryptographically secure blowfish algorithm (`PASSWORD_BCRYPT`), ensuring resistance against rainbow table and brute-force attacks.

2. **Role-Based Segmentation:**
   Differentiates between customer accounts (`tipo_usuario = 1`) and administrative personnel (`tipo_usuario = 2` or admin view routes), isolating administrative functions within protected controllers.

---

## Local Setup

1. Ensure your MySQL database server is running. Create a database named `aquabite` (or update `webservice/application/config/database.php` to point to `bd_awi4_t218`).
2. Verify that the table `usuario` contains the appropriate schema fields (`id`, `usuario`, `email`, `password`, `tipo_usuario`, `estatus`).
3. Set base URLs in both `app` and `webservice` `config.php` files.
4. Access the storefront in your web browser:
   ```text
   http://localhost/Practices-with-CodeIgniter/practica7%20(AquaBite)/app/
   ```
