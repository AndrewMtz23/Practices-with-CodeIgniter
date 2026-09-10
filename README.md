# Interactive Web Applications with CodeIgniter & Modern Web APIs

A comprehensive monorepo containing laboratory assignments and projects developed for the **Interactive Web Applications (AWI - Industry 4.0)** curriculum. The repository showcases the progression from decoupled PHP backends (CodeIgniter 3) exposing RESTful APIs to modern frontend architectures incorporating data visualization, geospatial mapping, and Single Page Applications (React).

---

## Repository Structure

The repository is organized as a monorepo where each directory represents an independent module or practice. Each project contains its own configuration, views, and client/service components.

```text
.
├── bd_awi4_t218.sql            # Master MySQL database schema and sample seed data
├── configuracion.txt           # Apache mod_rewrite (.htaccess) and base_url reference
├── practica1/                  # RESTful Web Service (JSON/XML) with AJAX Client
├── practica2/                  # Interactive Time-Series Charts with Highcharts JS
├── practica3/                  # Single View Application (SVA) with Student Performance Analytics
├── practica4/                  # Google Maps JavaScript API: Dynamic Markers & Animations
├── practica5c/                 # Geospatial Student Mapping with Database Synchronization
├── practica6/                  # Full-Stack Dashboard using React and CodeIgniter REST API
├── practica7 (AquaBite)/       # Full Commercial Platform: Catalog, Admin Panel & User Auth
└── practica8/                  # Social Authentication Workflow with Facebook OAuth in React
```

---

## Practices Summary

| Directory | Title | Core Technologies | Primary Objective |
| :--- | :--- | :--- | :--- |
| [`practica1/`](./practica1/) | REST API with CodeIgniter | PHP, CodeIgniter 3, jQuery, XML/JSON | Expose CRUD endpoints for promotions and products supporting both JSON and XML content negotiation. |
| [`practica2/`](./practica2/) | Highcharts Data Visualization | CodeIgniter 3, Highcharts JS, MySQL | Fetch historical temperature records and render interactive multi-city time-series charts. |
| [`practica3/`](./practica3/) | Single View Application | CodeIgniter 3, Highcharts, Fetch/AJAX | Student registry and academic grading system supporting standard and raw JSON payload parsing. |
| [`practica4/`](./practica4/) | Google Maps API & Events | JavaScript, Google Maps API, Bootstrap 5 | Interactive map allowing custom coordinate marking, bounce animations, and marker lifecycle control. |
| [`practica5c/`](./practica5c/) | Geospatial Student Locator | CodeIgniter 3, Google Maps API, MySQL | Modal-based geolocation allowing coordinate capture and database updates for registered students. |
| [`practica6/`](./practica6/) | React & PHP Dashboard | React 18, React-Bootstrap, Highcharts | Modern SPA frontend consuming CodeIgniter REST endpoints for charts and map rendering. |
| [`practica7 (AquaBite)/`](./practica7%20(AquaBite)/) | AquaBite Web Platform | CodeIgniter 3, BCRYPT, Bootstrap | E-commerce platform with customer storefront, admin dashboard, and secure user authentication. |
| [`practica8/`](./practica8/) | Facebook OAuth Integration | React 18, `react-facebook-login` | Third-party social login integration capturing user profile data and handling state routing. |

---

## Environment Requirements

To run these projects locally, ensure the following software is installed and configured:

* **Web Server:** Apache 2.4+ with `mod_rewrite` enabled
* **PHP Engine:** PHP 7.4 or 8.x
* **Database:** MySQL 5.7+ or MariaDB 10.4+
* **Node Environment:** Node.js 16+ and npm 8+ (for `practica6` and `practica8`)
* **PHP Extensions:** `mysqli`, `curl`, `json`, `mbstring`, `openssl`

---

## Database Setup

1. Open your MySQL client (phpMyAdmin, MySQL Workbench, or CLI).
2. Create a new database named `bd_awi4_t218`:
   ```sql
   CREATE DATABASE bd_awi4_t218 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```
3. Import the SQL dump located at the root of this repository:
   ```bash
   mysql -u root -p bd_awi4_t218 < bd_awi4_t218.sql
   ```
4. For Practice 7 (`AquaBite`), note that the service connects to `aquabite`. You may either create an `aquabite` database or point `database.php` to your designated database name.

---

## Server & Base URL Configuration

Each CodeIgniter instance requires its base URL to match your local host setup:

1. Open the corresponding configuration file:
   ```text
   [practice]/app/application/config/config.php
   [practice]/webservice/application/config/config.php
   ```
2. Set the `$config['base_url']` according to your local Apache alias or virtual host:
   ```php
   $config['base_url'] = 'http://localhost/Practices-with-CodeIgniter/practica1/app/';
   ```
3. Ensure Apache allows `.htaccess` overrides by setting `AllowOverride All` in your Apache `httpd.conf` or virtual host configuration.

---

## License & Academic Disclaimer

These projects were created for educational purposes within the academic period at Universidad Tecnológica de Querétaro. All trademarks, logos, and external libraries are the property of their respective owners.
